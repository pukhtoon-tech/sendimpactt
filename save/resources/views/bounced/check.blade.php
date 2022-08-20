@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Bounce Checker)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Bounce Checker)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Email Address)</label>
                        <input type="email" class="input w-full border mt-2" name="email" placeholder="Email Address" required id="emailAddress" data-parsley-required data-parsley-type="email">
                    </div>


                    <div class="text-right mt-5">
                        <button type="button" onclick="checkBounce()" class="button w-24 bg-theme-1 text-white">@translate(Check)</button>
                    </div>

                </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->


     <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5 hidden" id="resultOfBoundBox">
            <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">

                    <div id="checkResult"></div>
                    

                </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

    {{-- Loader --}}
    <div class="loading hidden"></div>
    {{-- Loader::end --}}

    <input type="hidden" value="{{ route('bounce.checker') }}" id="bounce_checker_url">

@endsection

@section('script')
   <script src="{{ filePath('assets/js/email_contacts.js') }}"></script>

   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>

@endsection