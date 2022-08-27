<div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">

<div class="intro-y box py-3 mt-5">

        
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                        <a href="{{ route('payment.setup.paypal') }}" id="">
                                <div class="flex items-start px-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                        <button class="button w-full bg-theme-1 text-white">
                                               Paypal
                                        </button>
                                    </div>
                                </div>
                        </a>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                        <a href="{{ route('payment.setup.stripe') }}" id="">
                        
                                <div class="flex items-start px-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                        <button class="button w-full bg-theme-1 text-white">
                                            Stripe
                                        </button>
                                    </div>
                                </div>

                        </a>
                    </div>
                    
                </div>
                
       
    </div>

</div>