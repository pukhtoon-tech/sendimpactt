@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Create Autoresponder)</title>
@endsection

@section('subcontent')
<div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create Autoresponder)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="wizard flex lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-white bg-theme-1">1</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">@translate(New Autoresponder)</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Setup Template)</div>
            </div>
          
            <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('autoresponder.builder') }}" method="GET">
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Autoresponder Name)</label>
                        <input type="text" 
                                class="input w-full border mt-2" 
                                name="name" 
                                placeholder="Autoresponder Name" 
                                data-parsley-required>
                    </div>

                    <div class="input-form mt-3"> 
                        <label class="flex flex-col sm:flex-row"> @translate(Choose Campaign Server To Get Emails)*</label> 
                        <select class="w-full form-select sm:w-1/2" name="campaign_id" required>
                            @forelse (allCampaigns('email') as $campaign)
                                <option value="{{ $campaign->id }}" 
                                        class="normal-case">
                                        {{ Str::camel($campaign->name) }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="mt-3">
                        <label>@translate(Active Status)</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" class="input input--switch border" name="status">
                        </div>
                    </div>


                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">@translate(Next)</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')

@endsection