@extends('../layout/' . layout())

@section('subhead')
<title>@translate(SMTP Setup)</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">@translate(SMTP Setup)</h2>


<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-6 lg:col-span-6">
        <!-- BEGIN: Form Layout -->

        <form class="" 
        enctype="multipart/form-data"
        action="{{ route('system.smtp.configure.update') }}"
        onsubmit="return validateform()"
        method="GET">

            <div class="mt-3">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row"> @translate(SMTP Providers)*</label> 
                    <select class="w-full form-select sm:w-1/2" name="provider_name" required>
                        @forelse (smtp_provider_list() as $smtp_provider_list)
                            <option value="{{ Str::lower($smtp_provider_list) }}" {{ env('DEFAULT_MAIL') === Str::lower($smtp_provider_list) ? 'selected' : null }}>{{ $smtp_provider_list }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row"> @translate(Driver)</label> 
                    <select class="w-full form-select sm:w-1/2" name="driver">
                        @forelse (smtp_driver_list() as $smtp_driver_list)
                            <option value="{{ $smtp_driver_list }}" {{ env('MAIL_MAILER') == $smtp_driver_list ? 'selected' : null }}>{{ Str::upper($smtp_driver_list) }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="host"> @translate(Host)*</label> 
                    <input type="text" name="host" value="{{ env('MAIL_HOST') }}" class="input w-full border mt-2" id="host" placeholder="smtp.mailtrap.io" data-parsley-type="text" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="Port"> @translate(Port)*</label> 
                    <input type="number" name="port" value="{{ env('MAIL_PORT') }}" class="input w-full border mt-2" id="Port" placeholder="2525" data-parsley-type="number" required>
                    <small>2525, 25, 587, 465</small>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="username"> @translate(Username)*</label> 
                    <input type="text" name="username" value="{{ env('MAIL_USERNAME') }}" class="input w-full border mt-2" id="username" placeholder="username" data-parsley-type="text" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="password"> @translate(Password)*</label> 
                    <input type="password" name="password"  value="{{ env('MAIL_PASSWORD') }}" class="input w-full border mt-2" id="password" placeholder="password" data-parsley-type="text" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row"> @translate(Security)</label> 
                    <select class="w-full form-select sm:w-1/2" name="encryption">
                        <option value="" {{ env('MAIL_ENCRYPTION') === '' ? 'selected' : null }}>No Encryption</option>
                        <option value="tls" {{ env('MAIL_ENCRYPTION') === 'tls' ? 'selected' : null }}>TLS</option>
                        <option value="ssl" {{ env('MAIL_ENCRYPTION') === 'ssl' ? 'selected' : null }}>SSL</option>
                    </select>
                </div>
            </div>


            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="from"> @translate(Email From Address)*</label> 
                    <input type="email" name="from" class="input w-full border mt-2"  value="{{ env('MAIL_FROM_ADDRESS') }}" id="from" placeholder="Email From Address" data-parsley-type="email" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="from_name"> @translate(Email From Name)*</label> 
                    <input type="text" name="from_name" class="input w-full border mt-2" value="{{ env('MAIL_FROM_NAME') }}" id="from_name" placeholder="Email From Name" data-parsley-type="text" required>
                </div>
            </div>


            <div class="mt-6">
                <button type="submit" class="button text-white bg-theme-1 mr-2">@translate(Save Changes)</button>
                <a href="{{ route('system.smtp.configure.test') }}" type="submit" class="button text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
            </div>

        </div>


        <div class="intro-y col-span-6 lg:col-span-6">
            <h2 class="text-3xl">@translate(Instruction)</h2>
            <p class="text-red-500 text-lg">@translate(Please be careful when you are configuring SMTP. For incorrect configuration you may get error at the time of order placing, new registration and some other features.)</p>
        <hr class="mt-3 mb-3">
        <h2 class="text-3xl">@translate(For Non-SSL)</h2>
        
        <ul>
            <li class="text-lg">Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver</li>
            <li class="text-lg">Set Mail Host according to your server Mail Client Manual Settings</li>
            <li class="text-lg">Set Mail port as '587'</li>
            <li class="text-lg">Set Mail Encryption as 'ssl' if you face issue with 'tls'</li>
        </ul>
        <hr class="mt-3 mb-3">
        <h2 class="text-3xl">@translate(For SSL)</h2>
        <ul>
            <li class="text-lg">Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver</li>
            <li class="text-lg">Set Mail Host according to your server Mail Client Manual Settings</li>
            <li class="text-lg">Set Mail port as '465'</li>
            <li class="text-lg">Set Mail Encryption as 'ssl'</li>
        </ul>
        </div>

            
   
        </form>
        <!-- END: Form Layout -->
   
</div>


@endsection

@section('script')

@endsection