 <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">@translate(Last Campaign)</h2>
    </div>
    <div class="mt-5">
        @forelse (campaignlogs() as $log)
            <div class="intro-x">
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                        <img alt="#{{ $log->id }}" class="tooltip" title="{{ $log->id }}" src="{{ commonAvatar($log->id) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium tooltip" title="{{ $log->campaign_name }} {{ $log->message }}">{{ Str::limit($log->campaign_name, 30) }}</div>
                    </div>
                </div>
            </div>
        @empty
        <img src="{{ notFound('log.png') }}" class="m-auto no-shadow" alt="#campaign-log-not-found">
        @endforelse
        <a href="{{ route('logs.campaign.index') }}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
    </div>
</div>