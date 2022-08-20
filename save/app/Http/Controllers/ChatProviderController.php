<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatProvider;
use File;
use Alert;
use Auth;
use Response;

class ChatProviderController extends Controller
{

    /**
     * index
     */

    public function index()
    {
        $chats = ChatProvider::select('id','name','status','created_at')->paginate(10);
        return view('chat.create', compact('chats'));
    }

    /**
     * store
     */

    public function store(Request $request)
    {

        // save as json

        $data = $request->only('name','body','status', 'owner_id');
        $test['token'] = time();
        $test['data'] = json_encode($data);
        $fileName = $test['token']. '_datafile.json';
        File::put(public_path('/chatjson/'.$fileName),$test);

        $file= public_path(). "/chatjson/" . $fileName;

        $headers = array(
                'Location: http://www.example.com/'
                );

        // store to database

        $chat = ChatProvider::firstOrNew();
        $chat->name = $request->name;
        $chat->body = $request->body;

        if ($request->status == 1) {
            $chat->status = 1;
        }else{
            $chat->status = 0;
        }

        $chat->owner_id = Auth::user()->id;
        $chat->save();

        Alert::success('success', 'Provider saved');
        return back();

    }

    /**
     * activenow
     */

    public function activenow($id)
    {
        $chat = ChatProvider::where('id', $id)->first();

        if ($chat->status == 1) {
            $chat->status = 0;
        }else{
            $chat->status = 1;
        }

        $chat->save();

        Alert::success('success', 'Activated');
        return back();
    }

    /**
     * edit
     */

    public function edit($id)
    {
        $chat = ChatProvider::where('id', $id)->first();
        return view('chat.edit', compact('chat'));
    }
    /**
     * update
     */

    public function update(Request $request, $id)
    {
        $chat = ChatProvider::where('id', $id)->firstOrNew();
        $chat->name = $request->name;
        $chat->body = $request->body;

        if ($request->status == 1) {
            $chat->status = 1;
        }else{
            $chat->status = 0;
        }

        $chat->owner_id = Auth::user()->id;
        $chat->save();

        Alert::success('success', 'Provider Updated');
        return back();
    }
    /**
     * destroy
     */

    public function destroy($id)
    {
        ChatProvider::where('id', $id)->delete();
        Alert::success('success', 'Provider Deleted');
        return back();
    }


    //END
}
