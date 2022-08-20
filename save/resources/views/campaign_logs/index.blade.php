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
                        <th class="text-center whitespace-no-wrap">@translate(CAMPAIGN NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(MESSAGE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(EMAILS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(GO TO)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>
                <tbody class="campaignLogName">
                    @forelse (campaignlogs() as $log)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $log->id }}" class="tooltip rounded-full" src="{{ commonAvatar($log->id) }}" title="{{ $log->id }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(Campaign Name)">
                                    {{ $log->campaign_name }}
                            </td>

                            <td class="text-center tooltip" title="@translate(Mail Subject)">{{ $log->campaign_name }} {{ $log->message }}</td>

                            <td class="text-center tooltip" title="@translate(Click to view emails)">
                                <a href="{{ route('logs.campaign.emails', $log->campaign_id) }}" class="bg-theme-14 text-theme-10 button">
                                     {{ getCampaignEmails($log->campaign_id) }}
                                </a>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('campaign.index') }}" class="maildoll-text-center"> <i data-feather="eye" class="tooltip" title="@translate(Visit to the link)"></i></a>
                            </td>

                            <td class="text-center tooltip" title="@translate(Campaign Date)">{{ $log->created_at }}</td>

                             <td class="text-center">
                                <a href="{{ route('logs.campaign.email.destroy', $log->id) }}" class="maildoll-text-center"> <i data-feather="trash" class="tooltip" title="@translate(delete)"></i></a>
                            </td>
                        </tr>
                    @empty
                    <td colspan="7">
                            <div class="text-center">
                                <img src="{{ notFound('campain-not-found.png') }}" class="w-2/5 m-auto no-shadow" alt="#campain-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ campaignlogs()->firstItem() ?? '0' }} to {{ campaignlogs()->lastItem() ?? '0' }} of {{ campaignlogs()->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ campaignlogs()->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')
<script src="{{ filePath('bladejs/campaignlogs/index.js') }}"></script>
@endsection