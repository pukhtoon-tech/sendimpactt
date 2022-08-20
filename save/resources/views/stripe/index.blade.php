<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ orgName() }} - Stripe Payment</title>
    <link href="{{ favIcon() }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ asset('assets/stripe/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stripe/style.css') }}">
</head>

<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-11 col-xl-10">
            <div class="card card0">
                <div class="row">
                    <div class="col-md-6 d-block p-0 box">
                        <div class="card rounded-0 border-0 card1 pr-xl-4 pr-lg-3">
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <h3 class="text-center mt-4 mb-4 package-title text-uppercase font-weight-bold" id="heading0">@translate(Purchasing From)</h3>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-5 fit-image text-center"> <img src="{{ logo() }}" height="auto" width="200px"> </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <h2 class="text-center mt-5 mb-3 package-title text-uppercase" id="sub-heading1">@translate(Purchasing)
                                        <br> <span class="text-clr">{{ Str::upper(subscriptionName($subscriptoin_plan_id)) }} </span>@translate(Plan)</h2>
                                </div>
                            </div>

                                <div class="container">
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="stripe-card">
                                                        <label class="mb-1 gift stripe-card__sub-title text-muted"><small>@translate(To)</small></label>
                                                        <h6 class="stripe-card__title text-capitalize">
                                                            {{ orgName() }}
                                                        </h6>
                                                        <div class="row mt-3">
                                                            <div class="col-12"> <label class="gift text-muted mb-1">
                                                                <small >@translate(Recipient email)</small>
                                                            </label>
                                                            <br>
                                                                <h6 class="stripe-card__title">

                                                             
                                                                        {{ org('company_email') }}

                                                                    </h6>

                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="stripe-card">
                                                        <label class="mb-1 gift stripe-card__sub-title text-muted"><small>@translate(From)</small></label>
                                                        <h6 class="stripe-card__title text-capitalize">
                                                            @if (Auth::check())
                                                        {{ Auth::user()->name }}
                                                            @else
                                                            {{ $name }}
                                                        @endif
                                                        </h6>
                                                        <div class="row mt-3">
                                                            <div class="col-12"> <label class="gift text-muted mb-1"><small >@translate(Recipient email)</small></label><br>
                                                                <h6 class="stripe-card__title">

                                                                    @if (Auth::check())
                                                                        {{ Auth::user()->email }}
                                                                    @else
                                                                        {{ $email }}
                                                                    @endif

                                                                    </h6>

                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 p-0 box">
                        <div class="card rounded-0 border-0 card2">

                            <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                        @csrf

                                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $subscriptoin_plan_id}}">
                                    <input type="hidden" name="plan_name" value="{{ $plan_name }}">
                                    <input type="hidden" name="amount" value="{{ StripePrice($amount) }}">
                                    <input type="hidden" name="payment_type" value="stripe">
                                    <input type="hidden" name="name" value="{{ $name }}">
                                    <input type="hidden" name="email" value="{{ $email }}">


                            <div class="form-card">
                                <h2 id="heading" class="text-center package-title text-uppercase font-weight-bold">@translate(Payment Information)</h2>

                                    <div class='text-center' data-value="credit"><img src="{{ asset('assets/stripe/stripe.png') }}" width="200px" height="auto"></div>

                                     <div class="row form-group">
                                    <div class="col-9 col-md-7">
                                        <input type="text" name="name" id="" placeholder="CARDHOLDER NAME" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" autocomplete='off' class="card-num" name="cardno" id="cr_no" placeholder="0000 0000 0000 0000" minlength="19" maxlength="19">
                                     </div>
                                </div>


                                <div class="row form-group mb-10">
                                    <div class="col-4 col-md-4"> <input type="text" name="expm" class="card-expiry-month" placeholder="MM" minlength="1" maxlength="2"> </div>
                                    <div class="col-4 col-md-4"> <input type="text" name="expy" class="card-expiry-year" placeholder="YY" minlength="2" maxlength="4"> </div>
                                    <div class="col-4 col-md-4"> <input type="password" name="cvcpwd" placeholder="&#9679;&#9679;&#9679;" class="placeicon card-cvc" autocomplete='off' minlength="3" maxlength="3"> </div>
                                </div>

                                <div class="">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                             <button type="submit" class="btn btn-success" type="submit">@translate(Pay Now) ({{ formatPrice($amount) }})</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('assets/stripe/jquery.js') }}"></script>
<script src="{{ asset('assets/stripe/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/stripe/script.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
$(function() {
    "use strict"
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }

  });

  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>


</html>

