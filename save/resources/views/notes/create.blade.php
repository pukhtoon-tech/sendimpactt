@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Create New Note)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create New Note)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Note Title)</label>
                        <input type="text" class="input w-full border mt-2" name="title" placeholder="Note Title" data-parsley-required>
                    </div>

                    
                    <div class="mt-3">
                        <label>@translate(Note Body)</label>
                        <div class="mt-2">
                            <textarea data-simple-toolbar="true" class="editor" name="note" data-parsley-required></textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" class="input input--switch border" name="status">
                        </div>
                    </div>


                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">@translate(Save)</button>
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
@endsection