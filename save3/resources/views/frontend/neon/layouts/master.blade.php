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


	{!! seo('google_analytics') ?? null !!}

	{{-- RLT --}}
    @if (checkDBConnection() == true && Schema::hasTable('organization_setups'))
            @if (checkthemeDirection()->exists())
                @if (themeDirection() == 'rtl')
                    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
					@else
                    <link rel="stylesheet" href="{{ asset('assets/css/ltr.css') }}">
                @endif
            @endif
    @endif
    {{-- RLT::END --}}

	{{-- CHAT PROVIDERS --}}
	 @if (checkDBConnection() == true && Schema::hasTable('chatproviders'))
            @forelse (chatProviders() as $chatProviders)
                @php
                    echo $chatProviders->body
                @endphp 
            @empty
            @endforelse
    @endif
	{{-- CHAT PROVIDERS::END --}}

	@notifyCss

	</head>
	
	<body id="home" class="rtl">
        <!-- loading -->
		@include('frontend.neon.components.loader')
		<!-- loading End -->
		<!--=================================
		Header -->
		@include('frontend.neon.components.header')
		<!--  Header End -->

        @yield('content')

        	<!-- Footer Start -->
			@include('frontend.neon.components.footer')
			<!-- Footer End -->


        	
			{{-- SCRIPT --}}
			@include('frontend.neon.layouts.script')
			{{-- SCRIPT::END --}}

			<script >
								var tpj=jQuery;
					
					var revapi10;
					tpj(document).ready(function() {
						if(tpj("#rev_slider_10_1").revolution == undefined){
							revslider_showDoubleJqueryError("#rev_slider_10_1");
						}else{
							revapi10 = tpj("#rev_slider_10_1").show().revolution({
								sliderType:"standard",
			jsFileLocation:"//localhost/revslider-standalone/revslider-standalone/revslider/public/assets/js/",
								sliderLayout:"fullwidth",
								dottedOverlay:"none",
								delay:9000,
								navigation: {
									onHoverStop:"off",
								},
								visibilityLevels:[1240,1024,778,480],
								gridwidth:1400,
								gridheight:830,
								lazyType:"none",
								parallax: {
									type:"mouse",
									origo:"enterpoint",
									speed:400,
									levels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,55],
									type:"mouse",
								},
								shadow:0,
								spinner:"spinner0",
								stopLoop:"off",
								stopAfterLoops:-1,
								stopAtSlide:-1,
								shuffle:"off",
								autoHeight:"off",
								disableProgressBar:"on",
								hideThumbsOnMobile:"off",
								hideSliderAtLimit:0,
								hideCaptionAtLimit:0,
								hideAllCaptionAtLilmit:0,
								debugMode:false,
								fallbacks: {
									simplifyAll:"off",
									nextSlideOnWindowFocus:"off",
									disableFocusListener:false,
								}
							});
						}
						});	/*ready*/
			</script>

			@include('sweetalert::alert')
			<x:notify-messages />
			@notifyJs
			
			
		</body>
	
</html>