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

</head>

<body>

	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">
			<!-- <a href="/" class="logo float-left">
					<img src="{{ env('CSS_URL')}}/img/logo.png')}}" height="70" alt="Porto Admin" />
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
<script src="{{env('CSS_URL')}}/vendor/jquery-ui/jquery-ui.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jquery-appear/jquery.appear.js"></script>
<script src="{{env('CSS_URL')}}/vendor/bootstrapv5-multiselect/js/bootstrap-multiselect.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jquery.easy-pie-chart/jquery.easypiechart.js"></script>
<script src="{{env('CSS_URL')}}/vendor/flot/jquery.flot.js"></script>
<script src="{{env('CSS_URL')}}/vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
<script src="{{env('CSS_URL')}}/vendor/flot/jquery.flot.pie.js"></script>
<script src="{{env('CSS_URL')}}/vendor/flot/jquery.flot.categories.js"></script>
<script src="{{env('CSS_URL')}}/vendor/flot/jquery.flot.resize.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{env('CSS_URL')}}/vendor/raphael/raphael.js"></script>
<script src="{{env('CSS_URL')}}/vendor/morris/morris.js"></script>
<script src="{{env('CSS_URL')}}/vendor/gauge/gauge.js"></script>
<script src="{{env('CSS_URL')}}/vendor/snap.svg/snap.svg.js"></script>
<script src="{{env('CSS_URL')}}/vendor/liquid-meter/liquid.meter.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/jquery.vmap.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/jquery.min.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/js/bootstrap.min.js"></script>
<script src="{{env('CSS_URL')}}/vendor/jqvmap/maps/continents/js/bootstrap-multiselect.js"></script>
<!-- Theme Base, Components and Settings -->
<script src="{{env('CSS_URL')}}/js/theme.js"></script>

<!-- Theme Custom -->
<script src="{{env('CSS_URL')}}/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="{{env('CSS_URL')}}/js/theme.init.js"></script>

<!-- Examples -->
<script src="{{env('CSS_URL')}}/js/examples/examples.dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</body>

</html>