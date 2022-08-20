@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Instamojo Setup)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Instamojo Setup)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('payment.setup.instamojo.store') }}" method="GET">
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Instamojo App Key)</label>
                        <input type="text"  value="{{ env('IM_API_KEY') ?? '' }}" class="input w-full border mt-2" name="im_api_key" placeholder="Instamojo App Key">
                    </div>

                    <div class="mt-3">
                      <div>
                          <label>@translate(Instamojo Auth Token)</label>
                          <input type="text"  value="{{ env('IM_AUTH_TOKEN') ?? '' }}" class="input w-full border mt-2" name="im_auth_token" placeholder="Instamojo Auth Token">
                      </div>
                    </div>

                    <div class="mt-3">
                      <div>
                          <label>@translate(Instamojo URL)</label>
                          <input type="text"  value="{{ env('IM_URL') ?? '' }}" class="input w-full border mt-2" name="im_url" placeholder="Instamojo URL">
                      </div>
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
