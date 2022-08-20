<header id="header" class="home {{ request()->routeIs('frontend.payment') ? 'payment_header' : '' }}" >
			<div class="container-fluid custom-container-fluid" id="home">
				<div class="row align-items-center">
					<div class="col-lg-10">
						<nav class="navbar navbar-expand-lg navbar-light">
							
							<a class="navbar-brand" href="{{ route('frontend.index') }}">
								<img class="logo custom-logo" src="{{ logo() }}" alt="{{ orgName() }}">
							</a>

							<button class="navbar-toggler" 
							type="button" 
							data-toggle="collapse" 
							data-target="#navbarNavDropdown" 
							aria-controls="navbarNavDropdown" 
							aria-expanded="false" 
							aria-label="Toggle navigation">

							<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNavDropdown">
								<ul class="navbar-nav custom-navbar-nav ml-auto">
									<li class="nav-item">
										<a class="nav-link" href="#home">@translate(Home)</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" href="#about">@translate(About Us)</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" href="#features">@translate(Features)</a>
									</li>
									
									@if (disableAtSaaS())
										@if (displaySubscriptionPlan() > 0)
										<li class="nav-item">
											<a class="nav-link" href="#pricing">@translate(Pricing)</a>
										</li>
										@endif
									@endif

									<li class="nav-item">
										<a class="nav-link" href="#newsletter">@translate(Newsletter)</a>
									</li>

									@if (env('MARKETPLACE') == "YES")
									<li class="nav-item">
										<a class="nav-link" href="{{ route('marketplace.frontend') }}" target="_blank">@translate(Marketplace)</a>
									</li>
									@endif

									@auth
									<li class="nav-item custom-btn"><a href="{{ route('dashboard') }}" class="nav-link custom-btn" title="{{ Auth::user()->name }}">@translate(My Account) </a></li>
									@endauth
									
									@guest
									<li class="nav-item login-btn"><a href="{{ route('login') }}" class="nav-">@translate(Login) <i class="fas fa-caret-right"></i></a></li>
									@endguest

								</ul>
							</div>
						</nav>
					</div>
					<div class="col-lg-2 text-right">
						<ul class="login maildoll-login custom-maildoll-login">

							@auth
							<li class="d-inline "><a href="{{ route('dashboard') }}" class="custom-btn" title="{{ Auth::user()->name }}">@translate(My Account) </a></li>
							@endauth
							
							@guest
							<li class="d-inline "><a href="{{ route('login') }}" class="button">@translate(Login) <i class="fas fa-caret-right"></i></a></li>
							@endguest

						</ul>
					</div>
				</div>
			</div>
		</header>