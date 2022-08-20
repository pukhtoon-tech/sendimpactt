@extends('../layout/side-menu')

@section('head')
    <title>Maildoll - Organization Setup</title>
@endsection

@section('content')
    <div class="container">
        <!-- BEGIN: Error Page -->
        <div class="page flex flex-col lg:flex-row h-screen lg:text-left">
            <div class="text-white mt-10 lg:mt-0">

                <!-- BEGIN: Company Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-black text-base mr-auto">@translate(Organization Setup)</h2>
                </div>
                <div class="p-5">
                <form action="{{ route('org.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-5" id="logo">
                        <div class="col-span-12 xl:col-span-4">
                           

                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative cursor-default mx-auto">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <div class="imagePreview bg-contain" style="background-image: url({{ maildollLogo() }});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">@translate(Change Photo)</button>
                                    <input type="file" id="" accept=".png, .jpg, .jpeg" name="avatar" class="imageUpload w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>


                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div>
                                <label class="text-black">@translate(Company Name) <small>@translate(required)</small> </label>
                                <input type="text" class="input text-black  w-full border bg-gray-100 mt-2" placeholder="@translate(Company Name)" value="" name="company_name" data-parsley-required>
                            </div>
                            <div class="mt-5">
                                <label class="text-black">@translate(Company Email) <small>@translate(required)</small> </label>
                                <input type="email" class="input text-black  w-full border bg-gray-100 mt-2" placeholder="@translate(Company Email)" name="company_email" value="" data-parsley-type="email" data-parsley-required>
                            </div>
                            <div class="mt-5">
                                <label class="text-black">@translate(Company Phone Number) <small>@translate(required)</small> </label>
                                <input type="number" class="input text-black  w-full border bg-gray-100 mt-2" placeholder="@translate(Company Phone Number)" name="company_phone_number" value="" data-parsley-required>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Company Telephone Number) <small>@translate(optional)</small> </label>
                                <input type="text" name="company_tel_number" class="input text-black  w-full border mt-2" placeholder="@translate(Telephone Number)" value="">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Company Address) <small>@translate(optional)</small> </label>
                                <input type="text" class="input text-black  w-full border mt-2" placeholder="@translate(Company Address)" name="company_address" value="">
                            </div>
                        </div>
                    </div>

                     <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Test Connection Email) <small>@translate(required)</small> <small>Ex: demo@maildoll.com</small> </label>
                                <input type="email" name="test_connection_email" class="input text-black  w-full border mt-2" placeholder="Test Connection Email" value="" data-parsley-type="email" data-parsley-required>
                            </div>
                            </div>
                             <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Test Connection Sms Number) <small>@translate(required)</small> <small>Ex: +8801825731327</small> </label>
                                <input type="text" name="test_connection_sms" class="input text-black  w-full border mt-2" placeholder="Test Connection Sms Number" value="" data-parsley-required>
                            </div>
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Company Information -->
            
            <div class="flex justify-end mt-4">
                <button type="submit" 
                        class="button w-full inline-block text-xl px-5 py-4 mr-1 mb-2 border text-white dark:bg-dark-5 dark:text-white-300">
                        Save and Next Step
                </button>
            </div>

            </form>

            </div>
        </div>
        <!-- END: Error Page -->
    </div>
@endsection

@section('script')
<script src="{{ filePath('bladejs/install/setupOrg.js') }}"></script>
<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('assets/js/parsley.js') }}"></script>
<script src="{{ filePath('assets/js/validation.js') }}"></script>

@endsection

