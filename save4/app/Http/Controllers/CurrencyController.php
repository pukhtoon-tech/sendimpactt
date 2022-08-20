<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all currency in index page
    public function index()
    {
        $currencies = Currency::paginate(20); // this is for list
        $dCurrencies = Currency::published()->get();

        return view('settings.application.currency.index', compact('currencies', 'dCurrencies'));
    }

    //create modal for currency
    public function create()
    {
        return view('settings.application.currency.create');
    }

    //store the currency in database
    public function store(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            $request->validate([
                'name' => 'required',
                'code' => 'required',
                'symbol' => 'required',
                'rate' => 'required',
            ],
        [
            'name.required' => translate('Name is required'),
            'code.required' => translate('Code is required'),
            'symbol.required' => translate('Symbol is required'),
            'rate.required' => translate('Rate is required'),
        ]);

            $currency = new Currency();
            $currency->name = $request->name;
            $currency->code = Str::upper($request->code);
            $currency->symbol = $request->symbol;
            $currency->rate = $request->rate;
            $currency->save();
            notify()->success($request->name.' '.translate('Currency created successfully'));

            return back();
        } catch (\Throwable $th) {
            Alert::error('Whoops', 'Something went wrong');

            return back()->withErrors($th->getMessage());
        }
    }

    //edit modal for currency
    public function edit($id)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $currency = Currency::findOrFail($id);

        return view('settings.application.currency.edit', compact('currency'));
    }

    //update the currency
    public function update(Request $request, $id)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            $request->validate([
                'name' => 'required',
                'code' => 'required',
                'symbol' => 'required',
                'rate' => 'required',
            ],
        [
            'name.required' => translate('Name is required'),
            'code.required' => translate('Code is required'),
            'symbol.required' => translate('Symbol is required'),
            'rate.required' => translate('Rate is required'),
        ]);

            $currency = Currency::where('id', $id)->first();
            $currency->name = $request->name;
            $currency->code = $request->code;
            $currency->symbol = $request->symbol;
            $currency->rate = $request->rate;
            $currency->save();
            notify()->success(translate('Currency updated'));

            return back();
        } catch (\Throwable $th) {
            Alert::error('Whoops', 'Something went wrong');

            return back()->withErrors($th->getMessage());
        }
    }

    //soft delete the currency
    public function destroy($id)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            $currency = Currency::where('id', $id)->first();

            if ($currency->is_published == 1) {
                notify()->warning(translate('Currency must be unpublished for delete.'));

                return back();
            } else {
                Currency::where('id', $id)->delete();
                notify()->success(translate('Currency deleted successfully.'));

                return back();
            }
        } catch (\Throwable $th) {
            notify()->success(translate('Whoops something went wrong.'));

            return back()->withErrors($th->getMessage());
        }
    }

    //change the status
    public function published(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $currency = Currency::where('id', $request->id)->first();
        if ($currency->is_published == 1) {
            $currency->is_published = 0;
            $currency->save();
        } else {
            $currency->is_published = 1;
            $currency->save();
        }

        return response(['message' => translate('Currency status is changed')], 200);
    }

    //change the currency alignment
    public function alignment(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $currency = Currency::where('id', $request->id)->first();
        if ($currency->align == 1) {
            $currency->align = 0;
            $currency->save();
        } else {
            $currency->align = 1;
            $currency->save();
        }

        return response(['message' => translate('Currency alignment changed')], 200);
    }

    public function change(Request $request)
    {

        //get currency
        session(['currency' => $request->id]);
        Artisan::call('optimize:clear');

        return back();
    }

    //END
}
