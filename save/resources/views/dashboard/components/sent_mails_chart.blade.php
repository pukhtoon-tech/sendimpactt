<div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Sent Mail Report)</h2>
                   
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-theme-20 dark:text-gray-300 text-lg xl:text-xl font-bold text-center">{{ number_format(sentMailCurrentMonthData()) }}</div>
                                <div class="text-gray-600 dark:text-gray-600">@translate(This Month)</div>
                            </div>
                            <div class="w-px h-12 border border-r border-dashed border-gray-300 dark:border-dark-5 mx-4 xl:mx-6"></div>
                            <div>
                                <div class="text-gray-600 dark:text-gray-600 text-lg xl:text-xl font-medium text-center">{{ number_format(sentMailLastMonthData()) }}</div>
                                <div class="text-gray-600 dark:text-gray-600">@translate(Last Month)</div>
                            </div>
                        </div>
                     
                    </div>

                    <div>
                        <div id="my-chart-1"></div>
                    </div>
                </div>
            </div>

            <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>
            <script>

                // This is dynmic script, all the datas are coming from laravel query

                "use strict"
                var options = {
          series: [{
            name: "Sent Mails",
            data: [
              @foreach(sentMailMonthWiseCurrentYearData() as $sent_mail)
              {{ $sent_mail->count }},
              @endforeach
              ]
        }],
          chart: {
          height: 350,
          type: 'area',
          zoom: {
            enabled: true
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Sent Mails By Month',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: [
            @foreach(sentMailMonthWiseCurrentYearData() as $monthly_sent_mail)
              '{{ $monthly_sent_mail->monthname }}',
            @endforeach
            ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#my-chart-1"), options);
        chart.render();

        

    
            </script>