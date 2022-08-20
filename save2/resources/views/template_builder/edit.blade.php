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
    <div id="gjs">
        {!! $template->html !!}
    </div>

    <input type="text" value="{{ $template->title }}" placeholder="@translate(Title)" class="css-input w-50" id="template_title" required>
    <button type="button" class="myButton-save" onclick="updateTem()">@translate(UPDATE)</button>
    <a href="{{ route('templates.index') }}" type="button" class="myButton-close">@translate(CLOSE)</a>

    <input type="hidden" value="{{ route('template.page.update', $template->id) }}" id="template_update_url">
    <input type="hidden" value="{{ Auth::user()->id }}" id="auth_user">
    <input type="hidden" value="{{ asset('sections/') }}" id="templates_img_url">

   <!-- partial -->
    <script src='{{ asset('page-builder\grapejs\jquery.js') }}'></script>
    <script src='{{ asset('page-builder\grapejs\grapes.js') }}'></script>
    <script src='{{ asset('page-builder\grapejs\grapesjs-preset-newsletter.js') }}'></script>
    <script src="{{ asset('page-builder/script.js') }}"></script>

</body>

@include('sweetalert::alert')
<x:notify-messages />
@notifyJs

</html>
