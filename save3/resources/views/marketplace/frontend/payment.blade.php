@extends('frontend.' . theme() .'.layouts.master')

@section('content')
<div class="container my-5 pt-5">
      <div class="py-5 mt-5 text-center">
        <h2 class="h2">@translate(Checkout form)</h2>
        <p class="lead">{{ orgName() }} @translate(needs your information. Please fill-up the form and make payment.)</p>
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
                <h6 class="my-0">{{ marketplace_country_code(Str::upper($country)) }}({{ $country }})</h6>
                <small class="text-muted">{{ $quantity }}</small>
              </div>
              <span class="text-muted">{{ $total }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>@translate(Total)</span>
              <strong>{{ $total }}</strong>
            </li>
          </ul>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">@translate(Billing address)</h4>

          <form
          class="needs-validation"
          novalidate
          action="{{ route('postPaymentWithpaypalMarketplace') }}"
          method="POST">

          @csrf


            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name <span class="badge badge-pill badge-secondary">required</span></label>
                <input type="text" onkeyup="userName()" class="form-control w-100" id="firstName" name="name" placeholder="Full Name"
                value=""
                required>
                <div class="invalid-feedback">
                  @translate(Valid first name is required.)
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email">Email <span class="badge badge-pill badge-secondary">required</span></label>
              <input type="email" onkeyup="userEmail()" class="form-control w-100 @error('email') is-invalid @enderror" name="email" id="email"
              value=""
              placeholder="you@example.com">

              @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              <div class="invalid-feedback">
                @translate(Please enter a valid email address.)
              </div>
              </div>
            </div>

            <hr class="mb-4">

            <h4 class="mb-4">@translate(Payment Methods)</h4>


            <div class="row">

                {{-- PAYPAL & STRIPE --}}

                <div class="col-md-3 text-center">

                    <input type="hidden" name="country" value="{{ $country }}">
                    <input type="hidden" name="email_amount" value="{{ $quantity }}">
                    <input type="hidden" name="price" value="{{ $total }}">
                    <input type="hidden" name="type" value="email">
                    <input type="hidden" name="gateway" value="paypal">

                    <button type="submit">
                        <img src="{{ asset('frontend/images/gateway/paypal.jpg') }}" class="img-fluid w-75" alt="#PayPal">
                    </button>

                </div>

                <div class="col-md-3 text-center">

                  <button type="button" id="btn-stripe" onclick="btnStripe()">
                    <img src="{{ asset('frontend/images/gateway/stripe.png') }}"  class="img-fluid w-75" alt="#Stripe">
                  </button>

                </div>

                <div class="col-md-3 text-center d-none">

                  <button type="button" id="btn-khalti">
                    <img src="{{ asset('frontend/images/gateway/khalti.png') }}"  class="img-fluid w-75" alt="#khalti">
                  </button>

                </div>

                {{-- PAYPAL & STRIPE::END --}}

          </div>

          </form>
        </div>
      </div>

    </div>


    {{-- Stripe --}}

    <form class=""
    enctype="multipart/form-data"
    action="{{ route('getPaymentWithStripe.marketplace') }}"
    method="GET"
    id="marketplace-form-stripe">

      <input type="hidden" name="country" value="{{ $country }}">
      <input type="hidden" name="email_amount" value="{{ $quantity }}">
      <input type="hidden" name="price" value="{{ $total }}">
      <input type="hidden" name="type" value="email">
      <input type="hidden" name="gateway" value="stripe">

      <input type="hidden" id="stripe-name" name="name" required>
      <input type="hidden" id="stripe-email" name="email" required>
      <input type="hidden" id="stripe-password" name="password" required>

    </form>

    {{-- Stripe::end --}}


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <input type="hidden" name="country" value="{{ $country }}">
    <input type="hidden" name="email_amount" value="{{ $quantity }}">
    <input type="hidden" name="price" value="{{ $total }}">
    <input type="hidden" name="type" value="email">
    <input type="hidden" id="app_url" value="{{ env('APP_URL') }}">

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
        var form = document.getElementById("marketplace-form-stripe");
        form.submit();
     }
    /**
     * Khalti
     */

    

        var config = {
            // replace the publicKey with yours
            "publicKey": "{{ env('KHALTI_KEY') }}", // public key
            "productIdentity": "{{ $country }}",
            "productName": "{{ $country }}",
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
                    console.log(payload);

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