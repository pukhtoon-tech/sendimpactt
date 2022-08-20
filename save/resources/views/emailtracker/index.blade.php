@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Campaign Statistics)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Campaign Statistics)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">

        @include('components.tracker-statistics')

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">


                
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CAMPAIGN)</th>
                        <th class="text-center whitespace-no-wrap">@translate(SERVED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(EMAILS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CLICKS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(UNIQUE CLICKS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(DELIVERED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(OPEN RATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>

                <tbody class="mailLogName">
                    @forelse ($campaigns as $campaign)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $campaign->campaign_name->name }}" 
                                         class="tooltip rounded-full" 
                                         src="{{ commonAvatar($campaign->campaign_name->name) }}" 
                                         title="{{ $campaign->campaign_name->name }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(CAMPAIGN)">
                            
                                    {{ $campaign->campaign_name->name }}
                                
                            </td>
                            <td class="text-center tooltip" title="@translate(SERVED)">
                            
                                    {{ campaignTotalRan($campaign->campaign_id) }} Time('s)
                                
                            </td>
                            <td class="text-center tooltip" title="@translate(EMAILS)">
                            
                                    {{ campaignTracker($campaign->campaign_id)->total }}
                                
                            </td>
                            <td class="text-center tooltip" title="@translate(CLICKS)">
                            
                                    {{ campaignEmailTotalClicks($campaign->campaign_id) }}
                                
                            </td>
                            <td class="text-center tooltip" title="@translate(UNIQUE CLICKS)">
                            
                                    {{ campaignEmailUniqueClicks($campaign->campaign_id) }}
                                
                            </td>
                            <td class="text-center tooltip" title="@translate(DELIVERED)">
            
                                        <div class="progress-bar">
                                            <span class="progress-bar-fill" 
                                                  style="width: {{ campaignDeliveryRate($campaign->campaign_id) }}%;">
                                                  {{ campaignEmailDelivered($campaign->campaign_id) }}/{{campaignEmailNotOpenedAndNotOpen($campaign->campaign_id)}}
                                            </span>
                                        </div>
                                
                            </td>
                            <td class="text-center tooltip" title="@translate(OPEN RATE)">
                            
                                    <div class="progress-bar">
                                        <span class="progress-bar-fill" 
                                                style="width: {{ campaignOpenRate($campaign->campaign_id) }}%;">
                                                {{ campaignEmailClicked($campaign->campaign_id) }}/{{campaignEmailNotOpenedAndNotOpen($campaign->campaign_id)}}
                                        </span>
                                    </div>
                                
                            </td>
                          
                            <td class="text-center">
                                <a href="{{ route('tracker.campaign', $campaign->campaign_id) }}" 
                                   class="maildoll-text-center"> 
                                   <i data-feather="eye" class="tooltip" title="@translate(View)"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                     <td colspan="9">
                            <div class="text-center">
                                <img src="{{ notFound('log.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            {{-- <div class="md:block mx-auto text-gray-600">Showing {{ $logs->firstItem() ?? '0' }} to {{ $logs->lastItem() ?? '0' }} of {{ $logs->total() }} entries</div> --}}
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{-- {{ $logs->links('vendor.pagination.custom') }} --}}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')

<script src="{{ filePath('bladejs/mail-logs/index.js') }}"></script>

@endsection