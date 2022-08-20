<!-- BEGIN: Top Bar -->
@auth
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="{{ route('dashboard') }}" class="">@translate(Dashboard)</a>

        <i data-feather="chevron-right" class="breadcrumb__icon"></i>


        @for($i = 1; $i <= count(Request::segments()); $i++)
            {{ucfirst(Request::segment($i))}}

            @if ($i + 1 == count(Request::segments()))
                <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            @endif

        @endfor

    </div>
    <!-- END: Breadcrumb -->

    <!-- BEGIN: Frontend -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <a href="{{ route('frontend.index') }}" target="_blank" class="button px-2 mr-1 mb-2 border text-gray-700 dark:bg-dark-5 dark:text-gray-300 tooltip inline-block" title="@translate(Go To Frontend)">
            <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="sun" class="w-4 h-4"></i> </span>
        </a>
    </div>
    <!-- END: Frontend -->

    @can('Admin')
        
    

 <!-- BEGIN: queue retry -->
    <div class="intro-x relative mr-3 sm:mr-6 blinking md:hidden">
        <a href="javascript:;" onclick="queueRetry()"
        class="button {{ CheckFailedJob() }} px-2 mr-1 mb-2 border text-gray-700 dark:bg-dark-5 dark:text-gray-300 tooltip inline-block"
        title="@translate(Queue Retry)">
            <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="radio" class="w-4 h-4 queue-retry-loader"></i> </span>
        </a>
    </div>
    <!-- END: queue retry -->

 <!-- BEGIN: queue retry -->
    <div class="intro-x relative mr-3 sm:mr-6 blinking md:hidden">
        <a href="javascript:;" onclick="queueWork()"
        class="button px-2 {{ CheckQueue() }} mr-1 mb-2 border text-gray-700 dark:bg-dark-5 dark:text-gray-300 tooltip inline-block"
        title="@translate(Restart Queue)">
            <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="refresh-ccw" class="w-4 h-4 queue-work-loader"></i> </span>
        </a>
    </div>
    <!-- END: queue retry -->

    @endcan


     <!-- BEGIN: Currency -->
                    <div class="intro-x relative mr-3 sm:mr-6">

         <div class="dropdown">

            <button class="dropdown-toggle button px-2 mr-1 mb-2 border text-gray-700 dark:bg-dark-5 dark:text-gray-300 tooltip" title="Currency switch">
                <span class="w-5 h-5 flex items-center justify-center">
                    {{ activeCurrencySymbol() }}
                </span>
            </button>

                <div class="dropdown-box currency-box">
                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                 @foreach(\App\Models\Currency::where('is_published', 1)->get() as $item)
                    <a href="{{route('currencies.change')}}" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                    onclick="event.preventDefault();
                                               document.getElementById('{{$item->code}}').submit()"
                                               >

                                               {{Str::ucfirst($item->symbol.' '.$item->code)}}

                        <form id="{{$item->code}}" class="d-none"
                                              action="{{ route('currencies.change') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                        </form>
                    </a>

                @endforeach

                </div>

            </div>
        </div>
    </div>

    <!-- END: Currency -->


    <!-- BEGIN: Language -->
    <div class="intro-x relative mr-3 sm:mr-6 md:hidden">
         {{-- Select  --}}

         {{-- Select End --}}
         <div class="dropdown">

            <button class="dropdown-toggle button px-2 mr-1 mb-2 border text-gray-700 dark:bg-dark-5 dark:text-gray-300 tooltip" title="Language switch">
                <span class="w-6 h-5 flex items-center justify-center">
                    <img
                    src="{{asset('uploads/lang/'. countryFlag())}}" class="" height="30px"
                    alt=""/>
                </span>
            </button>

                <div class="dropdown-box lang-box">
                <div class="dropdown-box__content dropdown-box__lang box dark:bg-dark-1 p-2">
                @forelse (languages() as $language)
                    <a href="{{route('language.default',$language->id)}}" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <img alt="{{ $language->name }}" class="tooltip w-12 rounded m-auto" src="{{ flag($language->image) }}" title="{{ $language->name }}">
                    </a>
                    @empty
                    <a href="javscript:;" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">@translate(No language created)</a>
                @endforelse

                </div>

            </div>
        </div>
    </div>
    <!-- END: Language -->


    <!-- BEGIN: Notifications -->

    <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="dropdown-toggle notification

        {{ count(notifications()) > 0 ?'notification--bullet' : '' }}

        cursor-pointer tooltip" title="@translate(Notifications)">
            <i data-feather="bell" class="notification__icon dark:text-gray-300"></i>
        </div>
        <div class="notification-content pt-2 dropdown-box">
            <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                <div class="notification-content__title">
                    <a href="{{ route('notifications.index') }}">
                        @translate(See All Notifications)
                    </a>
                </div>



                @forelse (notifications() as $key => $notification)
                    <div class="cursor-pointer relative flex items-center {{ $key ? 'mt-5' : '' }}">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            <img alt="Maildoll" class="rounded-full" src="{{ commonAvatar($notification->message) }}">
                            <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="{{ $notification->link ?? 'javascript:;' }}" class="font-medium mr-5">{{ $notification->message }}</a>
                            </div>
                            <div class="w-full truncate text-gray-600">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="intro-y">
                            <div class="px-4 py-4 mb-3 flex items-center">

                                <img src="{{ notFound('no-notification.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">

                            </div>
                        </div>

                @endforelse




            </div>
        </div>
    </div>


    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in tooltip" title="{{ username() }}">
            <img src="{{ avatar() }}" />
        </div>
        <div class="dropdown-box w-56">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                    <div class="font-medium">{{ username() }}</div>
                    <div class="text-xs text-theme-41 dark:text-gray-600">{{ Auth::user()->user_type }}</div>
                    @can('Admin')
                    <div class="text-xs text-theme-42 dark:text-gray-700">@translate(Balance): ${{ totalEarned() }}</div>
                    @endcan
                </div>
                <div class="p-2">
                    <a href="{{ route('profile.index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i> @translate(Profile)
                    </a>
                    <a href="{{ route('limit.index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="edit" class="w-4 h-4 mr-2"></i> @translate(Add Account)
                    </a>
                    <a href="{{ route('profile.change.password') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> @translate(Reset Password)
                    </a>

                    
                    <a href="javascript:;" class="hidden flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> @translate(Support Ticket)
                    </a>
                    
                    <a href="{{ route('app.api.index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> @translate(API Integration)
                    </a>

                    @can('Admin')
                        
                    @endcan



                </div>
                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                    <a href="{{ route('logout') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> @translate(Logout)
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->


{{-- Second row:end --}}

<input type="hidden" value="{{ route('queue.work') }}" id="queue_work_url">
<input type="hidden" value="{{ route('queue.retry') }}" id="queue_retry_url">
<script src="{{ filePath('bladejs/top-bar.js') }}"></script>

@endauth
