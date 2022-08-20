            <!-- BEGIN: Inbox Filter -->
            {{-- <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                    <input type="text" onkeyup="search(this)"
                        class="input w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13"
                        placeholder="Search mail">
                </div>

            </div>
            <!-- END: Inbox Filter -->
            <!-- BEGIN: Inbox Content -->
            <div class="intro-y inbox box mt-5">
                <div
                    class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
                    <div
                        class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                        <input class="input border border-gray-500 checkAll" id="check_all" type="checkbox">
                        <a href="javascript:;" onclick="pageLoad()"
                            class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 tooltip"
                            title="@translate(Reload)">
                            <x-feathericon-refresh-cw />
                        </a>

                        <a href="javascript:;"
                            class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 unblock-all tooltip"
                            title="@translate(Unblock email)">
                            <x-feathericon-rotate-ccw />
                        </a>
                        <a href="javascript:;"
                            class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 delete-all tooltip"
                            title="@translate(Delete selected email)">
                            <x-feathericon-trash />
                        </a>
                    </div>
                    <div class="flex items-center sm:ml-auto">

                        <div class="dark:text-gray-300 ml-5">@translate(Total) {{ number_format(blockedCount()) }}
                            @translate(email)</div>

                    </div>
                </div>
                <div class="overflow-x-auto sm:overflow-x-visible myTable">
                    @forelse ($blocks as $block)
                    <div class="intro-y">
                        <div
                            class="cursor-pointer inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1">
                            <div class="flex px-5 py-3">
                                <div class="w-56 flex-none flex items-center mr-10">
                                    <input class="input flex-none border border-gray-500 checking tooltip"
                                        title="@translate(Mark)" data-id="{{ $block->id }}" name="check"
                                        type="checkbox">
                                    <div class="w-6 h-6 flex-none image-fit relative ml-5">
                                        <img alt="{{ $block->email }}" class="rounded-full"
                                            src="{{ emailAvatar($block->email) }}">
                                    </div>

                                    <a href="{{ route('email.contact.show', $block->id) }}"
                                        class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500 tooltip"
                                        title="@translate(Edit)">
                                        <x-feathericon-edit />
                                    </a>
                                </div>

                                <div class="grid grid-cols-3 w-full gap-4">
                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight tooltip"
                                            title="{{ $block->email }}">{{ $block->email }}</span>
                                    </div>

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight tooltip"
                                            title="{{ $block->name }}">{{ $block->name }}</span>
                                    </div>

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight tooltip"
                                            title="{{ $block->phone }}">{{ $block->phone }}</span>
                                    </div>
                                </div>


                                <div class="inbox__item--time whitespace-no-wrap ml-auto pl-10 tooltip"
                                    title="{{ $block->created_at->format('H:i a') }}">
                                    {{ $block->created_at->format('H:i a') }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center">
                            <img src="{{ notFound('mail-not-found.png') }}" class="m-auto" alt="#email-not-found">
                        </div>
                    @endforelse
                </div>
                <div class="p-5 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
                    <div class="dark:text-gray-300">@translate(Total) {{ number_format(blockedCount()) }}
                        @translate(email)</div>
                </div>
            </div> --}}
            <!-- END: Inbox Content -->

            <!-- BEGIN: Inbox Filter -->
            <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                <div class="w-full flex sm:w-auto relative mr-auto mt-3 sm:mt-0">
                    <x-feathericon-search class="mt-2"/>
                    <input type="text" onkeyup="search(this)" class=" input w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13" placeholder="Search mail">
                </div>
            </div>
            <!-- END: Inbox Filter -->

                <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
                    <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                        <input class="input border border-gray-500 checkAll" id="check_all" type="checkbox">
                        <a href="javascript:;" onclick="pageLoad()" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(Reload)">
                            <x-feathericon-refresh-cw/>
                        </a>
                         <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 favourites-all" title="@translate(Add to favourite)">
                            <x-feathericon-star/>
                        </a>
                         <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 block-all" title="@translate(Blacklist email)">
                            <x-feathericon-x-octagon/>
                        </a>
                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 delete-all" title="@translate(Delete selected email)">
                            <x-feathericon-trash/>
                        </a>

                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300 send-email" title="@translate(Send test email)">
                            <x-feathericon-send/>
                        </a>

                        <a href="{{ route('email.contacts.export') }}" title="@translate(Export CSV)" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-30"> 
                            <span class="w-5 h-5 flex items-center justify-center"> 
                                <x-feathericon-file-text/>
                            </span> 
                        </a>
                        
                    </div>
                    <div class="flex items-center sm:ml-auto">
                        <div class="dark:text-gray-300 ml-5">@translate(Total) {{ number_format(blockedCount()) }} email(s)</div>
                    </div>
                </div>

            <div class="min-h-screen py-5">
                <div class='overflow-x-auto w-full'>
                    <table class='mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left">
                                <th class="font-semibold text-sm uppercase px-6 py-4"> Users </th>
                                <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Created </th>
                                <th class="font-semibold text-sm uppercase px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 myTable">
                            @forelse ($blocks as $block)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-6">
                                        <div class="inline-flex w-10 h-10"> 
                                            <img class='w-10 h-10 object-cover rounded-full' 
                                                alt='{{ $block->email ?? 'No Email' }}' 
                                                src='{{ emailAvatar($block->email ?? 'No Email') }}' /> 
                                        </div>
                                        <div>
                                            <p> <label for="{{ $block->id }}">{{ $block->name ?? 'No name' }}</label> </p>
                                            <p class="text-gray-500 text-sm font-semibold tracking-wide"> <label for="{{ $block->id }}">{{ $block->email ?? 'No email address' }}</label></p>
                                            <p class="text-gray-500 text-sm font-semibold tracking-wide"> <label for="{{ $block->id }}">
                                                {{ $block->phone != null ?? '+'}}{{ $block->country_code }}{{ $block->phone ?? 'No phone number'}}
                                                </label>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $block->created_at->diffForHumans() }} </td>
                                <td class="py-4 text-right">

                                    <div class="flex-none flex justify-end mr-4">
                                        <input id="{{ $block->id }}" class="input flex-none border border-gray-500 checking" data-id="{{ $block->id }}"  data-email="{{ $block->email }}" name="check" type="checkbox">
                                        <a href="javascript:;" id="markAsFav" data-id="{{ $block->id }}" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500">
                                            <x-feathericon-star class="{{ $block->favourites == 1 ? 'text-blue-300' : null }}"/>
                                        </a>

                                        <a href="{{ route('email.contact.show', $block->id) }}"
                                        class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500 tooltip"
                                        title="@translate(Edit)">
                                        <x-feathericon-edit />
                                    </a>
                                        
                                        <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                            <img alt="{{ $block->email ?? 'No Email' }}" class="rounded-full" src="{{ emailAvatar($block->email ?? 'No Email') }}">
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @empty
                                <div class="text-center">
                                    <img src="{{ notFound('mail-not-found.png') }}" class="m-auto" alt="#email-not-found">
                                </div>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="p-5 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
                        <div class="dark:text-gray-300">@translate(Total) {{ number_format(blockedCount()) }} email(s)</div>
                    </div>

                </div>
            </div>

<script src="{{ filePath('bladejs/email_contacts/load_pages/blocked.js') }}"></script>