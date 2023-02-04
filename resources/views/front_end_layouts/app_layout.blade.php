<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="description"
      content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- title -->
    <title>Gasak home</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('front_end_style/assets/img/favicon.png') }}" />
    <!-- google font -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap"
      rel="stylesheet"
    />
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/all.min.css') }}" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/bootstrap/css/bootstrap.min.css') }}" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/owl.carousel.css') }}" />
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/magnific-popup.css') }}" />
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/animate.css') }}" />
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/meanmenu.min.css') }}" />
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/main.css') }}" />
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('front_end_style/assets/css/responsive.css') }}" />
  </head>
  <body>
    <!--PreLoader-->
    <div class="loader">
      <div class="loader-inner">
        <div class="circle"></div>
      </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12 text-center">
            <div class="main-menu-wrap">
              <!-- logo -->
              <div class="site-logo">
                <a class="logo_text" href="{{ route('welcome') }}">
                  Gasak
                </a>
              </div>
              <!-- logo -->

              <!-- menu start -->
              <nav class="main-menu">
                <ul>
                  <li class="current-list-item">
                    <a href="{{ route('welcome') }}">Home</a>

                  </li>
                  <li>
                    <a href="{{ route('gas') }}">Categories</a>
                    @if(isset($public_categories) && $public_categories->count() > 0)
                        <ul class="sub-menu">
                            @foreach ($public_categories as $category)
                                <li><a href="{{ route('products',$category->id) }}">{{$category->name_en}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                  </li>
                  <li><a href="{{ route('products') }}">Shop</a></li>
                  <li><a href="{{ route('about') }}">About</a></li>
                  <li><a href="{{ route('services') }}">Services</a></li>
                  <li><a href="{{ route('contact') }}">Contact</a></li>
                  <li>
                    <div class="header-icons">
                    @if(Auth::guard('customers')->check())
                      <a class="" href="{{ route('customers.profile') }}"><i class="fas fa-user"></i></a>
                    @else
                      <a class="" href="{{ route('customers.login') }}"><i class="fas fa-user"></i></a>
                    @endif
                      <a class="shopping-cart" href="{{ route('customers.cart') }}"><i class="fas fa-shopping-cart"></i></a>
                      {{-- <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a> --}}
                    </div>
                  </li>
                </ul>
              </nav>
              <a class="mobile-show search-bar-icon" href="#"
                ><i class="fas fa-search"></i
              ></a>
              <div class="mobile-menu"></div>
              <!-- menu end -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <span class="close-btn"><i class="fas fa-window-close"></i></span>
            <div class="search-bar">
              <div class="search-bar-tablecell">
                <h3>Search For:</h3>
                <input type="text" placeholder="Keywords" />
                <button type="submit">
                  Search <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end search area -->



    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}


    @yield('content')

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}



     <!-- footer -->
	<div class="footer-area">
		<div class="container">
		  <div class="row">
			<div class="col-lg-6 col-md-6">
			  <div class="footer-box about-widget">
				<h2 class="widget-title">About us</h2>
				<p>
				  Gasak is the easiest way to get your gas cylinder home in a few
				  simple steps. Order your gas cylinder now and gas distributors
				  will reach you and provide you with the best services.
				</p>
			  </div>
			</div>
			<div class="col-lg-6 col-md-6">
			  <div class="footer-box get-in-touch">
				<h2 class="widget-title">Get in Touch</h2>
				<ul>
				  <li>{{$public_contact->address_en}}</li>
				  <li>{{$public_contact->email}}</li>
				  <li>{{$public_contact->phone}}</li>
				</ul>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- end footer -->

	  <!-- copyright -->
	  <div class="copyright">
		<div class="container">
		  <div class="row">
			<div class="col-lg-6 col-md-12">
			  <p>
				Copyrights &copy; 2022  , All Rights Reserved.<br />

    <!-- end copyright -->

    <!-- jquery -->
    <script src="{{ asset('front_end_style/assets/js/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('front_end_style/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- count down -->
    <script src="{{ asset('front_end_style/assets/js/jquery.countdown.js') }}"></script>
    <!-- isotope -->
    <script src="{{ asset('front_end_style/assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
    <!-- waypoints -->
    <script src="{{ asset('front_end_style/assets/js/waypoints.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('front_end_style/assets/js/owl.carousel.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('front_end_style/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- mean menu -->
    <script src="{{ asset('front_end_style/assets/js/jquery.meanmenu.min.js') }}"></script>
    <!-- sticker js -->
    <script src="{{ asset('front_end_style/assets/js/sticker.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('front_end_style/assets/js/main.js') }}"></script>
  </body>
</html>
