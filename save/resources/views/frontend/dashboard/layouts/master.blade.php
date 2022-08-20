<!doctype html>
<html lang="en">
	
<head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link href="{{ favIcon() }}" rel="shortcut icon">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ seo('description') ?? null }}">
    <meta name="keywords" content="{{ seo('keywords') ?? null }}">
    <meta name="author" content="{{ env('AUTHOR') }}">
    <meta name="copyright" content="{{ env('AUTHOR') }}">
    <meta name="version" content="{{ env('VERSION') }}">

    {{-- OPEN GRAPH --}}
    <meta property="og:title" content="@yield('head')" >
    <meta property="og:url" content="{{ org('company_name') ?? 'Maildoll' }}" >
    <meta property="og:image" content="{{ logo() }}" >
    <meta property="og:type" content="website" >
    <meta name="og:description" content="{{ seo('description') ?? null }}">

	<title>{{ orgName() }}</title>
	
	{{-- CSS --}}
    @include('frontend.neon.layouts.style')
	{{-- CSS::END --}}

	 @notifyCss

	</head>
	<body id="home">

        <!-- loading -->
		@include('frontend.neon.components.loader')
		<!-- loading End -->
		<!--=================================
		Header -->
		@include('frontend.dashboard.layouts.components.header')
		<!--  Header End -->

        @yield('content')

        	<!-- Footer Start -->
			@include('frontend.neon.components.footer')
			<!-- Footer End -->


        	
			{{-- SCRIPT --}}
			@include('frontend.neon.layouts.script')
			{{-- SCRIPT::END --}}

			<script src="{{ filePath('bladejs/frontend.js') }}"></script>
			
			
			
		</body>

		@include('sweetalert::alert')
<x:notify-messages />
@notifyJs
	
</html>