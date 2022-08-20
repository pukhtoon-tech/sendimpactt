<header>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-shadow navbar-scroll-autohide navbar-expand-lg navbar-light bg-white py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand order-lg-1 flex-grow-1" href="{{ route('frontend.index') }}" aria-label="Logo">
                <img class="logo d-flex" src="{{ logo() }}" alt="{{ orgName() }}" />
            </a>
            <!-- End Logo -->

            <!-- Navbar Action Button -->
            <div class="d-none d-md-flex align-items-center order-2 order-lg-2 justify-content-end mr-3 mr-lg-0">
                @guest
                <a class="btn btn-primary d-inline-flex align-items-center" href="{{ route('login') }}">
                    <i class="ri-shopping-cart-2-line ri-lg mr-2"></i>
                    <span class="editable is-modified" data-cid="70" tabindex="1">{{ argonContent(70) ?? 'Login' }}</span>
                </a>
                @endguest
                @auth
                <a class="btn btn-primary d-inline-flex align-items-center" href="{{ route('dashboard') }}">
                    <i class="ri-user-line ri-lg mr-2"></i>
                    <span>{{ Auth::user()->name }}</span>
                </a>
                @endauth
            </div>
            <!-- End Navbar Action Button -->

            <!-- Navbar Toggler / Humberger Menu -->
            <button class="navbar-toggler d-lg-none d-flex align-items-center order-3 order-lg-3" type="button"
                data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="ri-menu-3-fill ri-xl"></i>
            </button>
            <!-- End Navbar Toggler / Humberger Menu -->

            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse order-3 order-lg-1 mr-lg-3" id="navbar">
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item -->
                    <li class="nav-item">
                        <a class="nav-link editable is-modified" href="{{ route('frontend.index') }}" data-cid="71" tabindex="1">{{ argonContent(71) ?? 'Home' }}</a>
                    </li>
                    <!-- End Nav Item -->

                    <!-- Nav Item -->
                    <li class="nav-item">
                        <a class="nav-link editable is-modified" href="#about" data-cid="72" tabindex="1">{{ argonContent(72) ?? 'About Us' }}</a>
                    </li>
                    <!-- End Nav Item -->

                    <!-- Nav Item -->
                    <li class="nav-item">
                        <a class="nav-link editable is-modified" href="#features" data-cid="73" tabindex="1">
                            {{ argonContent(73) ?? 'Features' }}
                        </a>
                    </li>
                    <!-- End Nav Item -->

                    <!-- Nav Item -->
                    @if (displaySubscriptionPlan() > 0)
                    <li class="nav-item">
                        <a class="nav-link editable is-modified" href="#pricing" data-cid="74" tabindex="1">
                            {{ argonContent(74) ?? 'Pricing' }}
                        </a>
                    </li>
                    @endif
                    <!-- End Nav Item -->

                    <!-- Nav Item -->
                    <li class="nav-item">
                        <a class="nav-link editable is-modified" href="#newsletter" data-cid="75" tabindex="1">
                            {{ argonContent(75) ?? 'Newsletter' }}
                        </a>
                    </li>
                    <!-- End Nav Item -->

                    @guest
                    <li class="nav-item d-none">
                        <a class="nav-link editable is-modified" href="{{ route('login') }}" data-cid="76" tabindex="1">
                            {{ argonContent(76) ?? 'Login' }}
                        </a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item d-none">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    @endauth

            @guest
            <li class="nav-item  d-md-none">
              <a class="nav-link editable is-modified" href="{{ route('login') }}" data-cid="78" tabindex="1">
                {{ argonContent(78) ?? 'Login' }}
              </a>
            </li>
            @endguest
            @auth
            <li class="nav-item d-none">
              <a class="nav-link editable is-modified" href="{{ route('dashboard') }}">
                {{ Auth::user()->name }}
              </a>
            </li>
            @endauth

                </ul>
            </div>
            <!-- End Navbar Menu -->
        </div>
    </nav>
    <!-- End Navbar -->
</header>
