@extends('../layout/' . layout())

@section('subhead')
    <title>How To Setup</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">@translate(How To Setup)</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('help.components.side-menu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: How To Setup -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(How To Setup)</h2>
                </div>
                <div class="p-5">
                    {{-- cronjobs --}}
                    <section id="Infobip">
                        <h1 class="font-medium">Cron Jobs</h1>
                        <div class="mt-3"></div>
                        <ul>
                            <li> - Go to you hosting server</li>
                            <li> - Login to the portal</li>
                            <li> - Find Cron Jobs</li>
                            <li> - Add new Cron Jobs</li>
                            <li> - Command example: <strong>/usr/local/bin/php/home/hosting-username/laravel-folder/artisan command >> /dev/null 2>&1</strong></li>
                            <li> - Campaign schedule command: <strong>/usr/local/bin/php/home/hosting-username/laravel-folder/artisan email:send >> /dev/null 2>&1</strong></li>

                            <li>
                                <strong class="bg-theme-18">Note: On common settings set your convenient time for task schedule.</strong>
                            </li>

                            <li>
                                <strong class="bg-theme-18">Suggesion: Maildoll recommand you to set One per five minutes or Twice per hour.</strong>
                            </li>

                            <li> <br> <img src="{{ asset('cronjobs/1.png') }}" alt=""> <br> </li>
                            <li> <br> <img src="{{ asset('cronjobs/2.png') }}" alt=""> <br> </li>
                        
                        </ul>
                    </section>
                    {{-- cronjobs::END --}}

                    <div class="mt-3"></div>

                </div>
            </div>
            <!-- END: How To Setup -->
           
        </div>
    </div>
@endsection
