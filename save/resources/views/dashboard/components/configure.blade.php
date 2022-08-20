<div class="col-span-12 grid grid-cols-12 gap-6 mt-8 rounded">
        <div class="col-span-12 sm:col-span-12 xxl:col-span-12 intro-y mt-6 mb-6">

            @if (env('TEST_CONNECTION_MAIL') == null)

            <a href="{{ route('org.index') }}">

                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>
                    Test connection email is not configured.
            </div>

            </a>
            
                
            @endif

            @if (env('TEST_CONNECTION_SMS') == null)

            <a href="{{ route('org.index') }}">

            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                     Test connection phone number is not configured.
            </div>

            </a>
                
            @endif

            
            @if (env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
            <a href="{{ route('smtp.index') }}">

            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                     SMTP Servers area not configured
            </div>

            </a>
                
            @endif

            @if (env('STRIPE_KEY') == null && env('STRIPE_SECRET') == null)

            <a href="{{ route('payment.setup.stripe') }}">

                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                    <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                        Stripe payment gateway is not configured.
                </div>
          
                
            @endif

            @if (env('PAYPAL_CLIENT_ID') == null && env('PAYPAL_SECRET') == null)

            <a href="{{ route('payment.setup.paypal') }}">

            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                     PayPal payment gateway is not configured.
            </div>
            </a>
                
            @endif

            @if (templateCount() <= 0)

            <a href="{{ route('templates.index') }}">

            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                     No email template found. Create at least one email template.
            </div>

            </a>
                
            @endif

            @if (smsTemplateCount() <= 0)

            <a href="{{ route('builder.sms.templates') }}">

            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11 border-warning"> 
                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                     No SMS template found. Create at least one sms template.
            </div>

            </a>
                
            @endif

        </div>
</div>