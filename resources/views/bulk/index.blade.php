@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Bulk Export Import Contacts)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Bulk Export Import Contacts)</h2>
<style>

    .textty {
        text-align: left;
        margin: 2% 2% 2% 2%;
    }

</style>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Import List -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <div class="lg:m-auto lg:m-auto text-center lg:text-left w-full">
                            

                            <img src="{{ asset('bulk/import.jpg') }}" class="m-auto" width="15%" height="15%" alt="">
                            

                            <div class="text-center mt-4">
                                
                                <form action="{{ route('bulk.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mt-6">
                                        <div class="input-form textty">
                                            <label><strong>Select CSV File</strong></label><br/>
                                            <input type="file" class="input w-full border" placeholder="Ex: 1825731327"  name="csv" required>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <div class="input-form textty">
                                            <label><strong>File Name</strong></label><br/>
                                            <input type="text" name="fileName" class="input w-full border" placeholder="Ex: 1825731327" required>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <div class="input-form textty">

                                            <label><strong>Select Group</strong></label><br/>
                                            <select class="tail-select w-full"  multiple data-live-search="true" name="groups[]">
                                                @forelse(allEmailGroups() as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>


                                    <div class="mt-6">
                                        <div class="input-form">
                                            <button type="submit" class="button w-24 bg-theme-1 text-white">Import</button>
                                            <a href="{{ route('bulk.sample.csv') }}" class="button w-24 bg-theme-1 text-white">Sample Sheet</a>
                                        </div>
                                    </div>

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

<!--                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 text-left mt-2" role="alert">
                            <p>Please upload your containing csv file compitable with CSV(Comma Delimited) unless some field will be truncated.</p>
                            </div>

                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 text-left" role="alert">
                            <p>Please care with the columns extra column is not ideal csv for importing.</p>
                            </div>-->

                        </div>
                    </div>
                </div>
        </div>
        <!-- END: Import List -->
        <!-- BEGIN: Export List -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y" style="height: 100%">

                <div class="box" style="height: 100%">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5" style="height: 100%">
                        <div class="llg:m-auto lg:m-auto text-center lg:text-left">

                            <div class="text-center mt-6">
                                <img class="m-auto" src="{{ asset('bulk/export.jpg') }}" width="40%" height="40%" alt="">
                            </div>
                            <div class="text-center mt-6">
                                <a href="{{ route('bulk.export') }}" class="button w-24 bg-theme-1 text-white">Export Contacts</a>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        <!-- END: Export List -->




    </div>

    <div class="box text-center mt-3">
        <img src="{{ asset('sample/sample.png') }}" alt="sample-csv" class="w-full">
    </div>



@endsection

@section('script')

@endsection