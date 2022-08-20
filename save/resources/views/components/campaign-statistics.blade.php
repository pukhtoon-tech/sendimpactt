   <div class="col-span-12 xxl:col-span-12 xxl:border-l border-theme-5 mb-10 pb-10">
        
    <div class="xxl:pl-12 grid grid-cols-12 gap-6">
    <div class="col-span-12 md:col-span-12 xl:col-span-12 xxl:col-span-12 mt-3 xxl:mt-12">
        <div id="statistics"></div>
    </div>



    <div class="col-span-12 md:col-span-12 xl:col-span-12 xxl:col-span-12 mt-3 xxl:mt-12">
        <div class="col-span-12 lg:col-span-8 xl:col-span-6 mt-2">
                                <div class="report-box-2 intro-y mt-12 sm:mt-5">
                                    <div class="box sm:flex">


                                        <div class="px-8 py-12 flex flex-col justify-center flex-1">

                                          <div class="flex">
                                              <img alt="#{{ $campaign->campaign_name->name }}" 
                                                  class="tooltip rounded-full" 
                                                  src="{{ commonAvatar($campaign->campaign_name->name) }}" 
                                                  title="{{ $campaign->campaign_name->name }}" width="40" height="40">

                                                  <h2 class="text-lg font-medium ml-5 mt-2">{{ $campaign->campaign_name->name }}</h2>
                                          </div>
                                        

                                          <div id="singleStatistics"></div>
                                            {{-- <button class="btn btn-outline-secondary relative justify-start rounded-full mt-12">
                                                Download Reports 
                                                <span class="w-8 h-8 absolute flex justify-center items-center bg-theme-1 text-white rounded-full right-0 top-0 bottom-0 my-auto ml-auto mr-0.5"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right w-4 h-4"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> </span>
                                            </button> --}}
                                        </div>



                                        <div class="px-8 py-12 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-gray-300 dark:border-dark-5 border-dashed">
                                            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                                              <div class="intro-x flex items-center h-10">
                                                  <h2 class="text-lg font-medium truncate mr-5">
                                                      @translate(Campaign Schedules)
                                                  </h2>
                                              </div>
                                              <div class="mt-5">
                                                  <div class="intro-x box">
                                                      <div class="p-5">
                                                          <div class="flex">
                                                              <div class="font-medium text-base mx-auto">{{ Carbon\Carbon::now()->format('d F Y') }}</div>
                                                          </div>
                                                          <div class="grid grid-cols-7 gap-4 mt-5 text-center">
                                                              <div class="font-medium">Su</div>
                                                              <div class="font-medium">Mo</div>
                                                              <div class="font-medium">Tu</div>
                                                              <div class="font-medium">We</div>
                                                              <div class="font-medium">Th</div>
                                                              <div class="font-medium">Fr</div>
                                                              <div class="font-medium">Sa</div>

                                                              @foreach (calendar() as $calendar)
                                                                <div class="py-0.5 rounded relative {{ checkCampaignSchedule($campaign->campaign_id, $calendar) == true ? 'bg-theme-1 dark:bg-theme-1 text-white' : 'text-gray-600' }}">
                                                                    {{ parseDate($calendar) }}
                                                                </div>
                                                              @endforeach
                                                              
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
    </div>


    </div>
  </div>


<script src="{{ filePath('assets/js/apexcharts.js') }}"></script>

<script>

  // statistics

    var options = {
          series: [{
          data: [{{ campaignStatisticsRecipients($campaign->campaign_id) }}, 
                 {{ campaignStatisticsDelivered($campaign->campaign_id) }}, 
                 {{ campaignStatisticsClicked($campaign->campaign_id) }}, 
                 {{ campaignStatisticsUniqueClicked($campaign->campaign_id) }}, 
                 {{ campaignStatisticsFailed($campaign->campaign_id) }}, 
                 {{ campaignStatisticsOpened($campaign->campaign_id) }}, 
                 {{ campaignStatisticsBounced($campaign->campaign_id) }}
                ]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: true
        },
        xaxis: {
            categories: [
                'Recipients', 
                'Delivered', 
                'Click', 
                'Unique Click',
                'Failed', 
                'Open', 
                'Bounce'
            ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#statistics"), options);
        chart.render();


        // Rate of Open

      var options = {
          series: [
                    {{ campaignStatisticsRecipients($campaign->campaign_id) }}, 
                    {{ campaignStatisticsDelivered() }}, 
                    {{ campaignStatisticsClicked() }}, 
                    {{ campaignStatisticsUniqueClicked() }}, 
                    {{ campaignStatisticsFailed() }}, 
                    {{ campaignStatisticsOpened() }}, 
                    {{ campaignStatisticsBounced() }}
                  ],
          labels: ["Recipients", "Delivered", "Click", "Unique", "Failed", "Open", "Bounce"],
          dataLabels: {
            enabled: true
          },
          chart: {
          type: 'polarArea',
        },
        stroke: {
          colors: ['#fff']
        },
        fill: {
          opacity: 0.8
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#singleStatistics"), options);
        chart.render();


        // Heatmap

        var options = {
          series: [{
          name: 'Metric1',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric2',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric3',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric4',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric5',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric6',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric7',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric8',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        },
        {
          name: 'Metric9',
          data: generateData(18, {
            min: 0,
            max: 90
          })
        }
        ],
          chart: {
          height: 350,
          type: 'heatmap',
        },
        dataLabels: {
          enabled: false
        },
        colors: ["#008FFB"],
        title: {
          text: 'HeatMap Chart (Single color)'
        },
        };

        var chart = new ApexCharts(document.querySelector("#timeStatistics"), options);
        chart.render()
</script>