<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailGroup;
use App\Models\EmailListGroup;
use Auth;
use Alert;

class EmailGroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $groups = EmailGroup::where('owner_id', Auth::user()->id)->latest()->paginate(10);
            return view('group.index', compact('groups'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.set_group');
    }

    /**
     * createGroup
     */
    public function createGroup($type)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        if ($type == 'email') {
            return view('group.email.create.step1', compact('type'));
        }else{
            return view('group.sms.create.step1', compact('type'));
        }
    }

    /**
     * step1
     */

     public function step1Store(Request $request)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $type = $request->type;

        try {
        $step1 = new EmailGroup();
        $step1->owner_id = Auth::user()->id;
        $step1->name = $request->name;
        $step1->type = $request->type;
        $step1->description = $request->description ?? null;

        if($request->status == 1)
        {
            $step1->status = true;
        }else{
            $step1->status = false;
        }
        $step1->save();

        notify()->success(translate('Group Name Stored'));
        return $this->createStep2($step1, $type);
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

        
     }

    /**
     * createStep2
     */


    public function createStep2($step1, $type)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {

            if ($type == 'email') {
                $group_id = $step1->id;
                return view('group.email.create.step2', compact('group_id'));
            }else{
                $group_id = $step1->id;
                return view('group.sms.create.step2', compact('group_id'));
            }

            
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * emailsStore
     */

     public function emailsStore(Request $request)
     {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        $ids = $request->ids;
        $group_id = $request->group_id;
        $emails = explode(",", $ids);
        $emails = collect($emails);

        foreach($emails as $email)
        {
            $campaign_email = new EmailListGroup();
            $campaign_email->email_group_id = $group_id;
            $campaign_email->email_id = $email;
            $campaign_email->owner_id = Auth::user()->id;
            $campaign_email->save();
        }


        return response()->json(['status'=>true,'message'=> translate('Group Stored Successfully')]);
     }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $group = EmailGroup::where('id', $id)->where('owner_id', Auth::user()->id)->first();
            return view('group.show', compact('group'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Group Not Exist'));
            return back()->withErrors($th->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $group = EmailGroup::where('id', $id)->where('owner_id', Auth::user()->id)->with('email_groups')->first();
            return view('group.edit', compact('group'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      $request->validate([
            'name' => 'required'
        ]);


        try {
            $update_group = EmailGroup::where('id', $id)->first();
        $update_group->owner_id = Auth::user()->id;
        $update_group->name = $request->name;
        $update_group->description = $request->description ?? null;

        if($request->status == 1)
        {
            $update_group->status = true;
        }else{
            $update_group->status = false;
        }
        $update_group->save();

        $emails = collect($request->email_id);


        $delete_email = EmailListGroup::where('email_group_id', $id)->delete();

        foreach($emails as $email)
        {

          $check_email = EmailListGroup::where('email_group_id', $id)->where('email_id', $email)->first();

          if ($check_email == null) {
            $update_group_email = new EmailListGroup();
            $update_group_email->email_group_id =$id;
            $update_group_email->email_id = $email;
            $update_group_email->save();
          }

        }

        notify()->success(translate('Group Updated'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            EmailGroup::findOrFail($id)->delete();
            EmailListGroup::where('email_group_id', $id)->delete();
            Alert::warning(translate('Deleted'), translate('Group Deleted'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }


    //END
}
