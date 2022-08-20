<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend;
use App\Models\FrontendModule;
use App\Models\FrontendFeature;
use Alert;
use Auth;
use App\Models\Demo;
use App\Models\SubscriptionPlan;
use App\Models\PlanPurchased;
use App\Models\EmailContact;
use App\Models\EmailGroup;
use App\Models\EmailListGroup;
use App\Models\User;
use Illuminate\Support\Str;
use Notification;
use App\Notifications\SubscriberNotification;

class FrontendController extends Controller
{

    function __construct()
    {
        $this->middleware(['installed']);
    }

    /**
     * INDEX
     */

    public function index()
    {
        if (disable_theme()) {
            return redirect()->route('dashboard'); // Redirect to dashboard
        }else {
            return view('frontend.' . theme() . '.index'); // Load theme index
        }
    }

    /**
     * SETUP
     */

    public function setup()
    {
        return view('frontend.dashboard.index');
    }
     
    /**
     * store
     */

    public function store(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
        
        /**
         * HEADER
         */

        try {

        if ($request->has('slider_label')) {
            $frontend = Frontend::where('label', 'slider_label')->first();
            $frontend->label = 'slider_label';
            $frontend->value = $request->slider_label;
            $frontend->save();
        }

        if ($request->has('slider_title')) {
            $frontend = Frontend::where('label', 'slider_title')->first();
            $frontend->label = 'slider_title';
            $frontend->value = $request->slider_title;
            $frontend->save();
        }

        if ($request->has('slider_small')) {
            $frontend = Frontend::where('label', 'slider_small')->first();
            $frontend->label = 'slider_small';
            $frontend->value = $request->slider_small;
            $frontend->save();
        }

        if ($request->hasFile('slider_image')) {
            $frontend = Frontend::where('label', 'slider_image')->first();
            $frontend->value = fileUpload($request->slider_image,'slider_image');
            $frontend->save();
        }

        /**
         * Module
         */

            if ($request->has('module1')) {
                $module1 = FrontendModule::where('label', 'module1')->first();
                $module1->label = 'module1';
                $module1->title = $request->module1_title;
                $module1->small = $request->module1_small;
                $module1->list1 = $request->module1_list1;
                $module1->list2 = $request->module1_list2;
                $module1->list3 = $request->module1_list3;

                if ($request->hasFile('module1_image')) {
                    $module1->image = fileUpload($request->module1_image,'modules');
                }

                $module1->save();
            }

            if ($request->has('module2')) {
                $module2 = FrontendModule::where('label', 'module2')->first();
                $module2->label = 'module2';
                $module2->title = $request->module2_title;
                $module2->small = $request->module2_small;
                $module2->list1 = $request->module2_list1;
                $module2->list2 = $request->module2_list2;
                $module2->list3 = $request->module2_list3;
                if ($request->hasFile('module2_image')) {
                    $module2->image = fileUpload($request->module2_image,'modules');
                }
                $module2->save();
            }

            if ($request->has('module3')) {
                $module3 = FrontendModule::where('label', 'module3')->first();
                $module3->label = 'module3';
                $module3->title = $request->module3_title;
                $module3->small = $request->module3_small;
                $module3->list1 = $request->module3_list1;
                $module3->list2 = $request->module3_list2;
                $module3->list3 = $request->module3_list3;
                if ($request->hasFile('module3_image')) {
                    $module3->image = fileUpload($request->module3_image,'modules');
                }
                $module3->save();
            }

            if ($request->has('module4')) {
                $module4 = FrontendModule::where('label', 'module4')->first();
                $module4->label = 'module4';
                $module4->title = $request->module4_title;
                $module4->small = $request->module4_small;
                $module4->list1 = $request->module4_list1;
                $module4->list2 = $request->module4_list2;
                $module4->list3 = $request->module4_list3;
                if ($request->hasFile('module4_image')) {
                    $module4->image = fileUpload($request->module4_image,'modules');
                }
                $module4->save();
            }

            /**
             * FEATURES
             */

                $features = FrontendFeature::where('label', 'features_title')->first();
                $features->label = 'features_title';
                $features->title = $request->features_title;
                $features->small = $request->features_small;
                $features->save();

                $features1 = FrontendFeature::where('label', 'features1')->first();
                $features1->label = 'features1';
                $features1->title = $request->features1_title;
                $features1->small = $request->features1_small;
                if ($request->hasFile('features1_icon')) {
                    $features1->icon = fileUpload($request->features1_icon,'features');
                }
                $features1->save();

                $features2 = FrontendFeature::where('label', 'features2')->first();
                $features2->label = 'features2';
                $features2->title = $request->features2_title;
                $features2->small = $request->features2_small;
                if ($request->hasFile('features2_icon')) {
                    $features2->icon = fileUpload($request->features2_icon,'features');
                }
                $features2->save();

                $features3 = FrontendFeature::where('label', 'features3')->first();
                $features3->label = 'features3';
                $features3->title = $request->features3_title;
                $features3->small = $request->features3_small;
                if ($request->hasFile('features3_icon')) {
                    $features3->icon = fileUpload($request->features3_icon,'features');
                }
                $features3->save();

                $features4 = FrontendFeature::where('label', 'features4')->first();
                $features4->label = 'features4';
                $features4->title = $request->features4_title;
                $features4->small = $request->features4_small;
                if ($request->hasFile('features4_icon')) {
                    $features4->icon = fileUpload($request->features4_icon,'features');
                }
                $features4->save();

                $features5 = FrontendFeature::where('label', 'features5')->first();
                $features5->label = 'features5';
                $features5->title = $request->features5_title;
                $features5->small = $request->features5_small;
                if ($request->hasFile('features5_icon')) {
                    $features5->icon = fileUpload($request->features5_icon,'features');
                }
                $features5->save();

                $features6 = FrontendFeature::where('label', 'features6')->first();
                $features6->label = 'features6';
                $features6->title = $request->features6_title;
                $features6->small = $request->features6_small;
                if ($request->hasFile('features6_icon')) {
                    $features6->icon = fileUpload($request->features6_icon,'features');
                }

                $features6->save();

            Alert::success(translate('Success'), translate('Save Changed'));
            return back();

         } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
         }
    }

    /**
     * PAYMENT
     */

     public function payment($id, $plan)
     {
        $subscription_plan = SubscriptionPlan::where('id', $id)->first();
        return view('frontend.payment', compact('subscription_plan'));
     }


     /**
      * newSubscriber
      */

      public function newSubscriber(Request $request)
      {

            $checkAdmin = User::where('user_type', 'Admin')->first();
            $checkEmail = EmailContact::where('email', $request->email)->count();
            $checkGroup = EmailGroup::where('name', 'Subscribed')->count();

            if ($checkEmail <= 0) {

                $email = new EmailContact();
                $email->owner_id = $checkAdmin->id;
                $email->name = $request->name;
                $email->email = $request->email;
                $email->phone = $request->phone;
                $email->country_code = null;
                $email->is_subscribed = true;
                $email->save(); 

                if ($checkGroup <= 0) {

                    $group = new EmailGroup();
                    $group->owner_id = $checkAdmin->id;
                    $group->name = "Subscribed";
                    $group->description = null;
                    $group->status = true;
                    $group->save();

                    $group_email = new EmailListGroup();
                    $group_email->email_group_id = $group->id;
                    $group_email->email_id = $email->id;
                    $group_email->save();

                }else{

                    $update_group = EmailGroup::where('name', 'Subscribed')->first();
                    $update_group->owner_id = $checkAdmin->id;
                    $update_group->name = "Subscribed";
                    $update_group->description = null;
                    $update_group->status = true;
                    $update_group->save();

                    $new_group_email = new EmailListGroup();
                    $new_group_email->email_group_id = $update_group->id;
                    $new_group_email->email_id = $email->id;
                    $new_group_email->save();

                }

                try {
                    $user_email = User::first();
                    Notification::send($user_email, new SubscriberNotification());
                } catch (\Throwable $th) {
                    //throw $th;
                }
                return translate('Subscribed');
            }else{
                return translate('Already Subscribed');
            }
      }

    //END
}