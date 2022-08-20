@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(SMS Body) - {{ $show_builder->name }}</title>
@endsection

@section('subcontent')

<div class="intro-y news p-5 box mt-8">

        <!-- BEGIN: Blog Layout -->
        <h2 class="intro-y font-medium text-xl sm:text-2xl">{{ Str::upper($show_builder->name) }}</h2>
        <div class="intro-y text-gray-700 dark:text-gray-600 mt-3 text-xs sm:text-sm">
            {{ $show_builder->created_at->diffForHumans() }}
        </div>
       
        <div class="intro-y text-justify leading-relaxed pt-16 sm:pt-6 pb-6">
            <p class="mb-5">{{ strip_tags($show_builder->body) }}</p>
        </div>
     
        <!-- END: Blog Layout -->
    
    </div>
  
@endsection

@section('script')
   
@endsection