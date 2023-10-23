
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
        @stack('css')
		<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/animate/animate.compat.css">
		<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/boxicons/css/boxicons.min.css" />
		<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="{{env('CSS_URL')}}/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{env('CSS_URL')}}/css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{env('CSS_URL')}}/css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{env('CSS_URL')}}/css/custom.css">

		<!-- Head Libs -->
		<script src="{{env('CSS_URL')}}/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo float-start">
					<img src="{{env('CSS_URL')}}/img/logo.png" height="70" alt="Porto Admin" />
				</a>



				<div class="panel card-sign">
					<div class="card-title-sign mt-3 text-end">
						<h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Sign In</h2>
					</div>
					<div class="card-body">
						<form action="{{'/user-signin'}}" method="post">
                            @csrf
                            @if (session('success'))
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                    @endif
							<div class="form-group mb-3">
								<label>Email</label>
								<div class="input-group">
									<input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-lg" />
									<span class="text-danger">@error('email')
                                        {{$message}}
                                    @enderror
                                    </span>
								</div>
							</div>

							<div class="form-group mb-3">
                                {{-- <div class="clearfix">
									<label >Password</label>
									<a href="{{'/signup'}}" class="float-end"> | Sign Up </a>
									<a href="{{'/forget-password'}}" class="float-end"> Lost Password?</a>
								</div> --}}
                                <label>Password</label>
								<div class="input-group">
									<input name="password" type="password" class="form-control form-control-lg" />
									<span class="text-danger">@error('password')
                                        {{$message}}
                                        @enderror
                                    </span>
								</div>
							</div>

							<div class="row">

								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary mt-2">Sign In</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-3 mb-3">Copyright @ 2023 - All Rights Reserved.. <a href="https://netgains.org" style="color:black;"> NETGAINS</a></p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="{{env('CSS_URL')}}/vendor/jquery/jquery.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/popper/umd/popper.min.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/common/common.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="{{env('CSS_URL')}}/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Specific Page Vendor -->

		<!-- Theme Base, Components and Settings -->
		<script src="{{env('CSS_URL')}}/js/theme.js"></script>

		<!-- Theme Custom -->
		<script src="{{env('CSS_URL')}}/js/custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="{{env('CSS_URL')}}/js/theme.init.js"></script>

	</body>
</html>
