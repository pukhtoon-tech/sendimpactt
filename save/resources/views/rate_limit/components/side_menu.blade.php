<div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Maildoll" class="rounded-full" src="{{ avatar() }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ Str::upper($limit_user->user->name) }}</div>
                        {{-- TODO --}}
                        <div class="text-gray-600">{{ $limit_user->user->user_type }}</div>
                    </div>
                
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                        @translate(Each user has emails & SMS limit with a specific date-time. Admin can manage users limit at any time. Provide email and SMS limit with duration month.)
                </div>
               
            </div>
        </div>