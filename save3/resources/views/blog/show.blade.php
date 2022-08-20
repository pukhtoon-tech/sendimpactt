@extends('../layout/' . layout())

@section('subhead')
    <title>{{ $blog->title }}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.css') }}">
   
@endsection

@section('subcontent')
<div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Edit) - {{ $blog->title }}</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('dashboard.blog.update', [$blog->id, Str::slug($blog->title)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Blog Title) <small>required</small></label>
                        <input type="text" class="input w-full border mt-2" name="title" value="{{ $blog->title }}" placeholder="Blog Title" data-parsley-required>
                    </div>

                    <div class="mt-3">
                        <label>@translate(Blog Thumbnail) <small>@translate(required)</small> </label>
                        <div class="mt-2">
                            <input name="old_thumbnail" type="hidden" value="{{ $blog->thumbnail ?? null }}"/>
                            <input name="thumbnail" type="file" class="dropify" data-height="300"  data-default-file="{{ asset($blog->thumbnail ?? notFound('no-preview.png')) }}" data-allowed-file-extensions="jpg png jpeg" />
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>@translate(Active Status)</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" {{ $blog->status == 1 ? 'checked' : null }} class="input input--switch border" name="status">
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-50 bg-theme-1 text-white" name="editor" value="classic">@translate(Next)</button>
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
   <script src="{{ filePath('assets/js/sweetalert2@10.js') }}"></script>
   <script src="{{ filePath('bladejs/dropify.js') }}"></script>

   

   <script>

    //    this is dynamic script, error message receiving from laravel query

       @if ($errors->any())
        Swal.fire(
            '',
            @foreach ($errors->all() as $error)
            "{{ $error }}",
            @endforeach
            )
        @endif
   </script>
@endsection