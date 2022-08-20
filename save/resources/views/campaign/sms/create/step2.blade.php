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
                <button class="w-10 h-10 rounded-full button text-white bg-theme-1">2</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Setup SMS Template)</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">3</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Select Audiance)</div>
            </div>
          
            <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('campaign.store.store2') }}" method="POST">
                @csrf

                <input type="hidden" value="{{ $step1->owner_id }}" name="owner_id">
                <input type="hidden" value="{{ $step1->name }}" name="name">
                <input type="hidden" value="{{ $step1->description }}" name="description">
                <input type="hidden" value="{{ $step1->status }}" name="status">
                <input type="hidden" value="type" name="sms">



                    <div class="grid grid-cols-12 gap-6 mt-5">
                        @foreach ($sms_templates as $sms_template)
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="box">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">
                                       


                                        <div class="section over-hide z-bigger">
                                            <div class="section over-hide z-bigger">
                                                    <div class="container pb-5">
                                                        <div class="row justify-content-center pb-5">
                                                            <div class="col-12 pb-5">
                                                                <input class="checkbox-tools" data-parsley-required type="radio" value="{{ $sms_template->id }}" name="sms_template_id" id="tool-{{ $sms_template->id }}">
                                                                <label class="for-checkbox-tools w-full" for="tool-{{ $sms_template->id }}">
                                                                    <div class="">
                                                                        <div class="h-80 xxl:h-56 image-fit">
                                                                            <div class="rounded-md w-1/2 m-auto preview-template ">
                                                                                <span class="text-lg font-medium leading-none">
                                                                                    {{  $sms_template->name }}
                                                                                </span>
                                                                                <hr>
                                                                                {{ strip_tags($sms_template->body) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">@translate(Next)</button>
                    </div>
              



            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection