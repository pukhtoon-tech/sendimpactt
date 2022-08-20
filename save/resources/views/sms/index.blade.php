@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(SMS Settings)</title>
@endsection

@section('subcontent')

<h2 class="intro-y text-lg font-medium mt-10">
    @translate(SMS Gateways)
</h2>

<div class="grid grid-cols-12 gap-6 mt-5">

    {{-- twilio --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(Twilio)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('twilio') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(Twilio)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'twilio') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TWILIO_ID={{ $twilio->sms_id ?? NULL }}
                        <input type="hidden" name="TWILIO_SID" class="input w-full border mt-2"
                            placeholder="TWILIO SID" value="{{ $twilio->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TWILIO_TOKEN={{ $twilio->sms_token ?? NULL }}
                        <input type="hidden" name="TWILIO_TOKEN" class="input w-full border mt-2"
                            placeholder="TWILIO TOKEN" value="{{ $twilio->sms_token ?? NULL }}">

                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TWILIO_FROM={{ $twilio->sms_from ?? NULL }}
                        <input type="hidden" placeholder="TWILIO FROM" class="input w-full border mt-2"
                            name="TWILIO_FROM" value="{{ $twilio->sms_from ?? NULL }}">

                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TWILIO_NUMBER={{ $twilio->sms_number ?? NULL }}
                        <input type="hidden" name="TWILIO_NUMBER" class="input w-full border mt-2"
                            placeholder="TWILIO NUMBER" value="{{ $twilio->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'twilio') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>

                        @if (getSmsInfo('twilio'))
                        <a href="{{ route('sms.connection.test', 'twilio') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                        @endif

            </form>
        </div>
    </div>
</div>
{{-- twilio::END --}}

    {{-- nexmo --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(Nexmo)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('nexmo') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(Nexmo/Vonage)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'nexmo') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        NEXMO_KEY={{ $nexmo->sms_id ?? NULL }}
                        <input type="hidden" name="NEXMO_KEY" class="input w-full border mt-2"
                            placeholder="NEXMO KEY" value="{{ $nexmo->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        NEXMO_SECRET={{ $nexmo->sms_token ?? NULL }}
                        <input type="hidden" name="NEXMO_SECRET" class="input w-full border mt-2"
                            placeholder="NEXMO SECRET" value="{{ $nexmo->sms_token ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        NEXMO_FROM={{ $nexmo->sms_from ?? NULL }}
                        <input type="hidden" name="NEXMO_FROM" class="input w-full border mt-2"
                            placeholder="NEXMO FROM" value="{{ $nexmo->sms_from ?? NULL }}">
                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        NEXMO_NUMBER={{ $nexmo->sms_number ?? NULL }}
                        <input type="hidden" name="NEXMO_NUMBER" class="input w-full border mt-2"
                            placeholder="NEXMO NUMBER" value="{{ $nexmo->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'nexmo') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>
                    
                    @if (getSmsInfo('nexmo'))
                    <a href="{{ route('sms.connection.test', 'nexmo') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                    @endif

            </form>
        </div>
    </div>

     </div>

{{-- nexmo::END --}}

    {{-- PLIVO --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(PLIVO)" class="rounded-md" style="width: 200px; height: 80px;" src="{{ smsLogo('plivo') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(PLIVO)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'plivo') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        PLIVO_KEY={{ $plivo->sms_id ?? NULL }}
                        <input type="hidden" name="PLIVO_KEY" class="input w-full border mt-2"
                            placeholder="PLIVO KEY" value="{{ $plivo->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        PLIVO_TOKEN={{ $plivo->sms_token ?? NULL }}
                        <input type="hidden" name="PLIVO_TOKEN" class="input w-full border mt-2"
                            placeholder="PLIVO TOKEN" value="{{ $plivo->sms_token ?? NULL }}">
                    </div>
                    
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        PLIVO_FROM={{ $plivo->sms_from ?? NULL }}
                        <input type="hidden" name="PLIVO_FROM" class="input w-full border mt-2"
                            placeholder="PLIVO FROM" value="{{ $plivo->sms_from ?? NULL }}">
                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        PLIVO_NUMBER={{ $plivo->sms_number ?? NULL }}
                        <input type="hidden" name="PLIVO_NUMBER" class="input w-full border mt-2"
                            placeholder="PLIVO NUMBER" value="{{ $plivo->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'plivo') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>
                    
                    @if (getSmsInfo('plivo'))
                    <a href="{{ route('sms.connection.test', 'plivo') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                    @endif
            </form>
        </div>
    </div>

{{-- PLIVO::END --}}

</div>

{{-- SIGNALWIRE --}}

{{-- <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
    <div class="box">
        <div class="flex items-start px-5 pt-5">
            <div class="w-full flex flex-col lg:flex-row items-center">
                <div class="w-64 h-16 image-fit">
                    <img alt="@translate(SIGNALWIRE)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('signalwire') }}">
                </div>
                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                    @translate(SIGNALWIRE)
                </div>
            </div>
        </div>
        <form action="{{ route('sms.configure.default', 'signalwire') }}" method="POST">
            @csrf
            <div class="text-center lg:text-left p-5">
                <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                    <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                    SIGNALWIRE_PROJECT_ID={{ $signalwire->sms_id ?? NULL }}
                    <input type="hidden" name="SIGNALWIRE_PROJECT_ID" class="input w-full border mt-2"
                        placeholder="SIGNALWIRE PROJECT ID" value="{{ $signalwire->sms_id ?? NULL }}">
                </div>
                <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                    <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                    SIGNALWIRE_TOKEN={{ Str::limit($signalwire->sms_token ?? NULL, 40) }}
                    <input type="hidden" name="SIGNALWIRE_TOKEN" class="input w-full border mt-2"
                        placeholder="SIGNALWIRE TOKEN" value="{{ $signalwire->sms_token ?? NULL }}">
                </div>
                
                <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                    <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                    SIGNALWIRE_SPACE_URL={{ $signalwire->sms_from ?? NULL }}
                    <input type="hidden" name="SIGNALWIRE_SPACE_URL" class="input w-full border mt-2"
                        placeholder="SIGNALWIRE SPACE URL" value="{{ $signalwire->sms_from ?? NULL }}">
                </div>

                <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                    <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                    SIGNALWIRE_PHONE_NUMBER={{ $signalwire->sms_number ?? NULL }}
                    <input type="hidden" name="SIGNALWIRE_PHONE_NUMBER" class="input w-full border mt-2"
                        placeholder="SIGNALWIRE PHONE NUMBER" value="{{ $signalwire->sms_number ?? NULL }}">
                </div>
                
            </div>
            <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                <a href="{{ route('sms.configure', 'signalwire') }}"
                    class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>
                
                @if (getSmsInfo('signalwire'))
                <a href="{{ route('sms.connection.test', 'signalwire') }}"
                    class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                @endif
        </form>
    </div>
</div> --}}

{{-- SIGNALWIRE::END --}}

{{-- infobip --}}

<div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(INFOBIP)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('infobip') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(INFOBIP)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'infobip') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        INFOBIP_TOKEN={{ Str::limit($infobip->sms_token ?? NULL, 30) }}
                        <input type="hidden" name="INFOBIP_TOKEN" class="input w-full border mt-2"
                            placeholder="INFOBIP TOKEN" value="{{ $infobip->sms_token ?? NULL }}">
                    </div>
                

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        INFOBIP_PHONE_NUMBER={{ $infobip->sms_number ?? NULL }}
                        <input type="hidden" name="INFOBIP_PHONE_NUMBER" class="input w-full border mt-2"
                            placeholder="INFOBIP PHONE NUMBER" value="{{ $infobip->sms_number ?? NULL }}">
                    </div>
                  
                </div>

                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'infobip') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>
                    
                    @if (getSmsInfo('infobip'))
                    <a href="{{ route('sms.connection.test', 'infobip') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                    @endif
                </div>

            </form>
        </div>
    </div>
{{-- infobip::END --}}

{{-- viber --}}

<div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(VIBER)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('viber') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(VIBER)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'viber') }}" method="POST">
                @csrf

                <div class="text-center lg:text-left p-5">
                    
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        VIBER_SCENARIO={{ Str::limit($viber->sms_from ?? NULL, 30) }}
                        <input type="hidden" name="VIBER_SCENARIO" class="input w-full border mt-2"
                            placeholder="VIBER SCENARIO" value="{{ $viber->sms_from ?? NULL }}">
                    </div>

                    
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        VIBER_TOKEN={{ Str::limit($viber->sms_token ?? NULL, 30) }}
                        <input type="hidden" name="VIBER_TOKEN" class="input w-full border mt-2"
                            placeholder="VIBER TOKEN" value="{{ $viber->sms_token ?? NULL }}">
                    </div>


                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        VIBER_PHONE_NUMBER={{ $viber->sms_number ?? NULL }}
                        <input type="hidden" name="VIBER_PHONE_NUMBER" class="input w-full border mt-2"
                            placeholder="VIBER PHONE NUMBER" value="{{ $viber->sms_number ?? NULL }}">
                    </div>
                  
                </div>

                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">
                    <a href="{{ route('sms.configure', 'viber') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>
                    
                    @if (getSmsInfo('viber'))
                        <a href="{{ route('sms.connection.test', 'viber') }}"
                            class="button button--sm text-white bg-theme-7 mr-2">
                            @translate(Test Connection)
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>
{{-- viber::END --}}

{{-- WhatsApp --}}

<div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(WhatsApp)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('whatsapp') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(WhatsApp)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'whatsapp') }}" method="POST">
                @csrf

                <div class="text-center lg:text-left p-5">
                    
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        WHATSAPP_SCENARIO={{ Str::limit($whatsapp->sms_from ?? NULL, 30) }}
                        <input type="hidden" name="WHATSAPP_SCENARIO" class="input w-full border mt-2"
                            placeholder="WHATSAPP SCENARIO" value="{{ $whatsapp->sms_from ?? NULL }}">
                    </div>

                    
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        WHATSAPP_TOKEN={{ Str::limit($whatsapp->sms_token ?? NULL, 30) }}
                        <input type="hidden" name="WHATSAPP_TOKEN" class="input w-full border mt-2"
                            placeholder="WHATSAPP TOKEN" value="{{ $whatsapp->sms_token ?? NULL }}">
                    </div>


                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        WHATSAPP_PHONE_NUMBER={{ $whatsapp->sms_number ?? NULL }}
                        <input type="hidden" name="WHATSAPP_PHONE_NUMBER" class="input w-full border mt-2"
                            placeholder="WHATSAPP PHONE NUMBER" value="{{ $whatsapp->sms_number ?? NULL }}">
                    </div>
                  
                </div>

                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">
                    <a href="{{ route('sms.configure', 'whatsapp') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>
                    
                    @if (getSmsInfo('whatsapp'))
                        <a href="{{ route('sms.connection.test', 'whatsapp') }}"
                            class="button button--sm text-white bg-theme-7 mr-2">
                            @translate(Test Connection)
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>
{{-- WhatsApp::END --}}

{{-- VERSION 5.1.0 --}}
{{-- Telesign --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(Telesign)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('telesign') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(Telesign)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'telesign') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TELESIGN_ID={{ $telesign->sms_id ?? NULL }}
                        <input type="hidden" name="TELESIGN_SID" class="input w-full border mt-2"
                            placeholder="TELESIGN SID" value="{{ $telesign->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TELESIGN_TOKEN={{ Str::limit($telesign->sms_token ?? NULL, 20) }}
                        <input type="hidden" name="TELESIGN_TOKEN" class="input w-full border mt-2"
                            placeholder="TELESIGN TOKEN" value="{{ $telesign->sms_token ?? NULL }}">

                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TELESIGN_FROM={{ $telesign->sms_from ?? NULL }}
                        <input type="hidden" placeholder="TELESIGN FROM" class="input w-full border mt-2"
                            name="TELESIGN_FROM" value="{{ $telesign->sms_from ?? NULL }}">

                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        TELESIGN_NUMBER={{ $telesign->sms_number ?? NULL }}
                        <input type="hidden" name="TELESIGN_NUMBER" class="input w-full border mt-2"
                            placeholder="TELESIGN NUMBER" value="{{ $telesign->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'telesign') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>

                        @if (getSmsInfo('telesign'))
                        <a href="{{ route('sms.connection.test', 'telesign') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                        @endif

            </form>
        </div>
    </div>
</div>
{{-- Telesign::END --}}

{{-- SINCH --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(Sinch)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('sinch') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(Sinch)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'sinch') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        SINCH_ID={{ $sinch->sms_id ?? NULL }}
                        <input type="hidden" name="SINCH_SID" class="input w-full border mt-2"
                            placeholder="SINCH SID" value="{{ $sinch->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        SINCH_TOKEN={{ Str::limit($sinch->sms_token ?? NULL, 20) }}
                        <input type="hidden" name="SINCH_TOKEN" class="input w-full border mt-2"
                            placeholder="SINCH TOKEN" value="{{ $sinch->sms_token ?? NULL }}">

                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        SINCH_FROM={{ $sinch->sms_from ?? NULL }}
                        <input type="hidden" placeholder="SINCH FROM" class="input w-full border mt-2"
                            name="SINCH_FROM" value="{{ $sinch->sms_from ?? NULL }}">

                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        SINCH_NUMBER={{ $sinch->sms_number ?? NULL }}
                        <input type="hidden" name="SINCH_NUMBER" class="input w-full border mt-2"
                            placeholder="SINCH NUMBER" value="{{ $sinch->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'sinch') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>

                        @if (getSmsInfo('sinch'))
                        <a href="{{ route('sms.connection.test', 'sinch') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                        @endif

            </form>
        </div>
    </div>
</div>
{{-- SINCH::END --}}

{{-- CLICKATELL --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(Clickatell)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('clickatell') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(Clickatell)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'clickatell') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        CLICKATELL_ID={{ $clickatell->sms_id ?? NULL }}
                        <input type="hidden" name="CLICKATELL_SID" class="input w-full border mt-2"
                            placeholder="CLICKATELL SID" value="{{ $clickatell->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        CLICKATELL_TOKEN={{ Str::limit($clickatell->sms_token ?? NULL, 20) }}
                        <input type="hidden" name="CLICKATELL_TOKEN" class="input w-full border mt-2"
                            placeholder="CLICKATELL_TOKEN TOKEN" value="{{ $clickatell->sms_token ?? NULL }}">

                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        CLICKATELL_FROM={{ $clickatell->sms_from ?? NULL }}
                        <input type="hidden" placeholder="CLICKATELL FROM" class="input w-full border mt-2"
                            name="CLICKATELL_FROM" value="{{ $clickatell->sms_from ?? NULL }}">

                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        CLICKATELL_NUMBER={{ $clickatell->sms_number ?? NULL }}
                        <input type="hidden" name="CLICKATELL_NUMBER" class="input w-full border mt-2"
                            placeholder="CLICKATELL NUMBER" value="{{ $clickatell->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'clickatell') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>

                        @if (getSmsInfo('clickatell'))
                        <a href="{{ route('sms.connection.test', 'clickatell') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                        @endif

            </form>
        </div>
    </div>
</div>
{{-- CLICKATELL::END --}}

{{-- Mailjet --}}

    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(Mailjet)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('mailjet') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(Mailjet)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'mailjet') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        MAILJET_ID={{ $mailjet->sms_id ?? NULL }}
                        <input type="hidden" name="MAILJET_SID" class="input w-full border mt-2"
                            placeholder="MAILJET SID" value="{{ $mailjet->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        MAILJET_TOKEN={{ Str::limit($mailjet->sms_token ?? NULL, 20) }}
                        <input type="hidden" name="MAILJET_TOKEN" class="input w-full border mt-2"
                            placeholder="MAILJET_TOKEN TOKEN" value="{{ $mailjet->sms_token ?? NULL }}">

                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        MAILJET_FROM={{ $mailjet->sms_from ?? NULL }}
                        <input type="hidden" placeholder="MAILJET FROM" class="input w-full border mt-2"
                            name="MAILJET_FROM" value="{{ $mailjet->sms_from ?? NULL }}">

                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        MAILJET_NUMBER={{ $mailjet->sms_number ?? NULL }}
                        <input type="hidden" name="MAILJET_NUMBER" class="input w-full border mt-2"
                            placeholder="MAILJET NUMBER" value="{{ $mailjet->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'mailjet') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>

                        @if (getSmsInfo('mailjet'))
                        <a href="{{ route('sms.connection.test', 'mailjet') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                        @endif

            </form>
        </div>
    </div>
    {{-- Mailjet::ENDS --}}
</div>

{{-- LAO TELECOM --}}
    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
        <div class="box">
            <div class="flex items-start px-5 pt-5">
                <div class="w-full flex flex-col lg:flex-row items-center">
                        <img alt="@translate(LAO TELECOM)" class="rounded-md" style="width: 200px; height: 100px;" src="{{ smsLogo('lao') }}">
                    <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                        @translate(LAO TELECOM)
                    </div>
                </div>
            </div>
            <form action="{{ route('sms.configure.default', 'lao') }}" method="POST">
                @csrf
                <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        LAO_ID={{ $lao->sms_id ?? NULL }}
                        <input type="hidden" name="LAO_SID" class="input w-full border mt-2"
                            placeholder="LAO SID" value="{{ $lao->sms_id ?? NULL }}">
                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        LAO_TOKEN={{ Str::limit($lao->sms_token ?? NULL, 20) }}
                        <input type="hidden" name="LAO_TOKEN" class="input w-full border mt-2"
                            placeholder="LAO_TOKEN TOKEN" value="{{ $lao->sms_token ?? NULL }}">

                    </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        LAO_FROM={{ $lao->sms_from ?? NULL }}
                        <input type="hidden" placeholder="LAO FROM" class="input w-full border mt-2"
                            name="LAO_FROM" value="{{ $lao->sms_from ?? NULL }}">

                    </div>

                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1">
                        <i data-feather="at-sign" class="w-3 h-3 mr-2"></i>
                        LAO_NUMBER={{ $lao->sms_number ?? NULL }}
                        <input type="hidden" name="LAO_NUMBER" class="input w-full border mt-2"
                            placeholder="LAO NUMBER" value="{{ $lao->sms_number ?? NULL }}">
                    </div>
                  
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">

                    <a href="{{ route('sms.configure', 'lao') }}"
                        class="button button--sm text-white bg-theme-6 mr-2">@translate(Configure Now)</a>

                        @if (getSmsInfo('lao'))
                        <a href="{{ route('sms.connection.test', 'lao') }}"
                        class="button button--sm text-white bg-theme-7 mr-2">@translate(Test Connection)</a>
                        @endif

            </form>
        </div>
    </div>
{{-- LAO TELECOM::END --}}

{{-- VERSION 5.1.0 --}}

</div>

@endsection

@section('script')

@endsection
