@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Api App Key)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create Api App Key)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">

        @if (check_key())
        <div class="bg-indigo-900 text-center py-4 lg:px-4">
        <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
            <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">@translate(Message)</span>
            <span class="font-semibold mr-2 text-left flex-auto">@translate(Please setup your API, click on the submit to setup your API.)</span>
        </div>
        </div>
        @endif
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('app.api.store') }}" method="POST">
                @csrf

                <div class="intro-y p-5">

                    @if (!check_key())

                    <div>
                        <label>@translate(APP KEY)</label>
                        <input type="text" 
                                class="input w-full border mt-2 cursor-not-allowed	" 
                                name="app_key" 
                                value="{{ user_app_key() }}"
                                placeholder="APP KEY" 
                                disabled
                                data-parsley-required>
                    </div>

                    <div class="mt-2">
                        <label>@translate(APP SECRET KEY)</label>
                        <input type="text" 
                                class="input w-full border mt-2 cursor-not-allowed" 
                                name="app_secret" 
                                placeholder="APP SECRET KEY" 
                                value="{{ user_app_secret_key() }}"
                                disabled
                                data-parsley-required>
                    </div>

                    @endif

                    <div class="mt-3">
                        <button type="submit" class="button bg-theme-1 text-white">Generate New Api</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection