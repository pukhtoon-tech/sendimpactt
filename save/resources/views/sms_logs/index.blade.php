@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(SMS Logs)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(SMS Logs)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="smsLogIndex">
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
                        <th class="text-center whitespace-no-wrap">@translate(To)</th>
                        <th class="text-center whitespace-no-wrap">@translate(MESSAGE ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(MESSAGE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CAMPAING)</th>
                        <th class="text-center whitespace-no-wrap">@translate(DATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>
                <tbody class="smsLogName">
                    @forelse ($logs as $log)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $loop->iteration }}" class="tooltip rounded-full" src="{{ commonAvatar($loop->iteration) }}" title="{{ $loop->iteration }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(SMS To)">
                                    {{ $log->number ?? null }}
                            </td>
                            <td class="text-center tooltip" title="{{ $log->message_id ?? null }}">{{ $log->message_id ?? null }}</td>
                            <td class="text-center tooltip" title="{{ $log->message ?? null }}">{{ $log->message ?? null }}</td>
                            <td class="text-center tooltip" title="{{ $log->campaign->name ?? 'No Campaign' }}">{{ $log->campaign->name ?? 'No Campaign' }}</td>
                            <td class="text-center tooltip" title="{{ $log->created_at }}">{{ $log->created_at }}</td>

                            <td class="text-center">
                                <a href="{{ route('logs.campaign.sms.destroy', $log->id) }}" class="maildoll-text-center"> <i data-feather="trash" class="tooltip" title="@translate(delete)"></i></a>
                            </td>
                        </tr>
                    @empty
                    <td colspan="6">
                            <div class="text-center">
                                <img src="{{ notFound('log.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $logs->firstItem() ?? '0' }} to {{ $logs->lastItem() ?? '0' }} of {{ $logs->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $logs->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')
<script src="{{ filePath('bladejs/sms-logs/index.js') }}"></script>
@endsection