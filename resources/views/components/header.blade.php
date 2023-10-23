<!doctype html>

<html class="fixed">



<head>



	<!-- Basic -->

	<meta charset="UTF-8">



	<title>Ehoa-{{$titletext}}</title>





	@section('title') {{'Page Title Goes Here'}} @endsection

	<meta name="keywords" content="Ehoa App" />

	<meta name="description" content="Ehoa App">

	<meta name="author" content="Ehoa App">



	<!-- Mobile Metas -->

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />



	<!-- Web Fonts  -->

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"

		rel="stylesheet" type="text/css">

		<link href="{{env('CSS_URL')}}/vendor/bootstrap.min.css" rel="stylesheet"/>

	

		<link href="{{env('CSS_URL')}}/vendor/bootstrap-multiselect.css" rel="stylesheet"/>

		

	<!-- Vendor CSS -->

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/bootstrap/css/bootstrap.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/animate/animate.compat.css">

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/font-awesome/css/all.min.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/boxicons/css/boxicons.min.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/magnific-popup/magnific-popup.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/jquery-ui/jquery-ui.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/jquery-ui/jquery-ui.theme.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />

	<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/morris/morris.css" />



	<!-- Theme CSS -->

	<link rel="stylesheet" href="{{env('CSS_URL')}}/css/theme.css" />



	<!-- Skin CSS -->

	<link rel="stylesheet" href="{{env('CSS_URL')}}/css/skins/default.css" />



	<!-- Theme Custom CSS -->

	<link rel="stylesheet" href="{{env('CSS_URL')}}/css/custom.css">



	<!-- Head Libs -->

	<script src="{{env('CSS_URL')}}/vendor/modernizr/modernizr.js"></script>



	<!-- boootstrap css  -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <style>

			.frz:focus{

				outline:none;

			}

		</style>

</head>



<body>

	<section class="body">

		<!-- start: header -->





			<!-- start: search & user box -->

			<!-- {{-- <div class="header-right">

				<div id="userbox" class="userbox">

					<a href="#" data-bs-toggle="dropdown">

						<figure class="profile-picture">

							<img src="{{env('CSS_URL')}}/img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle"

								data-lock-picture="img/!logged-user.jpg" />

						</figure>

						<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">

							<span class="name">{{ auth()->user()->usersname }}</span>

							<span class="role">

								@if(auth()->user()->type==4)

								<?php echo 'Administrator' ?>

								@elseif(auth()->user()->type==3)

								<?php echo 'Agent' ?>

								@elseif(auth()->user()->type==2)

								<?php echo 'Super Admin' ?>

								@else

								<?php echo 'Admin' ?>

								@endif

							</span>

						</div>



						<i class="fa custom-caret"></i>

					</a>



					<div class="dropdown-menu">

						<ul class="list-unstyled mb-2">

							<li class="divider"></li>

							<li>

								<a role="menuitem" tabindex="-1" href="{{'/signout'}}"><i

										class="bx bx-power-off"></i> Logout</a>

							</li>

						</ul>

					</div>

				</div>

			</div> --}} -->

			<!-- end: search & user box -->

            

            

            

            <header class="header">

				<div class="logo-container">

					<a  href="{{'/admin/dashboard'}}" class="logo d-block d-sm-none">

						<img src="https://wahine.netgains.org/public/template/img/ehoa.png" width="85" height="55" alt=" Ehoa" />

					</a>



					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">

						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>

					</div>



				</div>



				<!-- start: search & user box -->

				

				<!-- end: search & user box -->

			</header>

            

            



		<!-- end: header -->



		<div class="inner-wrapper">

			<!-- start: sidebar -->

			<aside id="sidebar-left" class="sidebar-left">



				<div class="sidebar-header">

					<div class="sidebar-title">

						Navigation

					</div>

					<div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed"

						data-target="html" data-fire-event="sidebar-left-toggle">

						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>

					</div>

				</div>



				<!-- side navbars start  -->

				<div class="nano">

					<div class="nano-content">

						<nav id="menu" class="nav-main" role="navigation">



							<ul class="nav nav-main">

							<li>

									<a class="nav-link" href="{{'/admin/dashboard'}}">

										<i class="fas fa-home" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Dashboard</span>

									</a>

								</li>

								<li class="nav-parent {{ Route::is('package') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fas fa-database" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Packages</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('package') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/package'}}">

												Create Package

											</a>

										</li>

										

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('package') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/list-all-packages'}}">

											 List Packages

											</a>

										</li>

										

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('package') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/archived-package'}}">

											 Archived Packages

											</a>

										</li>

										

									</ul>

									

								</li>

								<li class="nav-parent {{ Route::is('order') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa fa-shopping-cart" aria-hidden="true" style="color: #ffffff;"></i>

									

										<span>Orders </span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('order') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/order/orders'}}">

												Orders Details

											</a>

										</li>

										

									</ul>

								

									

								</li>

								

								

							

                                <li class="nav-parent {{ Route::is('category') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fas fa-list-alt" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Categories</span>

									</a>



                                   

                                    <ul class="nav nav-children">

                                        <li  class="{{ Route::is('category') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/n-create-category'}}">

										Create Category

											</a>

										</li>

                                    </ul>

									<ul class="nav nav-children">

										<li  class="{{ Route::is('category') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/n-list-category'}}">

										List Category

											</a>

										</li>

                                    </ul>

                                    <ul class="nav nav-children">

										<li class="{{ Route::is('category') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/archived-category'}}">

										Archived Category

											</a>

										</li>

                                    </ul>

								</li>

								<li class="nav-parent {{ Route::is('tip') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-solid fa-t" style="color: #ffffff;"></i>

										<span>Tips</span>

									</a>

									<ul class="nav nav-children">

										<li  class="{{ Route::is('tip') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/tips-create'}}">

												Create Tips

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li  class="{{ Route::is('tip') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/list-all-tips'}}">

												List Tips

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li   class="{{ Route::is('tip') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/archived-tips'}}">

												Archived Tips

											</a>

										</li>

									</ul>

								</li>

								{{-- <li class="nav-parent">

									<a class="nav-link" href="#">

										<i class="fa-regular fa-person-walking" style="color: #ffffff;"></i>

										{{-- <i class="fas fa-gift" aria-hidden="true"></i> --}}

										{{-- <span>Yoga</span>

									</a>

									<ul class="nav nav-children">

										<li>

											<a class="nav-link" href="{{'/admin/yoga-create'}}">

												Create Yogas

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li>

											<a class="nav-link" href="{{'/admin/list-all-yogas'}}">

												List Yogas

											</a>

										</li>

									</ul>

								</li> --}} 

								<li class="nav-parent {{ Route::is('video') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-solid fa-video" style="color: #ffffff;"></i>

										{{-- <i class="fas fa-gift" aria-hidden="true"></i> --}}

										<span>Video</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('video') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/videos-create'}}">

												Create Video

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('video') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/list-all-videos'}}">

												List Video

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('video') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/admin/archived-video'}}">

												Archived Video

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('podcast') ? 'nav-expanded' : '' }} ">

									<a class="nav-link" href="#">

										<i class="fa-sharp fa-solid fa-podcast" style="color: #ffffff;"></i>

										{{-- <i class="fas fa-gift" aria-hidden="true"></i> --}}

										<span>Podcast</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('podcast') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/admin/podcast-create'}}">

												Create Podcast

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('podcast') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/admin/list-all-podcast'}}">

												List Podcast

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('podcast') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/admin/archived-podcast'}}">

												Archived Podcast

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent  {{ Route::is('blog') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fas fa-solid fa-blog" style="color: #ffffff;"></i>

										{{-- <i class="fas fa-gift" aria-hidden="true"></i> --}}

										<span>Blogs</span>

									</a>

									<ul class="nav nav-children">

										<li {{ Route::is('blog') ? 'nav-active' : '' }} >

											<a class="nav-link" href="{{'/admin/create-blog'}}">

												Create Blogs

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li {{ Route::is('blog') ? 'nav-active' : '' }} >

											<a class="nav-link" href="{{'/admin/get-list-blog'}}">

												List Blogs

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li  {{ Route::is('blog') ? 'nav-active' : '' }}>

											<a class="nav-link" href="{{'/admin/archived-blog'}}">

												Archived Blogs

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent  {{ Route::is('menstrual') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-solid fa-droplet" style="color: #ffffff;"></i>

										{{-- <i class="fas fa-gift" aria-hidden="true"></i> --}}

										<span>Menstrual Flow</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('menstrual') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/disorder/menstrual-create/menstrual'}}">

												Menstrual Flow Create

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('menstrual') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/disorder/list-menstrual'}}">

												Menstrual Flow List 

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('menstrual') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/disorder/archived-menstrual'}}">

											 Archived Menstrual Flow List 

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('symptoms') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-sharp fa-solid fa-s" style="color: #ffffff;"></i>

										{{-- <i class="fas fa-gift" aria-hidden="true"></i> --}}

										<span>Symptoms</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('symptoms') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/disorder/symptoms-create/symptoms'}}">

												Symptoms Create

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li  class="{{ Route::is('symptoms') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/disorder/list-symtoms'}}">

												Symptoms List 

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('symptoms') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/disorder/archived-symtoms'}}">

											Archived Symptoms 

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('emotions') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-sharp fa-solid fa-face-smile" style="color: #ffffff;"></i>

										<span>Emotions </span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('emotions') ? 'nav-active' : '' }}"  >

											<a class="nav-link" href="{{'/disorder/emotions-create/emotions'}}">

												Emotions  Create

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('emotions') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/disorder/list-emotions'}}">

												Emotions  List 

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('emotions') ? 'nav-active' : '' }}" >

											<a class="nav-link" href="{{'/disorder/archived'}}">

												Archived Emotions

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('energy') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-solid fa-bolt" style="color: #ffffff;"></i>

										<span>Energy</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('energy') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/disorder/energy-create/energy'}}">

												Energy  Create

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('energy') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/disorder/list-energy'}}">

												Energy  List 

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('energy') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/disorder/archived-energy'}}">

												Archived Energy  

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('moon') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa-solid fa-moon" style="color: #ffffff;"></i>

										<span>Moon Phase</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('moon') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/disorder/moonphase-create'}}">

												Moon Phase  Create

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('moon') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/disorder/list-all-moonphase'}}">

												Moon Phase List 

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('moon') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/disorder/archived-moonphase'}}">

											Archived Moon Phase  

											</a>

										</li>

									</ul>

								</li>

							

                                <li class="nav-parent {{ Route::is('user') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fas fa-user" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Users</span>

									</a>

									<ul class="nav nav-children">

										<li  class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/all-users-list'}}">

												Users list

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/archived-user'}}">

												Archived Users 

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/groups/group-create'}}">

												Users Group

											</a>

										</li>

										

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/groups/list-all-groups'}}">

												List Users Groups

											</a>

										</li>

										

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/groups/archived-groups'}}">

												Archived List Users Groups

											</a>

										</li>

										

									</ul>
									<ul class="nav nav-children Admin-userss">

										<li class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/admin-user'}}">

												Admin Users List

											</a>

										</li>

										<li class="{{ Route::is('user') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/admin/add-admin-user'}}">

												Add new Admin Users

											</a>

										</li>



									</ul>

									

								</li>

                                <li class="nav-parent {{ Route::is('coupon') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fas fa-gift" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Coupons</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('coupon') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/coupens/coupens-create'}}">

												Create Coupons

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('coupon') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/coupens/list-all-coupons'}}">

												List Coupons

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('coupon') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/coupens/archived-coupons'}}">

												Archived Coupons

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('notification') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fa fa-bell" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Notifications</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('notification') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/notifications/push-notifications'}}">

												Create Notification

											</a>

										</li></ul>

										<ul class="nav nav-children">

										<li class="{{ Route::is('notification') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/notifications/list-all-notifications'}}">

												List Notification

											</a>

										</li>

									</ul>

									<ul class="nav nav-children">

										<li class="{{ Route::is('notification') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/notification/archived-notifi'}}">

												Archived Notifications

											</a>

										</li>

									</ul>

								</li>

								<li class="nav-parent {{ Route::is('country') ? 'nav-expanded' : '' }} ">

									<a class="nav-link" href="#" >

										<i class="fa fa-flag" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Country</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('country') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/country/country-create'}}">

												Create Country

											</a>

										</li></ul>

										<ul class="nav nav-children">

										<li class="{{ Route::is('country') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/country/country-list'}}">

												List Country

											</a>

										</li>



									</ul>

								</li>

								<li class="nav-parent {{ Route::is('language') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#" >

									

										<i class="fa fa-language" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Languages</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('language') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/language/language-create'}}">

												Create Language

											</a>

										</li></ul>

										<ul class="nav nav-children">

										<li class="{{ Route::is('language') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/language/language-list'}}">

												List Language

											</a>

										</li>



									</ul>

								</li>

								<li class="nav-parent  {{ Route::is('editior') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#" >

										<i class="fa-solid fa-code" style="color: #ffffff;"></i>

										<span>Editior</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('editior') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/editior/editior-create'}}">

												Create CMS

											</a>

										</li></ul>

										<ul class="nav nav-children">

											<li class="{{ Route::is('editior') ? 'nav-active' : '' }}">

												<a class="nav-link" href="{{'/editior/list-editior'}}">

													List CMS

												</a>

											</li></ul>

								</li>

								{{-- <li class="nav-parent">

									<a class="nav-link" href="#" >

										<i class="fa-solid fa-person-half-dress" style="color: #ffffff;"></i>

										<span>Pronoun</span>

									</a>

									<ul class="nav nav-children">

										<li>

											<a class="nav-link" href="{{'/pronoun/pronoun-create'}}">

												Create Pronoun

											</a>

										</li></ul>

								</li> --}}

                                <li class="nav-parent  {{ Route::is('setting') ? 'nav-expanded' : '' }}">

									<a class="nav-link" href="#">

										<i class="fas fa-cog" aria-hidden="true" style="color: #ffffff;"></i>

										<span>Settings</span>

									</a>

									<ul class="nav nav-children">

										<li class="{{ Route::is('setting') ? 'nav-active' : '' }}">

											<a class="nav-link" href="{{'/setting/upload-setting'}}">

												Uploads  Settings

											</a>

										</li>



									</ul>

								</li>

								{{-- <li>

									<a class="nav-link" href="{{'/reset'}}">

										<i class="fas fa-user-lock" aria-hidden="true"></i>

										<span>Reset Password</span>

									</a>

								</li> --}}

								<li >

									<a class="nav-link" href="{{'/signout'}}">

										<i class="bx bx-power-off" style="color: #ffffff;"></i>

										<span>Log Out</span>

									</a>

								</li>

							</nav>

							<img src="{{env('CSS_URL')}}/img/ehoa.png"   alt="" class="logoimg" />

					</div>



					<script>

						// Maintain Scroll Position

						if (typeof localStorage !== 'undefined') {

							if (localStorage.getItem('sidebar-left-position') !== null) {

								var initialPosition = localStorage.getItem('sidebar-left-position'),

									sidebarLeft = document.querySelector('#sidebar-left .nano-content');



								sidebarLeft.scrollTop = initialPosition;

							}

						}

					</script>



				</div>

				<!-- end sidebar  -->

			</aside>

			<!-- end: sidebar -->

