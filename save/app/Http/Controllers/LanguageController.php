<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\OrganizationSetup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Alert;

class LanguageController extends Controller
{

    //list of language
    public function langIndex()
    {
        try {
            $languages = Language::paginate(20);
            return view('settings.application.language.language', compact('languages'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    //list of langNew
    public function langNew()
    {
        return view('settings.application.language.components.add_new_lang');
    }


    //store a  new language
    public function langStore(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $request->validate([
            'code' => ['required', 'unique:languages'],
            'name' => ['required', 'unique:languages'],
            'image' => ['required', 'unique:languages']
        ]);
        $lan = new Language();
        $lan->code =Str::lower(str_replace(' ','_',$request->code));
        $lan->name = $request->name;
        $lan->image = $request->image;
        $lan->save();

        notify()->success(translate('Stored'));
        
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    //delete the language
    public function langDestroy($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            Language::where('id', $id)->forceDelete();

        notify()->success(translate('Trashed'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }


    //languages for create translate
    public function translate_create($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $lang = Language::findOrFail($id);
        return view('settings.application.language.translate',compact('lang'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }


    //translate language save ase a json format file
    public function translate_store(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $language = Language::findOrFail($request->id);

        //check the key have translate data
        $data = openJSONFile($language->code);
        foreach ($request->translations as $key => $value) {
            $data[$key] = $value;
        }

        //save the new keys translate data
        saveJSONFile($language->code, $data);

        notify()->success(translate('Translated'));
   
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }


    /*languages change in session*/
    public function languagesChange(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            session(['locale' => $request->code]);
        Artisan::call('optimize:clear');
        notify()->success(translate('Changed'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    //defaultLanguage
    public function defaultLanguage($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }


        try {
        $language = Language::findOrFail($id);
        overWriteEnvFile('DEFAULT_LANGUAGE', $language->code);
        session(['locale' => $language->code]);
        
        $org = OrganizationSetup::where('name', 'default_language')->first();
        $org->name = 'default_language';
        $org->value = $language->code;
        $org->save();

        Artisan::call('optimize:clear');
        notify()->success(translate('Language switched'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }
    
    //END
}
