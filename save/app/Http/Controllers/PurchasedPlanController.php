<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;

class PurchasedPlanController extends Controller
{

    /**
     * INDEX
     */
    public function index()
    {
        return view('purchased_plans.index');
    }

    /**
     * DOWNLOAD INVOICE
     */
    public function downloadInvoice($invoice)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        try {
            return response()->download(invoice_path($invoice));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Invoice Not Found'));
            return back()->withErrors($th->getMessage());
        }
    }
    //END
}
