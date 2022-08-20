@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Manage) {{ username() }} @translate(Limit)</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">@translate(Manage) {{ username() }} @translate(Limit)</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('rate_limit.components.side_menu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Manage Email And SMS Limit)</h2>
                </div>
                <div class="p-5">
                    <form action="{{ route('limit.update', $limit_user->owner_id) }}" method="post">
                        @csrf
                  
                    <div class="mt-3">
                        <label>@translate(Email Limit)</label>
                        <input type="number" name="email" value="{{ $limit_user->email }}" class="input w-full border mt-2" placeholder="Email Limit" data-parsley-required>
                    </div>
                  
                    <div class="mt-3">
                        <label>@translate(SMS Limit)</label>
                        <input type="number" name="sms" value="{{ $limit_user->sms }}" class="input w-full border mt-2" placeholder="SMS Limit" data-parsley-required>
                    </div>


                    <div class="mt-3">
                            <div class="input-form"> 
                                
                                <label class="flex flex-col sm:flex-row"> @translate(Plan Duration) <span
                                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 2 months</span>
                                </label> 
                                
                                <select data-placeholder="Select your favorite actors" name="duration" data-search="true" class="tail-select w-full" single data-parsley-required> 
                                    <option selected>Select Month</option> 
                                    <option value="1">1 Month</option> 
                                    <option value="2">2 Months</option> 
                                    <option value="3">3 Months</option>
                                    <option value="4">4 Months</option> 
                                    <option value="5">5 Months</option> 
                                    <option value="6">6 Months</option> 
                                    <option value="7">7 Months</option> 
                                    <option value="8">8 Months</option> 
                                    <option value="9">9 Months</option> 
                                    <option value="10">10 Months</option> 
                                    <option value="11">11 Months</option> 
                                    <option value="12">12 Months</option> 
                                </select> 

                            </div>
                    </div>
                  
                    <button type="submit" class="button bg-theme-1 text-white mt-4">@translate(Update Limit)</button>
                    </form>
                </div>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>
@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection