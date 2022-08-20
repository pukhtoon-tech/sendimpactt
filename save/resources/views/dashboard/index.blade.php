@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Dashboard)</title>
@endsection

@section('subcontent')
 <div class="grid grid-cols-12 gap-6">

            

        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">

            @can('Admin')

                @if (
                env('TEST_CONNECTION_MAIL') == null 
                && env('TEST_CONNECTION_SMS') == null 
                && env('MAIL_USERNAME') == null 
                && env('MAIL_PASSWORD') == null 
                && env('STRIPE_KEY') == null 
                && env('STRIPE_SECRET') == null 
                && env('PAYPAL_CLIENT_ID') == null 
                && env('PAYPAL_SECRET') == null
                && templateCount() > 0 
                && smsTemplateCount() > 0
                )
                <!-- BEGIN: configure Alert -->
                @include('dashboard.components.configure')
                <!-- END: configure Alert -->
                @endif

                
                
            @endcan

            
            
            <!-- BEGIN: General Report -->
            @include('dashboard.components.general_report')
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->

            {{-- sent_mails_chart --}}
            @include('dashboard.components.sent_mails_chart')
            {{-- sent_mails_chart:END --}}
            
            {{-- sent_mails_chart --}}
            @include('dashboard.components.sent_sms_chart')
            {{-- sent_mails_chart:END --}}

            @include('components.tracker-statistics')

            @include('dashboard.components.plan_limit_chart')
            <!-- END: Sales Report -->
           
            <!-- BEGIN: purchase_history -->
            @include('dashboard.components.purchase_history')
            <!-- END: purchase_history -->

            <!-- BEGIN: purchase_chart -->
            @include('dashboard.components.purchase_chart')
            <!-- END: purchase_chart -->
            @can('Admin')
            <!-- BEGIN: earning -->
            @include('dashboard.components.earning')
            <!-- END: earning -->
            <!-- BEGIN: Weekly Top Products -->
            @include('dashboard.components.weekly_top_senders')
            <!-- END: Weekly Top Products -->
            @endcan
        </div>
        <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">

                <!-- BEGIN: Last Sent Mail -->
                @include('dashboard.components.last_sent_mail')
                <!-- END: Last Sent Mail -->

                <!-- BEGIN: Last Sent SMS -->
                @include('dashboard.components.last_sent_sms')
               <!-- END: Last Sent SMS -->
               
               <!-- BEGIN: Important Notes -->
               @if (count(notes()) > 0)
                   @include('dashboard.components.notes')
                @endif
                   <!-- END: Important Notes -->
                <!-- BEGIN: campaign_log -->
                    @include('dashboard.components.campaign_log')
                <!-- END: campaign_log -->
            </div>
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
<script src="{{ filePath('assets/js/dashboard.js') }}"></script>
@endsection