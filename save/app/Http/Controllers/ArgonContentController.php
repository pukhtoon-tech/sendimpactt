<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArgonContent;
use Str;
use Alert;

class ArgonContentController extends Controller
{

    
      /**
       * frontendJsonEditor
       */

       public function frontendJsonEditor(Request $request)
       {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

            $cid = ArgonContent::where('cid', $request->cid)->exists();

            if ($cid != null) {
                $data = ArgonContent::where('cid', $request->cid)->first();
                $data->cid = $request->cid;
                $data->text = $request->text;
            }else {
                $data = new ArgonContent;
                $data->cid = $request->cid;
                $data->text = $request->text;
            }
            $data->save();
            
            return response()->json($data);
       }

       /**
        * frontendJsonupload
        */

        public function frontendJsonupload(Request $request)
        {

            if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

            $folderPath = public_path('frontend/argon/uploads/');
            $image_parts = explode(";base64,", $request->text);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.' . $image_type;
            file_put_contents($file, $image_base64);

            $imageName = Str::after($file, 'uploads/');

            $cid = ArgonContent::where('cid', $request->cid)->exists();

            if ($cid != null) {
                $data = ArgonContent::where('cid', $request->cid)->first();
                $data->cid = $request->cid;
                $data->text = $imageName;
            }else {
                $data = new ArgonContent;
                $data->cid = $request->cid;
                $data->text = $imageName;
            }
            $data->save();

            return response()->json(['success' => true]);

        }
    //ENDS HERE
}
