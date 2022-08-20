@extends('frontend.argon.layouts.master')

@section('content')
	
<section class="space-5 pb-5 bg-light">
    <div class="container">
      <div class="text-center w-lg-75 mx-auto mb-5">
        <h1 class="font-weight-bold">{{ $blog->title }}</h1>
        <div class="d-flex align-items-center mb-3 justify-content-center">
          <img class="rounded-pill mr-2 w-10 h-10" src="{{ commonAvatar($blog->user->name) }}" height="36" alt="Avatar">
          <h6 class="m-0 mr-3">{{ Str::upper($blog->user->name) }}</h6>
          <span class="font-weight-medium text-primary">{{ $blog->created_at->format('F d, Y') }}</span>
        </div>
      </div>
      <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid rounded-lg medium-zoom-image m-auto" data-zoomable="">
      <div class="blog_details">
        <div id="editorjs"></div>
      </div>
      <div class="text-center mt-5 pt-3">
        <a class="d-inline-flex align-items-center text-primary" href="{{ route('frontend.index') }}">
          <i class="ri-arrow-left-line"></i>
          <span class="ml-1">{{ __('Return to homepage') }}</span>
        </a>
      </div>
    </div>
  </section>
		
@endsection

@section('scripts')

<script src="{{ asset('editorjs/js/jquery.js') }}"></script>
<script src="{{ asset('editorjs/js/header@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/simple-image@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/delimiter@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/list@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/checklist@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/quote@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/code@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/embed@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/table@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/link@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/warning@latest.js') }}"></script>

<script src="{{ asset('editorjs/js/marker@latest.js') }}"></script>
<script src="{{ asset('editorjs/js/inline-code@latest.js') }}"></script>

<!-- Load Editor.js's Core -->
<script src="{{ asset('editorjs/js/editorjs@latest.js') }}"></script>

     <!-- Initialization -->
    <script>
        /**
         * To initialize the Editor, create a new instance with configuration object
         * @see docs/installation.md for mode details
         */
        var editor = new EditorJS({
            /**
             * Enable/Disable the read onlyll mode
             */
            readOnly: true,

            /**
             * Wrapper of Editor
             */
            holder: 'editorjs',

            /**
             * Common Inline Toolbar settings
             * - if true (or not specified), the order from 'tool' property will be used
             * - if an array of tool names, this order will be used
             */
            // inlineToolbar: ['link', 'marker', 'bold', 'italic'],
            // inlineToolbar: true,

            /**
             * Tools list
             */
            tools: {
                /**
                 * Each Tool is a Plugin. Pass them via 'class' option with necessary settings {@link docs/tools.md}
                 */
                header: {
                    class: Header,
                    inlineToolbar: ['marker', 'link'],
                    config: {
                        placeholder: 'Header'
                    },
                    shortcut: 'CMD+SHIFT+H'
                },

                /**
                 * Or pass class directly without any configuration
                 */
                image: SimpleImage,

                list: {
                    class: List,
                    inlineToolbar: true,
                    shortcut: 'CMD+SHIFT+L'
                },

                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },

                quote: {
                    class: Quote,
                    inlineToolbar: true,
                    config: {
                        quotePlaceholder: 'Enter a quote',
                        captionPlaceholder: 'Quote\'s author',
                    },
                    shortcut: 'CMD+SHIFT+O'
                },

                warning: Warning,

                marker: {
                    class: Marker,
                    shortcut: 'CMD+SHIFT+M'
                },

                code: {
                    class: CodeTool,
                    shortcut: 'CMD+SHIFT+C'
                },

                delimiter: Delimiter,

                inlineCode: {
                    class: InlineCode,
                    shortcut: 'CMD+SHIFT+C'
                },

                linkTool: LinkTool,

                embed: Embed,

                table: {
                    class: Table,
                    inlineToolbar: true,
                    shortcut: 'CMD+ALT+T'
                },

            },

            /**
             * This Tool will be used as default
             */
            // defaultBlock: 'paragraph',

            /**
             * Initial Editor data
             */
            data: {
                blocks: {!! $blog->description ?? '[]' !!}
            },
        
        });

    </script>
@endsection