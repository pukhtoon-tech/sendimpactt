            <!-- BEGIN: Inbox Filter -->
                
            <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                <div class="w-full flex sm:w-auto relative mr-auto mt-3 sm:mt-0">

                    <input type="text" onkeyup="search(this)" class=" input w-full sm:w-64 box px-4 text-gray-700 dark:text-gray-300 placeholder-theme-13" placeholder="Search mail">
                    <div class="absolute search_icon_mail">
                        <x-feathericon-search class="mt-2"/>
                    </div>
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
                        <a class="w-15 h-5 ml-5 flex items-center justify-center dark:text-gray-30"> | </a>
                    </div>

                    <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                        <a href="javascript:void(0)" onclick="getEmails()" class="activeEmail w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(All Contacts)">
                            <x-feathericon-circle class="iconColor" id="allEmailsData" />
                        </a>
                        <a href="javascript:void(0)" onclick="getAllEmails()" class="activeAllEmail w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(Email List)">
                            <x-feathericon-mail class="iconColor" />
                        </a>
                        <a href="javascript:void(0)" onclick="getAllPhone()" class="activeAllPhone w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(Phone List)">
                            <x-feathericon-phone class="iconColor" />
                        </a>
                        <a href="javascript:void(0)" onclick="getFavourites()" class="activeFavourites w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(Favourites List)">
                            <x-feathericon-star class="iconColor" />
                        </a>
                        <a href="javascript:void(0)" onclick="getBlocked()" class="activeBlocked w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(Blocked List)">
                            <x-feathericon-x-octagon class="iconColor" />
                        </a>
                        <a href="javascript:void(0)" onclick="getTrashed()" class="activeTrashed w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300" title="@translate(Trashed List)">
                            <x-feathericon-trash-2 class="iconColor" />
                        </a>

                    </div>
                    <div class="flex items-center sm:ml-auto">
                        <div class="dark:text-gray-300 ml-5">@translate(Total) {{ number_format(emailCount()) }} email(s)</div>
                    </div>
                </div>

            <div class="min-h-screen py-5">
                <div class='overflow-x-auto w-full'>
                    <table class='mx-auto w-full whitespace-nowrap rounded-md bg-white divide-y divide-gray-300 overflow-hidden myTable'>
                        <thead class="bg-gray-900 height_45px">
                            <tr class="text-white text-left">
                                <th class="text-center whitespace-no-wrap">@translate(SL.)</th>
                                <th class="text-center whitespace-no-wrap">@translate(First Name)</th>
                                <th class="text-center whitespace-no-wrap">@translate(Last Name)</th>
                                <th class="text-center whitespace-no-wrap">@translate(Company Name)</th>
                                <th class="text-center whitespace-no-wrap">@translate(EMAIL)</th>
                                <th class="text-center whitespace-no-wrap">@translate(PHONE)</th>
                                <th class="text-center whitespace-no-wrap">@translate(DATE)</th>
                                <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($emails as $email)
                            <tr>
                                <td class="text-center">
                                    {{$loop->iteration}}
                                </td>
                                <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    {{ $email->first_name ?? $email->name ?? 'No first name' }}

                                </td>
                                <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    {{ $email->last_name ?? 'No last name' }}

                                </td>

                                <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    {{ $email->company_name ?? 'No company' }}

                                </td>

                                <td class="text-center tooltip" title="@translate(Recipient Email)">
                                    <label for="{{ $email->id }}">{{ Str::limit($email->email, 50) ?? 'No email address' }}</label>
                                </td>
                                <td  class="text-center tooltip" title="@translate(Recipient Email)">
                                    <label for="{{ $email->id }}">{{ $email->phone != null ?? '+'}}{{ $email->country_code }}{{ $email->phone ?? 'No phone number'}}</label>
                                </td>
                                <td class="text-center tooltip" title="@translate(Mail Date)">{{ $email->created_at->format('Y-m-d') }}</td>
                                <td class="py-4 text-center">

                                    <div class="flex-none flex justify-end mr-4">
                                        <input id="{{ $email->id }}" class="input flex-none border border-gray-500 checking" data-id="{{ $email->id }}"  data-email="{{ $email->email }}" name="check" type="checkbox">
                                        <a href="javascript:;" id="markAsFav" data-id="{{ $email->id }}" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500">
                                            <x-feathericon-star class="{{ $email->favourites == 1 ? 'text-blue-300' : null }}"/>
                                        </a>

                                        <a href="{{ route('email.contact.show', $email->id) }}"
                                        class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500 tooltip"
                                        title="@translate(Edit)">
                                        <x-feathericon-edit />
                                    </a>
                                        
                                        <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                            <img alt="{{ $email->email ?? 'No Email' }}" class="rounded-full" src="{{ emailAvatar($email->email ?? 'No Email') }}">
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
                            {{ $emails->links('vendor.pagination.default') }}
                    </div>

                </div>
            </div>

<script src="{{ filePath('bladejs/email_contacts/load_pages/emails.js') }}"></script>