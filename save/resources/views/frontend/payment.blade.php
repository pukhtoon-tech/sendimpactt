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

            <h4 class="mb-4">@translate(Payment)</h4>


            <div class="row">

                @if ($subscription_plan->name != 'free')

                {{-- PAYPAL & STRIPE --}}

                <div class="col-md-3 text-center">

                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscription_plan->id }}">
                    <input type="hidden" name="plan_name" value="{{ $subscription_plan->name }}">
                    <input type="hidden" name="amount" value="{{ PaypalPrice($subscription_plan->price) }}">
                    <input type="hidden" name="payment_type" value="paypal">

                    <button type="submit">
                        <img src="{{ asset('frontend/images/gateway/paypal.jpg') }}" class="img-fluid w-50" alt="#PayPal">
                    </button>

                </div>

                <div class="col-md-3 text-center">



                  <button type="button" id="btn-stripe" onclick="btnStripe()">
                    <img src="{{ asset('frontend/images/gateway/stripe.png') }}"  class="img-fluid w-50" alt="#Stripe">
                  </button>

                </div>

                {{-- PAYPAL & STRIPE::END --}}

                @else

                {{-- FREE --}}
                <div class="col-md-3 text-center">
                    <img src="{{ asset('frontend/images/gateway/free.jpg') }}" class="img-fluid w-50" alt="#Free">
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

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


    // name
    function userName()
    {
       var name = document.getElementById("firstName").value;
       var stripeName = document.getElementById("stripe-name").value = name;

     }

    // email
    function userEmail()
    {
       var email = document.getElementById("email").value;
       var stripeEmail = document.getElementById("stripe-email").value = email;

     }

    // Password
    function userPassword()
    {
       var password = document.getElementById("Password").value;
       var stripePassword = document.getElementById("stripe-password").value = password;

     }


    </script>


@endsection