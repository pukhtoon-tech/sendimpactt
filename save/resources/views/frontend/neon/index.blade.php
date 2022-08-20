@extends('frontend.neon.layouts.master')

@section('content')
	
		

		
		<!--   Banner -->
		@include('frontend.neon.components.slider')
		<!-- END REVOLUTION SLIDER -->


			<!-- Banner End-->
			<!-- Main Content -->
			<div class="main-content">
				
				<!-- Driver sales -->
				@include('frontend.neon.components.sales')
				<!-- Driver sales  End-->
				
				<!-- Drag And Drop-->
				@include('frontend.neon.components.editor')
				<!-- Drag And Drop  End-->
				
				<!-- Features -->
				@include('frontend.neon.components.features')
				<!-- Features End -->

				@if (displaySubscriptionPlan() > 0)
					<!-- pricing -->
					@include('frontend.neon.components.pricing')
					<!-- pricing End -->
				@endif


			
				<!-- Subscribe -->
				@include('frontend.neon.components.subscribe')
				<!-- Subscribe End -->
			</div>
			<!-- Main Content END -->
		
		@endsection