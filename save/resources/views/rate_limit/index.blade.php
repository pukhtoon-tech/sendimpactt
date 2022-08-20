@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Limit Manager)</title>
@endsection

@section('subcontent')

 <h2 class="intro-y text-lg font-medium mt-10">@translate(Limit Manager)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="javascript:;" 
                data-toggle="modal" 
                data-target="#superlarge-limit-modal-size-preview" 
                class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" 
                title="@translate(Add New Subscription Plan & Limit)">
                @translate(Add New User With Subscription Plan & Limit)
            </a>
        </div>
        <!-- BEGIN: Users Layout -->

        @forelse ($limits as $limit)

        @if ($limit->user != null)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="{{ $limit->user->name }}" class="rounded-full tooltip" title="{{ $limit->user->name }}" src="{{ namevatar($limit->user->name) }}">
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="javascript:;" class="font-medium">{{ Str::upper($limit->user->name) }}</a>
                            <div class="text-gray-600 text-xs">{{ $limit->user->user_type }}</div>
                        </div>
                        <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                            <a href="{{ route('limit.manage', $limit->user->id) }}" class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 m-2">@translate(Manage Limit)</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:flex-no-wrap items-center justify-center p-5">
                        <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">

                            <div>
                                <label for="">@translate(Emails)</label>
                                <div class="w-full h-4 bg-gray-400 dark:bg-dark-1 rounded">
                                    <div class="{{ emailLimitProgressBar($limit->user->id) }} h-full rounded text-center text-xs text-white">{{ round(emailLimitCheckPercentage($limit->user->id)) }}%</div>
                                </div>
                            </div>

                            <div class="my-3">
                                <label for="">@translate(SMS)</label>
                                <div class="w-full h-4 bg-gray-400 dark:bg-dark-1 rounded">
                                    <div class="{{ smsLimitProgressBar($limit->user->id) }} h-full rounded text-center text-xs text-white">{{ round(smsLimitCheckPercentage($limit->user->id)) }}%</div>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
            </div>

            @endif
        @empty

        @endforelse

        
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        {{ $limits->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>


    {{-- modal --}}


                        <div class="modal" id="superlarge-limit-modal-size-preview">
                            <div class="modal__content modal__content--xl p-10"> 
                                <div class="intro-y flex items-center mt-8">
                                    <h2 class="text-lg font-medium mr-auto">@translate(Add New Subscription Plan & Limit )</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-12 mt-5">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                        <!-- BEGIN: Form Layout -->

                                        <form class="" 
                                            enctype="multipart/form-data"
                                            action="{{ route('limit.create') }}"
                                            method="POST">
                                            @csrf

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Full Name) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: John Doe</span>
                                                    </label> <input type="text" name="name" class="input w-full border mt-2" placeholder="Full Name" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Email Address) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: johndoe$mail.com</span>
                                                    </label> <input type="email" name="useremail" class="input w-full border mt-2" placeholder="Email Address" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Password) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 12345678</span>
                                                    </label> <input type="password" name="password" class="input w-full border mt-2" placeholder="Password" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label>@translate(Email Limit)</label>
                                                <input type="number" name="email" value="" class="input w-full border mt-2" placeholder="Email Limit" data-parsley-required>
                                            </div>
                                        
                                            <div class="mt-3">
                                                <label>@translate(SMS Limit)</label>
                                                <input type="number" name="sms" value="" class="input w-full border mt-2" placeholder="SMS Limit" data-parsley-required>
                                            </div>


                                            <div class="mt-3">
                                                    <div class="input-form"> 
                                                        
                                                        <label class="flex flex-col sm:flex-row"> @translate(Plan Duration) <span
                                                                class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 2 months</span>
                                                        </label> 
                                                        
                                                        <select data-placeholder="Select your favorite actors" name="duration" data-parsley-required data-search="true" class="tail-select w-full" single> 
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

                                            <div class="mt-3">
                                                    <div class="input-form"> 
                                                        
                                                        <label class="flex flex-col sm:flex-row"> @translate(User Role) <span
                                                                class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: Customer</span>
                                                        </label> 
                                                        
                                                        <select data-placeholder="Select your favorite actors" data-parsley-required name="user_type" data-search="true" class="tail-select w-full" single> 
                                                            <option selected>Select Month</option> 
                                                            <option value="Admin">Admin</option> 
                                                            <option value="Customer">Customer</option> 
                                                        </select> 

                                                    </div>
                                            </div>
                                    
                                                <button type="submit"
                                                    class="button bg-theme-1 text-white mt-5">@translate(Create)</button>
                                        </form>
                                        <!-- END: Form Layout -->
                                
                                    </div>
                                </div>
                                </div>
                        </div>

                    </div>


                        {{-- modal::END --}}
                        
  
@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection