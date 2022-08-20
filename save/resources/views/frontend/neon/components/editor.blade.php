<section class="lightblue-bg">
					<div class="container">
						<div class="row ">
							<div class="col-lg-6 align-self-center position-relative wow slideInLeft">
								<img src="{{ asset(frontendModule('module4')->image ?? null) }}" class="img-fluid" alt="images">
							</div>
							<div class="col-lg-6 iq-rmt-50">
								<h2 class="mb-3 h2">{{ frontendModule('module4')->title }}</h2>
								<p class="mb-5">{{ frontendModule('module4')->small ?? null }}</p>
								<ul class="listing mb-5">
									<li>{{ frontendModule('module4')->list1 ?? null }}</li>
									<li>{{ frontendModule('module4')->list2 ?? null }}</li>
									<li class="mb-0">{{ frontendModule('module4')->list3 ?? null }}</li>
								</ul>
								<a class="button" href="#pricing">@translate(Free Trial Now)</a>
							</div>
						</div>
					</div>
				</section>