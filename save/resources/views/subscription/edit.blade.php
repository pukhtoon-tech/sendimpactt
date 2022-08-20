@extends('layout.' .  layout())

@section('subhead')
    <title>{{ Str::upper($edit_plan->name) }} @translate(Plan)</title>
@endsection

@section('subcontent')

<div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-12">
    <h2 class="text-lg font-medium mr-auto">@translate(Edit) {{ Str::upper($edit_plan->name) }} @translate(Subscription Plan & Limit) </h2>
</div>
<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <form class="" 
        enctype="multipart/form-data"
        action="{{ route('subscription.update', $edit_plan->id) }}"
        method="POST">
        @csrf

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Name) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: @translate(Free)</span>
                </label>
                
                <select data-placeholder="Select your favorite actors" name="name" data-search="true" class="tail-select w-full" single data-parsley-required> 
                     <option selected>Select Plan</option> 
                     <option value="free" {{ $edit_plan->name == 'free' ? 'selected' : '' }} >Free</option> 
                     <option value="monthly" {{ $edit_plan->name == 'monthly' ? 'selected' : '' }}>Monthly</option> 
                     <option value="yearly" {{ $edit_plan->name == 'yearly' ? 'selected' : '' }}>Yearly</option> 
                </select>

            </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Description) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: This plan is all about free users</span>
                </label>
                
                <textarea data-simple-toolbar="true" class="editor" name="description" data-parsley-required>
                      {{ $edit_plan->description }}
                </textarea> 

                 </div>
            </div>

            
            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Duration) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 2 months</span>
                </label> 
                
                <select data-placeholder="Select your favorite actors" name="duration" data-search="true" class="tail-select w-full" single data-parsley-required> 
                     <option selected>Select Month</option> 
                     <option value="1" {{ $edit_plan->duration == 1 ? 'selected' : '' }} >1 Month</option> 
                     <option value="2" {{ $edit_plan->duration == 2 ? 'selected' : '' }} >2 Months</option> 
                     <option value="3" {{ $edit_plan->duration == 3 ? 'selected' : '' }} >3 Months</option>
                     <option value="4" {{ $edit_plan->duration == 4 ? 'selected' : '' }} >4 Months</option> 
                     <option value="5" {{ $edit_plan->duration == 5 ? 'selected' : '' }} >5 Months</option> 
                     <option value="6" {{ $edit_plan->duration == 6 ? 'selected' : '' }} >6 Months</option> 
                     <option value="7" {{ $edit_plan->duration == 7 ? 'selected' : '' }} >7 Months</option> 
                     <option value="8" {{ $edit_plan->duration == 8 ? 'selected' : '' }} >8 Months</option> 
                     <option value="9" {{ $edit_plan->duration == 9 ? 'selected' : '' }} >9 Months</option> 
                     <option value="10" {{ $edit_plan->duration == 10 ? 'selected' : '' }} >10 Months</option> 
                     <option value="11" {{ $edit_plan->duration == 11 ? 'selected' : '' }} >11 Months</option> 
                     <option value="12" {{ $edit_plan->duration == 12 ? 'selected' : '' }} >12 Months</option> 
                </select> 

                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Limits Of Email) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 1000</span>
                </label> <input type="number" name="emails" value="{{ $edit_plan->emails }}" class="input w-full border mt-2" placeholder="Limits Of Email" data-parsley-required>
                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Limits Of SMS) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 1000</span>
                </label> <input type="number" name="sms" value="{{ $edit_plan->sms }}" class="input w-full border mt-2" placeholder="Limits Of SMS" data-parsley-required>
                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Price) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 100</span>
                </label> <input type="number" name="price"  value="{{ $edit_plan->price }}" class="input w-full border mt-2" placeholder="Plan Price" data-parsley-required>
                 </div>
            </div>


            <div class="flex items-center text-gray-700 dark:text-gray-500 mt-5"> 
                <input type="checkbox" name="status" value="1" class="input border mr-2" id="vertical-remember-me" {{ $edit_plan->status == 1 ? 'checked' : '' }}> 
                <label class="cursor-pointer select-none" for="vertical-remember-me">Publish Now</label>
            </div>

            <div class="flex items-center text-gray-700 dark:text-gray-500 mt-5"> 
                <input type="checkbox" name="display" value="1" class="input border mr-2" id="vertical-remember-me" {{ $edit_plan->display == 1 ? 'checked' : '' }}> 
                <label class="cursor-pointer select-none" for="vertical-remember-me">Display at frontend</label>
            </div>


         
   
       <button type="submit"
                class="button bg-theme-1 text-white mt-5">@translate(Publish)</button>
        </form>
        <!-- END: Form Layout -->
   
</div>
</div>

@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection