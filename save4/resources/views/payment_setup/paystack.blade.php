@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Paystack Setup)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Paystack Setup)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('paystack.store') }}" method="GET">
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Paystack Public Key)</label>
                        <input type="text"  value="{{ env('PAYSTACK_PUBLIC_KEY') ?? '' }}" class="input w-full border mt-2" name="paystack_public_key" placeholder="Paystack Public Key">
                    </div>

                    <div class="mt-3">
                      <div>
                          <label>@translate(Paystack Secret Key)</label>
                          <input type="text"  value="{{ env('PAYSTACK_SECRET_KEY') ?? '' }}" class="input w-full border mt-2" name="paystack_secret_key" placeholder="Paystack Secret Key">
                      </div>
                    </div>

                    <div class="mt-3">
                      <div>
                          <label>@translate(Paystack Payment URL)</label>
                          <input type="text"  value="{{ env('PAYSTACK_PAYMENT_URL') ?? '' }}" class="input w-full border mt-2" name="paystack_payment_url" placeholder="Paystack Payment URL">
                      </div>
                    </div>

                    <div class="mt-3">
                      <div>
                          <label>@translate(Paystack Merchant Email)</label>
                          <input type="text"  value="{{ env('MERCHANT_EMAIL') ?? '' }}" class="input w-full border mt-2" name="paystack_merchant_email" placeholder="Paystack Merchant Email">
                      </div>
                    </div>

                    <div class="mt-3">
                      <div>
                          <label>@translate(Paystack Merchant Currency)</label>
                            <select class="w-full form-select sm:w-1/2" name="paystack_merchant_currency" required="">
                                    <option value="GHS" {{ env('MERCHANT_CURRENCY') == "GHS" ? 'selected' : null }}>Ghana (GHS)</option>
                                    <option value="NGN" {{ env('MERCHANT_CURRENCY') == "NGN" ? 'selected' : null }}>Nigeria (NGN)</option>
                                    <option value="ZAR" {{ env('MERCHANT_CURRENCY') == "ZAR" ? 'selected' : null }}>South Africa (ZAR)</option>
                            </select>
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
