<?php

namespace App\Http\Controllers;

use Alert;
use App\Mail\InvoiceMail;
use App\Models\Demo;
use App\Models\EmailSMSLimitRate;
use App\Models\PlanPurchased;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\UserSentLimitPlan;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use PayPal\Api\Payment;
use Paystack;
use PDF;
use Redirect;
use URL;

class PayStackController extends Controller
{
    /**
     * Backend Interface
     */
    public function index()
    {
        return view('payment_setup.paystack');
    }

    /**
     * Backend Interface
     */
    public function store(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        overWriteEnvFile('PAYSTACK_PUBLIC_KEY', $request->paystack_public_key);
        overWriteEnvFile('PAYSTACK_SECRET_KEY', $request->paystack_secret_key);
        overWriteEnvFile('PAYSTACK_PAYMENT_URL', $request->paystack_payment_url);
        overWriteEnvFile('MERCHANT_EMAIL', $request->paystack_merchant_email);
        overWriteEnvFile('MERCHANT_CURRENCY', $request->paystack_merchant_currency);

        Artisan::call('optimize:clear');

        telling(route('paystack.index'), translate('Paystack Account Setup Completed'));

        notify()->success(translate('Paystack setup done'));

        return back();
    }

    /**
     * Redirect the User to Paystack Payment Page
     *
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        try {

            /**
             * CREATE USER
             */
            if (Auth::check()) {

                /**
                 * PURCHASE CHECK
                 */
                $plan = new PlanPurchased();
                $plan->user_id = Auth::user()->id;
                $plan->plan_id = $request->subscriptoin_plan_id;
                $plan->plan_name = $request->plan_name;
                $plan->invoice = invoiceNumber();
                $plan->price = $request->amount;
                $plan->gateway = $request->payment_type;
                $plan->status = false;
                $plan->save();

                $plan_details = SubscriptionPlan::where('id', $plan->plan_id)->first();

                $new_limit = new UserSentLimitPlan();
                $new_limit->owner_id = Auth::user()->id;
                $new_limit->plan_name = $plan_details->name;
                $new_limit->limit = $plan_details->emails;
                $new_limit->from = Carbon::now();
                $new_limit->to = Carbon::now()->addMonths($plan_details->duration);
                $new_limit->status = false;
                $new_limit->save();

                /**
                 * EMAIL SMS LIMIT RATE
                 */
                $check_email_sms_rate = EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();

                if ($check_email_sms_rate == null) {
                    $email_sms_rate = new EmailSMSLimitRate();
                    $email_sms_rate->owner_id = Auth::user()->id;
                    $email_sms_rate->email = $plan_details->emails;
                    $email_sms_rate->sms = $plan_details->sms;
                    $email_sms_rate->from = Carbon::now();
                    $email_sms_rate->to = Carbon::now()->addMonths($plan_details->duration);
                    $email_sms_rate->status = false;
                    $email_sms_rate->save();
                } else {
                    $update_email_sms_rate = EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();
                    $update_email_sms_rate->owner_id = Auth::user()->id;
                    $update_email_sms_rate->email = $check_email_sms_rate->email += $plan_details->emails;
                    $update_email_sms_rate->sms = $check_email_sms_rate->sms += $plan_details->sms;
                    $update_email_sms_rate->from = Carbon::now();
                    $update_email_sms_rate->to = Carbon::parse($check_email_sms_rate->to)->addMonths($plan_details->duration);
                    $update_email_sms_rate->status = false;
                    $update_email_sms_rate->save();
                }
            } else {

                /**
                 * REGISTERING USER
                 */
                if (checkUser($request->email) == null) {
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->slug = Str::slug($request->name).rand(100, 1000);
                    $user->visitor = $_SERVER['REMOTE_ADDR'];
                    $user->save();

                    $request->session()->forget('new_user_id');
                    $request->session()->put('new_user_id', $user->id);
                } else {
                    Alert::error(@translate('Whoops'), @translate('User Already Exist'));

                    return back();
                }

                $plan = new PlanPurchased();
                $plan->user_id = $user->id;
                $plan->plan_id = $request->subscriptoin_plan_id;
                $plan->plan_name = $request->plan_name;
                $plan->price = $request->amount;
                $plan->invoice = invoiceNumber();
                $plan->gateway = $request->payment_type;
                $plan->status = false;
                $plan->save();

                $plan_details = SubscriptionPlan::where('id', $plan->plan_id)->first();

                $new_limit = new UserSentLimitPlan();
                $new_limit->owner_id = $user->id;
                $new_limit->plan_name = $plan_details->name;
                $new_limit->limit = $plan_details->emails;
                $new_limit->from = Carbon::now();
                $new_limit->to = Carbon::now()->addMonths($plan_details->duration);
                $new_limit->status = false;
                $new_limit->save();

                $email_sms_rate = new EmailSMSLimitRate();
                $email_sms_rate->owner_id = $user->id;
                $email_sms_rate->email = $plan_details->emails;
                $email_sms_rate->sms = $plan_details->sms;
                $email_sms_rate->from = Carbon::now();
                $email_sms_rate->to = Carbon::now()->addMonths($plan_details->duration);
                $email_sms_rate->status = false;
                $email_sms_rate->save();
            }

            /**
             * CREATE USER::ENDS
             */

            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            Alert::error(translate('Whoops'), translate('The paystack token has expired. Please refresh the page and try again.'));

            return Redirect::back();
        }
    }

    /**
     * Obtain Paystack payment information
     *
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['status'] == 'success') {

            // SUCCESSFULL PAYMENT------------------------------------------------------------------------------------
            \Session::put('success', 'Payment success !!');

            if (Auth::check()) {

                /**
                 * PURCHASE CHECK
                 */
                $success_plan = PlanPurchased::where('user_id', Auth::user()->id)->latest()->first();
                $success_plan->status = true;
                $success_plan->save();

                $plan_details = SubscriptionPlan::where('id', $success_plan->plan_id)->first();

                $success_limit = UserSentLimitPlan::where('owner_id', Auth::user()->id)->first();
                $success_limit->status = true;
                $success_limit->save();

                /**
                 * EMAIL SMS LIMIT RATE
                 */
                $update_email_sms_rate = EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();
                $update_email_sms_rate->status = true;
                $update_email_sms_rate->save();
            } else {

                /**
                 * PURCHASE CHECK
                 */
                $new_user_id = request()->session()->get('new_user_id');

                $success_plan = PlanPurchased::where('user_id', $new_user_id)->latest()->first();
                $success_plan->status = true;
                $success_plan->save();

                $plan_details = SubscriptionPlan::where('id', $success_plan->plan_id)->first();

                $success_limit = UserSentLimitPlan::where('owner_id', $new_user_id)->first();
                $success_limit->status = true;
                $success_limit->save();

                /**
                 * EMAIL SMS LIMIT RATE
                 */
                $update_email_sms_rate = EmailSMSLimitRate::where('owner_id', $new_user_id)->first();
                $update_email_sms_rate->status = true;
                $update_email_sms_rate->save();
            }

            /**
             * SENDING MAIL
             * STORING PDF
             * PDF ATTACHMENT
             */
            $details = new Demo();
            $details->user_id = $success_plan->user_id;
            $details->plan_id = $success_plan->plan_id;
            $details->invoice = $success_plan->invoice;
            $details->date = $success_plan->created_at->format('d/m/y');
            $details->price = $success_plan->price;
            $details->gateway = 'paystack';
            $details->status = $success_plan->status;
            $details->purchase_id = $success_plan->id;

            /**
             * SENDING MAIL
             * STORING PDF
             * PDF ATTACHMENT
             */
            try {
                $pdf = PDF::loadView('success.attachment_invoice', compact(
            'details',
        ))->save(invoice_path($details->invoice));

                Mail::to(getUser($details->user_id)->email)->send(new InvoiceMail($details));
            } catch (\Throwable $th) {
                //throw $th;
            }

            return view('success.order_success');
        // SUCCESSFULL PAYMENT::END-------------------------------------------------------------------------------
        } else {
            \Session::put('error', 'Payment failed !!');

            return view('errors.payment_failed');
        }
    }
    //ENDS
}
