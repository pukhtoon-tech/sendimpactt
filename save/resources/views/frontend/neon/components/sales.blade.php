<section class="iq-driver-sale pt-0 position-relative mt-5" id="about">
					<div class="container">
						<div class="row flex-row-reverse">
							<div class="col-lg-6 align-self-center position-relative wow slideInRight">
								<img src="{{ asset(frontendModule('module1')->image ?? null) }}" class="img-fluid" alt="images">
							</div>
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3 h2">{{ frontendModule('module1')->title }}</h2>
								<p class="mb-5">{{ frontendModule('module1')->small ?? null }}</p>
								<ul class="listing mb-5">
									<li>{{ frontendModule('module1')->list1 ?? null }}</li>
									<li>{{ frontendModule('module1')->list2 ?? null }}</li>
									<li class="mb-0">{{ frontendModule('module1')->list3 ?? null }}</li>
								</ul>
								<a class="button" href="#pricing">@translate(Free Trial Now)</a>
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
							</div>
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3 h2">{{ frontendModule('module2')->title }}</h2>
								<p class="mb-5">{{ frontendModule('module2')->small ?? null }}</p>
								<ul class="listing mb-5">
									<li>{{ frontendModule('module2')->list1 ?? null }}</li>
									<li>{{ frontendModule('module2')->list2 ?? null }}</li>
									<li class="mb-0">{{ frontendModule('module2')->list3 ?? null }}</li>
								</ul>
								<a class="button" href="#pricing">@translate(Free Trial Now)</a>
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
								<h2 class="mb-3 h2">{{ frontendModule('module3')->title }}</h2>
								<p class="mb-5">{{ frontendModule('module3')->small ?? null }}</p>
								<ul class="listing mb-5">
									<li>{{ frontendModule('module3')->list1 ?? null }}</li>
									<li>{{ frontendModule('module3')->list2 ?? null }}</li>
									<li class="mb-0">{{ frontendModule('module3')->list3 ?? null }}</li>
								</ul>
								<a class="button" href="#pricing">@translate(Free Trial Now)</a>
							</div>
							<div class="col-lg-6 align-self-center position-relative iq-rmt-50 ">
								<div class="scrollme">
									<img src="{{ asset(frontendModule('module3')->image ?? null) }}" class="img-fluid hand-img animateme"
									data-when="enter"
									data-from="1"
									data-to="0"
									data-translatey="-100" alt="images">
								</div>
							</div>
							
						</div>
					</div>
					<img src="{{ asset('frontend/images/bg/01.png') }}" class="img-fluid bg-one" alt="images">
				</section>