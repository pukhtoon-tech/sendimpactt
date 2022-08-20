@extends('layout.' .  layout())

@section('subhead')
    <title>{{ $email->name ?? $email->email }}</title>
@endsection

@section('subcontent')
         <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ Str::upper($email->name ?? $email->email ?? '+' . $email->country_code . $email->phone) }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="{{ $email->name }}" class="rounded-full" src="{{ emailAvatar($email->name ?? $email->email ?? $email->phone) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ Str::upper($email->name ?? $email->email) }}</div>
                    </div>
                 
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                     <p>@translate(Edit email contacts with valid user informations. Must provide exist email address and verified phone number with country code. For example +8801825731327)</p>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center mt-5" href="{{ route('email.contacts.index') }}">
                        <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> @translate(Go Back)
                    </a>
                </div>
               
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Information)</h2>
                </div>
                <div class="p-5">

                    <form action="{{ route('email.contact.update', $email->id) }}" method="POST" data-parsley-validate="">
                        @csrf
                    
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt="{{ $email->name ?? null }}" src="{{ emailAvatar($email->email ?? 'MD') }}">
                                </div>                                
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> 
                <label>@translate(Full Name) 
                    <small>@translate(Empty username field will make name from email.)</small>
                </label> 
                <input type="text" name="name" value="{{ $email->name ?? null }}" class="input w-full border mt-2" placeholder="@translate(User Name)"> 
            </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> 
                <label class="flex flex-col sm:flex-row"><label> @translate(Email Address) 
                    <small>@translate(Empty email field will not count as an email contact.)</small>
                </label> 
                <input type="email" name="email" value="{{ $email->email }}" class="input w-full border mt-2" placeholder="@translate(Enter Email)" data-parsley-type="email">
                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> 
                <label class="flex flex-col sm:flex-row"><label> @translate(Phone Number) 
                    <small>@translate(Empty phone field will not count as a sms contact.)</small>
                </label> 

                <div class="flex">

                <div class="w-2/5">

                        <select data-search="true" class="tail-select w-full" name="country_code">

                            @forelse (country_codes() as $country_code)
                                <option data-countryCode="{{ $country_code->iso3 }}" value="{{ $country_code->phonecode }}" {{ $country_code->phonecode == $email->country_code ? 'selected' : null }}>{{ $country_code->nicename }} (+{{ $country_code->phonecode }})</option>
                            @empty
                                <option data-countryCode="" value="">No country found</option>
                            @endforelse
                            
                        </select>

                    </div>
                
                <input type="text" name="phone" class="input w-full border" value="{{ $email->phone }}" placeholder="@translate(User Phone)"
                    minlength="2">

                    </div>

                 </div>
            </div>
                            <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">@translate(Save)</button>
                        </div>
                    </div>
</form>

                </div>
            </div>
            <!-- END: Display Information -->
        
        </div>
    </div>
@endsection

@section('script')
<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('assets/js/parsley.js') }}"></script>
<script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection