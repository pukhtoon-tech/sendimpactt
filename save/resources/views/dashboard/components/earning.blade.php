<div class="col-span-12 grid grid-cols-12 gap-6 mt-8 bg-white rounded">
                <div class="col-span-12 sm:col-span-12 xxl:col-span-12 intro-y mt-6 mb-6">
                  
                        <div id="chart-earning"></div>
             
                </div>
               
            </div>



            <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>

<script>

    // This is dynamic script, all the datas are coming from laravel query

      "use strict"

     var options = {
          series: [{
          name: 'Earnings',
          data: [
              @foreach(monthWiseEarnings() as $monthly_earning)
              '{{ $monthly_earning->total_amount }}',
            @endforeach
          ]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          },
          animations: {
            enabled: false
          }
        },
        stroke: {
          width: [5],
          curve: 'straight'
        },
        labels: [
            @foreach(monthWiseEarnings() as $monthly_earning)
              '{{ $monthly_earning->monthname }}',
            @endforeach
        ],
        title: {
          text: 'Total Earnings ' + '($' + {{ totalEarned() }} + ')'
        },
        xaxis: {
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart-earning"), options);
        chart.render();

</script>