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
                    <h2 class="font-medium text-black text-base mr-auto">@translate(Create Admin User)</h2>
                </div>
                <div class="p-5">
                <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                 
                        <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Admin Name) <small>@translate(required)</small> </label>
                                <input type="text" name="name" class="input text-black  w-full border mt-2" placeholder="@translate(Admin Name)" value="" required>
                            </div>
                        </div>
                        
                        <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Admin Email) <small>@translate(required)</small> <small>Ex: admin@maildoll.com</small> </label>
                                <input type="email" name="email" class="input text-black  w-full border mt-2" placeholder="Admin Email" value="" data-parsley-type="email" data-parsley-required>
                            </div>
                        </div>

                        <div class="col-span-12 xl:col-span-6">
                            <div class="">
                                <label class="text-black">@translate(Admin Password) <small>@translate(required)</small> </label>
                                <input type="password" name="password" class="input text-black  w-full border mt-2" placeholder="Admin Password" value="" data-parsley-type="password" data-parsley-required>
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

<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('assets/js/parsley.js') }}"></script>
<script src="{{ filePath('assets/js/validation.js') }}"></script>

@endsection

