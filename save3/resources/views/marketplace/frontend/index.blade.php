@extends('marketplace.frontend.layouts.master')

@section('content')
    <!-- ================================================================= -->
  <!-- ========================== Header Area ========================== -->
  <!-- ================================================================= -->

  <header class="header-area-desktop miwlo-white-bg miwlo-header-black">
    <div class="container">
      <div class="row">
        <div class="col">
          <nav class="navbar navbar-expand-md miwlo-initial-navbar">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">
              <h1 class="header-brand">{{ orgName() }}</h1>
              <div class="header-sub-brand">
                <span>M</span>
                <span>A</span>
                <span>R</span>
                <span>K</span>
                <span>E</span>
                <span>T</span>
                <span>P</span>
                <span>L</span>
                <span>A</span>
                <span>C</span>
                <span>E</span>
              </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto">
                <li class="menu-item"><a href="{{ route('frontend.index') }}">@translate(Home)</a></li>
                <li class="menu-item"><a href="{{ route('frontend.index') }}#about">@translate(About Us)</a></li>
                <li class="menu-item d-none"><a href="#pricing">@translate(Pricing)</a></li>
              </ul>
            </div>
            <!-- .collapse .navbar-collapse -->
          </nav>
        </div>
        <!-- .col-xs-12 -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
  </header>
  <!-- .header-area-desktop -->

  <!-- ================================================================= -->
  <!-- ======================== Mobile Menu Area ======================= -->
  <!-- ================================================================= -->

  <div class="miwlo-header-area-mobile">
    <div class="miwlo-header-mobile">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <ul class="active">
              <li>
                <a class="mobile-logo" href="{{ route('frontend.index') }}">
                  <h1 class="header-brand">{{ orgName() }}</h1>
                  <div class="header-sub-brand">
                    <span>M</span>
                    <span>A</span>
                    <span>R</span>
                    <span>K</span>
                    <span>E</span>
                    <span>T</span>
                    <span>P</span>
                    <span>L</span>
                    <span>A</span>
                    <span>C</span>
                    <span>E</span>
                  </div>
                </a>
              </li>

              <li>
                <a href="javascript:;">
                  <span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                  </span>
                </a>
                <ul>
                    <li><a href="{{ route('frontend.index') }}">@translate(Home)</a></li>
                    <li><a href="{{ route('frontend.index') }}#about">@translate(About Us)</a></li>
                    <li class="d-none"><a href="#pricing">@translate(Pricing)</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- .col -->
        </div>
        <!-- .row -->
      </div>
      <!-- .container-fluid -->
    </div>
    <!-- .miwlo-header-mobile -->
  </div>
  <!-- .miwlo-header-area-mobile -->

  <!-- ================================================================= -->
  <!-- ====================== App Landing Banner ======================= -->
  <!-- ================================================================= -->

  <div class="miwlo-app-landing-banner-wrap">
    <div class="app-landing-top-shape">
      <img class="app-circle-shape" src="{{ asset('marketplace_assets/images/shape/circle-line-large.png') }}" alt="Circle" />
      <div class="small-dot-wrapper miwlo-parallax">
        <div class="layer" data-depth="0.1">
          <div data-aos="fade-up" data-aos-delay="1000">
            <img data-parallax='{"y" : 30}' class="app-line-dot-small" src="{{ asset('marketplace_assets/images/shape/line-dot-sm.png') }}"
              alt="Line Dot" />
          </div>
        </div>
        <!-- .layer -->
      </div>
      <!-- .small-dot-wrapper -->
      <div class="circle-dot-left miwlo-parallax">
        <div class="layer" data-depth="2">
          <div data-aos="fade-up" data-aos-delay="1200">
            <img data-parallax='{"y" : 100}' src="{{ asset('marketplace_assets/images/shape/circle-line-25.png') }}" alt="Circle" />
          </div>
        </div>
        <!-- .layer -->
      </div>
      <!-- .circle-dot-left -->
      <div class="circle-dot-right miwlo-parallax">
        <div class="layer" data-depth="3">
          <div data-aos="fade-up" data-aos-delay="1200">
            <img data-parallax='{"y" : 100}' src="{{ asset('marketplace_assets/images/shape/qube-60.png') }}" alt="Circle" />
          </div>
        </div>
        <!-- .layer -->
      </div>
      <!-- .circle-dot-right -->
    </div>
    <!-- .app-circle-shape -->
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-7 align-self-center">
          <div class="miwlo-app-landing-banner-text">
            <h2 data-aos="fade-up" data-aos-delay="1000" class="editable is-modified" data-cid="1100" tabindex="1">
              {{ argonContent(1100) ?? 'Get Start Your Marketing Campaign Today' }}
            </h2>
            <p class="mt-2 editable is-modified" data-aos="fade-up" data-aos-delay="1200" data-cid="1101" tabindex="1">
              {{ argonContent(1101) ?? 'A whole lifetime skips above whatever geography software
              beams opposite the jest the sphere elaborates!' }}
            </p>
            <div data-aos="fade-up" data-aos-delay="1400" class="miwlo-app-landing-btn-wrap d-lg-flex">
              <a class="miwlo-btn-border btn-black d-flex align-items-center" href="#pricing">
                <div class="icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div>
                  <span>Get it now</span>
                  See Pricing
                </div>
              </a>
              <a class="miwlo-btn-border btn-black d-flex align-items-center" 
                 href="{{ route('marketplace.csv.viewer') }}" 
                 target="_blank">
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <div>
                  <span>Upload CSV</span>
                  CSV Viewer
                </div>
              </a>
            </div>
            <!-- .miwlo-app-landing-btn-wrap -->
          </div>
          <!-- .miwlo-app-landing-banner-text -->
        </div>

   
        <!-- .col-md-7 -->
        <div class="col-12 col-lg-5 d-nonef d-lg-block">
        

          <div class="miwlo-app-landing-banner-right ">
            <div class="miwlo-app-landing-banner-image miwlo-parallax">
              <div class="mobile-wrapper mx-auto">
                <div>
                  <!-- slider range will go here -->
                  <div class="slider-range-table-wrapper text-center">
                    <h3 class="section-subheading mb-3 d-block text-center rangeValue">0</h3>

                    <input class="mm_hero-range mb-4 pricing_range" type="range" name="" value="0" min="0" max="1"
                      onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)" />

                  </div>
                  <div class="mm_hero-mobile-table-wraper">
                    <div class="mm_table-price-wrapper mm_hero-price-wrapper">
                      <h5><span class="totalValue">$0</span></h5>
                      <!-- country selector -->
                      <div class="d-flex align-items-center justify-content-center hero-country-selector">
                        <i class="fas fa-map-marker-alt mm_text-blue"></i>
                        <select class="mm_country-selector country-select">
                            <option value="">Select Country</option>
                            @forelse (marketplace_available_csv() as $country_name_code_list)
                                <option value="{{ $country_name_code_list->marketplace_csv->country }}">
                                    {{ marketplace_country_code(Str::upper($country_name_code_list->marketplace_csv->country)) }}({{ $country_name_code_list->marketplace_csv->country }})
                                </option>
                            @empty

                            @endforelse
                        </select>
                      </div>
                    </div>
                    <ul class="d-none">
                      <li>
                        <span class="table-header w-50">type</span>
                        <span class="table-header w-50 text-end">included</span>
                      </li>
                      <li>
                        <span class="table-text  text-width">
                          <i class="fas fa-caret-right d-inline-block me-2 mm_text-blue"></i>
                            emails
                        </span>
                        <span class="table-text text-end  pe-5"><i class="fas fa-check-circle mm_text-blue"></i></span>
                      </li>
                    </ul>
                    <div class="d-flex justify-content-center mt-3 py-4">
                      <a class="miwlo-btn-pill btn-black d-flex align-items-center" href="javascript:;" onclick="PurchaseBtn()">
                            <div class="icon">
                            <i class="fas fa-credit-card"></i>
                            </div>
                            <div>
                            <span>Get the CSV</span>
                                Purchase Now
                            </div>
                        </a>

                      

                    </div>
                  </div>
                </div>
                <!-- .layer -->
              </div>
              <!-- .mobile-wrapper -->
            </div>

            <!-- .app-landing-moible-bg -->
          </div>
          <!-- .miwlo-app-landing-banner-right -->
        </div>
        <!-- .col-md-5 -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
    <div class="app-landing-bottom-shape">
      <div class="app-line-dot-small-bottom miwlo-parallax">
        <div class="layer" data-depth="1">
          <div data-aos="fade-up" data-aos-delay="1200">
            <img data-parallax='{"x" : 80}' src="{{ asset('marketplace_assets/images/shape/line-dot-sm.png') }}" alt="Line Dot" />
          </div>
        </div>
      </div>
      <!-- .app-line-dot-small-bottom -->
      <div class="circle-dot-bottom-left miwlo-parallax">
        <div class="layer" data-depth="1">
          <div data-aos="fade-up" data-aos-delay="1000">
            <img data-parallax='{"y" : 30}' src="{{ asset('marketplace_assets/images/shape/qube-60.png') }}" alt="Circle" />
          </div>
        </div>
      </div>
      <!-- .circle-dot-bottom-left -->
    </div>
    <!-- .app-circle-shape -->
  </div>
  <!-- .miwlo-app-landing-banner-wrap -->

  <!-- ================================================================= -->
  <!-- ======================== Why Choose Area ======================== -->
  <!-- ================================================================= -->

  <div class="miwlo-why-choose-wrap d-none">
    <div class="miwlo-why-choose-right-shape">
      <img data-parallax='{"y" : 100}' src="{{ asset('marketplace_assets/images/shape/shape-05.png') }}" alt="Shape" />
    </div>
    <!-- .miwlo-why-choose-right-shapes -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="miwlo-why-choose-text text-center" data-aos="fade-up" data-aos-delay="100">
            <p class="section-subheading">Behind the Scene</p>
            <h3 class="section-heading">Why Choose Miwlo</h3>
          </div>
          <!-- .miwlo-why-choose-text -->
        </div>
        <!-- .col-md-7 -->
      </div>
      <!-- .row -->
      <div class="row text-center">
        <div class="col-12 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="200">
          <div class="why-choice-options option-one">
            <div class="why-choice-options-img-wrap">
              <img src="{{ asset('marketplace_assets/images/icons/icon-01.png') }}" alt="Data Management" />
            </div>
            <!-- .why-choice-options -->
            <h4>Manage Data</h4>
            <p>We publish a very broad range of fiction books</p>
          </div>
          <!-- .why-choice-options -->
        </div>
        <!-- .col-md-6 col-lg -->
        <div class="col-12 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="400">
          <div class="why-choice-options option-two">
            <div class="why-choice-options-img-wrap">
              <img src="{{ asset('marketplace_assets/images/icons/icon-02.png') }}" alt="Data Management" />
            </div>
            <!-- .why-choice-options -->
            <h4>Fully Secured</h4>
            <p>We publish a very broad range of fiction books</p>
          </div>
          <!-- .why-choice-options -->
        </div>
        <!-- .col-md-6 col-lg -->
        <div class="col-12 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="600">
          <div class="why-choice-options option-three">
            <div class="why-choice-options-img-wrap">
              <img src="{{ asset('marketplace_assets/images/icons/icon-03.png') }}" alt="Data Management" />
            </div>
            <!-- .why-choice-options -->
            <h4>Easy Installation</h4>
            <p>We publish a very broad range of fiction books</p>
          </div>
          <!-- .why-choice-options -->
        </div>
        <!-- .col-md-6 col-lg -->
        <div class="col-12 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="600">
          <div class="why-choice-options option-four">
            <div class="why-choice-options-img-wrap">
              <img src="{{ asset('marketplace_assets/images/icons/icon-07.png') }}" alt="Best Support" />
            </div>
            <!-- .why-choice-options -->
            <h4>Best Support</h4>
            <p>We publish a very broad range of fiction books</p>
          </div>
          <!-- .why-choice-options -->
        </div>
        <!-- .col-md-6 col-lg -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
    <div class="miwlo-why-choose-left-shape">
      <img data-parallax='{"y" : 50}' src="{{ asset('marketplace_assets/images/shape/shape-06.png') }}" alt="Shape" />
    </div>
    <!-- .miwlo-why-choose-left-shapes -->
  </div>
  <!-- .miwlo-why-choose-wrap -->

  <!-- ================================================================= -->
  <!-- ======================== Pricing area ======================== -->
  <!-- ================================================================= -->

  <div class="miwlo-why-choose-wrap d-none" id="pricing">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="text-center" data-aos="fade-up" data-aos-delay="100">
            <p class="section-subheading">Pick the best pacakage for you</p>
            <h3 class="section-heading">Pricing table</h3>
          </div>
          <!-- .miwlo-why-choose-text -->
        </div>
        <!-- .col-md-7 -->
      </div>
      <!-- .row -->
      <div class="row text-center justify-content-center">
        <div class="col-lg-6 col-12" data-aos="fade-up" data-aos-delay="200">
          <div class="miwelo_maildol_pricing-table">
            <!-- slider range will go here -->
            <div class="slider-range-table-wrapper">
              <h3 class="section-subheading mb-3 mt-4 rangeValue">0</h3>
              <input class="range pricing_range" type="range" name="" value="0" min="0" max="1"
                onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)" />
            </div>

            <!-- pricing box  -->
            <table class="table">
              <tbody>
                <tr class="">
                  <td class="mm_table-price-wrapper" colspan="3">
                    <h5><span class="totalValue">$0</span></h5>
                    <!-- country selector -->
                    <div class="d-flex align-items-center justify-content-center">
                      <i class="fas fa-map-marker-alt"></i>
                        <select class="mm_country-selector country-select">
                            <option value="">Select Country</option>
                            @forelse (marketplace_available_csv() as $country_name_code_list)
                                <option value="{{ $country_name_code_list->marketplace_csv->country }}">
                                    {{ marketplace_country_code(Str::upper($country_name_code_list->marketplace_csv->country)) }}({{ $country_name_code_list->marketplace_csv->country }})
                                </option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="head-text text-center" colspan="2">feature</td>
                  <td class="head-text text-center">enterprise pacakage</td>
                </tr>
                <tr>
                  <td class="" colspan="2">
                    <i class="fas fa-caret-right d-inline-block me-2 text-dark"></i>
                    unlimited calls
                  </td>
                  <td class="text-center text-dark">
                    <i class="fas fa-check-circle"></i>
                  </td>
                </tr>
                <tr>
                  <td class="" colspan="2">
                    <i class="fas fa-caret-right d-inline-block me-2 text-dark"></i>
                    free hosting & domain
                  </td>
                  <td class="text-center text-dark">
                    <i class="fas fa-check-circle"></i>
                  </td>
                </tr>
                <tr>
                  <td class="" colspan="2">
                    <i class="fas fa-caret-right d-inline-block me-2 text-dark"></i>
                    100 mb odf storage space
                  </td>
                  <td class="text-center text-dark">
                    <i class="fas fa-check-circle"></i>
                  </td>
                </tr>
                <tr>
                  <td class="" colspan="2">
                    <i class="fas fa-caret-right d-inline-block me-2 text-dark"></i>
                    500mb bandwidth
                  </td>
                  <td class="text-center text-dark">
                    <i class="fas fa-check-circle"></i>
                  </td>
                </tr>
                <tr>
                  <td class="" colspan="2">
                    <i class="fas fa-caret-right d-inline-block me-2 text-dark"></i>
                    10 email account
                  </td>
                  <td class="text-center text-dark">
                    <i class="fas fa-check-circle"></i>
                  </td>
                </tr>
                <tr>
                  <td class="" colspan="2">
                    <i class="fas fa-caret-right d-inline-block me-2 text-dark"></i>
                    1 year online support
                  </td>
                  <td class="text-center text-dark">
                    <i class="fas fa-check-circle"></i>
                  </td>
                </tr>
                <tr class="">
                  <td class="text-center" colspan="3">
                    <button class="miwlo-btn-pill btn-black">
                      Purchase now
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- .why-choice-options -->
        </div>
        <!-- .col-md-6 col-lg -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
  </div>
  <!-- .miwlo-why-choose-wrap -->

  <!-- ================================================================= -->
  <!-- ========================= Features Area ========================= -->
  <!-- ================================================================= -->

  <div class="miwlo-features-wrap feature-one d-none">
    <div class="feature-circle-dot-left miwlo-parallax">
      <div class="layer" data-depth="2">
        <div>
          <img data-parallax='{"y" : 100}' src="{{ asset('marketplace_assets/images/shape/circle-line-20.png') }}" alt="Circle" />
        </div>
      </div>
      <!-- .layer -->
    </div>
    <!-- .feature-circle-dot-left -->
    <div class="container">
      <div class="row">
        <div class="col-lg col-md">
          <div class="miwlo-feature-img-wrapper">
            <div class="miwlo-feature-img miwlo-parallax">
              <div class="layer" data-depth="0.1">
                <div data-aos="fade-up" data-aos-delay="300">
                  <img data-parallax='{"y" : 30}' class="mobile" src="{{ asset('marketplace_assets/images/others/feature-01.png') }}" alt="Feature" />
                </div>
              </div>
              <!-- .layer -->
            </div>
            <!-- .miwlo-feature-img -->
            <div class="miwlo-feature-img-shape miwlo-parallax">
              <div class="layer" data-depth="1">
                <div data-aos="fade-up" data-aos-delay="500">
                  <img data-parallax='{"x" : 80}' src="{{ asset('marketplace_assets/images/shape/shape-07.png') }}" alt="Line Dot" />
                </div>
              </div>
            </div>
            <!-- .miwlo-feature-img-shape -->
          </div>
          <!-- .miwlo-feature-img-wrapper -->
        </div>
        <!-- .col-lg -->
        <div class="col-lg col-md offset-xl-2 offset-md-1 align-self-center">
          <div class="miwlo-features-text-wrapper">
            <h3 data-aos="fade-up" data-aos-delay="300">
              Create the Best <br />Presentation for App
            </h3>
            <p data-aos="fade-up" data-aos-delay="400">
              A lifetime skips above whatever geography software beams
              opposite the jest international books
            </p>
            <div data-aos="fade-up" data-aos-delay="500">
              <a class="miwlo-btn-border btn-black" href="#">Get Started</a>
            </div>
          </div>
          <!-- .miwlo-features-text-wrapper -->
        </div>
        <!-- .col-lg -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
    <div class="feature-bottom-shape">
      <div class="feature-circle-dot-bottom-left miwlo-parallax">
        <div class="layer" data-depth="1">
          <div>
            <img data-parallax='{"y" : 30}' src="{{ asset('marketplace_assets/images/shape/circle-line-25.png') }}" alt="Circle" />
          </div>
        </div>
      </div>
      <!-- .feature-circle-dot-bottom-left -->
      <div class="feature-triangle-shape miwlo-parallax">
        <div class="layer">
          <div>
            <img data-parallax='{"y" : 50}' src="{{ asset('marketplace_assets/images/shape/shape-08.png') }}" alt="Circle" />
          </div>
        </div>
      </div>
      <!-- .feature-triangle-shape -->
    </div>
    <!-- .feature-bottom-shape -->
  </div>
  <!-- .miwlo-features-wrap -->

  <div class="miwlo-features-wrap feature-two d-none">
    <div class="feature-circle-dot-left miwlo-parallax">
      <div class="layer" data-depth="2">
        <div>
          <img data-parallax='{"y" : 100}' src="{{ asset('marketplace_assets/images/shape/circle-pill-black-25.png') }}" alt="Circle" />
        </div>
      </div>
      <!-- .layer -->
    </div>
    <!-- .feature-circle-dot-left -->
    <div class="container">
      <div class="row">
        <div class="col-lg col-md align-self-center order-md-1 order-2">
          <div class="miwlo-features-text-wrapper">
            <h3 data-aos="fade-up" data-aos-delay="300">
              Create the Best <br />Presentation for App
            </h3>
            <p data-aos="fade-up" data-aos-delay="400">
              A lifetime skips above whatever geography software beams
              opposite the jest international books
            </p>
            <div data-aos="fade-up" data-aos-delay="500">
              <a class="miwlo-btn-border btn-black" href="#">Get Started</a>
            </div>
          </div>
          <!-- .miwlo-features-text-wrapper -->
        </div>
        <!-- .col-md -->
        <div class="col-lg col-md offset-lg-2 offset-md-1 offset-sm-0 order-md-2 order-1">
          <div class="miwlo-feature-img-wrapper">
            <div class="miwlo-feature-img miwlo-parallax">
              <div class="layer" data-depth="0.1">
                <div data-aos="fade-up" data-aos-delay="300">
                  <img data-parallax='{"y" : 30}' class="mobile" src="{{ asset('marketplace_assets/images/others/feature-02.png') }}" alt="Feature" />
                </div>
              </div>
              <!-- .layer -->
            </div>
            <!-- .miwlo-feature-img -->
            <div class="miwlo-feature-img-shape miwlo-parallax">
              <div class="layer" data-depth="1">
                <div data-aos="fade-up" data-aos-delay="500">
                  <img data-parallax='{"x" : 80}' src="{{ asset('marketplace_assets/images/shape/shape-07.png') }}" alt="Line Dot" />
                </div>
              </div>
            </div>
            <!-- .miwlo-feature-img-shape -->
          </div>
          <!-- .miwlo-feature-img-wrapper -->
        </div>
        <!-- .col-md -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
    <div class="feature-bottom-shape">
      <div class="feature-circle-dot-bottom-left miwlo-parallax">
        <div class="layer" data-depth="1">
          <div>
            <img data-parallax='{"y" : 30}' src="{{ asset('marketplace_assets/images/shape/cross-25.png') }}" alt="Circle" />
          </div>
        </div>
      </div>
      <!-- .feature-circle-dot-bottom-left -->
    </div>
    <!-- .feature-bottom-shape -->
  </div>
  <!-- .miwlo-features-wrap -->

  <!-- ================================================================= -->
  <!-- ========================== Footer Wrap ========================== -->
  <!-- ================================================================= -->

  <div class="miwlo-footer-wrap">
    <div class="footer-triangle-shape-top miwlo-parallax">
      <div class="layer" data-depth="1">
        <div>
          <img data-parallax='{"y" : 30}' src="{{ asset('marketplace_assets/images/shape/shape-11.png') }}" alt="Triangle" />
        </div>
      </div>
    </div>
    <!-- .footer-triangle-shape-top -->
    <div class="container">
      <div class="row">
        <div class="col-lg col-sm-12">
          <div class="miwlo-footer-text text-center">
            <h1 class="footer-brand">{{ orgName() }}</h1>
            <h6 class="footer-sub-brand">@translate(Marketplace)</h6>
            <p>
              @translate(Copyright) @ {{ date('Y') }}<br />
            </p>
            <ul class="miwlo-footer-social mt-2">
              @if (org('facebook'))
              <li>
                <a href="{{ org('facebook') }}"><i class="fab fa-facebook-f"></i></a>
              </li>
              @endif
              @if (org('twitter'))
              <li>
                <a href="{{ org('twitter') }}"><i class="fab fa-twitter"></i></a>
              </li>
              @endif
              @if (org('linkedin'))
              <li>
                <a href="{{ org('linkedin') }}"><i class="fab fa-linkedin"></i></a>
              </li>
              @endif
              @if (org('skype'))
              <li>
                <a href="{{ org('skype') }}"><i class="fab fa-skype"></i></a>
              </li>
              @endif

            </ul>
          </div>
          <!-- .miwlo-footer-text -->
        </div>
       
        <!-- .col-lg col-sm-4 -->
      </div>
      <!-- .row -->
    </div>
    <!-- .container -->
    <div class="footer-triangle-shape-bottom miwlo-parallax">
      <div class="layer" data-depth="1">
        <div>
          <img data-parallax='{"y" : 30}' src="{{ asset('marketplace_assets/images/shape/shape-12.png') }}" alt="Triangle" />
        </div>
      </div>
    </div>
    <!-- .footer-triangle-shape-bottom -->
    <img class="app-circle-shape-footer" src="{{ asset('marketplace_assets/images/shape/circle-line-footer.png') }}" alt="Circle" />
  </div>
  <!-- .miwlo-footer-wrap -->
@endsection

@section('js')
    <script type="text/javascript">
    "use strict"

    const $staffSelect = document.querySelector('.country-select');

    var country_csv = '';
    var country_csv_price = '';

    $staffSelect.onchange = function () {

         var country_code = this.value;

         if (country_code == '') {
             toastr.clear();
            toastr.info('Please select country first to see price.');
         }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
	    });

        $.ajax({
            type: 'GET',
            url: '{{ route("marketplace.get.country.csv") }}',
            data: {
                country_code: country_code
            },
            beforeSend: function() {
                toastr.clear();
                toastr.info('Calculating data. Please wait...');
            },
            success: function(data) {
              console.log(data);
                $('.pricing_range').attr('min', data.marketplace_setting.min);
                $('.pricing_range').attr('value', data.marketplace_setting.min);
                $('.pricing_range').attr('max', data.marketplace_setting.max);
                $('.rangeValue').html(data.marketplace_setting.min);
                country_csv = '';
                country_csv_price = '';
                country_csv += data.country;
                country_csv_price += data.marketplace_setting.each_price;
                $(".totalValue").html("$" + country_csv_price);
            },
            error: function() { // if error occured
                toastr.clear();
                toastr.error('Error occured.please try again');
            },
	    });
    }


    function rangeSlide(value) {

        if (country_csv == '') {
            return false;
        }

        $('.rangeValue').html(value);

        // quantity[email] * price[per email{USA}];
        var total = value * country_csv_price;

        $(".totalValue").html("$" + total.toFixed(2));
    }

    function PurchaseBtn(){

        var country_code = $staffSelect.value;
        var quantity = $('.pricing_range').val();
        var total = $('.totalValue').html();

        if (country_code == '') {
            toastr.clear();
            toastr.info('Please select country first to see price.');
            return false;
        }

        if (quantity == '') {
            toastr.clear();
            toastr.info('Please select quantity.');
            return false;
        }

        if (total == '') {
            toastr.clear();
            toastr.info('Please select quantity.');
            return false;
        }

        // redirect to
        window.location = '{{ route("marketplace.payment") }}' + '?country_code=' + country_code  + '&quantity=' + quantity + '&total=' + total;

    }
  </script>
@endsection
