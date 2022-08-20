<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemplateBuilder;
use Illuminate\Support\Str;
use Auth;
use Alert;
use DB;

class ProTemplateBuilderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    *   Editor view
    *   @return view
    */
    public function create()
    {
        return view('maildoll_editor.create');
    }

    /*
    *   Image Upload
    *   @param $request
    *   @return json
    */
    public function imgUpload(Request $request)
    {
        $file = $request->file('file');
        $fileName = time(). '.' . $file->extension(); ;
        $file->move(public_path('editor_images'), $fileName);
        return response()->json(['success' => $fileName]);
    }

    /*
    *   Get all images from the folder
    *   @param $request
    *   @return json
    */
    public function getImg(Request $request)
    {
        $upload_dir = public_path('editor_images/');
        //get all files in uploads folder
        $files = array_diff(scandir($upload_dir), array('.', '..'));

        //creating response
        $response=array();

        $response['code']= 0;
        $response['files']= $files;
        // $response['directory']= $upload_dir;
        $response['directory']= route('frontend.index') .'/editor_images/';
        //convert to json
        return json_encode($response);
    }
    
    /*
    *   Store template to the database and create a HTML copy
    *   @param $request
    *   @return json
    */
    public function store(Request $request)
    {
        $html = TemplateBuilder::where('id', $request->id)->first();
        $html->html = $request->html;
        $html->save();

        $pagename = $html->id;
        $newFileName = 'public/maildoll-editor/templates/saved/' . $pagename . ".html";
        $newFileContent = $html->html;

        if (file_put_contents($newFileName, $newFileContent) !== false) {
            return response()->json(['success' => 'File created (' . basename($newFileName) . ')']);
        } else {
            return response()->json(['success' => 'Cannot create file (' . basename($newFileName) . ')']);
        }
    }

    /*
    *   Editor view
    *   @return view
    */
    public function edit(Request $request)
    {
        $template = TemplateBuilder::where('id', $request->template_id)->where('owner_id', Auth::user()->id)->first();
        return view('maildoll_editor.edit', compact('template'));
    }

    //END
}
