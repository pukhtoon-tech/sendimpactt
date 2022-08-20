<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Autoresponder;
use App\Models\AutoresponderContacts;
use App\Models\AutoresponderTemplate;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Models\EmailContact;
use Auth;
use Illuminate\Http\Request;

class AutoresponderController extends Controller
{
    // index
    public function index()
    {
        $autoresponders = Autoresponder::where('owner_id', Auth::id())->paginate(20);

        return view('autoresponder.index', compact('autoresponders'));
    }

    // create_step1
    public function create_step1()
    {
        return view('autoresponder.create.step1');
    }

    // autoresponder_builder
    public function autoresponder_builder(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'campaign_id' => 'required',
        ], [
            'name.required' => 'Please enter autoresponder name',
            'name.max' => 'Autoresponder name must be less than 255 characters',
            'campaign_id.required' => 'Please select campaign',
        ]);

        $responder = new Autoresponder;
        $responder->name = $request->name;
        $responder->campaign_id = $request->campaign_id;
        $responder->owner_id = Auth::id();

        if ($responder->status = 1) {
            $responder->status = true;
        } else {
            $responder->status = false;
        }
        $responder->save();

        $autoresponder_id = $responder->id;

        return view('autoresponder.create.builder', compact('autoresponder_id'));
    }

    // store
    public function store(Request $request, $autoresponder_id)
    {
        try {
            $responder = Autoresponder::where('id', $autoresponder_id)->first();
            $templates = $request->template_id;

            foreach ($templates as $key => $template) {
                // autoresponder_template
                $autoresponder_template = new AutoresponderTemplate;
                $autoresponder_template->autoresponder_id = $autoresponder_id;
                $autoresponder_template->template_id = $template;
                $autoresponder_template->position = $key + 1;
                $autoresponder_template->uuid = rand(10, 100).$autoresponder_id.$responder->campaign_id.$responder->status;
                $autoresponder_template->save();

                // campaign_emails
                $campaign_emails = CampaignEmail::where('campaign_id', $responder->campaign_id)->get('email_id');

                foreach ($campaign_emails as $campaign_email) {
                    if (EmailContact::where('id', $campaign_email->email_id)->first()->email ?? null != null) {
                        $contacts = new AutoresponderContacts;
                        $contacts->autoresponder_id = $responder->id;
                        $contacts->template_id = $autoresponder_template->template_id;
                        $contacts->uuid = rand(10, 100).$responder->id.$responder->campaign_id.$responder->status;
                        $contacts->campaign_id = $responder->campaign_id;
                        $contacts->contact_id = $campaign_email->email_id;
                        $contacts->email = EmailContact::where('id', $campaign_email->email_id)->first()->email ?? null;
                        $contacts->phone = null;
                        $contacts->status = 0;
                        $contacts->position = $autoresponder_template->position;
                        $contacts->save();
                    }
                }
            }

            Alert::success(translate('Wow, Great!'), translate('Autoresponder has been created successfully.'));

            return redirect()->route('autoresponder.index');
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Autoresponder failed to create.'));

            return redirect()->route('autoresponder.index')->withErrors($th->getMessage());
        }
    }

    // edit_step1
    public function edit_step1($id)
    {
        $autoresponder = Autoresponder::where('id', $id)->first();

        return view('autoresponder.edit.step1', compact('autoresponder'));
    }

    // autoresponder_builder_edit
    public function autoresponder_builder_edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'campaign_id' => 'required',
        ], [
            'name.required' => 'Please enter autoresponder name',
            'name.max' => 'Autoresponder name must be less than 255 characters',
            'campaign_id.required' => 'Please select campaign',
        ]);

        $responder = Autoresponder::where('id', $id)->first();
        $responder->name = $request->name;
        $responder->campaign_id = $request->campaign_id;

        if ($responder->status = 1) {
            $responder->status = true;
        } else {
            $responder->status = false;
        }
        $responder->save();

        $autoresponder_id = $responder->id;

        $autoresponder_templates = AutoresponderTemplate::where('autoresponder_id', $autoresponder_id)->get();

        return view('autoresponder.edit.builder', compact('autoresponder_id', 'autoresponder_templates'));
    }

    // store
    public function update(Request $request, $autoresponder_id)
    {
        try {
            $responder = Autoresponder::where('id', $autoresponder_id)->first();
            $templates = $request->template_id;

            foreach ($templates as $key => $template) {
                // autoresponder_template
                $autoresponder_template = new AutoresponderTemplate;
                $autoresponder_template->autoresponder_id = $autoresponder_id;
                $autoresponder_template->template_id = $template;
                $autoresponder_template->position = $key + 1;
                $autoresponder_template->uuid = rand(10, 100).$autoresponder_id.$responder->campaign_id.$responder->status;
                $autoresponder_template->save();

                // campaign_emails
                $campaign_emails = CampaignEmail::where('campaign_id', $responder->campaign_id)->get('email_id');

                foreach ($campaign_emails as $campaign_email) {
                    if (EmailContact::where('id', $campaign_email->email_id)->first()->email ?? null != null) {
                        $contacts = new AutoresponderContacts;
                        $contacts->autoresponder_id = $responder->id;
                        $contacts->template_id = $autoresponder_template->template_id;
                        $contacts->uuid = rand(10, 100).$responder->id.$responder->campaign_id.$responder->status;
                        $contacts->campaign_id = $responder->campaign_id;
                        $contacts->contact_id = $campaign_email->email_id;
                        $contacts->email = EmailContact::where('id', $campaign_email->email_id)->first()->email ?? null;
                        $contacts->phone = null;
                        $contacts->status = 0;
                        $contacts->position = $autoresponder_template->position;
                        $contacts->save();
                    }
                }
            }

            Alert::success(translate('Wow, Great!'), translate('Autoresponder has been created successfully.'));

            return redirect()->route('autoresponder.index');
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Autoresponder failed to create.'));

            return redirect()->route('autoresponder.index')->withErrors($th->getMessage());
        }
    }

    //destroy
    public function destroy($autoresponder_id)
    {
        $autoresponder = Autoresponder::where('id', $autoresponder_id)->first();
        $autoresponder->autoresponder_templates()->delete();
        $autoresponder->autoresponder_contacts()->delete();
        $autoresponder->delete();
        Alert::success(translate('Wow, Great!'), translate('Autoresponder has been deleted successfully.'));

        return redirect()->route('autoresponder.index');
    }

    //END
}
