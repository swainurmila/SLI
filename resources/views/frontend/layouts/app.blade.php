<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- For Window Tab Color -->
		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#061948">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#061948">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#061948">
		<title>SLI-State Labour Institute</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="{{asset('sli_assets/images/fav-icon/icon-seal.png')}}">
		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('sli_assets/css/style.css')}}">
		<!-- responsive style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('sli_assets/css/responsive.css')}}">
		<!-- custom style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('sli_assets/css/custom.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('sli_assets/vendor/datagrid/datatables/datatables.min.css')}}">
		<!-- Fix Internet Explorer ______________________________________-->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->	
	</head>

	<body>
		<div class="main-page-wrapper">

			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="loader-wrapper">
				<div id="loader"></div>
			</div>

			{{-- <section class="header-topbar-sec">
				<div class="container-fluid">
				  	<div class="row">
						<div class="col-xl-12 col-lg-12">
					  		<div class="topbar-right-link">
								<div class="topbar-phone">
									<i class="flaticon-phone-receiver"></i>
									<a href=""> 0674-2395275</a> 
								</div>
								<div class="gigw-comp">
									<span class="sizechanger">
										<a id="btn-decrease" class="changer" onclick="set_font_size('decrease')" href="javascript:void(0)" title="Decrease font size">-A</a>
										<a id="btn-orig" class="changer" onclick="set_font_size('')" href="javascript:void(0)" title="Reset font size">A</a>
										<a id="btn-increase" class="changer" onclick="set_font_size('increase')" href="javascript:void(0)" title="Increase font size">+A</a>
									</span>
									<span class="colorchanger">
										<a href="javascript:void(0)" class="normalbg" title="Normal Contrast">A</a>
										<a href="javascript:void(0)" class="blackbg" title="High Contrast">A</a>
									</span>
									<a href="{{$switchLanguageUrl }}" class="alink" id="switch-lang" rel="">{{app()->getLocale() == 'en' ? "Odia" : "English"}}</a>
								</div>
			
					  		</div>
						</div>
				  	</div>
				</div>
			</section> --}}
            @include('frontend.layouts.header')

           
			


            

			

            @yield('content')


            @include('frontend.layouts.footer')


			
			


			
			
			


		<!-- Optional JavaScript _____________________________  -->

    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<!-- jQuery -->
		<script src="{{asset('sli_assets/vendor/jquery.2.2.3.min.js')}}"></script>
		<!-- Popper js -->
		<script src="{{asset('sli_assets/vendor/popper.js/popper.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{asset('sli_assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<!-- Camera Slider -->
		<script src="{{asset('sli_assets/vendor/Camera-master/scripts/jquery.mobile.customized.min.js')}}"></script>
	    <script src="{{asset('sli_assets/vendor/Camera-master/scripts/jquery.easing.1.3.js')}}"></script>
	    <script src="{{asset('sli_assets/vendor/Camera-master/scripts/camera.min.js')}}"></script>
	    <!-- menu  -->
		<script src="{{asset('sli_assets/vendor/menu/src/js/jquery.slimmenu.js')}}"></script>
		<!-- WOW js -->
		<script src="{{asset('sli_assets/vendor/WOW-master/dist/wow.min.js')}}"></script>
		<!-- owl.carousel -->
		<script src="{{asset('sli_assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
		<!-- js count to -->
		<script src="{{asset('sli_assets/vendor/jquery.appear.js')}}"></script>
		<script src="{{asset('sli_assets/vendor/jquery.countTo.js')}}"></script>
		<!-- Fancybox -->
		<script src="{{asset('sli_assets/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>
		
		<script src="{{ asset('sli_assets/vendor/datagrid/datatables/datatables.min.js') }}"></script>

		<!-- Theme js -->
		<script src="{{asset('sli_assets/js/theme.js')}}"></script>

		<script src="{{asset('sli_assets/js/letter-inc-desc.js')}}"></script>
		@yield('js')
		</div> <!-- /.main-page-wrapper -->
	</body>
</html>