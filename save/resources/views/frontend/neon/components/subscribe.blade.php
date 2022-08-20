<section class="iq-subscribe main-bg" id="newsletter">
					<div class="container">
						<div class="row justify-content-center ">
							<div class="col-lg-10 col-sm-12">
								<div class="title-box mb-5">
									<h2 class="text-white h2">@translate(Subscribe For Newsletter)</h2>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-sm-12 text-center">
								<form class="subscribe-form">

									<div class="form-row m-auto w-60">
										<div class="col">
											<input type="text" 
													class="form-control w-100 subscription-name" 
													name="name" 
													id="name" 
													placeholder="Full name" 
													required>
										</div>
										<div class="col">
											<input type="number" 
													name="phone_number" 
													required 
													id="phone_number" 
													class="form-control w-100 subscription-phone" 
													placeholder="Mobile number Ex : +8801825731327">
										</div>
									</div>

									<div class="mt-3">

										<input type="email" 
												name="email" 
												id="email" 
												class="form-control subscription-email" 
												placeholder="Email" 
												required>
									
										<input type="hidden" id="subscription_url" value="{{ route('new.subscription') }}">
										<a href="javascript:;" class="button subscribe-btn buttonload" class="btn-subscribe" onclick="subscribe()">
											<i class="fa fa-refresh fa-spin d-none" id="loader-spinner"></i>
											@translate(Subscribe Now)
										</a>

									</div>

									
								</form>
								<div class="w-60">
									<small id="invalid-email" class="text-white"></small>
								</div>
								
							
							</div>
						</div>
					</div>
				</section>