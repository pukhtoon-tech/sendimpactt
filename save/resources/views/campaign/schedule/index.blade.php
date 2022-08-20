@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Campaigns Schedules)</title>
@endsection

@section('css')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Campaigns Schedule List)</h2>



    <div class="grid grid-cols-12 gap-6 mt-5">
       
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ICON)</th>
                        <th class="whitespace-no-wrap">@translate(CAMPAING NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(Schedule at)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="campaignName">
                    @forelse ($schedules as $schedule)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $schedule->campaign->name  }}" class="tooltip rounded-full" src="{{ namevatar($schedule->campaign->name) }}" title="{{ $schedule->campaign->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="{{ $schedule->campaign->name  }}">{{$schedule->campaign->name }}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap" data-theme="light">{!! Str::limit($schedule->campaign->description, 150) !!}</div>
                            </td>


                            <td class="text-center w-40">{{ $schedule->scheduled_at }}</td>
                       
                            
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $schedule->status == 'SENT' ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $schedule->status == 'SENT' ? 'Sent' : 'Pending' }}
                                </div>
                            </td>

                            <td class="text-center w-40">{{ $schedule->created_at }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                    <a class="flex items-center mr-3 tooltip" title="@translate(Edit)" href="{{ route('campaign.schedule.email.edit', $schedule->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" 
                                    href="{{ route('campaign.schedule.email.delete', $schedule->id) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <td colspan="8">
                            <div class="text-center">
                                <img src="{{ notFound('campain-not-found.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $schedules->firstItem() ?? '0' }} to {{ $schedules->lastItem() ?? '0' }} of {{ $schedules->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $schedules->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>



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

   <script src="{{ filePath('bladejs/campaigns/index.js') }}"></script>

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