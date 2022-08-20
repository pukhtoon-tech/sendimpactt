<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;

class PaymentSetupController extends Controller
{

     // Paypal

    public function paypal()
    {
      return view('payment_setup.paypal');
    }

    public function paypalCreate(Request $request)
    {

      if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      overWriteEnvFile('PAYPAL_CLIENT_ID', $request->paypal_client_id);
      overWriteEnvFile('PAYPAL_SECRET', $request->paypal_secret);

      telling(route('payment.setup.paypal'), translate('PayPal Account Setup Completed'));

      notify()->success(translate('Paypal setup done'));
      return back();
    }

    // Stripe

    public function stripe()
    {
      return view('payment_setup.stripe');
    }

    public function stripeCreate(Request $request)
    {

      if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      overWriteEnvFile('STRIPE_KEY', $request->stripe_client_id);
      overWriteEnvFile('STRIPE_SECRET', $request->stripe_secret);

      telling(route('payment.setup.stripe'), translate('Stripe Account Setup Completed'));

      notify()->success(translate('Stripe setup done'));
      return back();
    }

    
    //END
}
