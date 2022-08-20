            <!-- END: Inbox Filter -->

                <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
                    <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                        <input class="input border border-gray-500 checkAll" id="check_all" type="checkbox">
                       
                        <p class="ml-3">
                            Select all in this page
                        </p>
                        
                    </div>
                    <div class="flex items-center sm:ml-auto">
                        <div class="dark:text-gray-300 ml-5">@translate(Total) {{ number_format(emailCount()) }} email(s)</div>
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
                            @forelse ($emails as $email)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-6">
                                        <div class="inline-flex w-10 h-10"> 
                                            <img class='w-10 h-10 object-cover rounded-full' 
                                                alt='{{ $email->email ?? 'No Email' }}' 
                                                src='{{ emailAvatar($email->email ?? 'No Email') }}' /> 
                                        </div>
                                        <div>
                                            <p> <label for="{{ $email->id }}">{{ $email->name ?? 'No name' }}</label> </p>
                                            <p class="text-gray-500 text-sm font-semibold tracking-wide"> <label for="{{ $email->id }}">
                                                {{ $email->phone != null ?? '+'}}{{ $email->country_code }}{{ $email->phone ?? 'No phone number'}}
                                                </label>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $email->created_at->diffForHumans() }} </td>
                                <td class="py-4 text-right">

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
                            {{ $emails->links('vendor.pagination.custom') }}
                    </div>

                </div>
            </div>

<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.checkAll').click(function(){
            if($(this).is(':checked')){
                $('.checking').prop('checked', true);
            }else{
                $('.checking').prop('checked', false);
            }
        });
    });
</script>