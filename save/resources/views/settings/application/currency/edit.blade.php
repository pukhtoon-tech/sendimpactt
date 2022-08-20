@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Currency Update)</title>
@endsection

@section('subcontent')

        <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">@translate(Currency Update)</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('settings.application.currency.components.currency_sidemenu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Currency Update)</h2>
                </div>
                <div class="p-5">
                      <!-- BEGIN: Form Layout -->

                                        <form class="" 
                                            enctype="multipart/form-data"
                                            action="{{ route('currencies.update', $currency->id) }}"
                                            method="POST">
                                            @csrf

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Currency Name) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: United State</span>
                                                    </label> <input type="text" name="name" value="{{ $currency->name }}" class="input w-full border mt-2" placeholder="Currency Name" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Currency Symbol) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: $</span>
                                                    </label> <input type="text" name="symbol" value="{{ $currency->symbol }}" class="input w-full border mt-2" placeholder="Currency Symbol" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Currency Code) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: USD</span>
                                                    </label> <input type="text" name="code" value="{{ $currency->code }}" class="input w-full border mt-2" placeholder="Currency Code" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Exchange Rate) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Exchange Rate Ex: 1 USD = ? </span>
                                                    </label> <input type="number" name="rate" min="1" step="0.01" value="{{ $currency->rate }}" class="input w-full border mt-2" placeholder="Exchange Rate" data-parsley-required>
                                                </div>
                                            </div>

                                            <button type="submit" class="button bg-theme-1 text-white mt-5">@translate(Update Currency)</button>

                                        </form>
                                        <!-- END: Form Layout -->
                </div>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>
    
@endsection


@section('script')

@endsection