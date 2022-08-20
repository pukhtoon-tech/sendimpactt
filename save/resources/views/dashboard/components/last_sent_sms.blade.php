 <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">@translate(Last Sent SMS)</h2>
    </div>
    <div class="mt-5">
        @forelse (lastSentSMS(10) as $lastSentSms)
            <div class="intro-x">
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                        <img alt="{{ $lastSentSms->number }}" class="tooltip" title="{{ $lastSentSms->number }}" src="{{ commonAvatar($lastSentSms->gateway) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium tooltip" title="{{ $lastSentSms->number }}">{{ Str::limit($lastSentSms->number, 25) }}</div>
                        <div class="text-gray-600 text-xs">{{ $lastSentSms->created_at->format('d M, Y') }}</div>
                    </div>
                </div>
            </div>

        @empty
            <img src="{{ notFound('sms-not-found.png') }}" class="m-auto no-shadow" alt="#last-sent-sms-not-found">
        @endforelse
        <a href="{{ route('log.sms') }}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
    </div>
</div>