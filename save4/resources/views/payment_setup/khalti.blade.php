@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Khalti Setup)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Khalti Setup)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">

        <div class="px-5 sm:px-20 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('payment.setup.khalti.create') }}" method="GET">
                <div class="intro-y p-5">

                    <div>
                        <label>@translate(Khalti Client ID)</label>
                        <input  type="text" value="{{ env('KHALTI_KEY') ?? '' }}" class="input w-full border mt-2" name="khalti_client_id" placeholder="Khalti Client ID">
                    </div>

                    <div class="mt-3">
                          <label>@translate(Khalti Secret Key)</label>
                          <input  type="text" value="{{ env('KHALTI_SECRET') ?? '' }}" class="input w-full border mt-2" name="khalti_secret" placeholder="Khalti Secret Key">
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">@translate(Setup)</button>
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
