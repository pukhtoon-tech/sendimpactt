<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')

    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />

    {{-- RLT --}}
    
    @if (checkDBConnection() == true && Schema::hasTable('organization_setups'))
            @if (checkthemeDirection()->exists())
                @if (themeDirection() == 'rtl')
                    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
                @endif
            @endif
    @endif

    {{-- RLT::END --}}


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @if (checkDBConnection() == true && Schema::hasTable('organization_setups'))
            @if (checkthemeLayout()->exists())
                @if (themeLayout() == 'classic')
                    <link rel="stylesheet" href="{{ asset('assets/css/classic.css') }}">
                @else
                    <style>
                        .app{
                        background-color: {{ color() }};
                    }
                    </style>
                @endif
            @else
                <link rel="stylesheet" href="{{ asset('assets/css/classic.css') }}">
            @endif
    @endif


    <meta property="og:title" content="@yield('head')" >
    <meta property="og:type" content="website" >
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    

    @if (checkDBConnection() == true && Schema::hasTable('organization_setups'))
        @if (Schema::hasColumn('organization_setups', 'company_name') || Schema::hasColumn('organization_setups', 'logo'))
            <link href="{{ favIcon() }}" rel="shortcut icon">
            <meta property="og:url" content="{{ org('company_name') ?? 'Maildoll' }}" >
            <meta property="og:image" content="{{ logo() }}" >
        @else
            <link href="{{ favIcon() }}" rel="shortcut icon">
        @endif
    @endif

    @if (checkDBConnection() == true && Schema::hasTable('seos'))

    <meta name="description" content="{{ seo('description') ?? null }}">
    <meta name="keywords" content="{{ seo('keywords') ?? null }}">

    {{-- OPEN GRAPH --}}
    <meta name="og:description" content="{{ seo('description') ?? null }}">

    @endif

    @yield('head')

    <script src="{{ filePath('bladejs/google-translate.js') }}"></script>

    @notifyCss
    
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

@yield('body')

@include('sweetalert::alert')
<x:notify-messages />
@notifyJs

</html>