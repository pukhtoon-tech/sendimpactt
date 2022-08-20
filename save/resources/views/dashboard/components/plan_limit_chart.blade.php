<div class="col-span-12 lg:col-span-12 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Limit Report)</h2>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                   

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
                                <div id="chart-emails-dashboard"></div>
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
                                <div id="chart-sms-dashboard"></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="text-base text-gray-600 mt-1">@translate(Campaign SMS Usage)</div>
                </div>
            </div>
        </div>
    </div>

                    <div>
                        <div id="plan-limit-chart"></div>
                    </div>

                </div>
            </div>

            <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>


<script>

  // This is dynmic script, all the datas are coming from laravel query

        "use strict"
        // EMAIL

        var options = {
          series: [{{ usedEmail() }}, {{ emailLeftCount() }}],
          chart: {
          width: 350,
          type: 'pie',
        },
        labels: ['Sent Emails', 'Available Emails'],
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

        var chart = new ApexCharts(document.querySelector("#chart-emails-dashboard"), options);
        chart.render();

        // SMS
                
        var options = {
          series: [{{ usedSMS() }}, {{ smsLeftCount() }}],
          chart: {
          width: 350,
          type: 'pie',
        },
        labels: ['Sent SMS', 'Available SMS'],
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

        var chart = new ApexCharts(document.querySelector("#chart-sms-dashboard"), options);
        chart.render();


                

            </script>
            