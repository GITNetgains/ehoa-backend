<!doctype html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('assets/new-admin/vendor/bootstrap/css/bootstrap.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/new-admin/vendor/animate/animate.compat.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/new-admin/vendor/font-awesome/css/all.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/new-admin/vendor/boxicons/css/boxicons.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/new-admin/vendor/magnific-popup/magnific-popup.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/new-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{ asset('assets/new-admin/css/theme.css')}}" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="{{ asset('assets/new-admin/css/skins/default.css')}}" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="{{ asset('assets/new-admin/css/custom.css')}}">

	<!-- Head Libs -->
	<script src="{{ asset('assets/new-admin/vendor/modernizr/modernizr.js')}}"></script>

</head>

<body class="backvideo">

	<video id="background-video" autoplay="" loop="" muted="" src="{{asset('/public/animated-logo.mp4')}}" style="width: 100vw;height: 100vh;object-fit: cover;position: fixed;left: 0;right: 0;top: 0;bottom: 0;z-index: -1;opacity: 0.98;">
		<source src="{{asset('/public/animated-logo.mp4')}}" type="video/mp4">
	</video>

	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">
			<!-- <a href="/" class="logo float-left">
					<img src="{{ asset('assets/new-admin/img/logo.png')}}" height="70" alt="Porto Admin" />
				</a> -->

			<div class="panel card-sign">
				<div class="card-body">
					<form action="{{ route('reset.password.post') }}" method="post">
						@csrf
						@if (session('error'))
						<div class="alert alert-success">
							{{ session('error') }}
						</div>
						@endif
						<div class="form-group mb-3">
							<label>E-Mail</label>
							<div class="input-group">
								<input name="email" type="email" placeholder="E-mail" class="form-control form-control-lg" required />
								<span class="input-group-text">
									<i class="bx bx-user text-4"></i>
								</span>
							</div>
							@error('email')
							{{$message}}
							@enderror
						</div>
						<input type="hidden" name="token" value="{{ $token }}">
							
						<label>Password</label>
							<div class="input-group mb-3">
								<input name="password" type="password" class="form-control form-control-lg" />
								<span class="input-group-text">
									<i class="bx bx-lock text-4"></i>
								</span>
							</div>
							@error('password')
							{{$message}}
							@enderror
							<label>Confirm Password</label>
							<div class="input-group mb-3">
								<input name="password_confirmation" type="password" class="form-control form-control-lg" />
								<span class="input-group-text">
									<i class="bx bx-lock text-4"></i>
								</span>
							</div>
						<div class="row">
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary mt-2">Update Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- end: page -->

	<!-- Vendor -->
	<script src="{{ asset('assets/new-admin/vendor/jquery/jquery.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/popper/umd/popper.min.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/common/common.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/nanoscroller/nanoscroller.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
	<script src="{{ asset('assets/new-admin/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>

	<!-- Specific Page Vendor -->

	<!-- Theme Base, Components and Settings -->
	<script src="{{ asset('assets/new-admin/js/theme.js')}}"></script>

	<!-- Theme Custom -->
	<script src="{{ asset('assets/new-admin/js/custom.js')}}"></script>

	<!-- Theme Initialization Files -->
	<script src="{{ asset('assets/new-admin/js/theme.init.js')}}"></script>

</body>

</html>