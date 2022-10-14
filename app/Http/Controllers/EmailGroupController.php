<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailGroup;
use App\Models\EmailListGroup;
use Auth;
use Alert;
use Illuminate\Support\Str;

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

    public function group_new()
    {
        return view('group.group_two');
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
        } else {
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

            if ($request->status == 1) {
                $step1->status = true;
            } else {
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
            } else {
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

        foreach ($emails as $email) {
            $campaign_email = new EmailListGroup();
            $campaign_email->email_group_id = $group_id;
            $campaign_email->email_id = $email;
            $campaign_email->owner_id = Auth::user()->id;
            $campaign_email->save();
        }


        return response()->json(['status' => true, 'message' => translate('Group Stored Successfully')]);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Campaign $campaign
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
     * @param \App\Models\Campaign $campaign
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campaign $campaign
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

            if ($request->status == 1) {
                $update_group->status = true;
            } else {
                $update_group->status = false;
            }
            $update_group->save();

            $emails = collect($request->email_id);


            EmailListGroup::where('email_group_id', $id)->delete();

            foreach ($emails as $email) {

                $check_email = EmailListGroup::where('email_group_id', $id)->where('email_id', $email)->first();

                if ($check_email == null) {
                    $update_group_email = new EmailListGroup();
                    $update_group_email->email_group_id = $id;
                    $update_group_email->email_id = $email;
                    $update_group_email->owner_id = \Illuminate\Support\Facades\Auth::id();
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
     * @param \App\Models\Campaign $campaign
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

    public function groupFilter($group_id)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }
        if ($group_id == 'all') {
            $data = EmailGroup::where('owner_id', Auth::user()->id)->get();
        } else {
            $data = EmailGroup::where('owner_id', Auth::user()->id)->where('type', $group_id)->get();
        }
        $sendSearch = '';

        if (count($data) > 0) {
            foreach ($data as $index => $group) {
                $status = $group->status == 1 ? 'text-theme-9' : 'text-theme-6';
                $status1 = $group->status == 1 ? 'Active' : 'Inactive';
                $type = $group->type == 'email' ? 'text-theme-10' : 'text-theme-6';
                $sendSearch .=

                    '<tr class="intro-x">
                             <td class="text-center">' . ($index + 1) . '</td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="' . $group->name . '">' . $group->name . '</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap" data-theme="light">' . Str::limit($group->description, 50) . '</div>
                            </td>

                            <td class="text-center">' . EmailListGroup::where("email_group_id", $group->id)->count() . '</td>

                            <td class="w-40">
                                <div class="flex items-center justify-center ' . $status . '">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ' . $status1 . '
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="' . $type . '">
                                    ' . Str::upper($group->type) . '
                                </span>
                            </td>

                            <td class="text-center">' . $group->created_at->diffForHumans() . '</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 tooltip" title="' . translate("View") . '" href="' . route("group.show", $group->id) . '">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye w-4 h-4 mr-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a>
                                    <a class="flex items-center mr-3 tooltip" href="' . route("group.edit", $group->id) . '" title="' . translate("Edit") . '">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" href="' . route("group.emails.destroy", $group->id) . '" title="' . translate("Delete") . '">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                </div>
                            </td>

                        </tr>';
            }
        }

        return $sendSearch;

    }


    //END
}
