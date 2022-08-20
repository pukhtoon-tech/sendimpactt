   <div class="col-span-12 xxl:col-span-12 xxl:border-l border-theme-5 mb-10 pb-10">

        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate ml-5">@translate(Campaign Report)</h2>
        </div>
        
    <div class="xxl:pl-12 grid grid-cols-12 gap-6">
    <div class="col-span-12 md:col-span-12 xl:col-span-12 xxl:col-span-12 mt-3 xxl:mt-12">
        <div id="statistics"></div>
    </div>
    </div>
        </div>


<script src="{{ filePath('assets/js/apexcharts.js') }}"></script>

<script>
    var options = {
          series: [{
          data: [{{ campaignStatisticsRecipients() }}, 
                 {{ campaignStatisticsDelivered() }}, 
                 {{ campaignStatisticsClicked() }}, 
                 {{ campaignStatisticsUniqueClicked() }}, 
                 {{ campaignStatisticsFailed() }}, 
                 {{ campaignStatisticsOpened() }}, 
                 {{ campaignStatisticsBounced() }}
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
</script>