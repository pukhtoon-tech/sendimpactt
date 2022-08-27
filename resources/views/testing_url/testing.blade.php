@extends('../layout/' .  layout())
<head>
        <link rel="stylesheet" href="{{ filePath('frontend/css/stag.css')}}">
    </head>
@section('subhead')
    <title>@translate(Testing)</title>
    
@endsection

@section('subcontent')
 <div class="new_tabs_start my-3">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">My Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Organization Setup</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Subscription</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-payment-tab" data-toggle="pill" data-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Payment Setup</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">

  @include('testing_url.components.my-profile-content')  

  @include('testing_url.components.organization-setup-content')

  @include('testing_url.components.subscription-content')

  @include('testing_url.components.payment-setup-content')

</div>
            
          
    </div>


    <input type="hidden" id="queueUrl" value="{{ route('queue.count') }}">
    <input type="hidden" id="totalMaillUrl" value="{{ route('total.mail.count') }}">
    <input type="hidden" id="totalCampaignlUrl" value="{{ route('total.campaign.count') }}">
    <input type="hidden" id="totalGrouplUrl" value="{{ route('total.group.count') }}">
    <input type="hidden" id="totalTemplatelUrl" value="{{ route('total.template.count') }}">
    <input type="hidden" id="totalReachUrl" value="{{ route('total.reach.count') }}">
    <input type="hidden" id="totalNotReachUrl" value="{{ route('total.notreach.count') }}">
    <input type="hidden" id="totalFailedUrl" value="{{ route('total.failed.count') }}">
    <input type="hidden" id="totalBouncedUrl" value="{{ route('total.bounced.count') }}">
    <input type="hidden" id="totalTaskUrl" value="{{ route('total.tasks.count') }}">
    <input type="hidden" id="totalSentMailkUrl" value="{{ route('total.sent.mail.count') }}">

@endsection

@section('script')
<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('assets/js/email_contacts.js') }}"></script>
<script src="{{ filePath('assets/js/parsley.js') }}"></script>
<script src="{{ filePath('assets/js/validation.js') }}"></script>
<script src="{{ filePath('assets/js/sweetalert2@10.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
@endsection