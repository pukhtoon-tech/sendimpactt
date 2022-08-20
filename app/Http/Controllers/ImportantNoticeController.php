<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImportantNotice;
use Alert;

class ImportantNoticeController extends Controller
{

    /**
     * INDEX
     */

    public function index()
    {
        try {
            $notes = ImportantNotice::latest()->paginate(10);
        return view('notes.index', compact('notes'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * CREATE
     */
    
    public function create()
    {
        return view('notes.create');
    }

    /**
     * STORE
     */
    
    public function store(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      $request->validate([
            'title' => 'required',
            'note' => 'required'
        ]);

        try {
            $note = new ImportantNotice();
        $note->title = $request->title;
        $note->note = $request->note;
        if ($request->status == 1) {
            $note->status = true;
        }else{
            $note->status = false;
        }
        $note->save();

        Alert::success(translate('Success'), translate('New Note Created Successfully'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * UPDATE
     */
    
    public function update(Request $request, $id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      $request->validate([
            'title' => 'required',
            'note' => 'required'
        ]);

        try {
            $update_note = ImportantNotice::where('id', $id)->first();
        $update_note->title = $request->title;
        $update_note->note = $request->note;
        if ($request->status == 1) {
            $update_note->status = true;
        }else{
            $update_note->status = false;
        }
        $update_note->save();

        Alert::success(translate('Updated'), translate('Note Updated Successfully'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * SHOW
     */

    public function show($id)
    {
        try {
            $note = ImportantNotice::where('id', $id)->first();
        return view('notes.show', compact('note'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * EDIT
     */

    public function edit($id)
    {
        try {
            $edit_note = ImportantNotice::where('id', $id)->first();
        return view('notes.edit', compact('edit_note'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * DELETE
     */

    public function delete($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            ImportantNotice::where('id', $id)->delete();
        Alert::success(translate('Deleted'), translate('Note Deleted'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }
    //END
}
