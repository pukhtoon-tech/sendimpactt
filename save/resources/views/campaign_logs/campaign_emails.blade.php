@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Campaign Logs)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Campaign Logs)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="campaignLogIndex">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(Log ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(EMAIL)</th>
                        <th class="text-center whitespace-no-wrap">@translate(PHONE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED AT)</th>
                    </tr>
                </thead>
                <tbody class="campaignLogName">
                    @forelse (listCampaignEmails($id) as $log)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $log->id }}" class="tooltip rounded-full" src="{{ commonAvatar($log->id) }}" title="{{ $log->id }}">
                                </div>
                            </td>
                            
                            <td class="text-center tooltip" title="@translate(Campaign Name)">
                                    {{ $log->emails->email }}
                            </td>
                            
                            <td class="text-center tooltip" title="@translate(Campaign Name)">
                                    {{ $log->emails->phone ?? '-' }}
                            </td>

                            <td class="text-center tooltip" title="@translate(Campaign Date)">{{ $log->created_at }}</td>
                        </tr>
                    @empty
                     <td colspan="4">
                            <div class="text-center">
                                <img src="{{ notFound('campain-not-found.png') }}" class="w-2/5 m-auto no-shadow" alt="#campain-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- END: Data List -->
    
    </div>
@endsection

@section('script')
<script src="{{ filePath('bladejs/campaignlogs/campaign_emails.js') }}"></script>
@endsection