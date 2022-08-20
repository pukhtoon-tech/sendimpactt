@extends('frontend.' . theme() .'.layouts.master')

@section('content')
<div class="container my-5 pt-5">
      <div class="py-5 mt-5 text-center">
        <h2 class="h2">@translate(Checkout form)</h2>
        <p class="lead">{{ orgName() }} @translate(needs your information to purchase any plan. Please fill-up the form and make payment.)</p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">@translate(Your cart)</span>
            <span class="badge badge-secondary badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{ Str::upper($subscription_plan->name) }}</h6>
                <small class="text-muted">{{ $subscription_plan->duration }} @translate(Month)</small> •
                <small class="text-muted">{{ $subscription_plan->emails }} @translate(Emails)</small> •
                <small class="text-muted">{{ $subscription_plan->sms }} @translate(SMS)</small> •
              </div>
              <span class="text-muted">{{ formatPrice($subscription_plan->price) }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>@translate(Total)</span>
              <strong>{{ formatPrice($subscription_plan->price) }}</strong>
            </li>
          </ul>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">@translate(Billing address)</h4>

            @if ($subscription_plan->name == 'free')
                    <form
                    class="needs-validation"
                    novalidate
                    action="{{ route('freePayment') }}"
                    method="POST">
            @endif

          <form
          class="needs-validation"
          novalidate
          action="{{ route('postPaymentWithpaypal') }}"
          method="POST">

          @csrf

        @if ($subscription_plan->name == 'free')

            <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
            <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
            <input type="hidden" name="amount" value="{{ onlyPrice($subscription_plan->price) }}">
            <input type="hidden" name="payment_type" value="free">

        @endif

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name <span class="badge badge-pill badge-secondary">required</span></label>
                <input type="text" onkeyup="userName()" class="form-control w-100" id="firstName" name="name" placeholder="Full Name"
                value="@auth {{ Auth::user()->name }} @endauth"
                required>
                <div class="invalid-feedback">
                  @translate(Valid first name is required.)
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email">Email <span class="badge badge-pill badge-secondary">required</span></label>
              <input type="email" onkeyup="userEmail()" class="form-control w-100 @error('email') is-invalid @enderror" name="email" id="email"
              value="@auth {{ Auth::user()->email }} @endauth"
              placeholder="you@example.com">

              @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              <div class="invalid-feedback">
                @translate(Please enter a valid email address.)
              </div>
              </div>
            </div>

            @guest

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="Password">Password <span class="badge badge-pill badge-secondary">required</span></label>
                <input type="password"  onkeyup="userPassword()" class="form-control w-100" name="password" id="Password" placeholder="Password" required>
                <div class="invalid-feedback">
                  @translate(Password is required.)
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="confirm_password">Confirm Password <span class="badge badge-pill badge-secondary">required</span></label>
              <input type="password" class="form-control w-100" id="confirm_password" placeholder="Confirm Password" required>
              <div class="invalid-feedback">
                @translate(Confirm password is required.)
              </div>
              </div>
            </div>

            @endguest




            <hr class="mb-4">

            <h4 class="mb-4">@translate(Payment Methods)</h4>


            <div class="row">

                @if ($subscription_plan->name != 'free')

                @if (enable_disable_payment_gateway('paypal'))

                {{-- PAYPAL --}}

                <div class="col-md-3 text-center">
                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
                    <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
                    <input type="hidden" name="amount" value="{{ PaypalPrice($subscription_plan->price) }}">
                    <input type="hidden" name="payment_type" value="paypal">
                    <button type="submit">
                        <img src="{{ asset('frontend/images/gateway/paypal.jpg') }}" class="img-fluid w-75" alt="#PayPal">
                    </button>
                </div>
                {{-- PAYPAL::END --}}

                @endif

                @if (enable_disable_payment_gateway('stripe'))
                {{-- stripe --}}
                <div class="col-md-3 text-center">
                  <button type="button" id="btn-stripe" onclick="btnStripe()">
                    <img src="{{ asset('frontend/images/gateway/stripe.png') }}"  class="img-fluid w-75" alt="#Stripe">
                  </button>
                </div>
                {{-- stripe::END --}}
                @endif

                @if (enable_disable_payment_gateway('khalti'))
                {{-- khalti --}}
                @if (maildoll_config('khalti'))
                <div class="col-md-3 text-center">

                  <button type="button" id="btn-khalti">
                    <img src="{{ asset('frontend/images/gateway/khalti.png') }}"  class="img-fluid w-75" alt="#khalti">
                  </button>

                </div>
                @endif
                {{-- khalti::END --}}
                @endif

                @if (enable_disable_payment_gateway('flutterwave'))
                {{-- flutterwave --}}
                @if (maildoll_config('flutterwave'))
                <div class="col-md-3 text-center">

                  <button type="button" id="btn-flutterwave" onclick="FlutterwaveBtn()" value="Buy">
                    <img src="{{ asset('frontend/images/gateway/flutterwave.png') }}"  class="img-fluid w-75" alt="#flutterwave.png">
                  </button>

                </div>
                @endif
                {{-- flutterwave::END --}}
                @endif

                @if (enable_disable_payment_gateway('instamojo'))
                {{-- instamojo --}}
                @if (maildoll_config('instamojo'))
                <div class="col-md-3 text-center">

                  <button type="button" id="btn-instamojo" onclick="InstamojoBtn()">
                    <img src="{{ asset('frontend/images/gateway/instamojo.png') }}"  class="img-fluid w-75" alt="#instamojo.png">
                  </button>

                </div>
                @endif
                {{-- instamojo::END --}}
                @endif

                @if (enable_disable_payment_gateway('paystack'))
                {{-- instamojo --}}
                @if (maildoll_config('paystack'))
                <div class="col-md-3 text-center">

                  <button type="button" id="btn-paystack" onclick="PaystackBtn()">
                    <img src="{{ asset('frontend/images/gateway/paystack.png') }}"  class="img-fluid w-75" alt="#paystack.png">
                  </button>

                </div>
                @endif
                {{-- instamojo::END --}}
                @endif

                @else

                {{-- FREE --}}
                <div class="col-md-3 text-center">
                    <img src="{{ asset('frontend/images/gateway/free.jpg') }}" class="img-fluid w-75" alt="#Free">
                </div>
                {{-- FREE::END --}}

                @endif

          </div>

            @guest
                @if ($subscription_plan->name == 'free')
                        <hr class="mb-4 mt-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">@translate(Continue to checkout)</button>
                @endif
            @endguest

            @auth
                 @if ($subscription_plan->name == 'free')
                    <hr class="mb-4 mt-4">

                    @if (freeDateLimitCheck($subscription_plan->name))
                        <a href="javascript:;" class="btn btn-primary btn-lg btn-block not-allowed">@translate(Plan is already running)</a>
                        @else
                        <button class="btn btn-primary btn-lg btn-block" type="submit">@translate(Continue to checkout)</button>
                    @endif

                @endif
            @endauth

          </form>
        </div>
      </div>

    </div>

    {{-- Stripe --}}

    <form class=""
    enctype="multipart/form-data"
    action="{{ route('getPaymentWithStripe') }}"
    method="GET"
    id="form-stripe">

      <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
      <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
      <input type="hidden" name="amount" value="{{ StripePrice($subscription_plan->price) }}">
      <input type="hidden" name="payment_type" value="stripe">

      <input type="hidden" id="stripe-name" name="name" required>
      <input type="hidden" id="stripe-email" name="email" required>
      <input type="hidden" id="stripe-password" name="password" required>

    </form>

    {{-- Stripe::end --}}

    {{-- Flutterwave --}}
    @if (maildoll_config('flutterwave'))
    <form class=""
    action="{{ route('rave.pay') }}"
    method="POST"
    id="form-flutterwave">
    @csrf
      <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
      <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
      <input type="hidden" name="amount" value="{{ noFormatPrice($subscription_plan->price) }}">
      <input type="hidden" name="payment_type" value="flutterwave">
      <input type="hidden" name="description" value="Purchasing {{ Str::upper($subscription_plan->name) }} plan from {{ orgName() }}">
      <input type="hidden" id="flutterwave-name" name="name" required>
      <input type="hidden" id="flutterwave-email" name="email" required>
      <input type="hidden" id="flutterwave-password" name="password" required>
    </form>
    @endif
    {{-- Flutterwave::END --}}

    {{-- Instamojo --}}
    @if (maildoll_config('instamojo'))
    <form class=""
    action="{{ route('instamojo.pay') }}"
    method="POST"
    id="form-instamojo">
    @csrf 
      <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
      <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
      <input type="hidden" name="amount" value="{{ noFormatPrice($subscription_plan->price) }}">
      <input type="hidden" name="payment_type" value="instamojo">
      <input type="hidden" name="description" value="Purchasing {{ Str::upper($subscription_plan->name) }} plan from {{ orgName() }}">
      <input type="hidden" id="instamojo-name" name="name" required>
      <input type="hidden" id="instamojo-email" name="email" required>
      <input type="hidden" id="instamojo-password" name="password" required>
    </form>
    @endif
    {{-- Instamojo::END --}}

    {{-- paystack --}}
    @if (maildoll_config('paystack'))
    <form method="POST" action="{{ route('paystack.pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="form-paystack">
      @csrf
        <div class="row" style="margin-bottom:40px;">
            <div class="col-md-8 col-md-offset-2">
                <input type="hidden" name="orderID" value="{{ rand(100, 1000) }}">
                <input type="hidden" name="amount" value="{{ noFormatPrice($subscription_plan->price) }}"> {{-- required in kobo --}}
                <input type="hidden" name="currency" value="{{ env('MERCHANT_CURRENCY') }}">
                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}   
                
                <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
                <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
                <input type="hidden" name="payment_type" value="paystack">
                <input type="hidden" id="paystack-name" name="name" required>
                <input type="hidden" id="paystack-email" name="email" required>
                <input type="hidden" id="paystack-password" name="password" required>
            </div>
        </div>
    </form>
    @endif
    {{-- paystack::END --}}

    {{-- Khalti --}}

    @if (maildoll_config('khalti'))
        
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <input type="hidden" id="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
    <input type="hidden" id="plan_name" value="{{ $subscription_plan->name }}">
    <input type="hidden" id="amount" value="{{ NPRPrice($subscription_plan->price) }}">
    <input type="hidden" id="app_url" value="{{ env('APP_URL') }}">

    @endif

    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

    <script>

      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();


    /**
     * STRIPE
     */

     function btnStripe()
     {
        var form = document.getElementById("form-stripe");
        form.submit();
     }

    /**
     * Flutterwave
     */

     function FlutterwaveBtn()
     {
        var form = document.getElementById("form-flutterwave");
        form.submit();
     }

    /**
     * Instamojo
     */

     function InstamojoBtn()
     {
        var form = document.getElementById("form-instamojo");
        form.submit();
     }

    /**
     * Paystack
     */

     function PaystackBtn()
     {
        var form = document.getElementById("form-paystack");
        form.submit();
     }


    /**
     * Khalti
     */

        var config = {
            // replace the publicKey with yours
            "publicKey": "{{ env('KHALTI_KEY') }}", // public key
            "productIdentity": "{{ $subscription_plan->name }}",
            "productName": "{{ $subscription_plan->name }}",
            "productUrl": "{{ env('APP_URL') }}",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    // console.log(payload);

                    var name = document.getElementById("firstName").value;
                    var email = document.getElementById("email").value;
                    var password = document.getElementById("Password").value;
                    var subscriptoin_plan_id = document.getElementById("subscriptoin_plan_id").value;
                    var plan_name = document.getElementById("plan_name").value;
                 
                    // ------------------------------
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                    type: 'GET',
                    url: '{{ route("getPaymentWithKhalti") }}',
                    data: {
                          amount: payload.amount,
                          idx: payload.idx,
                          mobile: payload.mobile,
                          product_identity: payload.product_identity,
                          product_name: payload.product_name,
                          product_url: payload.product_url,
                          token: payload.token,
                          name: name,
                          email: email,
                          password: password,
                          subscriptoin_plan_id: subscriptoin_plan_id,
                          plan_name: plan_name,
                      },
                      success: function(data) {
                        window.location.href = data.url;
                      }
                    });
                    // ------------------------------
                },
                onError (error) {
                    alert('Payment Failed');
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("btn-khalti");
        btn.onclick = function () {
            // check empty fields
            if (document.getElementById("firstName").value == "") {
                document.getElementById("firstName").classList.add("is-invalid");
                return false;
            }

            if (document.getElementById("email").value == "") {
                document.getElementById("email").classList.add("is-invalid");
                return false;
            }

            @guest

            if (document.getElementById("Password").value == "") {
                document.getElementById("Password").classList.add("is-invalid");
                return false;
            }

            if (document.getElementById("confirm_password").value == "") {
                document.getElementById("confirm_password").classList.add("is-invalid");
                return false;
            }

            @endguest
            
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            var amount = $('#amount').val();
            checkout.show({amount: amount * 100});
        }

        // Khalti::end

    // name
    function userName()
    {
       var name = document.getElementById("firstName").value;
       var stripeName = document.getElementById("stripe-name").value = name;
       var flutterwaveName = document.getElementById("flutterwave-name").value = name;
       var instamojoName = document.getElementById("instamojo-name").value = name;
       var paystackName = document.getElementById("paystack-name").value = name;
    }

    // email
    function userEmail()
    {
       var email = document.getElementById("email").value;
       var stripeEmail = document.getElementById("stripe-email").value = email;
       var flutterwaveEmail = document.getElementById("flutterwave-email").value = email;
       var instamojoEmail = document.getElementById("instamojo-email").value = email;
       var paystackEmail = document.getElementById("paystack-email").value = email;
     }

    // Password
    function userPassword()
    {
       var password = document.getElementById("Password").value;
       var stripePassword = document.getElementById("stripe-password").value = password;
       var flutterwavePassword = document.getElementById("flutterwave-password").value = password;
       var instamojoPassword = document.getElementById("instamojo-password").value = password;
       var paystackPassword = document.getElementById("paystack-password").value = password;
     }

    </script>

@endsection