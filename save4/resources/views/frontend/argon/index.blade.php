@extends('frontend.argon.layouts.master')

@section('content')

<!-- Section 1 -->
	@includeWhen(true, 'frontend.argon.components.section1')
<!-- End Section 1 -->
	
<!-- Section 2 -->
	@includeWhen(true, 'frontend.argon.components.section2')
<!-- End Section 2 -->

<!-- Section 3 -->
	@includeWhen(true, 'frontend.argon.components.section3')
<!-- End Section 3 -->

<!-- Section 4 -->
	@includeWhen(true, 'frontend.argon.components.section4')
<!-- End Section 4 -->

<!-- Section 5 -->
	@includeWhen(env('SAAS_ACTIVE') == "NO" ? true : false, 'frontend.argon.components.section5')
<!-- End Section 5 -->

<!-- Section 6 -->
	@includeWhen(false, 'frontend.argon.components.section6')
<!-- End Section 6 -->

<!-- Section 7 -->
	@includeWhen(false, 'frontend.argon.components.section7')
<!-- End Section 7 -->

<!-- Section 8 -->
	@includeWhen(true, 'frontend.argon.components.section8')
<!-- End Section 8 --> 
		
@endsection