<aside id="sidebar-right" class="sidebar-right">
	<div class="nano">
		<div class="nano-content">
			<a href="#" class="mobile-close d-md-none">
				Collapse <i class="fas fa-chevron-right"></i>
			</a>

			<div class="sidebar-right-wrapper">

				<div class="sidebar-widget widget-calendar">
					<h6>Upcoming Tasks</h6>
					<div data-plugin-datepicker data-plugin-skin="dark"></div>

					<ul>
						<li>
							<time datetime="2021-04-19T00:00+00:00">04/19/2021</time>
							<span>Company Meeting</span>
						</li>
					</ul>
				</div>

				<div class="sidebar-widget widget-friends">
					<h6>Friends</h6>
					<ul>
						<li class="status-online">
							<figure class="profile-picture">
								<img src="{{env('CSS_URL')}}/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
							</figure>
							<div class="profile-info">
								<span class="name">Joseph Doe Junior</span>
								<span class="title">Hey, how are you?</span>
							</div>
						</li>
						<li class="status-online">
							<figure class="profile-picture">
								<img src="{{env('CSS_URL')}}/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
							</figure>
							<div class="profile-info">
								<span class="name">Joseph Doe Junior</span>
								<span class="title">Hey, how are you?</span>
							</div>
						</li>
						<li class="status-offline">
							<figure class="profile-picture">
								<img src="{{env('CSS_URL')}}/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
							</figure>
							<div class="profile-info">
								<span class="name">Joseph Doe Junior</span>
								<span class="title">Hey, how are you?</span>
							</div>
						</li>
						<li class="status-offline">
							<figure class="profile-picture">
								<img src="{{env('CSS_URL')}}/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
							</figure>
							<div class="profile-info">
								<span class="name">Joseph Doe Junior</span>
								<span class="title">Hey, how are you?</span>
							</div>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</div>
</aside>

</section>
<script>
function userDetails(id){
// alert('okk');
    $('.list').html='';
    $('.list').load('/admin/user-all-details/'+id);
    $('.mytutremcls').show();
    $('.list').show();
    $('.mytutremcls').css("display:block");
}
</script>

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
