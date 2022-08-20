<section class="pt-0" id="pricing">
				    <div class="container">

					<div class="row">
							<div class="col-sm-12">
								<div class="title-box">
									<h2 class="mb-2 h4">@translate(Pricing)</h2>
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
								<div class="fancy-list-img purple-hover">{{ formatPrice($plans->price) }}</div>
								<div class="service-detail align-self-center">
									<h4 class="mb-2 h4">{{ Str::upper($plans->name) }}</h4>
									<p>{{ strip_tags($plans->description) }}</p>
									<div class="text-left">

										<ul class="iq-list mb-5">
											<li><i class="ion ion-checkmark-round"></i><span>  {{ $plans->duration }} @translate(Months)</span></li>
											<li><i class="ion ion-checkmark-round"></i><span>  {{ $plans->emails }} @translate(Emails)</span></li>
											<li><i class="ion ion-checkmark-round"></i><span>  {{ $plans->sms }} @translate(SMS) </span></li>
										</ul>

									<a class="button blue-btn gradient-btn button-icon" 
										href="{{ route('frontend.payment', [$plans->id, Str::slug($plans->name)]) }}">
										<span class="btn-effect"> @translate(Get It Now)</span>
									</a>

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