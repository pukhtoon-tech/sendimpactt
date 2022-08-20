@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Write New Blog)</title>
@endsection

@section('css')
    <link href="{{ asset('editorjs/assets/demo.css') }}" rel="stylesheet">
    <script src="{{ asset('editorjs/assets/json-preview.js') }}"></script>
@endsection

@section('subcontent')
<div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Write New Blog)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <div id="editorjs"></div>

            <div class=" pb-10">
                <div class="ce-example__button" id="storeBlock">
                    {{ __('Save Changes') }}
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
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

  <script src="{{ filePath('assets/js/sweetalert2@10.js') }}"></script>

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
      readOnly: false,

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
          class:  Marker,
          shortcut: 'CMD+SHIFT+M'
        },

        code: {
          class:  CodeTool,
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
        @if($editor->description == null)
        
        blocks: [
            {
                "id" : "k4rLS9Zl3y",
                "type" : "header",
                "data" : {
                    "text" : 'Write Here...',
                    "level" : 2
                }
            }
        ],
        @else
        blocks: {!! $editor->description ?? '[]' !!}
        @endif
      },
      onChange: function(api, event) {
        console.log('something changed', event);
      }
    });

    /**
     * Saving button
     */
    const saveButton = document.getElementById('saveButton');
    

    // ajax query
    $('#storeBlock').on('click', function(){
        editor.save()
        .then((savedData) => {
  
            // ajax setup

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            // ajax setup request start

            $.ajax({
            type: 'POST',
            url: '{{ route('dashboard.blog.editorjs.storeorupdate', [$editor->id, $editor->slug]) }}',
            data: {
                id: '{{ $editor->id }}',
                blocks: JSON.stringify(savedData.blocks)
            },
            beforeSend: function(){
                Swal.fire(
                    'Please wait...',
                    'Saving your changes...',
                    'info'
                );
              },
              success: function(data) {
                Swal.fire(
                    'Success',
                    'Your changes has been saved',
                    'success'
                );
              }
            });

            // ajax setup request end

        })
        .catch((error) => {
          Swal.fire(
            'Error',
            'Something went wrong',
            'error'
          );
        });
    });

  </script>

   

   <script>

    //  this is dynamic script, error message receiving from laravel query

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