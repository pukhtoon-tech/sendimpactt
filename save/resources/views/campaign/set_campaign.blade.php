@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Select Campaign Type)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Select Campaign Type)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">

        {{-- EMAILS OR GROUPS --}}
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                        <a href="{{ route('campaign.create.type', 'email') }}" id="">
                            <div class="box shadow">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                        <div class="mb-4">
                                            <img alt="#EMAILS" class="rounded-md" src="{{ notFound('email-group.png') }}">
                                        </div>
                                        <div class="lg:ml-4 mt-4 text-center font-medium lg:text-left mt-3 mb-3 lg:mt-0">
                                                @translate(CREATE EMAIL CAMPAIGN)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                        <a href="{{ route('campaign.create.type', 'sms') }}" id="">
                        
                            <div class="box shadow">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                        <div class="mb-4">
                                            <img alt="#GROUPS" class="rounded-md" src="{{ notFound('sms-group.png') }}">
                                        </div>
                                        <div class="lg:ml-4 mt-4 text-center font-medium lg:text-left mt-3 mb-3 lg:mt-0">
                                                @translate(CREATE SMS CAMPAIGN)
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                    
                </div>
                {{-- EMAILS OR GROUPS::END --}}
       
    </div>
    <!-- END: Wizard Layout -->

@endsection

@section('script')

@endsection