<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ orgName() }} - @translate(Email Template Builder) </title>
    <link href="{{ logo() }}" rel="shortcut icon">

    <link rel='stylesheet' href='{{ asset('page-builder\grapejs\css\normalize.css') }}'>
    <link rel='stylesheet' href='{{ asset('page-builder\grapejs\css\grapesjs-preset-newsletter.css') }}'>
    <link rel='stylesheet' href='{{ asset('page-builder\grapejs\css\grapes.css') }}'>
    <link rel='stylesheet' href='{{ asset('page-builder\custom.css') }}'>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ seo('description') ?? null }}">
    <meta name="keywords" content="{{ seo('keywords') ?? null }}">
    <meta name="author" content="{{ env('AUTHOR') }}">
    <meta name="copyright" content="{{ env('AUTHOR') }}">
    <meta name="version" content="{{ env('VERSION') }}">


    {{-- OPEN GRAPH --}}

    <meta property="og:title" content="@yield('head')">
    <meta property="og:url" content="{{ org('company_name') ?? Maildoll }}">
    <meta property="og:image" content="{{ logo() }}">
    <meta property="og:type" content="website">
    <meta name="og:description" content="{{ seo('description') ?? null }}">

     <!-- export -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-plugin-export.js') }}"></script>
    <!-- GrapesJS forms -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-plugin-forms.js') }}"></script>
    <!-- GrapesJS gradient -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-style-gradient.js') }}"></script>
 
    <!-- GrapesJS tooltip -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-tooltip.js') }}"></script>
    <!-- GrapesJS custom code -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-custom-code.js') }}"></script>
    <!-- GrapesJS touch -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-touch.js') }}"></script>
    <!-- GrapesJS touch -->
    <script src="{{ asset('page-builder\grapejs\grapesjs-parser-postcss.js') }}"></script>

@notifyCss

</head>

<body>
    <!-- partial:index.partial.html -->
    <div id="gjs"></div>

    <div class="mt-4 ml-4">

        <input type="hidden" value="{{ $originate->id }}" name="id" id="id">
        <input type="text" value="{{ $originate->title }}" class="w-50 css-input" placeholder="@translate(Template Title)" id="template_title" required>
        <button type="button" class="myButton-save ml-4" onclick="saveTem()">@translate(SAVE)</button>
        <a href="{{ route('templates.index') }}" type="button" class="myButton-close">@translate(CLOSE)</a>

    </div>
    

    <input type="hidden" value="{{ route('api.template.page.create') }}" id="template_create_url">
    <input type="hidden" value="{{ route('templates.index') }}" id="templates_index_url">
    <input type="hidden" value="{{ asset('sections/') }}" id="templates_img_url">
    <input type="hidden" value="{{ Auth::user()->id }}" id="auth_user">

    <!-- partial -->
    <script src='{{ asset('page-builder\grapejs\jquery.js') }}'></script>
    <script src='{{ asset('page-builder\grapejs\grapes.js') }}'></script>
    <script src='{{ asset('page-builder\grapejs\grapesjs-preset-newsletter.js') }}'></script>
    <script src="{{ asset('page-builder\script.js') }}"></script>


    

</body>

@include('sweetalert::alert')
<x:notify-messages />
@notifyJs

</html>
