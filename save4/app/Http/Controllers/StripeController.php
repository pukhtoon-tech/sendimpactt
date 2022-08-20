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
use PDF;
use Stripe;

class StripeController extends Controller
{
    public function getPaymentWithStripe(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $check_user = User::where('email', $request->email)->first();

        if ($check_user == null) {
            $subscriptoin_plan_id = $request->subscriptoin_plan_id;
            $plan_name = $request->plan_name;
            $amount = $request->amount;
            $payment_type = $request->payment_type;

            $name = $request->name;
            $email = $request->email;

            return view('stripe.index', compact(
                'subscriptoin_plan_id',
                'plan_name',
                'amount',
                'payment_type',
                'name',
                'email'
            ));
        } else {
            Alert::error(translate('Whoops'), translate('User Already Exist'));

            return back();
        }
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

        // $request->validate([
        //     'user_id' => 'required',
        //     'plan_id' => 'required',
        //     'plan_name' => 'required',
        //     'invoice' => 'required',
        //     'price' => 'required',
        //     'gateway' => 'required',
        // ]);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            'amount' => 100 * $request->amount,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => orgName().' '.$request->plan_name.' subscription plan payment',
        ]);

        // For Indian users

        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        //     $stripe->paymentIntents->create(
        //     [
        //         "amount" => 100 * $request->amount,
        //         "currency" => "usd",
        //         "description" => orgName() . ' ' . $request->plan_name .' subscription plan payment'
        //     ]
        // );

        // $stripe->customers->create(
        //     [
        //         'name' => $request->name,
        //         'address' => [
        //         'line1' => 'Delhi',
        //         'postal_code' => '110001',
        //         'city' => 'Delhi',
        //         'state' => 'DL',
        //         'country' => 'IN',
        //         ],
        //     ]
        // );

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
            $plan->status = true;
            $plan->save();

            $plan_details = SubscriptionPlan::where('id', $plan->plan_id)->first();

            $new_limit = new UserSentLimitPlan();
            $new_limit->owner_id = Auth::user()->id;
            $new_limit->plan_name = $plan_details->name;
            $new_limit->limit = $plan_details->emails;
            $new_limit->from = Carbon::now();
            $new_limit->to = Carbon::now()->addMonths($plan_details->duration);
            $new_limit->status = true;
            $new_limit->save();

            /**
             * EMAIL SMS LIMIT RATE
             */
            $check_email_sms_rate = EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();

            if ($check_email_sms_rate == null) {
                $email_sms_rate = new EmailSMSLimitRate();
                $email_sms_rate->owner_id = $user->id;
                $email_sms_rate->email = $plan_details->emails;
                $email_sms_rate->sms = $plan_details->sms;
                $email_sms_rate->from = Carbon::now();
                $email_sms_rate->to = Carbon::now()->addMonths($plan_details->duration);
                $email_sms_rate->status = true;
                $email_sms_rate->save();
            } else {
                $update_email_sms_rate = EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();
                $update_email_sms_rate->owner_id = Auth::user()->id;
                $update_email_sms_rate->email = $check_email_sms_rate->email += $plan_details->emails;
                $update_email_sms_rate->sms = $check_email_sms_rate->sms += $plan_details->sms;
                $update_email_sms_rate->from = Carbon::now();
                $update_email_sms_rate->to = Carbon::parse($check_email_sms_rate->to)->addMonths($plan_details->duration);
                $update_email_sms_rate->status = true;
                $update_email_sms_rate->save();
            }

            $details = new Demo();
            $details->user_id = $plan->user_id;
            $details->plan_id = $plan->plan_id;
            $details->invoice = $plan->invoice;
            $details->date = $plan->created_at->format('d/m/y');
            $details->price = $plan->price;
            $details->gateway = $request->payment_type;
            $details->status = $plan->status;
            $details->purchase_id = $plan->id;

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
        } else {

            /**
             * REGISTERING USER
             */
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->slug = Str::slug($request->name).rand(100, 1000);
            $user->visitor = $_SERVER['REMOTE_ADDR'];
            $user->save();

            $plan = new PlanPurchased();
            $plan->user_id = $user->id;
            $plan->plan_id = $request->subscriptoin_plan_id;
            $plan->plan_name = $request->plan_name;
            $plan->price = $request->amount;
            $plan->invoice = invoiceNumber();
            $plan->gateway = $request->payment_type;
            $plan->status = true;
            $plan->save();

            $plan_details = SubscriptionPlan::where('id', $plan->plan_id)->first();

            $new_limit = new UserSentLimitPlan();
            $new_limit->owner_id = $user->id;
            $new_limit->plan_name = $plan_details->name;
            $new_limit->limit = $plan_details->emails;
            $new_limit->from = Carbon::now();
            $new_limit->to = Carbon::now()->addMonths($plan_details->duration);
            $new_limit->status = true;
            $new_limit->save();

            $email_sms_rate = new EmailSMSLimitRate();
            $email_sms_rate->owner_id = $user->id;
            $email_sms_rate->email = $plan_details->emails;
            $email_sms_rate->sms = $plan_details->sms;
            $email_sms_rate->from = Carbon::now();
            $email_sms_rate->to = Carbon::now()->addMonths($plan_details->duration);
            $email_sms_rate->status = true;
            $email_sms_rate->save();
        }

        $details = new Demo();
        $details->user_id = $plan->user_id;
        $details->plan_id = $plan->plan_id;
        $details->invoice = $plan->invoice;
        $details->date = $plan->created_at->format('d/m/y');
        $details->price = $plan->price;
        $details->gateway = $request->payment_type;
        $details->status = $plan->status;
        $details->purchase_id = $plan->id;

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
    }

    //END
}
