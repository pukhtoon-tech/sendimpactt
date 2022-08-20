@extends('frontend.dashboard.layouts.master')

@section('content')

<form action="{{ route('frontend.store') }}" method="POST" id="frontendForm" enctype="multipart/form-data">

@csrf

		<!--   Banner -->
		<div id="rev_slider_10_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="email-marketing" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<!-- START REVOLUTION SLIDER 5.2.6 fullwidth mode -->
			<div id="rev_slider_10_1" class="rev_slider fullwidthabanner tp-overflow-hidden" style="display:none;" data-version="5.2.6">
				<ul>	<!-- SLIDE  -->

				<li data-index="rs-23" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
					<!-- MAIN IMAGE -->
					<img src="{{ asset('frontend/revslider/assets/abe02-04.png') }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<h2 class="tp-caption   tp-resizeme"
					id="slide-24-layer-1"
					data-x="50"
					data-y="360"
					data-width="['auto']"
					data-height="['auto']"
					data-transform_idle="o:1;"

					data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power3.easeInOut;"
					data-transform_out="opacity:0;s:300;e:Power3.easeInOut;"
					data-start="600"
					data-splitin="none"
					data-splitout="none"
					data-responsive_offset="on"

                    style="z-index: 5; white-space: nowrap; font-size: 32px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Poppins;">
                    <input type="text" placeholder="Slider Label" class="text-white" value="{{ frontend('slider_label') ?? null }}" name="slider_label">
                </h2>
					<!-- LAYER NR. 2 -->
					<h1 class="tp-caption   tp-resizeme"
					id="slide-24-layer-2"
					data-x="50"
					data-y="400"
					data-width="['auto']"
					data-height="['auto']"
					data-transform_idle="o:1;"

					data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power3.easeInOut;"
					data-transform_out="opacity:0;s:300;e:Power3.easeInOut;"
					data-start="900"
					data-splitin="none"
					data-splitout="none"
					data-responsive_offset="on"

                    style="z-index: 6; white-space: nowrap; font-size: 50px; line-height: 70px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Poppins;">
                    <input type="text" placeholder="Slider Title" class="text-white" value="{{ frontend('slider_title') ?? null }}" name="slider_title">
                </h1>
					<!-- LAYER NR. 3 -->
					<p class="tp-caption   tp-resizeme"
						id="slide-24-layer-3"
						data-x="50"
						data-y="480"
						data-width="['auto']"
						data-height="['auto']"
						data-transform_idle="o:1;"

						data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power3.easeInOut;"
						data-transform_out="opacity:0;s:300;e:Power3.easeOut;"
						data-start="1200"
						data-splitin="none"
						data-splitout="none"
						data-responsive_offset="on"

                    style="z-index: 7; white-space: nowrap; font-size: 18px; line-height: 35px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Poppins;">
                    <input type="text" name="slider_small" class="text-white" placeholder="Slider Small" value="{{ frontend('slider_small') ?? null }}">
                </p>
					<!-- LAYER NR. 4 -->
					<div class="tp-caption button"
						id="slide-24-layer-4"
						data-x="50"
						data-y="bottom" data-voffset="180"
						data-width="['auto']"
						data-height="['auto']"
						data-transform_idle="o:1;"
						data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;"
						data-style_hover=""

						data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power3.easeInOut;"
						data-transform_out="opacity:0;s:300;"
						data-start="1500"
						data-splitin="none"
						data-splitout="none"
						data-responsive_offset="on"

					style="z-index: 8; white-space: nowrap;  cursor:pointer;">
					<a href="javascript:;">
						{{-- TODO --}}
						@translate(Try Free Trial)
					</a>
				</div>
					<!-- LAYER NR. 5 -->
					<div class="tp-caption   tp-resizeme rs-parallaxlevel-1"
						id="slide-24-layer-5"
						data-x="742"
						data-y="164"
						data-width="['none','none','none','none']"
						data-height="['none','none','none','none']"
						data-transform_idle="o:1;"

						data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2100;e:Power3.easeInOut;"
						data-transform_out="opacity:0;s:300;e:Power3.easeInOut;"
						data-start="1800"
						data-responsive_offset="on"

					style="z-index: 9;">
					<img src="{{ asset(frontend('slider_image') ?? null) }}" alt="" data-ww="auto" data-hh="auto" data-no-retina>
					<input type="file" class="form-control" value="{{ frontend('slider_image') ?? null }}" name="slider_image">
				</div>
					<!-- LAYER NR. 6 -->
					<div class="tp-caption   tp-resizeme rs-parallaxlevel-1"
						id="slide-24-layer-6"
						data-x="215"
						data-y="650"
						data-width="['none','none','none','none']"
						data-height="['none','none','none','none']"
						data-transform_idle="o:1;"

						data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power3.easeInOut;"
						data-transform_out="opacity:0;s:300;e:Power3.easeInOut;"
						data-start="1800"
						data-responsive_offset="on"

					style="z-index: 10;">
					<img src="{{ asset('frontend/revslider/assets/3d839-03.png') }}" alt="" data-ww="auto" data-hh="auto" data-no-retina>

				</div>
				</li>
			</ul>
			<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>	</div>
		</div>
        <!-- END REVOLUTION SLIDER -->

			<!-- Banner End-->
			<!-- Main Content -->
			<div class="main-content">



				<!-- Driver sales -->
				<section class="iq-driver-sale pt-0 mt-5 position-relative">
					<div class="container">
						<div class="row flex-row-reverse">
							<div class="col-lg-6 align-self-center position-relative wow slideInRight">
								<img src="{{ asset(frontendModule('module1')->image ?? null) }}" class="img-fluid" alt="images">
								<input type="file" class="form-control" value="{{ frontendModule('module1')->image ?? null }}" name="module1_image">
								<input type="hidden" class="form-control" value="module1" name="module1">
							</div>
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3">
									<input type="text" class="form-control" placeholder="Module Title" value="{{ frontendModule('module1')->title ?? null }}" name="module1_title">
								</h2>
								<p class="mb-5">
									<input type="text" class="form-control" value="{{ frontendModule('module1')->small ?? null }}" name="module1_small">
								</p>
								<ul class="listing mb-5">
									<li><input type="text" class="form-control" value="{{ frontendModule('module1')->list1 ?? null }}" name="module1_list1"></li>
									<li><input type="text" class="form-control" value="{{ frontendModule('module1')->list2 ?? null }}" name="module1_list2"></li>
									<li class="mb-0"><input type="text" class="form-control" value="{{ frontendModule('module1')->list3 ?? null }}" name="module1_list3"></li>
								</ul>
								<a class="button" href="#pricing">Free Trial Now</a>
							</div>
						</div>
					</div>
					<img src="{{ asset('frontend/images/bg/01.png') }}" class="img-fluid bg-one" alt="images">
				</section>
				<!-- Driver sales  End-->


				<!-- Driver sales -->
				<section class="iq-driver-sale pt-0 position-relative">
					<div class="container">
						<div class="row ">
							<div class="col-lg-6 align-self-center position-relative wow slideInLeft">
								<img src="{{ asset(frontendModule('module2')->image ?? null) }}" class="img-fluid" alt="images">
								<input type="file" class="form-control" value="{{ frontendModule('module2')->image ?? null }}" name="module2_image">
								<input type="hidden" class="form-control" value="module2" name="module2">
							</div>
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3">
									<input type="text" class="form-control" placeholder="Module Title" value="{{ frontendModule('module2')->title ?? null }}" name="module2_title">
								</h2>
								<p class="mb-5">
									<input type="text" class="form-control" value="{{ frontendModule('module2')->small ?? null }}" name="module2_small">
								</p>
								<ul class="listing mb-5">
									<li><input type="text" class="form-control" value="{{ frontendModule('module2')->list1 ?? null }}" name="module2_list1"></li>
									<li><input type="text" class="form-control" value="{{ frontendModule('module2')->list2 ?? null }}" name="module2_list2"></li>
									<li class="mb-0"><input type="text" class="form-control" value="{{ frontendModule('module2')->list3 ?? null }}" name="module2_list3"></li>
								</ul>
								<a class="button" href="#pricing">Free Trial Now</a>
							</div>
						</div>
					</div>
					<img src="{{ asset('frontend/images/bg/02.png') }}" class="img-fluid bg-two" alt="images">
				</section>
				<!-- Driver sales  End-->
				<!-- Driver sales -->
				<section class="iq-driver-sale p-0 position-relative">
					<div class="container">
						<div class="row ">
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3">
									<input type="text" class="form-control" placeholder="Module Title" value="{{ frontendModule('module3')->title ?? null }}" name="module3_title">
									<input type="hidden" class="form-control" value="module3" name="module3">
								</h2>
								<p class="mb-5">
									<input type="text" class="form-control" value="{{ frontendModule('module3')->small ?? null }}" name="module3_small">
								</p>
								<ul class="listing mb-5">
									<li><input type="text" class="form-control" value="{{ frontendModule('module3')->list1 ?? null }}" name="module3_list1"></li>
									<li><input type="text" class="form-control" value="{{ frontendModule('module3')->list2 ?? null }}" name="module3_list2"></li>
									<li class="mb-0"><input type="text" class="form-control" value="{{ frontendModule('module3')->list3 ?? null }}" name="module3_list3"></li>
								</ul>
								<a class="button" href="#pricing">Free Trial Now</a>
							</div>
							<div class="col-lg-6 align-self-center position-relative iq-rmt-50 ">
								<div class="scrollme">

									<img src="{{ asset(frontendModule('module3')->image ?? null) }}"
									class="img-fluid"
									data-when="enter"
									data-from="1"
									data-to="0"
									data-translatey="-100"
									alt="images">
								<input type="file" class="form-control" value="{{ frontendModule('module3')->image ?? null }}" name="module3_image">

								</div>
							</div>

						</div>
					</div>
					<img src="{{ asset('frontend/images/bg/01.png') }}" class="img-fluid bg-one" alt="images">
				</section>
				<!-- Driver sales  End-->

				<!-- Drag And Drop-->
				<section class="lightblue-bg">
					<div class="container">
						<div class="row ">
							<div class="col-lg-6 align-self-center position-relative wow slideInLeft">
								<img src="{{ asset(frontendModule('module4')->image ?? null) }}" class="img-fluid" alt="images">
								<input type="file" class="form-control" value="{{ frontendModule('module4')->image ?? null }}" name="module4_image">
								<input type="hidden" class="form-control" value="module4" name="module4">
							</div>
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3">
									<input type="text" class="form-control" placeholder="Module Title" value="{{ frontendModule('module4')->title ?? null }}" name="module4_title">
									<input type="hidden" class="form-control" value="module4" name="module4">
								</h2>
								<p class="mb-5">
									<input type="text" class="form-control" value="{{ frontendModule('module4')->small ?? null }}" name="module4_small">
								</p>
								<ul class="listing mb-5">
									<li><input type="text" class="form-control" value="{{ frontendModule('module4')->list1 ?? null }}" name="module4_list1"></li>
									<li><input type="text" class="form-control" value="{{ frontendModule('module4')->list2 ?? null }}" name="module4_list2"></li>
									<li class="mb-0"><input type="text" class="form-control" value="{{ frontendModule('module4')->list3 ?? null }}" name="module4_list3"></li>
								</ul>
								<a class="button" href="#pricing">Free Trial Now</a>
							</div>
						</div>
					</div>
				</section>
				<!-- Drag And Drop  End-->

				<!-- Features -->
				<section class="iq-feature" id="features">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="title-box">
									<h2 class="mb-3">
										<input type="text" name="features_title" value="{{ frontendFeatures('features_title')->title ?? null }}" placeholder="Section Title">
									</h2>
									<p class="mb-0">
										<input type="text" name="features_small" value="{{ frontendFeatures('features_title')->small ?? null }}" placeholder="Section Small">
									</p>
								</div>
							</div>
						</div>
						<div class="row">


							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features1')->icon ?? null) }}" alt="images" class="img-fluid">
										<input type="file" class="form-control" name="features1_icon">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3">
											<input type="text" name="features1_title" class="form-control" value="{{ frontendFeatures('features1')->title ?? null }}" placeholder="Feature Title">
										</h4>
										<p class="mb-0">
											<input type="text" name="features1_small" class="form-control" value="{{ frontendFeatures('features1')->small ?? null }}" placeholder="Feature Small">
										</p>
									</div>
								</div>
							</div>


							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features2')->icon ?? null) }}" alt="images" class="img-fluid">
										<input type="file" class="form-control" name="features2_icon">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3">
											<input type="text" name="features2_title" class="form-control" value="{{ frontendFeatures('features2')->title ?? null }}" placeholder="Feature Title">
										</h4>
										<p class="mb-0">
											<input type="text" name="features2_small" class="form-control" value="{{ frontendFeatures('features2')->small ?? null }}" placeholder="Feature Small">
										</p>
									</div>
								</div>
							</div>


							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features3')->icon ?? null) }}" alt="images" class="img-fluid">
										<input type="file" class="form-control" name="features3_icon">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3">
											<input type="text" name="features3_title" class="form-control" value="{{ frontendFeatures('features3')->title ?? null }}" placeholder="Feature Title">
										</h4>
										<p class="mb-0">
											<input type="text" name="features3_small" class="form-control" value="{{ frontendFeatures('features3')->small ?? null }}" placeholder="Feature Small">
										</p>
									</div>
								</div>
							</div>


							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features4')->icon ?? null) }}" alt="images" class="img-fluid">
										<input type="file" class="form-control" name="features4_icon">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3">
											<input type="text" name="features4_title" class="form-control" value="{{ frontendFeatures('features4')->title ?? null }}" placeholder="Feature Title">
										</h4>
										<p class="mb-0">
											<input type="text" name="features4_small" class="form-control" value="{{ frontendFeatures('features4')->small ?? null }}" placeholder="Feature Small">
										</p>
									</div>
								</div>
							</div>


							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features5')->icon ?? null) }}" alt="images" class="img-fluid">
										<input type="file" class="form-control" name="features5_icon">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3">
											<input type="text" name="features5_title" class="form-control" value="{{ frontendFeatures('features5')->title ?? null }}" placeholder="Feature Title">
										</h4>
										<p class="mb-0">
											<input type="text" name="features5_small" class="form-control" value="{{ frontendFeatures('features5')->small ?? null }}" placeholder="Feature Small">
										</p>
									</div>
								</div>
							</div>


							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features6')->icon ?? null) }}" alt="images" class="img-fluid">
										<input type="file" class="form-control" name="features6_icon">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3">
											<input type="text" name="features6_title" class="form-control" value="{{ frontendFeatures('features6')->title ?? null }}" placeholder="Feature Title">
										</h4>
										<p class="mb-0">
											<input type="text" name="features6_small" class="form-control" value="{{ frontendFeatures('features6')->small ?? null }}" placeholder="Feature Small">
										</p>
									</div>
								</div>
							</div>




						<div class="row">
							<div class="col-sm-12 text-center mt-5">
								<a class="button" href="feature.html">Free Trial Now</a>
							</div>
						</div>
					</div>
				</section>
				<!-- Features End -->
				<!-- Testimonial -->
				<section class="pt-0" id="pricing">
				    <div class="container">

					<div class="row">
							<div class="col-sm-12">
								<div class="title-box">
									<h2 class="mb-3">@translate(Pricing)</h2>
								</div>
							</div>
						</div>



					@forelse (displaySubscriptions() as $plans)
					<div class="row align-items-center {{ $loop->iteration % 2 == 0 ? 'flex-row-reverse' : null }}">
						<div class="col-lg-6">
							<img class="img-fluid" src="{{ asset('frontend/images/pricing/602.png') }}" alt="img">
						</div>
						<div class="col-lg-6">
							<div class="fancy-list-box  wow fadeInUp  text-left">
								<div class="fancy-list-img purple-hover">{{ $plans->price }}</div>
								<div class="service-detail align-self-center">
									<h4 class="mb-2">{{ Str::upper($plans->name) }}</h4>
									<p>{{ strip_tags($plans->description) }}</p>
									<div class="text-left">
										<ul class="iq-list mb-5">
											<li><i class="ion ion-checkmark-round"></i><span>  {{ $plans->duration }} Months</span></li>
											<li><i class="ion ion-checkmark-round"></i><span>  {{ $plans->emails }} Emails</span></li>
											<li><i class="ion ion-checkmark-round"></i><span>  {{ $plans->sms }} SMS </span></li>
										</ul>
										<a class="button blue-btn gradient-btn button-icon" href="#"><span class="btn-effect"> @translate(Get It Now)</span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 text-center">

							@if (!$loop->last)

								@if ($loop->iteration % 2 == 0 ? 'flex-row-reverse' : null)
									<img class="img-fluid" src="{{ asset('frontend/images/pricing/605.png') }}" alt="img">
								@else
									<img class="img-fluid" src="{{ asset('frontend/images/pricing/603.png') }}" alt="img">
								@endif

							@endif



						</div>
					</div>

					@empty
						{{-- TODO --}}
					@endforelse



				</div>
			</section>
				<!-- Testimonial End -->

				<!-- Subscribe -->
				<section class="iq-subscribe main-bg">
					<div class="container">
						<div class="row justify-content-center ">
							<div class="col-lg-10 col-sm-12">
								<div class="title-box">
									<h2 class="text-white">@translate(Subscribe For Newsletter)</h2>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-sm-12 text-center">
								<form class="subscribe-form">
									<input type="email" name="email" class="form-control subscription-email " placeholder="Email">
									<a href="#" class="button subscribe-btn">Subscribe Now</a>
								</form>
							</div>
						</div>
					</div>
				</section>
				<!-- Subscribe End -->
			</div>
			{{-- Floating Button  --}}
			<nav class="floating-nav">
				<ul class="floating-nav__list">
					<li class="floating-nav__list-item">
						<a href="{{ route('frontend.index') }}" class="floating-nav__list-icon floating-nav__list-icon--1">
							<i class="fa fa-times" aria-hidden="true"></i>
						</a>
					</li>
					<li class="floating-nav__list-item">
						<a href="javascript:;" onclick="saveFrontend()" class="floating-nav__list-icon floating-nav__list-icon--2">
							<i class="fa fa-floppy-o" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</nav>
			{{-- Floating Button End --}}
            <!-- Main Content END -->
            </form>
		@endsection