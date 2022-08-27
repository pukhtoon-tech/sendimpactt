<div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">

<div class="intro-y flex items-center mt-8">
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Display User Information)</h2>
                </div>
                <div class="p-5">

                <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                
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
                                            <tr>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center space-x-6">
                                                        <div class="inline-flex w-10 h-10"> 
                                                            <img class='w-10 h-10 object-cover rounded-full' 
                                                                alt='' 
                                                                src='' /> 
                                                        </div>
                                                        <div>
                                                            <p> <label for="">First Name</label> </p>
                                                           
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center"> <span>Created at</span> </td>
                                                <td class="py-4 text-right">
                
                                                    <div class="flex-none flex justify-end mr-4">
                                                        <input id="" class="input flex-none border border-gray-500 checking" data-id=""  data-email="" name="check" type="checkbox">
                                                        <a href="javascript:;" id="markAsFav" data-id="" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500">
                                                            <x-feathericon-star class="text-blue-300"/>
                                                        </a>
                
                                                        <a href=""
                                                        class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500 tooltip"
                                                        title="@translate(Edit)">
                                                        <x-feathericon-edit />
                                                    </a>
                                                        
                                                        <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                                            <img alt="" class="rounded-full" src="">
                                                        </div>
                                                    </div>
                
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>

</div>
