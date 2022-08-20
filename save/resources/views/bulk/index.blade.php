@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Bulk Export Import Contacts)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Bulk Export Import Contacts)</h2>


    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Import List -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <div class="lg:m-auto lg:m-auto text-center lg:text-left w-full">
                            

                            <img src="{{ asset('bulk/import.jpg') }}" class="m-auto" width="300px" height="300px" alt="">
                            

                            <div class="text-center mt-4">
                                
                                <form action="{{ route('bulk.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="csv" required>

                                    

                                    <button type="submit" class="button w-24 bg-theme-1 text-white">Import</button>

                                     @if ($errors->any())

                                        <div class="alert alert-danger-soft show text-center flex items-center mb-2 mt-2">
                                            <ul class="m-auto">
                                                @foreach ($errors->all() as $error)
                                                    <li class="text-theme-6 font-medium leading-none mt-3">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    @else

                                    <ul class="mt-3 text-theme-1 font-medium leading-none">
                                        <li class="mt-2">File size must be smaller then 20MB</li>
                                        <li  class="mt-2">File type must be csv</li>
                                    </ul>

                                    @endif

                                </form>

                            </div>

                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 text-left mt-2" role="alert">
                            <p>Please upload your containing csv file compitable with CSV(Comma Delimited) unless some field will be truncated.</p>
                            </div>

                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 text-left" role="alert">
                            <p>Please care with the columns extra column is not ideal csv for importing.</p>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        <!-- END: Import List -->
        <!-- BEGIN: Export List -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">

                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <div class="llg:m-auto lg:m-auto text-center lg:text-left">
                            
                            <img src="{{ asset('bulk/export.jpg') }}" width="300px" height="300px" alt="">

                            <div class="text-center mt-6">
                                <a href="{{ route('bulk.export') }}" class="button w-24 bg-theme-1 text-white">Export Contacts</a>
                            </div>          

                        </div>

                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 text-left mt-2" role="alert">
                        <p>For better import or export experience you may use the sample CSV file providing by {{ org('company_name') }}. click <a href="{{ route('bulk.sample.csv') }}" class="text-lg text-theme-1 leading-none">here</a> to download sample CSV.</p>
                        <p>Download the <a href="{{ route('bulk.sample.csv') }}" class="text-lg text-theme-1 leading-none">sample csv</a> file and override the sample data. Make sure each column has data as like the sample csv.</p>
                        </div>

                    </div>

                </div>

        </div>
        <!-- END: Export List -->

        


    </div>


        

    
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mt-3" role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
            <p class="font-bold">Important message: please read before import</p>
            <p class="text-sm"> - You do not need to care about the <strong>"owner_id"</strong> value. The application will take the Owner ID by itself. You can put <strong>null</strong> or provide any number in this column.</p>
            <p class="text-sm"> - Empty column or extra column is not recommanded. Please follow sample instruction above.</p>
            </div>
        </div>
    </div>

    <div class="box text-center mt-3">
        <img src="{{ asset('sample/csv.png') }}" alt="sample-csv" class="w-full">
    </div>



@endsection

@section('script')

@endsection