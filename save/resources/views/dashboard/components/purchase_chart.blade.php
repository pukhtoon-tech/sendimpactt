
            <div class="col-span-12 xl:col-span-4 mt-6">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Most Used Gateway)</h2>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <div id="chart-purchase-dashboard"></div>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <span class="truncate">@translate(Free)</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{ mostUsedGateway('free') }}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="truncate">@translate(PayPal)</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{ mostUsedGateway('paypal') }}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="truncate">@translate(Stripe)</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{ mostUsedGateway('stripe') }}</span>
                        </div>
                    </div>
                </div>
            </div>



             <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>


<script>

  // This is dynmic script, all the datas are coming from laravel query

        "use strict"
        // EMAIL

      var options = {
          series: [{{ mostUsedGateway('free') }}, {{ mostUsedGateway('paypal') }}, {{ mostUsedGateway('stripe') }}],
          chart: {
          width: 350,
          type: 'polarArea'
        },
        labels: ['Free', 'PayPal', 'Stripe'],
        fill: {
          opacity: 1
        },
        stroke: {
          width: 1,
          colors: undefined
        },
        yaxis: {
          show: false
        },
        legend: {
          position: 'bottom'
        },
        plotOptions: {
          polarArea: {
            rings: {
              strokeWidth: 0
            }
          }
        },
        theme: {
          monochrome: {
            enabled: false,
            shadeTo: 'light',
            shadeIntensity: 0.6
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-purchase-dashboard"), options);
        chart.render();


            </script>
            