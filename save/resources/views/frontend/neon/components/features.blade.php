<section class="iq-feature" id="features">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="title-box">
									<h2 class="mb-3 h2">{{ frontendFeatures('features_title')->title ?? null }}</h2>
									<p class="mb-0">{{ frontendFeatures('features_title')->small ?? null }}</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features1')->icon ?? null) }}" alt="images" class="img-fluid">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3 h4">{{ frontendFeatures('features1')->title ?? null }}</h4>
										<p class="mb-0">{{ frontendFeatures('features1')->small ?? null }}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features2')->icon ?? null) }}" alt="images" class="img-fluid">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3 h4">{{ frontendFeatures('features2')->title ?? null }}</h4>
										<p class="mb-0">{{ frontendFeatures('features2')->small ?? null }}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features3')->icon ?? null) }}" alt="images" class="img-fluid">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3 h4">{{ frontendFeatures('features3')->title ?? null }}</h4>
										<p class="mb-0">{{ frontendFeatures('features3')->small ?? null }}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="feature-box wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features4')->icon ?? null) }}" alt="images" class="img-fluid">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3 h4">{{ frontendFeatures('features4')->title ?? null }}</h4>
										<p class="mb-0">{{ frontendFeatures('features4')->small ?? null }}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="feature-box mb-lg-0 wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features5')->icon ?? null) }}" alt="images" class="img-fluid">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3 h4">{{ frontendFeatures('features5')->title ?? null }}</h4>
										<p class="mb-0">{{ frontendFeatures('features5')->small ?? null }}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="feature-box mb-lg-0 wow slideInUp" data-wow-duration="1s">
									<div class="iq-icon">
										<img src="{{ asset(frontendFeatures('features6')->icon ?? null) }}" alt="images" class="img-fluid">
									</div>
									<div class="iq-feature-info">
										<h4 class="mb-3 h4">{{ frontendFeatures('features6')->title ?? null }}</h4>
										<p class="mb-0">{{ frontendFeatures('features6')->small ?? null }}</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 text-center mt-5">
								<a class="button" href="#pricing">@translate(Get Free Trial Now)</a>
							</div>
						</div>
					</div>
				</section>