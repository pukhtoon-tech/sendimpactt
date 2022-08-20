@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(SMS Campaigns)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(SMS Campaign List)</h2>

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

    
    <div class="grid grid-cols-12 gap-6 mt-5">

        

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('campaign.create.type', 'sms') }}" class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" title="@translate(Add new Campaign)">@translate(Add New SMS Campaign)</a>
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="smsIndex">
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
                        <th class="whitespace-no-wrap">@translate(CAMPAIGN NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(NUMBERS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(SEND SMS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="smsEmailName">
                    @forelse ($campaigns as $campaign)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $campaign->name  }}" class="tooltip rounded-full" src="{{ namevatar($campaign->name) }}" title="{{ $campaign->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="{{ $campaign->name  }}">{{$campaign->name }}</a>
                            </td>

                        <td class="text-center">{{ App\Models\CampaignEmail::where('campaign_id' , $campaign->id)->count() }}</td>
                            
                            <td>
                                <div class="flex items-center justify-center {{ $campaign->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $campaign->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center">{{ $campaign->created_at->diffForHumans() }}</td>


                            <td class="text-center">
                                <div class="mt-2">
                                    <select data-placeholder="@translate(Select Body)" 
                                    class="tail-select w-full tooltip" data-id="{{$campaign->id }}" 
                                    onchange="selectSMS(this)" single title="@translate(Select SMS Body)">
                                        <option>@translate(Select Body)</option>
                                        
                                        @forelse ($sms_templates as $sms_template)
                                            <option value="{{ $sms_template->id }}" {{ $campaign->sms_template_id == $sms_template->id ? 'selected' : null }}>{{ $sms_template->name }}</option>
                                        @empty
                                            <option>No Body</option>
                                        @endforelse
                                        
                                    </select>
                                </div>
                            </td>


                            <td class="text-center">

                                @if (emailLimitCheck($campaign->owner_id) && LimitStatus())
@if ($campaign->sms_template_id != null)
       <div class="accordion p-5">
                                    <div class="accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3">
                                        <a href="javascript:;" class="accordion__pane__toggle font-medium block">@translate(Send SMS)</a>
                                        <div class="accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed">

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Twilio)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'twilio']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Twilio)
                                            </a>

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Nexmo)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'nexmo']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Nexmo)
                                            </a>

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Plivo)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'plivo']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Plivo)
                                            </a>

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Infobip)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'infobip']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Infobip)
                                            </a>

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Viber)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'viber']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Viber)
                                            </a>

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With WhatsApp)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'whatsapp']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(WhatsApp)
                                            </a>

                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Telesign)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'telesign']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Telesign)
                                            </a>
                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Sinch)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'sinch']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Sinch)
                                            </a>
                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Clickatell)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'clickatell']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Clickatell)
                                            </a>
                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With Mailjet)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'mailjet']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(Mailjet)
                                            </a>
                                            <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-1 text-white inline-flex items-center" 
                                            title="@translate(Start With LTC)"
                                            href="{{ route('campaign.send.sms', [$campaign->id, $campaign->sms_template_id, 'lao']) }}"
                                            onclick="loaderSMSSending()"
                                            > 
                                            @translate(LTC)
                                            </a>

                                        </div>
                                    </div>
                                </div>
                        @else
                        <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-6 text-white inline-flex items-center" 
                        title="@translate(Please select a SMS body & reload the page)"
                        href="javascript:;"
                        > 
                        @translate(No SMS Template)
                        </a>
                        @endif

                        @else

                        <a class="button tooltip w-24 h6 inline-block mr-1 mb-2 bg-theme-6 text-white inline-flex items-center" 
                        title="@translate(Please select a SMS body & reload the page)"
                        href="javascript:;"
                        > 

                        @php
                            $x = App\Models\EmailSMSLimitRate::where('owner_id', Auth::user()->id)->first();
                            $y = App\Models\EmailSMSLimitRate::where('owner_id', Auth::user()->id)->whereDate('to', '>', Carbon\Carbon::now())->count();
                        @endphp
                        
                        @if ($x->status == 0)
                            @translate(Not Paid)
                            <br>
                        @endif
                        
                        @if ($x->sms <= 0)
                            @translate(Out Of SMS)
                            <br>
                        @endif
                        
                        @if ($y == 0)
                            @translate(Date Expired)
                        @endif

                        </a>
    
                        @endif

                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                   
                                    <a class="flex items-center mr-3 tooltip" title="@translate(Edit)" href="{{ route('campaign.emails.edit', $campaign->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>

                                    <a class="flex items-center text-theme-6 tooltip" href="{{ route('campaign.emails.destroy', $campaign->id) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>
                    @empty
                     <td colspan="8">
                            <div class="text-center">
                                <img src="{{ notFound('sms-not-found.png') }}" class="m-auto no-shadow" alt="#sms-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $campaigns->firstItem() ?? '0' }} to {{ $campaigns->lastItem() ?? '0' }} of {{ $campaigns->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $campaigns->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>


    {{-- Loader --}}
        <div class="loadingSMS hidden"></div>
    {{-- Loader::end --}}

    <input type="hidden" value="{{ route('sms.campaign.ajax') }}" id="sms_template_url">

@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/email_contacts.js') }}"></script>
   <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>

<script src="{{ filePath('bladejs/campaigns/sms.js') }}"></script>


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