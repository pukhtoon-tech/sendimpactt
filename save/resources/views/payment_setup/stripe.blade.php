@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Stripe Setup)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Stripe Setup)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('payment.setup.stripe.create') }}" method="GET">
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Stripe Client Id)</label>
                        <input data-parsley-required type="text" value="{{ env('STRIPE_KEY') ?? null }}" class="input w-full border mt-2" name="stripe_client_id" placeholder="Stripe Client ID">
                    </div>


                    <div class="mt-3">
                      <div>
                          <label>@translate(Stripe Secret Key)</label>
                          <input data-parsley-required type="text" value="{{ env('STRIPE_SECRET') ?? null }}" class="input w-full border mt-2" name="stripe_secret" placeholder="Stripe Secret Key">
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
