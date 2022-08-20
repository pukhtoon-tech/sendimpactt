<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\MarketplaceCSV;
use App\Models\MarketplaceSell;
use App\Models\MarketplaceSetting;
use File;
use Illuminate\Http\Request;
use Mail;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Redirect;
use Session;
use Str;
use Stripe;
use URL;

class MarketplaceController extends Controller
{
    public function index()
    {
        return view('marketplace.index');
    }

    // csv_upload
    public function csv_upload(Request $request)
    {
        $country = Str::lower($request->country);

        if ($request->has('country')) {
            $check_country = MarketplaceCSV::where('country', $country)->first();
            if ($check_country == null) {
                $csv = new MarketplaceCSV;
                $csv->country = $request->country;
                $csv->type = 'email';
                $csv->save();
            } else {
                return response()->json('Country already exists', 201);
            }

            // Store Session
            Session::put('country', $country);
        }

        if ($request->hasFile('filepond')) {
            $file_extension = $request->filepond->getClientOriginalExtension();

            if ($file_extension != 'csv') {
                return response()->json('Please upload a valid CSV file.', 422);
            } else {
                $update_csv_path = MarketplaceCSV::where('country', Session::get('country'))->first();
                $update_csv_path->csv_file_path = fileUpload($request->filepond, 'marketplace/csv/email');
                $update_csv_path->save();
                // rename file name
                rename(
                    public_path($update_csv_path->csv_file_path),
                    public_path('/uploads/marketplace/csv/email/'.Session::get('country').'.csv')
                );

                $update_csv_name = MarketplaceCSV::where('country', Session::get('country'))->first();
                $update_csv_name->csv_file_path = Session::get('country').'.csv';
                $update_csv_name->save();

                Session::forget('country');
            }
        }

        return response()->json('CSV file uploaded successfully', 200);
    }

    // csv_downlaoad
    public function csv_downlaoad($country_code)
    {
        $country = Str::lower($country_code);
        $csv_file_path = MarketplaceCSV::where('country', $country)->first();

        return response()->download(public_path('/uploads/marketplace/csv/email/'.$csv_file_path->csv_file_path));
    }

    // csv_destroy
    public function csv_destroy($country_code)
    {
        $country = Str::lower($country_code);
        $csv_file_path = MarketplaceCSV::where('country', $country)->first();
        // delete file
        unlink(public_path('/uploads/marketplace/csv/email/'.$csv_file_path->csv_file_path));

        // delete from marketplace_settings
        $marketplace_setting = MarketplaceSetting::where('csv_id', $csv_file_path->id)->delete();

        $csv_file_path->delete();
        Alert::success(translate('Success'), translate('CSV file deleted successfully'));

        return back();
    }

    // csv_update
    public function csv_update(Request $request, $country_code)
    {
        $country = Str::lower($country_code);
        $csv_file_path = MarketplaceCSV::where('country', $country)->first();

        // delete file
        unlink(public_path('/uploads/marketplace/csv/email/'.$csv_file_path->csv_file_path));

        $csv_file_path->csv_file_path = fileUpload($request->csv_update, 'marketplace/csv/email');
        $csv_file_path->save();

        // rename file name
        rename(
            public_path($csv_file_path->csv_file_path),
            public_path('/uploads/marketplace/csv/email/'.$country_code.'.csv')
        );

        $update_csv_name = MarketplaceCSV::where('country', $country_code)->first();
        $update_csv_name->csv_file_path = $country_code.'.csv';
        $update_csv_name->save();

        Alert::success(translate('Success'), translate('CSV file updated successfully'));

        return back();
    }

    // csv_settings
    public function csv_settings(Request $request)
    {
        $country = Str::lower($request->country);

        $csv = MarketplaceCSV::where('country', $country)->first();

        $csv_settings = new MarketplaceSetting;
        $csv_settings->csv_id = $csv->id;
        $csv_settings->min = $request->min;
        $csv_settings->max = $request->max;
        $csv_settings->each_price = $request->each_price;
        $csv_settings->type = 'email';
        $csv_settings->save();

        Alert::success(translate('Success'), translate('CSV settings updated successfully'));

        return back();
    }

    // csv_settings_update
    public function csv_settings_update(Request $request, $country_code)
    {
        $country = Str::lower($country_code);

        $csv = MarketplaceCSV::where('country', $country)->first();

        $csv_settings = MarketplaceSetting::where('csv_id', $csv->id)->first();

        $csv_settings->min = $request->min;
        $csv_settings->max = $request->max;
        $csv_settings->each_price = $request->each_price;
        $csv_settings->save();

        Alert::success(translate('Success'), translate('CSV settings updated successfully'));

        return back();
    }

    // marketplace_buyers
    public function marketplace_buyers()
    {
        $marketplace_buyers = MarketplaceSell::paginate(20);

        return view('marketplace.buyers', compact('marketplace_buyers'));
    }

    // FRONTEND
    public function frontend_index()
    {
        return view('marketplace.frontend.index');
    }

    public function get_country_csv(Request $request)
    {
        $country = Str::lower($request->country_code);
        $csv_data = MarketplaceCSV::where('country', $country)->with('marketplace_setting')->first();

        return response()->json($csv_data, 200);
    }

    // marketplace.payment
    public function marketplace_payment(Request $request)
    {
        $country = Str::lower($request->country_code);
        $quantity = $request->quantity;
        $total = $request->total;
        $csv_data = MarketplaceCSV::where('country', $country)->with('marketplace_setting')->first();

        return view('marketplace.frontend.payment', compact('csv_data', 'country', 'quantity', 'total'));
    }

    /**
     * PAYPAL
     */
    public function postPaymentWithpaypalMarketplace(Request $request)
    {
        $sale = new MarketplaceSell;
        $sale->name = $request->name;
        $sale->email = $request->email;
        $sale->email_amount = $request->email_amount;
        $sale->country = $request->country;
        $sale->price = str_replace('$', '', $request->price);
        $sale->type = $request->type;
        $sale->status = 'pending';
        $sale->gateway = 'paypal';
        $sale->save();

        \Session::put('sale_id', $sale->id);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($sale->price);

        $item_list = new ItemList();
        $item_list->setItems([$item_1]);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($sale->price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('getPaymentStatusMarketplace'))
            ->setCancelUrl(URL::route('getPaymentStatusMarketplace'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');

                return view('errors.payment_failed');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');

        return view('errors.payment_failed');
    }

    // getPaymentStatus
    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        $sale_id = \Session::put('sale_id', $sale->id);

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');

            return view('errors.payment_failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success !!');

            // update status
            $sale = MarketplaceSell::where('id', $sale_id)->first();
            $sale->status = 'paid';
            $sale->save();

            return view('success.order_success');
        }

        \Session::put('error', 'Payment failed !!');

        return view('errors.payment_failed');
    }

    /**
     * STRIPE
     */
    public function getPaymentWithStripe(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $country = $request->country;
        $quantity = $request->email_amount;
        $total = $request->price;
        $type = $request->type;
        $gateway = $request->gateway;

        $name = $request->name;
        $email = $request->email;

        return view('marketplace.frontend.stripe', compact(
            'country',
            'quantity',
            'total',
            'type',
            'gateway',
            'name',
            'email'
        ));
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $sale = new MarketplaceSell;
        $sale->name = $request->name;
        $sale->email = $request->email;
        $sale->email_amount = $request->email_amount;
        $sale->country = $request->country;
        $sale->price = str_replace('$', '', $request->price);
        $sale->type = $request->type;
        $sale->status = 'pending';
        $sale->gateway = 'stripe';
        $sale->save();

        \Session::put('sale_id', $sale->id);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Stripe\Charge::create([
            'amount' => 100 * $sale->price,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => orgName().' '.$sale->country.'.csv payment',
        ]);

        if ($charge->paid == true) {

            // CSV HERE

            // CSV Spliter

            $country_code = $sale->country; // country code
            $amount = $sale->email_amount; // email amount
            $csv_file = marketplace_email_csv_path(); // csv file path

            $generated_name = $country_code.'-emails-'.rand(1000, 10000);
            $outputFile = public_path('output/').$generated_name; // csv file name
            $splitSize = $amount + 1; // query amount records in a one file
            $in = fopen($csv_file, 'r'); // csv file directory

            $rows = 0;
            $fileCount = 0;
            $out = null;

            while (! feof($in)) {
                if (($rows % $splitSize) == 0) {
                    if ($rows > 0) {
                        fclose($out);
                    }

                    $fileCount++;

                    $fileCounterDisplay = sprintf('%04d', $fileCount); // for filenames like indiacountry-part-0001.csv, indiacountry-part-0002.csv etc

                    $fileName = "$outputFile$fileCounterDisplay.csv"; // file name

                    $out = fopen($fileName, 'w');

                    // skip other empty csv files
                    if ($fileCounterDisplay != '0001') {
                        FIle::delete($fileName);
                    }
                }

                $data = fgetcsv($in);

                if ($rows < $splitSize) {
                    fputcsv($out, $data); // update csv file
                }

                $rows++;
            }

            fclose($out);

            $file_url = $outputFile.'0001.csv'; // csv file name

            $sale_update = MarketplaceSell::where('id', $sale->id)->first();
            $sale_update->status = 'paid';
            $sale_update->file_path = $file_url;
            $sale_update->save();

            //sending email with attachment
            $data['email'] = $sale_update->email;
            $data['title'] = 'CSV Attachment';

            Mail::send('marketplace.csv_mail_file', ['data' => $data], function ($message) use ($data, $file_url) {
                $message->to($data['email'], $data['email'])
                        ->subject($data['title']);
                $message->attach($file_url);
            });

            // CSV::END

            return view('success.order_success');
        } else {
            return view('errors.payment_failed');
        }
    }

    /**
     * csv_viewer
     */
    public function csv_viewer()
    {
        return view('marketplace.frontend.csv_viewer');
    }

    /**
     * marketplace_send_file_to_buyer
     */
    public function marketplace_send_file_to_buyer($sale_id)
    {
        $sale = MarketplaceSell::where('id', $sale_id)->first();
        $data['email'] = $sale->email;
        $data['title'] = 'CSV Attachment';

        // check if file exists in the folder
        if (file_exists($sale->file_path)) {
            Mail::send('marketplace.csv_mail_file', ['data' => $data], function ($message) use ($data, $sale) {
                $message->to($data['email'], $data['email'])
                        ->subject($data['title']);

                $message->attach($sale->file_path);
            });
        } else {
            Alert::warning('warning', 'File not found. May be deleted.');

            return back();
        }

        Alert::success('success', 'Email sent successfully');

        return back();
    }

    //END
}
