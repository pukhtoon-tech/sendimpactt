@extends('layout.' .  layout())

@section('subhead')
    <title>{{ $schedule->campaign->name }}</title>
@endsection

@section('css')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">{{ $schedule->campaign->name }}</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 lg:col-span-12">
            <!-- BEGIN: Basic Datepicker -->
            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Select schedule date and time)</h2>
                </div>

                <div class="p-5" id="basic-datepicker">
                    <label for="">@translate(Date & Time)</label>
                    <form action="{{ route('campaign.schedule.email.update', $schedule->id) }}" method="post">
                            @csrf
                    <div class="preview mt-3 flex">
                        
                        <input class="datepicker input w-56 border" type="text" value="{{ $schedule->scheduled_at }}" name="date" data-single-mode="true">

                        <input class="input w-56 border" type="time" value="{{ Carbon\Carbon::parse($schedule->scheduled_at)->format('h:i:s') }}" name="time">
                        
                    </div>
                    <button type="submit" class="button bg-theme-1 text-white ml-auto mt-3">@translate(Update schedule)</button>

                </div>
            </form>

         

            </div>
            <!-- END: Basic Datepicker -->
         
        </div>



    </div>   
    <!-- END: Wizard Layout -->

    {{-- clock --}}

<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 lg:col-span-12">
        <!-- BEGIN: Basic Datepicker -->
        <div class="intro-y box">
            <div class="clock-container mt-5 m-auto">
                <div class="current-day">
                </div>
                <div class="current-seconds">
                </div>
                <div class="current-seconds"></div>
                <div class="clock-number num1">
                    <div>1</div>
                </div>
                <div class="clock-number num2">
                    <div>2</div>
                </div>
                <div class="clock-number num3">
                    <div>3</div>
                </div>
                <div class="clock-number num4">
                    <div>4</div>
                </div>
                <div class="clock-number num5">
                    <div>5</div>
                </div>
                <div class="clock-number num6">
                    <div>6</div>
                </div>
                <div class="clock-number num7">
                    <div>7</div>
                </div>
                <div class="clock-number num8">
                    <div>8</div>
                </div>
                <div class="clock-number num9">
                    <div>9</div>
                </div>
                <div class="clock-number num10">
                    <div>10</div>
                </div>
                <div class="clock-number num11">
                    <div>11</div>
                </div>
                <div class="clock-number num12">
                    <div>12</div>
                </div>
                <div class="clock-hand" id="sec">
                    <div class="second-hand"></div>
                </div>
                <div class="clock-hand" id="min">
                    <div class="minute-hand"></div>
                </div>
                <div class="clock-hand" id="hr">
                    <div class="hour-hand"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- clock::END --}}


{{-- caleneder --}}
<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 lg:col-span-12">
        <!-- BEGIN: Basic Datepicker -->
        <div class="intro-y box">

            {{-- CALENDER --}}
            <div class="ui container">
                <div class="ui grid">
                    <div class="ui sixteen column mt-5">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            {{-- CALENDER --}}
        </div>
    </div>
</div>
</div>
{{-- caleneder::END --}}


@endsection

@section('script')
 <script>  

        let secondHand=document.querySelector("#sec");  
        let minHand=document.querySelector("#min");
        let hourHand=document.querySelector("#hr"); 


        setInterval(clockRotating,1000)  

        function clockRotating(){  
            var date=new Date();  
            var getSeconds={{ Carbon\Carbon::parse($schedule->scheduled_at)->format('s') }}/60; // seconds
            var getMinutes={{ Carbon\Carbon::parse($schedule->scheduled_at)->format('i') }}/60;  // minutes
            var getHours={{ Carbon\Carbon::parse($schedule->scheduled_at)->format('h') }}/12;  // hours

            secondHand.style.transform="rotate("+getSeconds*360 + "deg)";
            minHand.style.transform="rotate("+getMinutes*360 + "deg)";
            hourHand.style.transform="rotate("+getHours*360 + "deg)";  

            document.querySelector(".current-day").innerHTML=date.toDateString();

        }      
            </script> 

<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

<script>
    $(document).ready(function () {

        $('#calendar').fullCalendar({
            // themeSystem: themeSystem,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '{{ Carbon\Carbon::now()->format('Y-m-d') }}',
            weekNumbers: true,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                @foreach($calendar as $cal)
                {
                    id:1,
                    title: '{{ $cal->campaign->name }}',
                    start: '{{ $cal->scheduled_at }}'
                },
                @endforeach
                
            ]
        });

    });

</script>

@endsection