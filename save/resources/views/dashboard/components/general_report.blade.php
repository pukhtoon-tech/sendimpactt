<div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(General Report)</h2>
                    <a href="javascript:;" class="ml-auto flex text-theme-1 dark:text-theme-10" onclick="generalReport()">
                        <i data-feather="corner-left-down" class="w-4 h-4 mr-3"></i> @translate(See More)
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('email.contacts.index') }}">
                                <div class="box p-5">
                                    <div class="flex">
                                    <i data-feather="mail" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto hidden">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="{{ number_format(getPercentageChange(totalMailCurrentMonthData(), totalMailLastMonthData())) }}% {{ checkHigherLowerThan(totalMailLastMonthData(), totalMailCurrentMonthData()) }}">
                                            {{ number_format(getPercentageChange(totalMailCurrentMonthData(), totalMailLastMonthData())) }}% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(emailCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Emails)</div>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('campaign.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="columns" class="report-box__icon text-theme-11"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(campaignCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Email Campaigns)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('campaign.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="columns" class="report-box__icon text-theme-11"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(SMScampaignCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(SMS Campaigns)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('group.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="users" class="report-box__icon text-theme-12"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(emailGroupCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Email Groups)</div>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                    
                    
                </div>


                {{-- Second row --}}
                

                <div class="grid grid-cols-12 gap-6 mt-5 hidden" id="more-report">

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('group.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="users" class="report-box__icon text-theme-12"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(SMSGroupCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(SMS Groups)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('templates.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="git-pull-request" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(templateCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Email Templates)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('builder.sms.templates') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="git-pull-request" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(smsTemplateCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(SMS Templates)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('mail.activity.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="mail" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">

                                        <div>
                                            <div id="chart-8"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6 totalSentMailkUrl">{{ totalSentMail() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Your Sent Emails)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    @can('Admin')
                        

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="flag" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        <a href="javascript:;" onclick="queueRetry()">
                                            <div class="report-box__indicator bg-theme-1 tooltip cursor-pointer" title="Retry Failed Queue">
                                                @translate(Retry) 
                                                <i data-feather="radio" class="ml-2 mr-2 w-4 h-4 queue-retry-loader"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6 totalFailedUrl">{{ failedJobs() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Failed)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="wind" class="report-box__icon text-theme-12"></i>
                                    <div class="ml-auto">
                                        <a href="javascript:;" onclick="queueWork()">
                                            <div class="report-box__indicator bg-theme-1 tooltip cursor-pointer" title="@translate(Restart Queue)">
                                                @translate(Restart Queue)
                                                <i data-feather="refresh-ccw" class="ml-2 mr-2 w-4 h-4 queue-work-loader"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6 queueCount">{{ queueCount() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(On Queue)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('smtp.index') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="hard-drive" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ SmtpServer() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Mail Server)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    @endcan



                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="book-open" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-xl font-bold leading-8 mt-6 lastPurchasedPlan">{{ Str::upper(lastPurchasedPlan()->plan_name ?? 'No Plan') }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Last Purchased Plan)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="dollar-sign" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6 totalExpense">{{ formatPrice(totalExpense()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Expense)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{ route('bounce.emails') }}">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="alert-octagon" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6 totalBouncedUrl">{{ number_format(mailBounced()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Bounced)</div>
                            </div>
                            </a>
                        </div>
                    </div>

                    @can('Admin')
                        
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="clock" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ totalCustomer() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Customer)</div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ totalPurchased() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Purchased Plan)</div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="clock" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ totalSystemSentMail() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Sent Emails)</div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="clock" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ totalSystemSMSSent() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Sent SMS)</div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user-plus" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(totalSubscribed()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Subscribed)</div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user-plus" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ number_format(phoneCount()) }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Total Phone Number)</div>
                            </div>
                        </div>
                    </div>

                    @endcan


                </div>


                {{-- Second row:end --}}

                <input type="hidden" value="{{ route('queue.work') }}" id="queue_work_url">
                <input type="hidden" value="{{ route('queue.retry') }}" id="queue_retry_url">
                

            </div>

            <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>

            <script>

                "use strict"
                
                function generalReport(){
                    var element = document.getElementById("more-report");
                    element.classList.toggle("hidden");
                }



        var options7 = {
          series: [{{ emailLimitCheckPercentage(Auth::user()->id) }}],
          chart: {
          type: 'radialBar',
          width: 50,
          height: 50,
          sparkline: {
            enabled: true
          }
        },
        dataLabels: {
          enabled: true
        },
        plotOptions: {
          radialBar: {
            hollow: {
              margin: 0,
              size:  '50%'
            },
            track: {
              margin: 0
            },
            dataLabels: {
              show: false
            }
          }
        }
        };

        var chart7 = new ApexCharts(document.querySelector("#chart-8"), options7);
        chart7.render();

            </script>

<script src="{{ filePath('bladejs/dashboard/components/general_report.js') }}"></script>