<div class="tab-pane fade" id="pills-mail-server" role="tabpanel" aria-labelledby="pills-mail-server-tab">

<div class="intro-y flex items-center mt-8">
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Mail Server Settings)</h2>
                </div>
                <div class="p-5">

                <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <h2>Mail Server</h2>

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
