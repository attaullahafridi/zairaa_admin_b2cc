<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ZAIRAA - @yield('title')</title>

	<?php
		$SocialMedia = \DB::table('social_media')->where('id', 1)->first();
	?>
	<link rel="icon" type="image/png" href="{{asset('public/app/'.$SocialMedia->fav_icon)}}"/>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('public/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/global_assets/css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/global_assets/js/plugins/editors/summernote/summernote.css')}}" rel="stylesheet" type="text/css">
	<!-- <link href="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.css')}}" rel="stylesheet" /> -->
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('public/global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('public/global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	{{--<script src="{{asset('public/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>--}}

	<script src="{{asset('public/assets/js/app.js')}}"></script>

	<script src="{{asset('public/global_assets/js/demo_pages/dashboard.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	
	<script src="{{asset('public/global_assets/js/demo_pages/datatables_basic.js')}}"></script>

	
	<script src="{{asset('public/global_assets/js/plugins/forms/selects/select2.full.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/editors/summernote/summernote.js')}}"></script>
	@stack('scripts')
	<!-- /theme JS files -->
</head>

<body>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	    @csrf
	</form>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="index.html" class="d-inline-block">
				<?php
					$SocialMedia = \DB::table('social_media')->where('id', 1)->first();
				?>
				<img src="{{asset('public/app/'.$SocialMedia->logo)}}" style="width: 220px; height: 50px;"  alt="Site Logo">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>

				
			</ul>

			<span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

			<ul class="navbar-nav">
				

				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<!-- <img src="public/global_assets/images/demo/users/face11.jpg" class="rounded-circle mr-2" height="34" alt=""> -->
						<span>@if(isset(Session::get('name')->fname)){{ Session::get('name')->fname }} {{Session::get('name')->lname}}@else Guest @endif</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a> -->
						<!-- <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a> -->
						<!-- <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-blue ml-auto">58</span></a> -->
						<!-- <div class="dropdown-divider"></div> -->
						<!-- <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a> -->
						<!-- <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a> -->
						
						<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="icon-switch2"></i>Logout</a>

					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<!-- <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li> -->
						<li class="nav-item">
							<a href="{{route('home')}}" class="nav-link {{ (Request::is('home*') ? 'active' : '') || (Request::is('flightdetail*') ? 'active' : '') || (Request::is('flightlocation*') ? 'active' : '') || (Request::is('hoteldetail*') ? 'active' : '') || (Request::is('hotellocation*') ? 'active' : '') || (Request::is('activitydetail*') ? 'active' : '') || (Request::is('activitylocation*') ? 'active' : '') || (Request::is('transferdetail*') ? 'active' : '') || (Request::is('transferlocation*') ? 'active' : '') }}">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{route('bookings.index')}}" class="nav-link {{ Request::is('bookings*') ? 'active' : '' }}">
								<i class="icon-book"></i>
								<span>
									Bookings
								</span>
							</a>
						</li>
						<li class="nav-item">
							{{-- <a href="#" class="nav-link {{ Request::is('bookings*') ? 'active' : '' }}"> --}}
							<a href="{{ route('users_detail') }}" class="nav-link {{ Request::is('users_detail*') ? 'active' : '' }}">
								<i class="icon-user"></i>
								<span>
									Users
								</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{route('markup.index')}}" class="nav-link {{ Request::is('markup*') ? 'active' : '' }}">
								<i class="fa fa-usd"></i>
								<span>
									Markup
								</span>
							</a>
						</li>


						<li class="nav-item">
							<a href="{{route('flightmarkup.index')}}" class="nav-link {{ Request::is('flightmarkup*') ? 'active' : '' }}">
								<i class="fa fa-plane"></i>
								<span>
									Flight Markup
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('promotionalfair.index')}}" class="nav-link {{ Request::is('promotionalfair*') ? 'active' : '' }}">
								<i class="fa fa-plane"></i>
								<span>
									Promotional Fair
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('customer_emails')}}" class="nav-link {{ Request::is('customer_emails*') ? 'active' : '' }}">
								<i class="fa fa-envelope"></i>
								<span>
									Recived Email Detail
								</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu {{ (Request::is('category*') ? 'nav-item-open' : '') || (Request::is('subcat*') ? 'nav-item-open' : '') }}">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Categories</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="display: {{ (Request::is('category*') ? 'block' : '') || (Request::is('subcat*') ? 'block' : '') }}">
								<li class="nav-item"><a href="{{route('category.index')}}" class="nav-link {{ Request::is('category*') ? 'active' : '' }}">Category Type</a></li>
								
								<li class="nav-item"><a href="{{route('subcat.index')}}" class="nav-link {{ Request::is('subcat*') ? 'active' : '' }}">Sub Category</a></li>
								
								
							</ul>
						</li>
						<li class="nav-item nav-item-submenu {{ Request::is('package*') ? 'nav-item-open' : '' }}">
							<a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span>Packages</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Themes" style="display: {{ Request::is('package*') ? 'block' : '' }}">
								<li class="nav-item"><a href="{{route('package.index')}}" class="nav-link {{ Request::is('package*') ? 'active' : '' }}">Package</a></li>
								
							</ul>
						</li>
						<li class="nav-item nav-item-submenu {{ (Request::is('accomodation*') ? 'nav-item-open' : '') || (Request::is('packagDetails*') ? 'nav-item-open' : '') || (Request::is('itnry*') ? 'nav-item-open' : '') || (Request::is('inclusion*') ? 'nav-item-open' : '') || (Request::is('exclusion*') ? 'nav-item-open' : '') || (Request::is('policy*') ? 'nav-item-open' : '') || (Request::is('pkgimages*') ? 'nav-item-open' : '') }}">
							<a href="#" class="nav-link"><i class="icon-stack"></i> <span>Package Details</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit" style="display: {{ (Request::is('accomodation*') ? 'block' : '') || (Request::is('packagDetails*') ? 'block' : '') || (Request::is('itnry*') ? 'block' : '') || (Request::is('inclusion*') ? 'block' : '') || (Request::is('exclusion*') ? 'block' : '') || (Request::is('policy*') ? 'block' : '') || (Request::is('pkgimages*') ? 'block' : '') }}">
								<li class="nav-item"><a href="{{route('packagDetails.index')}}" class="nav-link {{ Request::is('packagDetails*') ? 'active' : '' }}">Package Overview</a></li>
								<li class="nav-item"><a href="{{route('accomodation.index')}}" class="nav-link {{ Request::is('accomodation*') ? 'active' : '' }}">Package Accomodation</a></li>
								<li class="nav-item"><a href="{{route('itnry.index')}}" class="nav-link {{ Request::is('itnry*') ? 'active' : '' }}">Package Itinerary</a></li>
								<li class="nav-item"><a href="{{route('inclusion.index')}}" class="nav-link {{ Request::is('inclusion*') ? 'active' : '' }}">Package Inclusion</a></li>
								<li class="nav-item"><a href="{{route('exclusion.index')}}" class="nav-link {{ Request::is('exclusion*') ? 'active' : '' }}">Package Exclusion</a></li>
								<li class="nav-item"><a href="{{route('policy.index')}}" class="nav-link {{ Request::is('policy*') ? 'active' : '' }}">Package Policy</a></li>
								<li class="nav-item"><a href="{{route('pkgimages.index')}}" class="nav-link {{ Request::is('pkgimages*') ? 'active' : '' }}">Package Images</a></li>
							</ul>
						</li>

						<li class="nav-item nav-item-submenu {{ (Request::is('banner*') ? 'nav-item-open' : '') || (Request::is('inspiration*') ? 'nav-item-open' : '') || (Request::is('topDestination*') ? 'nav-item-open' : '') || (Request::is('topFlightt*') ? 'nav-item-open' : '') }} {{ Request::is('subscribe*') ? 'nav-item-open' : '' }}">
							<a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span>Home Page</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Themes" style="display: {{ (Request::is('banner*') ? 'block' : '') || (Request::is('topDestination*') ? 'block' : '') || (Request::is('inspiration*') ? 'block' : '') || (Request::is('topFlight*') ? 'block' : '') }} {{ Request::is('subscribe*') ? 'block' : '' }}">
								<li class="nav-item"><a href="{{route('banner.index')}}" class="nav-link {{ Request::is('banner*') ? 'active' : '' }}">Main Slider</a></li>

								<li class="nav-item">
									<a href="{{route('topDestination.index')}}" class="nav-link {{ (Request::is('topDestination*') ? 'active' : '') }}">Top Destination</a>
								</li>

								<li class="nav-item">
									<a href="{{route('topFlight.index')}}" class="nav-link {{ (Request::is('topFlight*') ? 'active' : '') }}">Top Flights</a>
								</li>

								<li class="nav-item">
									<a href="{{route('inspiration.index')}}" class="nav-link {{ Request::is('inspiration*') ? 'active' : '' }}">Inspirations</a>
								</li>
								<li class="nav-item">
									<a href="{{route('subscribe.index')}}" class="nav-link {{ Request::is('subscribe*') ? 'active' : '' }}">Subscribe</a>
								</li>
								<li class="nav-item">
									<a href="{{route('gallery.index')}}" class="nav-link {{ Request::is('gallery*') ? 'active' : '' }}">footer Gallery</a>
								</li>
							</ul>
						</li>


					{{--	<li class="nav-item nav-item-submenu {{ Request::is('flightsearchpage*') ? 'nav-item-open' : '' || Request::is('hotelsearchpage*') ? 'nav-item-open' : '' || Request::is('transfersearchpage*') ? 'nav-item-open' : '' || Request::is('actsearchpage*') ? 'nav-item-open' : '' }}">
							<a href="#" class="nav-link"><i class="fa fa-file"></i> <span>Search pages</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Themes" style="display: {{ Request::is('flightsearchpage*') ? 'block' : '' || Request::is('hotelsearchpage*') ? 'block' : '' || Request::is('transfersearchpage*') ? 'block' : '' || Request::is('actsearchpage*') ? 'block' : '' }}">
								<li class="nav-item"><a href="{{route('flightsearchpage.index')}}" class="nav-link {{ Request::is('flightsearchpage*') ? 'active' : '' }}">Flight Search Page</a></li>

								<li class="nav-item"><a href="{{route('hotelsearchpage.index')}}" class="nav-link {{ Request::is('hotelsearchpage*') ? 'active' : '' }}">Hotel Search Page</a></li>

								<li class="nav-item"><a href="{{route('transfersearchpage.index')}}" class="nav-link {{ Request::is('transfersearchpage*') ? 'active' : '' }}">Transfer Search Page</a></li>

								<li class="nav-item"><a href="{{route('actsearchpage.index')}}" class="nav-link {{ Request::is('actsearchpage*') ? 'active' : '' }}">Activity Search Page</a></li>

							</ul>
						</li>
						--}}
						<li class="nav-item nav-item-submenu {{ (Request::is('about_us*') ? 'nav-item-open' : '') || (Request::is('social_media*') ? 'nav-item-open' : '') || (Request::is('topDestination*') ? 'nav-item-open' : '') || (Request::is('topFlightt*') ? 'nav-item-open' : '')  }}">
							<a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span>Content Mangement</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Themes" style="display:">
								<li class="nav-item">
									<a href="{{route('social_media.index')}}" class="nav-link {{ Request::is('social_media*') ? 'active' : '' }}">
										Social Media
									</a>
								</li>

								<li class="nav-item">
									<a href="{{route('about_us.index')}}" class="nav-link {{ (Request::is('about_us*') ? 'active' : '') }}">About Us</a>
								</li>

								<li class="nav-item">
									<a href="{{route('contact_us.index')}}" class="nav-link {{ (Request::is('contact_us*') ? 'active' : '') }}">Contact Us</a>
								</li>

								<li class="nav-item">
									<a href="{{route('term_and_condition.index')}}" class="nav-link {{ (Request::is('term_and_condition*') ? 'active' : '') }}">Terms & Condition</a>
								</li>
								<li class="nav-item">
									<a href="{{route('privacy_and_policy.index')}}" class="nav-link {{ Request::is('privacy_and_policy*') ? 'active' : '' }}">Privacy & Policy</a>
								</li>
							</ul>
						</li>
						<!-- /main -->
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			


			<!-- Content area -->
			<div class="content">
				<div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul style="list-style-type: none;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif

                @if (session()->has('msg-success'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('msg-success') }}</div>
                @elseif (session()->has('msg-error'))
                <div class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('msg-error') }}
                </div>
                
                @endif
                

            </div>
				 @yield('content')
				
			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2015 - 2019. <a href="#">ZAIRAA</a>
					</span>

					<!-- <ul class="navbar-nav ml-lg-auto">
						<li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
						<li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
						<li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold"><span class="text-pink-400"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
					</ul> -->
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

<!-- Mirrored from demo.interface.club/limitless/demo/bs4/Template/layout_1/LTR/default/full/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 Feb 2019 10:30:23 GMT -->
	@stack('typeahead')
</html>
