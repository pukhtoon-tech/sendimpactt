@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Campaigns)</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">@translate(Campaign List)</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
            <div class="report-box">
                <div class="box p-5">
                    <div class="flex">

                        @translate(Total Emails) {{ availableEmail() + usedEmail() }}
                        <br>
                        @translate(Sent Emails) {{ usedEmail() }}
                        <br>
                        @translate(Available Emails) {{ emailLeftCount() }}

                        <div class="ml-auto">

                            <div>
                                <div id="chart-emails"></div>
                            </div>

                        </div>
                    </div>
                    <div class="text-base text-gray-600 mt-1">@translate(Campaign Email Usage)</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
            <div class="report-box">
                <div class="box p-5">
                    <div class="flex">

                        @translate(Total SMS) {{ availableSMS() + usedSMS() }}
                        <br>
                        @translate(Sent SMS) {{ usedSMS() }}
                        <br>
                        @translate(Available SMS) {{ smsLeftCount() }}

                        <div class="ml-auto">

                            <div>
                                <div id="chart-sms"></div>
                            </div>

                        </div>
                    </div>
                    <div class="text-base text-gray-600 mt-1">@translate(Campaign SMS Usage)</div>
                </div>
            </div>
        </div>
    </div>

    {{-- NOTE --}}
    <div class="bg-indigo-900 text-center py-4 lg:px-4 rounded mt-4">
        <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
             role="alert">
            <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">@translate(Note)</span>
            <span class="font-semibold mr-2 text-left flex-auto">
                @translate(Try schedule mailing for big amount of bulk email. No service in the world allows you to send 10,000 emails at once for free. Email providers like Gmail, Outlook, and Yahoo limit the number of daily recipients to 500 and consider you a spammer for trying to send more. Configure Cron Job in your server. Check Help menu for more information.)
            </span>
        </div>
    </div>
    {{-- NOTE::END --}}

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">

            <a href="{{ route('campaign.create.type', 'email') }}"
               class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip"
               title="@translate(Add new Campaign)">
                @translate(Add New Email Campaign)
            </a>

            <a href="{{ route('bounce.emails') }}"
               class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip"
               title="@translate(Add new Campaign)">
                @translate(Email Bounced)
            </a>

            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..."
                           id="emailIndex">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="whitespace-no-wrap">@translate(ICON)</th>
                    <th class="whitespace-no-wrap">@translate(NAME)</th>
                    <th class="text-center whitespace-no-wrap">@translate(EMAILS)</th>
                    <th class="text-center whitespace-no-wrap">@translate(TEMPLATE)</th>
                    <th class="text-center whitespace-no-wrap">@translate(SERVER)</th>
                    <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                    <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                    <th class="text-center whitespace-no-wrap">@translate(INSTANT MAILING)</th>
                    <th class="text-center whitespace-no-wrap">@translate(SCHEDULE)</th>
                    <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                </tr>
                </thead>
                <tbody class="campaignEmailName">
                @forelse ($campaigns as $campaign)
                    @if($campaign->template != null)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $campaign->name }}" class="tooltip rounded-full"
                                             src="{{ namevatar($campaign->name) }}" title="{{ $campaign->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   class="font-medium whitespace-no-wrap tooltip flex"
                                   title="{{ $campaign->name }}">
                                    {{$campaign->name }}

                                    @if (checkCampaignExistsInAutoresponder($campaign->id))
                                        <i data-feather="share-2" class="ml-2 w-4"></i>
                                    @endif

                                </a>
                            </td>

                            <td class="text-center tooltip"
                                title="{{ App\Models\CampaignEmail::where('campaign_id' , $campaign->id)->count() }}">
                                {{ App\Models\CampaignEmail::where('campaign_id' , $campaign->id)->count() }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('template.preview', $campaign->template->id) }}" target="_blank"
                                   class="text-theme-10 tooltip" title="@translate(Preview Template)">
                                    {{ $campaign->template->title }}
                                </a>
                            </td>

                            <td class="text-center normal-case">{{ Str::upper($campaign->relationWithSmtpServer->provider_name ?? 'No Server Found') }}</td>

                            <td class="w-40">
                                <div class="flex items-center justify-center tooltip {{ $campaign->status == 1 ? 'text-theme-9' : 'text-theme-6' }}"
                                     title="{{ $campaign->status == 1 ? 'Active' : 'Inactive' }}">
                                    <i data-feather="check-square"
                                       class="w-4 h-4 mr-2"></i> {{ $campaign->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center tooltip w-40"
                                title="{{ $campaign->created_at->diffForHumans() }}">{{ $campaign->created_at->format('Y-m-d') }}</td>


                            <td class="text-center">


                                @if (emailLimitCheck($campaign->owner_id) && LimitStatus())

                                    @if(isSMTServerConfigured())
                                        <a class="button tooltip w-40 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center"
                                           title="@translate(Click To Start Mailer Engine)"
                                           href="{{ route('campaign.send.email', [$campaign->id, $campaign->template->id]) }}"
                                           onclick="loaderSending()">
                                            @translate(INSTANT MAILING)
                                        </a>
                                    @else
                                        <a style="pointer-events: none; background-color: grey"
                                           class="button tooltip w-40 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center"
                                           title="@translate(Click To Start Mailer Engine)"
                                           href="{{ route('campaign.send.email', [$campaign->id, $campaign->template->id]) }}"
                                           onclick="loaderSending()">
                                            @translate(INSTANT MAILING)
                                        </a>
                                    @endif
                                @else

                                    <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-6 text-white inline-flex items-center text-xs"
                                       title="@translate(Your subscription plan is finished)"
                                       href="{{ route('subscription.index') }}"
                                    >

                                        @php
                                            $x = App\Models\EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();
                                            $y = App\Models\EmailSMSLimitRate::where('owner_id', Auth::user()->id)->whereDate('to', '>', Carbon\Carbon::now())->count();
                                        @endphp

                                        @if ($x->status == 0)
                                            @translate(Not Paid)
                                            <br>
                                        @endif

                                        @if ($x->email <= 0)
                                            @translate(Out Of Email)
                                            <br>
                                        @endif

                                        @if ($y == 0)
                                            @translate(Date Expired)
                                        @endif

                                    </a>

                                @endif


                            </td>

                            {{-- version 2.0 --}}


                            <td class="text-center">


                                @if (emailLimitCheck($campaign->owner_id) && LimitStatus())

                                    @if(isSMTServerConfigured())
                                        <a class="button tooltip w-40 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center"
                                           title="@translate(Click To Schedule Mailer Engine)"
                                           href="{{ route('campaign.schedule.email', [$campaign->id, $campaign->template->id]) }}">
                                            @translate(SCHEDULE MAILING)
                                        </a>
                                    @else
                                        <a style="pointer-events: none; background-color: grey"
                                           class="button tooltip w-40 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center"
                                           title="@translate(Click To Schedule Mailer Engine)"
                                           href="{{ route('campaign.schedule.email', [$campaign->id, $campaign->template->id]) }}">
                                            @translate(SCHEDULE MAILING)
                                        </a>
                                    @endif

                                @else

                                    <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-6 text-white inline-flex items-center text-xs"
                                       title="@translate(Your subscription plan is finished)"
                                       href="{{ route('subscription.index') }}"
                                    >

                                        @php
                                            $x = App\Models\EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();
                                            $y = App\Models\EmailSMSLimitRate::where('owner_id', Auth::user()->id)->whereDate('to', '>', Carbon\Carbon::now())->count();
                                        @endphp

                                        @if ($x->status == 0)
                                            @translate(Not Paid)
                                            <br>
                                        @endif

                                        @if ($x->email <= 0)
                                            @translate(Out Of Email)
                                            <br>
                                        @endif

                                        @if ($y == 0)
                                            @translate(Date Expired)
                                        @endif

                                    </a>

                                @endif


                            </td>

                            {{-- version 2.0::END --}}


                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 tooltip" title="@translate(Edit)"
                                       href="{{ route('campaign.emails.edit', $campaign->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>

                                    <a class="flex items-center text-theme-6 tooltip"
                                       href="{{ route('campaign.emails.destroy', $campaign->id) }}"
                                       title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endif
                @empty
                    <td colspan="10">
                        <div class="text-center">
                            <img src="{{ notFound('campain-not-found.png') }}" class="m-auto no-shadow"
                                 alt="#campaign-not-found">
                        </div>
                    </td>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $campaigns->firstItem() ?? '0' }}
                to {{ $campaigns->lastItem() ?? '0' }} of {{ $campaigns->total() }} entries
            </div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
    {{--         {{ $campaigns->links('vendor.pagination.custom') }}--}}
    <!-- END: Pagination -->
    </div>

    {{-- Loader --}}
    <div class="loading hidden"></div>
    {{-- Loader::end --}}

@endsection

@section('script')
    <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>
    <script src="{{ filePath('bladejs/campaigns/email.js') }}"></script>

    <script>

        // This is dynamic script, all the datas are coming from laravel query

        "use strict"
        // EMAIL

        var options = {
            series: [{{ usedEmail() }}, {{ emailLeftCount() }}],
            chart: {
                width: 300,
                type: 'pie',
            },
            labels: ['Sent Emails', 'Emails Left'],
            dataLabels: {
                enabled: true
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        show: true
                    }
                }
            }],
            legend: {
                position: 'right',
                offsetY: 0,
                height: 230,
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-emails"), options);
        chart.render();

        // SMS

        var options = {
            series: [{{ usedSMS() }}, {{ smsLeftCount() }}],
            chart: {
                width: 300,
                type: 'pie',
            },
            labels: ['Sent SMS', 'SMS Left'],
            dataLabels: {
                enabled: true
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        show: true
                    }
                }
            }],
            legend: {
                position: 'right',
                offsetY: 0,
                height: 230,
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-sms"), options);
        chart.render();

    </script>

@endsection