@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Create Campaign)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create Campaign)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="wizard flex lg:flex-row justify-center px-5 sm:px-20">

            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">1</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">@translate(New Campaign)</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Setup Email Template)</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-white bg-theme-1">3</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Select Audiance)</div>
            </div>
           
            <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
           
                <input type="hidden" value="{{ $campaign_id }}" name="" id="campaign_id">

                {{-- EMAILS OR GROUPS --}}
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                        <a href="#emailsSection" onclick="emailsList()" id="">
                            <div class="box shadow">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                        <div class="">
                                            <img alt="#EMAILS" class="rounded-md" src="{{ notFound('emails.png') }}">
                                        </div>
                                        <div class="lg:ml-4 text-center font-medium lg:text-left mt-3 mb-3 lg:mt-0">
                                                @translate(CLICK TO GET EMAIL LIST)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                        <a href="#groupsSection" onclick="emailsList()" id="">
                        
                            <div class="box shadow">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                        <div class="">
                                            <img alt="#GROUPS" class="rounded-md" src="{{ notFound('group.png') }}">
                                        </div>
                                        <div class="lg:ml-4 text-center font-medium lg:text-left mt-3 mb-3 lg:mt-0">
                                                @translate(CLICK TO GET GROUPS)
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                    
                </div>
                {{-- EMAILS OR GROUPS::END --}}
                    {{-- emails --}}
                    <div id="emails_list" class="hidden">
                        @include('campaign.components.emails')
                    </div>
                    {{-- emails:END --}}
                </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
    <script src="{{ filePath('bladejs/campaigns/email/step3.js') }}"></script>
@endsection