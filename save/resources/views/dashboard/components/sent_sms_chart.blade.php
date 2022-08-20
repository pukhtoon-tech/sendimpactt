<div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Sent SMS Report)</h2>
                  
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-theme-20 dark:text-gray-300 text-lg xl:text-xl font-bold text-center">{{ number_format(sentSMSCurrentMonthData()) }}</div>
                                <div class="text-gray-600 dark:text-gray-600">@translate(This Month)</div>
                            </div>
                            <div class="w-px h-12 border border-r border-dashed border-gray-300 dark:border-dark-5 mx-4 xl:mx-6"></div>
                            <div>
                                <div class="text-gray-600 dark:text-gray-600 text-lg xl:text-xl font-medium text-center">{{ number_format(sentSMSLastMonthData()) }}</div>
                                <div class="text-gray-600 dark:text-gray-600">@translate(Last Month)</div>
                            </div>
                        </div>
                     
                    </div>

                    <div>
                        <div id="sent_sms_chart"></div>
                    </div>
                </div>
            </div>

            <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>
            <script>

                // This is dynmic script, all the datas are coming from laravel query


                "use strict"
                
               var options = {
          series: [{
          name: 'Twilio',
          data: [
              @foreach(sentSMSMonthWiseCurrentYearDataTwilio() as $sent_sms_twilio)
              {{ $sent_sms_twilio->count }},
              @endforeach
          ]
        }, {
          name: 'Nexmo',
          data: [
              @foreach(sentSMSMonthWiseCurrentYearDataNexmo() as $sent_sms_nexmo)
              {{ $sent_sms_nexmo->count }},
              @endforeach
          ]
        }, {
          name: 'Plivo',
          data: [
              @foreach(sentSMSMonthWiseCurrentYearDataPlivo() as $sent_sms_plivo)
              {{ $sent_sms_plivo->count }},
              @endforeach
          ]
        }],
          chart: {
          type: 'area',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: [
            @foreach(sentSMSMonthWiseCurrentYearData() as $monthly_sent_sms)
              '{{ $monthly_sent_sms->monthname }}',
            @endforeach
          ],
        },
        yaxis: {
          title: {
            text: '@translate(Total SMS Sent)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#sent_sms_chart"), options);
        chart.render();
    
            </script>