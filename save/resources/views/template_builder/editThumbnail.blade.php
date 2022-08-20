@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Create New Email Template)</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.css') }}">
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create New Email Template)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('template.page.originate.update', $template->id ) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Template Title) <small>required</small></label>
                        <input type="text" 
                        class="input w-full border mt-2" 
                        value="{{ $template->title }}" 
                        name="title" 
                        placeholder="Template Name" 
                        data-parsley-required>
                    </div>

                    <div class="mt-3">
                        <label>@translate(Template Preview Image) <small>@translate(optional)</small> </label>
                        <div class="mt-2">
                            <input name="preview" type="file" class="dropify" data-default-file="{{ asset($template->preview ?? notFound('no-preview.png')) }}" data-height="300" data-allowed-file-extensions="jpg png jpeg" />
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">@translate(UPDATE)</button>
                    </div>
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
   <script src="{{ filePath('assets/js/dropify.js') }}"></script>
   <script src="{{ filePath('bladejs/dropify.js') }}"></script>
@endsection