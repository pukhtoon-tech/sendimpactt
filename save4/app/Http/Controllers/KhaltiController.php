<?php

namespace App\Http\Controllers;

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

class KhaltiController extends Controller
{
    public function verficationKhalti(Request $request)
    {
        $args = http_build_query([
            'token' => $request->token,
            'amount' => $request->amount,
        ]);

        $url = 'https://khalti.com/api/v2/payment/verify/';

        // Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key '.env('KHALTI_SECRET')]; // secret key
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status_code == 200) {
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

                return response()->json(['status' => 'success', 'url' => route('frontend.success')]);
            } else {

                /**
                 * REGISTERING USER
                 */
                $user = new User;
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

                $new_limit = new UserSentLimitPlan;
                $new_limit->owner_id = $user->id;
                $new_limit->plan_name = $plan_details->name;
                $new_limit->limit = $plan_details->emails;
                $new_limit->from = Carbon::now();
                $new_limit->to = Carbon::now()->addMonths($plan_details->duration);
                $new_limit->status = true;
                $new_limit->save();

                $email_sms_rate = new EmailSMSLimitRate;
                $email_sms_rate->owner_id = $user->id;
                $email_sms_rate->email = $plan_details->emails;
                $email_sms_rate->sms = $plan_details->sms;
                $email_sms_rate->from = Carbon::now();
                $email_sms_rate->to = Carbon::now()->addMonths($plan_details->duration);
                $email_sms_rate->status = true;
                $email_sms_rate->save();
            }

            $details = new Demo;
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

            return response()->json(['status' => 'success', 'url' => route('frontend.success')]);
        } else {
            return response()->json(['status' => 'failed', 'url' => route('frontend.failed')]);
        }
    }
    //ENDS
}
