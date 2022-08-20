<header id="header" class="home {{ request()->routeIs('frontend.payment') ? 'payment_header' : '' }}" >
			<div class="container-fluid" id="home">
				<div class="row align-items-center">
					<div class="col-lg-8">
						<nav class="navbar navbar-expand-lg navbar-light">
							
							<a class="navbar-brand" href="{{ route('frontend.index') }}">
								<img class="logo " src="{{ logo() }}" alt="{{ orgName() }}">
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
								<ul class="navbar-nav ml-auto">
									<li class="nav-item">
										<a class="nav-link" href="#home">@translate(Home)</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" href="#about">@translate(About Us)</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" href="#features">@translate(Features)</a>
									</li>
									
									@if (displaySubscriptionPlan() > 0)
									<li class="nav-item">
										<a class="nav-link" href="#pricing">@translate(Pricing)</a>
									</li>
									@endif

									<li class="nav-item">
										<a class="nav-link" href="#newsletter">@translate(Newsletter)</a>
									</li>

									@auth
									<li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link" title="{{ Auth::user()->name }}">@translate(My Account) </a></li>
									@endauth
									
									@guest
									<li class="nav-item login-btn"><a href="{{ route('login') }}" class="nav-">@translate(Login) <i class="fas fa-caret-right"></i></a></li>
									@endguest

								</ul>
							</div>
						</nav>
					</div>
					<div class="col-lg-4 text-right">
						<ul class="login maildoll-login">

							@if (orgPhone() != null)
								<li class="d-inline active"><a href="tel:{{ orgPhone() }}" class="phone"><i class="fas fa-phone"></i> {{ orgPhone() }}</a></li>
							@endif

							@auth
							<li class="d-inline"><a href="{{ route('dashboard') }}" class="" title="{{ Auth::user()->name }}">@translate(My Account) </a></li>
							@endauth
							
							@guest
							<li class="d-inline"><a href="{{ route('login') }}" class="button">@translate(Login) <i class="fas fa-caret-right"></i></a></li>
							@endguest

						</ul>
					</div>
				</div>
			</div>
		</header>