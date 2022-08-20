@extends('../layout/' . layout())

@section('subhead')
    <title>How To Config</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">@translate(How To Config)</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('how_to_config.components.side-menu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Company Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(How To Config)</h2>
                </div>
                <div class="p-5">
                    {{-- Infobip --}}
                    <section id="Infobip">
                        <h1 class="font-medium">Infobip</h1>
                        <div class="mt-3"></div>
                        <ul>
                            <li> - Go to <a target="_blank" class="text-theme-1" href="https://www.infobip.com">infobip.com</a></li>
                            <li> - Login to the portal</li>
                            <li> - Get public key API</li>
                            <li> <br> <img src="{{ asset('config/infobip/1.png') }}" alt=""> <br> </li>
                            <li> - Get a phone number</li>
                            <li> <br> <img src="{{ asset('config/infobip/2.png') }}" alt=""> <br> </li>
                            <li> - Setup</li>
                            <li> <br> <img src="{{ asset('config/infobip/3.png') }}" alt=""> <br> </li>
                        </ul>
                    </section>
                    {{-- Infobip::END --}}

                    <div class="mt-3"></div>

                    {{-- Viber --}}
                    <section id="Viber">
                        <h1 class="font-medium">Viber</h1>
                        <div class="mt-3"></div>

                        <ul>
                            <li> - Go to <a target="_blank" class="text-theme-1" href="https://www.infobip.com">infobip.com</a></li>
                            <li> - Login to the portal</li>
                            <li> - Get public key API</li>
                            <li> <br> <img src="{{ asset('config/infobip/1.png') }}" alt=""> <br> </li>
                            <li> - Get a phone number</li>
                            <li> <br> <img src="{{ asset('config/infobip/2.png') }}" alt=""> <br> </li>
                            <li> - Setup</li>
                            <li> <br> <img src="{{ asset('config/viber/1.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('config/viber/2.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('config/viber/3.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('config/viber/4.png') }}" alt=""> <br> </li>
                        </ul>

                    </section>
                    {{-- Viber::END --}}

                    <div class="mt-3"></div>

                    {{-- WhatsApp --}}
                    <section id="WhatsApp">
                        <h1 class="font-medium">WhatsApp</h1>
                        <div class="mt-3"></div>

                        <ul>
                            <li> - Go to <a target="_blank" class="text-theme-1" href="https://www.infobip.com">infobip.com</a></li>
                            <li> - Login to the portal</li>
                            <li> - Get public key API</li>
                            <li> <br> <img src="{{ asset('config/infobip/1.png') }}" alt=""> <br> </li>
                            <li> - Get a phone number</li>
                            <li> <br> <img src="{{ asset('config/infobip/2.png') }}" alt=""> <br> </li>
                            <li> - Setup</li>
                            <li> <br> <img src="{{ asset('config/whatsapp/1.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('config/whatsapp/2.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('config/whatsapp/3.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('config/whatsapp/4.png') }}" alt=""> <br> </li>
                        </ul>

                    </section>
                    {{-- WhatsApp::END --}}
                </div>
            </div>
            <!-- END: Company Information -->
           
        </div>
    </div>
@endsection
