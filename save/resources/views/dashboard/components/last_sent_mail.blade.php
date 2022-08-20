 <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">@translate(Last Sent Mail)</h2>
    </div>
    <div class="mt-5">
        @forelse (lastSentMails(10) as $lastSentMail)
            <div class="intro-x">
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                        <img alt="{{ $lastSentMail->id }}" class="tooltip" title="{{ $lastSentMail->id }}" src="{{ commonAvatar($lastSentMail->id) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium tooltip" title="{{ $lastSentMail->email }}">
                            {{ Str::limit($lastSentMail->email, 25) }}
                        </div>
                        <div class="text-gray-600 text-xs">{{ $lastSentMail->created_at->format('d M, Y') }}</div>
                    </div>
                </div>
            </div>
            @empty
            <img src="{{ notFound('mail-not-found.png') }}" class="m-auto no-shadow" alt="#last-sent-mail-not-found">
        @endforelse
        <a href="{{ route('mail.activity.index') }}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
    </div>
</div>