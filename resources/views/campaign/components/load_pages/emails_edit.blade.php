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
                                            <p class="text-gray-500 text-sm font-semibold tracking-wide"> <label for="{{ $email->id }}">{{ Str::limit($email->email, 50) ?? 'No email address' }}</label></p>
                                            <p class="text-gray-500 text-sm font-semibold tracking-wide"> <label for="{{ $email->id }}">
                                                {{ $email->phone != null ?? '+'}}{{ $email->country_code }}{{ $email->phone ?? 'No phone number'}}
                                                </label>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center"> {{ $email->created_at->diffForHumans() }}</td>
                                <td class="py-4 text-right">

                                    <div class="flex-none flex justify-end mr-4">
                                        <input id="{{ $email->id }}" 
                                        @foreach ($edit_campaign->campaign_emails as $campaign_email)
                                            {{ $campaign_email->email_id == $email->id ? 'checked' : '' }}
                                        @endforeach
                                        class="input flex-none border border-gray-500 checking" 
                                        data-id="{{ $email->id }}"
                                        data-email="{{ $email->email }}" 
                                        name="check" 
                                        type="checkbox">
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

                <button type="submit" 
                    class="button w-50 ml-8 mt-5 mr-2 mb-3 flex items-center justify-center bg-theme-1 text-white campaign-email"> 
            <i data-feather="activity" class="w-4 h-4 mr-2"></i> 
                 @translate(Save Campaign) 
            </button>


            </div>


<input type="hidden" value="{{ route('campaign.emails.update', $edit_campaign->id) }}" id="campaign_email_edit_url">
<input type="hidden" value="{{ route('campaign.index') }}" id="campaign_index">
<input type="hidden" value="{{ $edit_campaign->id }}" id="campaign_id">


<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.checkAll').on('click', function(){

            if($(this).is(':checked')){
                $('.checking').prop('checked', true);

                var favorite = [];
                $.each($("input[name='check']:checked"), function(){
                    favorite.push($(this).attr('data-id'));
                });

                let pmode = JSON.parse(localStorage.getItem('NewidsArr'));

                if (!Array.isArray(pmode)) {
                    pmode = [];
                }

                if ($(this).is(':checked')) {
                    if (!pmode.includes(favorite)) {
                        pmode.push(favorite);
                    }
                } else {
                const index = pmode.indexOf(favorite);
                    if (index > -1) {
                        pmode.splice(index, 1);
                    }
                }
                
                localStorage.setItem('NewidsArr', JSON.stringify(pmode));

                var arr1 = JSON.parse(localStorage.getItem('NewidsArr').slice(1, -1));
                var arr2 = JSON.parse(localStorage.getItem('idsArr'));
                var mergedArr = $.merge(arr2,arr1);

                localStorage.setItem('idsArr', JSON.stringify(mergedArr));
                localStorage.removeItem('NewidsArr');

            }else{
                $('.checking').prop('checked', false);
            }
        });
    });

    // Mark as read

    $('#markAsFav ').on('click', function(e) {
        var id = $(this).attr('data-id');
        var mark_as_read_url = $('#mark_as_read_url').val();

        $.ajax({
        url: mark_as_read_url,
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {

            getEmails();
        }
        });

    });


    // LOCALSTORAGE
    $('.checking').on('change', function(event) {  
    const $checkbox = $(event.target);
    const value = $checkbox.attr('data-id');
    
    try {
        let pmode = JSON.parse(localStorage.getItem('idsArr'));
        
        if (!Array.isArray(pmode)) {
        pmode = [];
        }
        
        if ($checkbox.is(':checked')) {
        if (!pmode.includes(value)) {
            pmode.push(value);
        }
        } else {
        const index = pmode.indexOf(value);

        if (index > -1) {
            pmode.splice(index, 1);
        }
        }
        
        localStorage.setItem('idsArr', JSON.stringify(pmode));
        } catch (error) {
            console.log(error);
        }
    });
    // LOCALSTORAGE::ENDS


    $('.campaign-email').on('click', function(e) {
        e.preventDefault();

        var campaign_name = $('#campaign_name').val();
        var smtp_server_id = $('#smtp_server_id').val();
        var description = $('#description').val();
        var status = $('#status').val();
        var template_id = $('input[name=template_id].checkbox-tools:checked').val();

            var idsArr = JSON.parse(localStorage.getItem('idsArr'));
            // var group_ids = [];
            // $(".group_id:checked").each(function() {
            //     group_ids.push($(this).attr('data-group-id'));
            // });

            var campaign_email_url = $('#campaign_email_edit_url').val(); //url
            var campaign_list_url = $('#campaign_index').val(); //url
            var campaign_id = $('#campaign_id').val(); //campaign_id

            // if(idsArr.length <= 0 && group_ids.length <= 0 )
            if(idsArr.length <= 0)
            {
                alert("Please select atleast one record");
            }  else {

                if(confirm("Are you sure?")){

                    var strIds = idsArr.join(",");
                    // var strGroupIds = group_ids.join(",");

                    $.ajax({
                        url: campaign_email_url,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            campaign_id: campaign_id,
                            ids: strIds,
                            name: campaign_name,
                            smtp_server_id: smtp_server_id,
                            description: description,
                            status: status,
                            check: 'on',
                            template_id: template_id,
                            // groupIds: strGroupIds
                        },
                        success: function (data) {
                                localStorage.removeItem("idsArr");
                                window.location = campaign_list_url;
                            
                            },
                        error: function (data) {
                            alert('Campaign error!!');
                        }
                    });
                }
            }
        });


</script>




