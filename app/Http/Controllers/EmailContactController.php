<?php

namespace App\Http\Controllers;

use App\Models\EmailContact;
use App\Models\CampaignEmail;
use App\Models\Demo;
use App\Http\Controllers\Controller;
use App\Models\EmailListGroup;
use Illuminate\Http\Request;
use App\Exports\EmailContactExport;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Alert;
use Auth;
use Carbon\Carbon;
use File;

class EmailContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('email_contacts.index');
    }

    public function index_two()
    {
        return view('email_contacts.contacts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'cname' => 'required',
        ]);


        try {
            if (!is_null($request->email)) {
                $email = EmailContact::where('email', $request->email)
                    ->where('owner_id', userId())
                    ->where('deleted_at', null)->first();
                if ($email != null) {
                    $email->update(array(
                        'owner_id' => userId(),
                        'name' => $request->fname . ' ' . $request->lname,
                        'first_name' => $request->fname,
                        'last_name' => $request->lname,
                        'company_name' => $request->cname,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                    ));

                    if ($request->groups) {
                        $list = array();
                        foreach ($request->groups as $val) {
                            $data = array(
                                'email_group_id' => $val,
                                'email_id' => $email->id,
                                'owner_id' => userId()
                            );
                            array_push($list, $data);
                        }

                        EmailListGroup::insert(
                            $list
                        );
                    }
                    Alert::success(translate('Success'), translate('New Contact Stored'));
                    return back();
                }
            }

            if (!is_null($request->phone)) {
                $email = EmailContact::where('phone', $request->phone)
                    ->where('owner_id', userId())
                    ->where('deleted_at', null)->first();

                if ($email != null) {
                    $email->update(array(
                        'owner_id' => userId(),
                        'name' => $request->fname . ' ' . $request->lname,
                        'first_name' => $request->fname,
                        'last_name' => $request->lname,
                        'company_name' => $request->cname,
                        'email' => $request->email,
                    ));
                    if ($request->groups) {
                        $list = array();
                        foreach ($request->groups as $val) {
                            $data = array(
                                'email_group_id' => $val,
                                'email_id' => $email->id,
                                'owner_id' => userId()
                            );
                            array_push($list, $data);
                        }

                        EmailListGroup::insert(
                            $list
                        );
                    }
                    Alert::success(translate('Success'), translate('New Contact Stored'));
                    return back();
                }
            }

            $email = new EmailContact();
            $email->owner_id = userId();
            $email->name = $request->fname . ' ' . $request->lname;
            $email->first_name = $request->fname;
            $email->last_name = $request->lname;
            $email->company_name = $request->cname;
            $email->email = $request->email;
            $email->country_code = $request->country_code;
            $email->phone = $request->phone;
            $email->save();

            if ($request->groups) {
                $list = array();
                foreach ($request->groups as $val) {
                    $data = array(
                        'email_group_id' => $val,
                        'email_id' => $email->id,
                        'owner_id' => \Illuminate\Support\Facades\Auth::id()
                    );
                    array_push($list, $data);
                }

                EmailListGroup::insert(
                    $list
                );
            }

            Alert::success(translate('Success'), translate('New Contact Stored'));
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
            $email = EmailContact::where('id', $id)->first();

            if ($email != null) {
                return view('email_contacts.show', compact('email'));
            } else {
                Alert::error(translate('Whoops'), translate('No Email Found'));
                return back();
            }
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
            'fname' => 'required',
            'lname' => 'required'
        ]);

        try {


            $email_update = EmailContact::where('id', $id)->first();

            if ($email_update != null) {
                $email_update->owner_id = userId();
                $email_update->name = $request->fname . ' ' . $request->lname;
                $email_update->first_name = $request->fname;
                $email_update->last_name = $request->lname;
                $email_update->company_name = $request->cname;
                $email_update->email = $request->email;
                if ($request->phone = '') {
                    $email_update->country_code = $request->country_code;
                }
                $email_update->phone = $request->phone;
                $email_update->save();

                if ($request->groups) {
                    EmailListGroup::where('owner_id', \Illuminate\Support\Facades\Auth::id())->where('email_id', $email_update->id)->delete();
                    $list = array();
                    foreach ($request->groups as $val) {
                        $data = array(
                            'email_group_id' => $val,
                            'email_id' => $email_update->id,
                            'owner_id' => \Illuminate\Support\Facades\Auth::id(),
                            'created_at' => \Illuminate\Support\Carbon::now(),
                            'updated_at' => \Illuminate\Support\Carbon::now(),
                        );
                        array_push($list, $data);
                    }

                    EmailListGroup::insert(
                        $list
                    );
                } else {
                    EmailListGroup::where('owner_id', \Illuminate\Support\Facades\Auth::id())->where('email_id', $email_update->id)->delete();
                }
                Alert::success(translate('Success'), translate('Information Updated'));
                return back();
            } else {
                Alert::error(translate('Whoops'), translate('Something went wrong. Check user exist first.'));
                return back();
            }

        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

    }

    /**
     * EMAILS
     */

    public function emails()
    {
        $emails = EmailContact::where('owner_id', Auth::user()->id)
            ->orderBy('email')
            ->Active()
            ->latest()
            ->simplePaginate(20);
        return view('email_contacts.load_pages.emails', compact('emails'));
    }

    public function allEmails()
    {
        $emails = EmailContact::where('owner_id', Auth::user()->id)
            ->where('email', '!=', null)
            ->orderBy('email')
            ->Active()
            ->latest()
            ->simplePaginate(20);
        return view('email_contacts.load_pages.all_emails', compact('emails'));
    }

    public function allPhones()
    {
        $emails = EmailContact::where('owner_id', Auth::user()->id)
            ->where('phone', '!=', null)
            ->orderBy('phone')
            ->Active()
            ->latest()
            ->simplePaginate(20);
        return view('email_contacts.load_pages.all_phones', compact('emails'));
    }

    /**
     * EMAIL LIST
     */

    public function emailList()
    {

        return view('email_contacts.list.email');

    }

    /**
     * PHONE LIST
     */

    public function phoneLIst()
    {

        return view('email_contacts.list.phone');

    }

    /**
     * favourites
     */

    public function favourite()
    {

        $favourites = EmailContact::where('owner_id', Auth::user()->id)->orderBy('email')->Favourite()->latest()->get();
        return view('email_contacts.load_pages.favourites', compact('favourites'));

    }

    /**
     * blocked
     */

    public function blocked()
    {

        $blocks = EmailContact::where('owner_id', Auth::user()->id)->orderBy('email')->Blocked()->latest()->get();
        return view('email_contacts.load_pages.blocked', compact('blocks'));

    }

    /**
     * unblockAll
     */

    public function unblockAll(Request $request)
    {


        $ids = $request->ids;
        $trashing = EmailContact::whereIn('id', explode(",", $ids))->update(['blocked' => 0]);
        return response()->json(['status' => true, 'message' => translate("Email contact unblocked successfully.")]);

    }

    /**
     * trashed
     */

    public function trashedBin()
    {


        $trashes = EmailContact::where('owner_id', Auth::user()->id)->TrashedBin()->latest()->get();
        return view('email_contacts.load_pages.trashed', compact('trashes'));

    }

    /**
     * destroyAll
     */

    public function destroyAll(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        $ids = $request->ids;
        $trashing = EmailContact::whereIn('id', explode(",", $ids))->update(['trashed' => 1]);
        EmailContact::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => translate("Email contact deleted successfully.")]);

    }

    /**
     * destroy
     */

    public function destroy($id)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        EmailContact::where('id', $id)->delete();

        $checkID = CampaignEmail::where('email_id', $id)->first();

        if ($checkID != null) {
            CampaignEmail::where('email_id', $id)->delete();
        }

        Alert::success(translate('Deleted'), translate('Contact Deleted'));
        return back();

    }

    /**
     * restoreAll
     */

    public function restoreAll(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        $ids = $request->ids;
        EmailContact::whereIn('id', explode(",", $ids))->restore();
        $trashing = EmailContact::whereIn('id', explode(",", $ids))->update(['trashed' => 0]);
        return response()->json(['status' => true, 'message' => translate("Email contact restored successfully.")]);

    }

    /**
     * destroy
     */

    public function permanentDestroyAll(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        $ids = $request->ids;
        EmailContact::whereIn('id', explode(",", $ids))->forceDelete();
        return response()->json(['status' => true, 'message' => translate("Email contact destroyed successfully.")]);

    }

    /**
     * blacklistAll
     */

    public function blacklistAll(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        $ids = $request->ids;
        $trashing = EmailContact::whereIn('id', explode(",", $ids))->update(['blocked' => 1]);
        return response()->json(['status' => true, 'message' => translate("Email contact blacklisted successfully.")]);

    }

    /**
     * favouriteAll
     */

    public function favouriteAll(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        $ids = $request->ids;
        $trashing = EmailContact::whereIn('id', explode(",", $ids))->update(['favourites' => 1]);
        return response()->json(['status' => true, 'message' => translate("Email contact added to favourites successfully.")]);

    }

    /**
     * dislikeAll
     */

    public function dislikeAll(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        $ids = $request->ids;
        $trashing = EmailContact::whereIn('id', explode(",", $ids))->update(['favourites' => 0]);
        return response()->json(['status' => true, 'message' => translate("Email contact removed from favourites successfully.")]);

    }

    /**
     * mailSearch
     */

    public function mailSearch(Request $request)
    {
        $search = $request->value;
        $emails = EmailContact::where(function ($q) use ($search) {

            $q->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->where('owner_id', \Illuminate\Support\Facades\Auth::id())
                ->Active()
                ->latest();
        })->get();

//        $emails = EmailContact::where('email', 'LIKE' , '%' . $request->value . '%')->orderBy('email')->get();
        $sendSearch = '';


        if (count($emails) > 0) {
            $sendSearch = '<thead class="bg-gray-900 height_45px">
                            <tr class="text-white text-left">
                                <th class="text-center whitespace-no-wrap">' . translate('SL') . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("First Name") . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("Last Name") . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("Company Name") . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("EMAIL") . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("PHONE") . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("DATE") . '</th>
                                <th class="text-center whitespace-no-wrap">' . translate("ACTION") . '</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 myTable">';
            foreach ($emails as $index => $email) {
                $loop = $index + 1;
                $fav = ($email->favourites == 1) ? 'text-blue-300' : '';
                $ph = ($email->phone != null) ? '+' : null;
                $ph .= $email->country_code . $email->phone;
                if ($email->email) {
                    $em = $email->email;
                } else {
                    $em = 'No Email';
                }

                $sendSearch .= '<tr>
                                <td class="text-center">
                                   ' . $loop . '
                                </td>   
                                <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    ' . $email->first_name . '

                                </td>
                                <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    ' . $email->last_name . '

                                </td>

                                <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    ' . $email->company_name . '

                                </td>

                                <td class="text-center tooltip" title="@translate(Recipient Email)">
                                    <label for="{{ $email->id }}">' . Str::limit($email->email, 50) . '</label>
                                </td>
                                <td  class="text-center tooltip" title="@translate(Recipient Email)">
                                    <label for="' . $email->id . '">' . $ph . '</label>
                                </td>
                                <td class="text-center tooltip" title="@translate(Mail Date)">' . $email->created_at->format('Y-m-d') . ' </td>
                                <td class="py-4 text-center">

                                    <div class="flex-none flex justify-end mr-4">
                                        <input id="' . $email->id . '" class="input flex-none border border-gray-500 checking" data-id="' . $email->id . '"  data-email="' . $email->email . '" name="check" type="checkbox">
                                        <a href="javascript:;" id="markAsFav" data-id="' . $email->id . '" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500">
                                            <svg class="' . $fav . '" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </a>

                                    <a href="' . route('email.contact.show', $email->id) . '"
                                        class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500 tooltip"
                                        title="@translate(Edit)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                        
                                        <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                            <img alt="' . $em . '" class="rounded-full" src="' . emailAvatar($em) . '">
                                        </div>
                                    </div>

                                </td>
                            </tr>';
            }
            $sendSearch .= '</tbody>';
        }

        return $sendSearch;
    }


    /**
     * sendEmail
     */

    public function sendEmail(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }


        $ids = $request->ids;
        $emails = EmailContact::whereIn('email', explode(",", $ids))
            ->get()
            ->pluck('email')
            ->toArray();

        foreach ($emails as $email) {
            \Artisan::call('mail:send-test SendTestMail ' . $email); // test mail
        }
        return response()->json(['status' => true, 'message' => translate("Test mail sent successfully.")]);


    }


    /**
     * EXPORT
     */

    public function emailExport()
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        try {
            return Excel::download(new EmailContactExport, 'users.csv');
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * markAsRead
     */

    function markAsRead(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        $markAsRead = EmailContact::where('id', $request->id)->first();

        if ($markAsRead->favourites == 1) {
            $markAsRead->favourites = 0;
        } else {
            $markAsRead->favourites = 1;
        }

        $markAsRead->save();

        return response()->json('success', 200);
    }

    /**
     * bulk csv
     */

    public function bulkCsv()
    {
        return view('bulk.index');
    }

    public function importCsv(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        try {

            if (File::exists(public_path('uploads/csv/' . Auth::user()->id . '.csv'))) {
                File::delete(public_path('uploads/csv/' . Auth::user()->id . '.csv'));
            }

            if ($request->hasFile('csv')) {
                $imageName = Auth::user()->id . '.' . $request->csv->getClientOriginalExtension();
                $request->csv->move(public_path('/uploads/csv'), $imageName);

                $file = asset('uploads/csv/' . Auth::user()->id . '.csv');

                $contacts = convert_csv_to_json($file);

                foreach (json_decode($contacts, true) as $value) {
                    $companyName = $value['company_name'] ?? null;
                    $email1 = $value['email'] ?? null;
                    $countryCode = $value['country_code'] ?? null;
                    $phone = $value['phone'] ?? null;

                    $companyName = trim($companyName);
                    $email1 = trim($email1);
                    $countryCode = trim($countryCode);
                    $phone = trim($phone);


                    if (!is_null($email1)) {
                        $checkedUser = EmailContact::where('email', $email1)
                            ->where('owner_id', userId())
                            ->where('deleted_at', null)->first();
                        if ($checkedUser != null) {
                            $checkedUser->update(array(
                                'owner_id' => userId(),
                                'name' => $request->fname . ' ' . $request->lname,
                                'first_name' => $request->fname,
                                'last_name' => $request->lname,
                                'company_name' => $request->cname,
                                'country_code' => $request->country_code,
                                'phone' => $phone,
                            ));

                            if ($request->groups) {
                                $list = array();
                                foreach ($request->groups as $val) {
                                    $data = array(
                                        'email_group_id' => $val,
                                        'email_id' => $checkedUser->id,
                                        'owner_id' => userId()
                                    );
                                    array_push($list, $data);
                                }

                                EmailListGroup::insert(
                                    $list
                                );
                            }
                            continue;
                        }
                    }

                    if (!is_null($phone)) {
                        $checkedUser = EmailContact::where('phone', $phone)
                            ->where('owner_id', userId())
                            ->where('deleted_at', null)->first();

                        if ($checkedUser != null) {
                            $checkedUser->update(array(
                                'owner_id' => userId(),
                                'name' => $request->fname . ' ' . $request->lname,
                                'first_name' => $request->fname,
                                'last_name' => $request->lname,
                                'company_name' => $request->cname,
                                'email' => $email1,
                            ));
                            if ($request->groups) {
                                $list = array();
                                foreach ($request->groups as $val) {
                                    $data = array(
                                        'email_group_id' => $val,
                                        'email_id' => $checkedUser->id,
                                        'owner_id' => userId()
                                    );
                                    array_push($list, $data);
                                }

                                EmailListGroup::insert(
                                    $list
                                );
                            }
                            continue;
                        }
                    }


                    $email = new EmailContact;
                    $email->owner_id = Auth::user()->id;
                    $email->name = $value['first_name'] . ' ' . $value['last_name'];
                    $email->first_name = $value['first_name'];
                    $email->last_name = $value['last_name'];
                    $email->company_name = ($companyName == 'NULL' || $companyName == null ||
                        $companyName == '') ? null : $companyName;
                    $email->email = ($email1 == 'NULL' || $email1 == null ||
                        $email1 == '') ? null : $email1;
                    $email->country_code = ($countryCode == 'NULL' || $countryCode == null ||
                        $countryCode == '' || $countryCode == 0) ? null : $countryCode;
                    $email->phone = ($phone == 'NULL' || $phone == null ||
                        $phone == '') ? null : $phone;
                    $email->file_name = $request->fileName ?? null;
                    $email->save();
                    if ($request->groups) {
                        $list = array();
                        foreach ($request->groups as $val) {
                            $data = array(
                                'email_group_id' => $val,
                                'email_id' => $email->id,
                                'owner_id' => \Illuminate\Support\Facades\Auth::id()
                            );
                            array_push($list, $data);
                        }

                        EmailListGroup::insert(
                            $list
                        );
                    }
                }
            }

            Alert::success(translate('Success'), translate('CSV Imported'));
            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

    }


    /**
     * EXPORT
     */

    public function exportCsv()
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        try {

            $connect = mysqli_connect(
                env('DB_HOST'),
                env('DB_USERNAME'),
                env('DB_PASSWORD'),
                env('DB_DATABASE')
            );

            header('Content-Type: text/csv; charset=utf-8');

            header('Content-Disposition: attachment; filename=data.csv');

            $output = fopen("php://output", "w");

            fputcsv($output, array('id',
                    'owner_id',
                    'first_name',
                    'last_name',
                    'company_name',
                    'name',
                    'email',
                    'country_code',
                    'phone',
                    'file_name',
                    'favourites',
                    'blocked',
                    'trashed',
                    'is_subscribed',
                    'deleted_at',
                    'created_at',
                    'updated_at')
            );

            $id = \Illuminate\Support\Facades\Auth::id();
            $query = "SELECT id, owner_id, first_name, last_name, company_name, name, email, country_code, phone, 
                                       file_name, favourites, blocked, trashed, is_subscribed, deleted_at, created_at, updated_at 
                            from email_contacts where owner_id = $id ORDER BY id DESC";

            $result = mysqli_query($connect, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($output, $row);
            }

            fclose($output);

        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

    }

    /**
     * DOWNLOAD CSV
     */
    public function sampleCsv()
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        try {
            return response()->download(csv_path());
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Invoice Not Found'));
            return back()->withErrors($th->getMessage());
        }
    }


    /**
     * AJAX PAGINATION
     */
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $emails = EmailContact::where('owner_id', Auth::user()->id)
                ->whereNotNull('email')
                ->orderBy('email')
                ->Active()
                ->latest()
                ->simplePaginate(20);
            return view('email_contacts.load_pages.emails', compact('emails'));
        }
    }

    //END
}
