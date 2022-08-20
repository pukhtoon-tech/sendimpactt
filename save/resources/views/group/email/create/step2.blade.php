@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Create Group)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create Group)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="wizard flex lg:flex-row justify-center px-5 sm:px-20">



            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">1</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">@translate(New Group)</div>
            </div>
        
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-white bg-theme-1">2</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Select Audiance)</div>
            </div>
          
            <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
           
            <input type="hidden" value="{{ $group_id }}" name="" id="group_id">
                
            {{-- Audiance --}}
                @include('group.components.emails')
            {{-- Audiance:END --}}
                   
        </div>
           
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

@endsection

@section('script')
   
@endsection