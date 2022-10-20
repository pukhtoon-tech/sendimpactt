@extends('../layout/' .  layout())
<head>
    <link rel="stylesheet" href="{{ filePath('frontend/css/stag.css')}}">
</head>
@section('subhead')
    <title>@translate(Email Campaign)</title>

@endsection

@section('subcontent')
    @php
        $calendar = \App\Models\ScheduleEmail::where('owner_id', \Illuminate\Support\Facades\Auth::id())
                                                           ->with('campaign')
                                                           ->get();
    @endphp
    <div class="new_tabs_start my-3">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-ec-tab" data-toggle="pill" data-target="#pills-ec"
                        type="button" role="tab" aria-controls="pills-ec" aria-selected="true">Email Campaign
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-es-tab" data-toggle="pill" data-target="#pills-es" type="button"
                        role="tab" aria-controls="pills-es" aria-selected="true">Email Schedule
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-ct-tab" data-toggle="pill" data-target="#pills-ct" type="button"
                        role="tab" aria-controls="pills-ct" aria-selected="true">Campaign Tracker
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-bc-tab" data-toggle="pill" data-target="#pills-bc" type="button"
                        role="tab" aria-controls="pills-bc" aria-selected="true">Bounce Checker
                </button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            @include('campaign.components.email-campaign-content')
            @include('campaign.components.email-schedule-content')
            @include('campaign.components.campaign-tracker-content')
            @include('campaign.components.bounce-checker-content')

        </div>


    </div>


    <input type="hidden" id="queueUrl" value="{{ route('queue.count') }}">
    <input type="hidden" id="totalMaillUrl" value="{{ route('total.mail.count') }}">
    <input type="hidden" id="totalCampaignlUrl" value="{{ route('total.campaign.count') }}">
    <input type="hidden" id="totalGrouplUrl" value="{{ route('total.group.count') }}">
    <input type="hidden" id="totalTemplatelUrl" value="{{ route('total.template.count') }}">
    <input type="hidden" id="totalReachUrl" value="{{ route('total.reach.count') }}">
    <input type="hidden" id="totalNotReachUrl" value="{{ route('total.notreach.count') }}">
    <input type="hidden" id="totalFailedUrl" value="{{ route('total.failed.count') }}">
    <input type="hidden" id="totalBouncedUrl" value="{{ route('total.bounced.count') }}">
    <input type="hidden" id="totalTaskUrl" value="{{ route('total.tasks.count') }}">
    <input type="hidden" id="totalSentMailkUrl" value="{{ route('total.sent.mail.count') }}">

@endsection

@section('script')
    <script src="{{ filePath('assets/js/jquery.js') }}"></script>
    <script src="{{ filePath('assets/js/email_contacts.js') }}"></script>
    <script src="{{ filePath('assets/js/parsley.js') }}"></script>
    <script src="{{ filePath('assets/js/validation.js') }}"></script>
    <script src="{{ filePath('assets/js/sweetalert2@10.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
    <script src="{{ filePath('assets/js/apexcharts.js') }}"></script>
    <script src="{{ filePath('bladejs/campaigns/email.js') }}"></script>
    <script src="{{ filePath('bladejs/mail-logs/index.js') }}"></script>

    <script src="{{ filePath('bladejs/campaigns/index.js') }}"></script>
    <script src="{{ filePath('bladejs/bounce.js') }}"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

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