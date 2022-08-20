@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Notifications)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Notifications List)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="notificationIndex">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ICON)</th>
                        <th class="whitespace-no-wrap">@translate(MESSAGE)</th>
                        <th class="whitespace-no-wrap">@translate(GO TO LINK)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                    </tr>
                </thead>
                <tbody class="notificationName">
                    @forelse (notifications() as $notification)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="{{ $notification->message }}" class="tooltip rounded-full" src="{{ commonAvatar($notification->message) }}" title="{{ $notification->message }}">
                                    </div>
                                </div>
                            </td>

                            <td class="">{{ $notification->message }}</td>
                            <td class="">
                                <a href="{{ $notification->link }}" class="{{ $notification->link == null ? 'cursor-not-allowed ' : '' }}"> <i data-feather="{{ $notification->link != null ? 'eye' : 'eye-off' }}" class="tooltip" title="{{ $notification->link != null ? '@translate(Visit to the link)' : '@translate(No link available)' }}"></i></a>
                            </td>

                            
                            
                            <td class="text-center w-40">{{ $notification->created_at->diffForHumans() }}</td>


                        </tr>
                    @empty
                       <td colspan="4">
                            <div class="text-center">
                                <img src="{{ notFound('no-notification.png') }}" class="m-auto no-shadow" alt="#notifications-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ notifications()->firstItem() ?? '0' }} to {{ notifications()->lastItem() ?? '0' }} of {{ notifications()->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ notifications()->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>

@endsection

@section('script')
<script src="{{ filePath('bladejs/notification/index.js') }}"></script>
@endsection