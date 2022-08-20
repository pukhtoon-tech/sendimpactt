@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Note) - {{ $note->title }}</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">{{ $note->title }}</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5 h-screen p-6">
            <!-- BEGIN: Form Layout -->
            <p class="text-center">{{ strip_tags($note->note) }}</p>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

@endsection

@section('script')
   
@endsection