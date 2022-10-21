<div class="tab-pane fade" id="pills-domain" role="tabpanel" aria-labelledby="pills-domain-tab">

<div class="intro-y flex items-center mt-8">
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Domain Settings)</h2>
                </div>
                <div class="p-5">

                <form action="{{ route('domain.verify') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12">
                            <div>
                                <label>@translate(Domain Name) <small>@translate(required)</small> </label>
                                <input type="text" required class="input w-full border bg-gray-100 mt-2" placeholder="Enter Domain Name" name="domain" data-parsley-required>
                            </div>

                            <button type="submit" class="button w-50 bg-theme-1 text-white mt-3">@translate(Verify)</button>
                        </div>
                    </div>

                </form>

                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>

</div>
