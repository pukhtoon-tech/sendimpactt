@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Subscription Plans)</title>
@endsection

@section('subcontent')


    


<div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-12">

    @can('Admin')

    <a href="javascript:;"
        data-toggle="modal"
        data-target="#superlarge-subscription-modal-size-preview"
        class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip"
        title="@translate(Add New Group)">
        @translate(Add New Subscription Plan & Limit)
    </a>

    @endcan

</div>



<h2 class="intro-y text-2xl font-medium mt-10 text-center mr-auto">@translate(Subscription Plans & Limits)</h2>
    <!-- BEGIN: Pricing Tab -->
    <div class="intro-y flex justify-center mt-6">
        <div class="pricing-tabs nav-tabs box rounded-full overflow-hidden flex">
            <a data-toggle="tab" data-target="#layout-1-free-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center active tooltip" title="@translate(Free)">@translate(Free)</a>
            <a data-toggle="tab" data-target="#layout-1-monthly-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center tooltip" title="@translate(Monthly Fees)">@translate(Monthly Fees)</a>
            <a data-toggle="tab" data-target="#layout-1-annual-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center tooltip" title="@translate(Yearly Fees)">@translate(Yearly Fees)</a>
        </div>
    </div>
    <!-- END: Pricing Tab -->
    <!-- BEGIN: Pricing Content -->
    <div class="flex mt-10">
        <div class="tab-content">

            <div class="tab-content__pane flex flex-col lg:flex-row active" id="layout-1-free-fees">

                <div class="inline-flex space-x-4">

                    @foreach (subscriptions('free') as $free)

                        <div class="flex-1">
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <i data-feather="briefcase" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                                <div class="text-xl font-medium text-center mt-10">{{ Str::upper($free->name) }}</div>
                                @can('Admin')
                                <div class="text-xl text-center">
                                    <small class="{{ $free->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">{{ $free->status == 1 ? 'Active' : 'Inactive' }}</small>
                                </div>
                                @endcan
                                <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                                    {{ $free->duration }} @translate(Month) <span class="mx-1">•</span> {{ $free->emails }} @translate(Emails)<span class="mx-1">•</span> {{ $free->sms }} @translate(SMS)
                                </div>
                                <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">{{ strip_tags($free->description) }}</div>
                                <div class="flex justify-center">
                                    <div class="relative text-5xl font-semibold mt-8 mx-auto">
                                        {{ formatPrice($free->price) }}
                                    </div>
                                </div>

                                @auth

                                <form class=""
                                    enctype="multipart/form-data"
                                    action="{{ route('freePayment') }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $free->id }}">
                                    <input type="hidden" name="plan_name" value="{{ $free->name }}">
                                    <input type="hidden" name="amount" value="{{ $free->price }}">
                                    <input type="hidden" name="payment_type" value="free">


                                    @if (freeDateLimitCheck($free->name))
                                        <a href="javasscript:;"
                                        class="button button--lg block w-2/4 text-white bg-theme-1 rounded-full mx-auto mt-8 tooltip cursor-not-allowed"
                                        title="@translate(Plan is already running)">@translate(Plan is already running)</a>
                                    @else
                                        @can('Customer')
                                        
                                        <button type="submit"
                                        class="button button--lg block w-2/4 text-white bg-theme-1 rounded-full mx-auto mt-8 tooltip"
                                        title="@translate(Checkout Now)">@translate(Checkout Now)</button>
                                        
                                        @endcan

                                    @endif

                                </form>

                                @endauth

                                @guest

                                <a href="javascript:;"
                                   data-toggle="modal"
                                   data-target="#superlarge-subscription-modal-size-preview{{ $free->id }}"
                                   class="button button--lg w-2/4 block text-white bg-theme-1 rounded-full mx-auto mt-8 tooltip"
                                   title="Pay with PayPal">
                                    @translate(Purchase With PayPal)
                                </a>


                                @endguest

                                @can('Admin')

                                <a href="{{ route('subscription.edit', $free->id) }}"
                                   class="button button--lg block text-white bg-theme-7 w-2/4 rounded-full mx-auto mt-8 tooltip"
                                   title="@translate(Edit Plan)">
                                    @translate(Edit Plan)
                                </a>

                                <a href="{{ route('subscription.delete', $free->id) }}"
                                   class="button button--lg block text-white bg-theme-6 w-2/4 rounded-full mx-auto mt-8 tooltip"
                                   title="@translate(Delete Plan)">
                                    @translate(Delete Plan)
                                </a>

                                @endcan


                            </div>
                        </div>


                        {{-- modal --}}


                        <div class="modal" id="superlarge-subscription-modal-size-preview{{ $free->id }}">
                            <div class="modal__content modal__content--xl p-10">
                                <div class="intro-y flex items-center mt-8">
                                    <h2 class="text-lg font-medium mr-auto">@translate(Purchasing) {{ Str::upper($free->name) }} @translate(Plan)</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-12 mt-5">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                        <!-- BEGIN: Form Layout -->

                                        <form class=""
                                            enctype="multipart/form-data"
                                            action="{{ route('postPaymentWithpaypal') }}"
                                            method="POST">
                                            
                                            @csrf

                                            <input type="hidden" name="subscriptoin_plan_id" value="{{ $free->id }}">
                                            <input type="hidden" name="plan_name" value="{{ $free->name }}">
                                            <input type="hidden" name="amount" value="{{ PaypalPrice($free->price) }}">
                                            <input type="hidden" name="payment_type" value="paypal">

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Full Name) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: John Doe</span>
                                                    </label> <input type="text" name="name" class="input w-full border mt-2" placeholder="Full Name">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Email Address) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: johndoe$mail.com</span>
                                                    </label> <input type="email" name="email" class="input w-full border mt-2" placeholder="Email Address">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Password) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 12345678</span>
                                                    </label> <input type="password" name="password" class="input w-full border mt-2" placeholder="Password">
                                                </div>
                                            </div>

                                                <button type="submit"
                                                    class="button bg-theme-1 text-white mt-5">@translate(Checkout)</button>
                                        </form>
                                        <!-- END: Form Layout -->

                                    </div>
                                </div>
                                </div>
                        </div>


                        {{-- modal::END --}}

                    @endforeach




                </div>

            </div>

            <div class="tab-content__pane flex flex-col lg:flex-row" id="layout-1-monthly-fees">


                <div class="inline-flex space-x-4">


                    @foreach (subscriptions('monthly') as $monthly)

                        <div class="flex-1">
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <i data-feather="briefcase" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                                <div class="text-xl font-medium text-center mt-10">{{ Str::upper($monthly->name) }}</div>
                                @can('Admin')
                                <div class="text-xl text-center">
                                    <small class="{{ $monthly->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">{{ $monthly->status == 1 ? 'Active' : 'Inactive' }}</small>
                                </div>
                                @endcan
                                <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                                    {{ $monthly->duration }} @translate(Month) <span class="mx-1">•</span> {{ $monthly->emails }} @translate(Emails)<span class="mx-1">•</span> {{ $monthly->sms }} @translate(SMS)
                                </div>
                                <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">{{ strip_tags($monthly->description) }}</div>
                                <div class="flex justify-center">
                                    <div class="relative text-5xl font-semibold mt-8 mx-auto">
                                        {{ formatPrice($monthly->price) }}
                                    </div>
                                </div>

                                @auth

                                <form class=""
                                    enctype="multipart/form-data"
                                    action="{{ route('postPaymentWithpaypal') }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $monthly->id }}">
                                    <input type="hidden" name="plan_name" value="{{ $monthly->name }}">
                                    <input type="hidden" name="amount" value="{{ PaypalPrice($monthly->price) }}">
                                    <input type="hidden" name="payment_type" value="paypal">

                                    <button type="submit" class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8 tooltip" title="{{ checkSubscription($monthly->id) }}">
                                        {{ checkSubscription($monthly->id) }}
                                    </button>
                                    
                                </form>

                                <form class=""
                                    enctype="multipart/form-data"
                                    action="{{ route('getPaymentWithStripe') }}"
                                    method="GET">

                                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $monthly->id }}">
                                    <input type="hidden" name="plan_name" value="{{ $monthly->name }}">
                                    <input type="hidden" name="amount" value="{{ $monthly->price }}">
                                    <input type="hidden" name="payment_type" value="stripe">

                                    <button type="submit" class="button button--lg w-2/4 block text-white bg-theme-6 rounded-full mx-auto mt-8 tooltip" title="Pay with stripe">
                                        Stripe
                                    </button>
                                    
                                </form>

                                @endauth

                                @guest

                                <a href="javascript:;"
                                   data-toggle="modal"
                                   data-target="#superlarge-subscription-modal-size-preview{{ $monthly->id }}"
                                   class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8 tooltip w-2/4"
                                   title="Pay with PayPal">
                                    @translate(Purchase With PayPal)
                                </a>

                                @endguest

                                @can('Admin')

                                <a href="{{ route('subscription.edit', $monthly->id) }}"
                                   class="button button--lg block text-white bg-theme-7 rounded-full w-2/4 mx-auto mt-8 tooltip"
                                   title="@translate(Edit Plan)">
                                    @translate(Edit Plan)
                                </a>

                                <a href="{{ route('subscription.delete', $monthly->id) }}"
                                   class="button button--lg block text-white bg-theme-6 w-2/4 rounded-full mx-auto mt-8 tooltip"
                                   title="@translate(Delete Plan)">
                                    @translate(Delete Plan)
                                </a>

                                @endcan


                            </div>
                        </div>


                        {{-- modal --}}


                        <div class="modal" id="superlarge-subscription-modal-size-preview{{ $monthly->id }}">
                            <div class="modal__content modal__content--xl p-10">
                                <div class="intro-y flex items-center mt-8">
                                    <h2 class="text-lg font-medium mr-auto">@translate(Purchasing) {{ Str::upper($monthly->name) }} @translate(Plan)</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-12 mt-5">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                        <!-- BEGIN: Form Layout -->

                                        <form class=""
                                            enctype="multipart/form-data"
                                            action="{{ route('postPaymentWithpaypal') }}"
                                            method="POST">
                                            @csrf

                                            <input type="hidden" name="subscriptoin_plan_id" value="{{ $monthly->id }}">
                                            <input type="hidden" name="plan_name" value="{{ $monthly->name }}">
                                            <input type="hidden" name="amount" value="{{ $monthly->price }}">
                                            <input type="hidden" name="payment_type" value="paypal">

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Full Name) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: John Doe</span>
                                                    </label> <input type="text" name="name" class="input w-full border mt-2" placeholder="Full Name">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Email Address) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: johndoe$mail.com</span>
                                                    </label> <input type="email" name="email" class="input w-full border mt-2" placeholder="Email Address">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Password) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 12345678</span>
                                                    </label> <input type="password" name="password" class="input w-full border mt-2" placeholder="Password">
                                                </div>
                                            </div>

                                                <button type="submit"
                                                    class="button bg-theme-1 text-white mt-5">@translate(Checkout)</button>
                                        </form>
                                        <!-- END: Form Layout -->

                                    </div>
                                </div>
                                </div>
                        </div>


                        {{-- modal::END --}}

                    @endforeach

                </div>



            </div>

            <div class="tab-content__pane flex flex-col lg:flex-row" id="layout-1-annual-fees">

                <div class="inline-flex space-x-4">


                    @foreach (subscriptions('yearly') as $yearly)

                        <div class="flex-1">
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <i data-feather="briefcase" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                                <div class="text-xl font-medium text-center mt-10">{{ Str::upper($yearly->name) }}</div>
                                @can('Admin')
                                <div class="text-xl text-center">
                                    <small class="{{ $yearly->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">{{ $yearly->status == 1 ? 'Active' : 'Inactive' }}</small>
                                </div>
                                @endcan
                                <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                                    {{ $yearly->duration }} @translate(Month) <span class="mx-1">•</span> {{ $yearly->emails }} @translate(Emails)<span class="mx-1">•</span> {{ $yearly->sms }} @translate(SMS)
                                </div>
                                <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">{{ strip_tags($yearly->description) }}</div>
                                <div class="flex justify-center">
                                    <div class="relative text-5xl font-semibold mt-8 mx-auto">
                                        {{ formatPrice($yearly->price) }}
                                    </div>
                                </div>


                                @auth

                                <form class=""
                                    enctype="multipart/form-data"
                                    action="{{ route('postPaymentWithpaypal') }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $yearly->id }}">
                                    <input type="hidden" name="plan_name" value="{{ $yearly->name }}">
                                    <input type="hidden" name="amount" value="{{ $yearly->price }}">
                                    <input type="hidden" name="payment_type" value="paypal">

                                    <button type="submit" class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8 tooltip" title="{{ checkSubscription($yearly->id) }}">{{ checkSubscription($yearly->id) }}</button>
                                </form>


                                <form class=""
                                    enctype="multipart/form-data"
                                    action="{{ route('getPaymentWithStripe') }}"
                                    method="GET">

                                    <input type="hidden" name="subscriptoin_plan_id" value="{{ $yearly->id }}">
                                    <input type="hidden" name="plan_name" value="{{ $yearly->name }}">
                                    <input type="hidden" name="amount" value="{{ $yearly->price }}">
                                    <input type="hidden" name="payment_type" value="stripe">

                                    <button type="submit" class="button button--lg block text-white bg-theme-6 rounded-full mx-auto mt-8 tooltip w-2/4" title="Pay With Stripe">
                                        Stripe
                                    </button>
                                    
                                </form>

                                @endauth

                                @guest

                                <a href="javascript:;"
                                   data-toggle="modal"
                                   data-target="#superlarge-subscription-modal-size-preview{{ $yearly->id }}"
                                   class="button button--lg block text-white bg-theme-1 rounded-full w-2/4 mx-auto mt-8 tooltip"
                                   title="Pay with PayPal">
                                    @translate(Purchase With PayPal)
                                </a>

                                @endguest

                                @can('Admin')

                                <a href="{{ route('subscription.edit', $yearly->id) }}"
                                   class="button button--lg block text-white bg-theme-7 rounded-full mx-auto mt-8 tooltip w-2/4"
                                   title="@translate(Edit Plan)">
                                    @translate(Edit Plan)
                                </a>

                                <a href="{{ route('subscription.delete', $yearly->id) }}"
                                   class="button button--lg block text-white bg-theme-6 rounded-full mx-auto mt-8 tooltip w-2/4"
                                   title="@translate(Delete Plan)">
                                    @translate(Delete Plan)
                                </a>

                                @endcan


                            </div>
                        </div>



                        {{-- modal --}}


                        <div class="modal" id="superlarge-subscription-modal-size-preview{{ $yearly->id }}">
                            <div class="modal__content modal__content--xl p-10">
                                <div class="intro-y flex items-center mt-8">
                                    <h2 class="text-lg font-medium mr-auto">@translate(Purchasing) {{ Str::upper($yearly->name) }} @translate(Plan)</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-12 mt-5">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                        <!-- BEGIN: Form Layout -->

                                        <form class=""
                                            enctype="multipart/form-data"
                                            action="{{ route('postPaymentWithpaypal') }}"
                                            method="POST">
                                            @csrf

                                            <input type="hidden" name="subscriptoin_plan_id" value="{{ $yearly->id }}">
                                            <input type="hidden" name="plan_name" value="{{ $yearly->name }}">
                                            <input type="hidden" name="amount" value="{{ $yearly->price }}">
                                            <input type="hidden" name="payment_type" value="paypal">

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Full Name) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: John Doe</span>
                                                    </label> <input type="text" name="name" class="input w-full border mt-2" placeholder="Full Name">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Email Address) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: johndoe$mail.com</span>
                                                    </label> <input type="email" name="email" class="input w-full border mt-2" placeholder="Email Address">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Password) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 12345678</span>
                                                    </label> <input type="password" name="password" class="input w-full border mt-2" placeholder="Password">
                                                </div>
                                            </div>

                                                <button type="submit"
                                                    class="button bg-theme-1 text-white mt-5">@translate(Checkout)</button>
                                        </form>
                                        <!-- END: Form Layout -->

                                    </div>
                                </div>
                                </div>
                        </div>


                        {{-- modal::END --}}

                    @endforeach

                </div>

            </div>

        </div>
    </div>
    <!-- END: Pricing Content -->

    @include('subscription.modal.create')


@endsection

@section('script')

@endsection
