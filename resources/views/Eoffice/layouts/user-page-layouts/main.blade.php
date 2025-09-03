<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLI | Training Course</title>
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/bootstrap.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('user-assets/css/bootstrap.min.css')}}"> --}}


    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/animate.css')}}">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/icon-fonts.css')}}">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/main.css')}}">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/responsive.css')}}">





    <style>
        .checkout-order {
            border: 2px solid #e1e1e1;
            padding: 40px;
        }
        .checkout-title .title {
            font-size: 24px;
            color: #131313;
            position: relative;
        }
        .checkout-title .title::after {
            content: "";
            width: 50px;
            display: block;
            margin-top: 10px;
            border-bottom-width: 2px;
            border-bottom-style: solid;
            border-color: inherit;
        }
        .checkout-order .table {
            margin-bottom: 0;
        }
        .checkout-order .table thead tr th {
            padding: 10px 0;
            border-top: 0;
            border-bottom: 1px solid #e1e1e1;
                border-bottom-color: rgb(225, 225, 225);
            font-weight: 400;
            font-size: 14px;
            color: #000;
            vertical-align: middle;
        }
        .checkout-order .table tbody tr:first-child td {
            padding-top: 20px;
        }
        .checkout-order .table tbody tr td {
            padding: 5px 0;
                padding-top: 5px;
            border-top: 0;
            vertical-align: middle;
        }
        .checkout-order .table tbody tr td p {
            font-weight: 400;
            font-size: 14px;
            color: #000;
        }
        .checkout-payment {
            margin-top: 30px;
        }
        .checkout-order ul {
        padding: 0;
        margin: 0;
        list-style: none;
        }
        .single-form .btn {
        height: 40px;
        line-height: 40px;
        padding: 0 35px;
        font-size: 15px;
        font-weight: 500;
        }
        .btn-custom {
        background-color: #2b932b;
        border-color: #2b932b;
        color: #ffffff !important;
        }
		.btn-secondary {
			background-color: #6e6f6e;
        	border-color: #6e6f6e;
        	color: #ffffff !important;	
			margin-left: 10px;
		}

		.modal-success{
			display: none;
		}
		 .modal {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: #565656b5;
			z-index: 99;
			overflow: hidden;
		}
		.modal-dialog {
			width: 80%;
			margin: auto;
			display: flex;
			align-content: center;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			text-align: center;
		}
		.modal-content {
			width: 52%;
			background: #fff;
			padding: 7rem;
			border-radius: 15px;
			margin: auto;
		} 
		@media screen and (max-width: 767px) {
			.modal-content {
			width: 100%;
			padding: 3rem;
			}
		}



        .success-alert{
            background: #2b932b;
        }
        .error-alert{
            background: red;
        }
        #snackbar {
            min-width: 250px;
            margin-left: -125px;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 92%;
            /* bottom: 30px; */
            font-size: 17px;
            }

            #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }

            @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
            }

            @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
            }

            @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;} 
            to {bottom: 0; opacity: 0;}
            }

            @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
            }
            .hide{
                display: none
            }

    </style>

    @yield('styles')
</head>

<body>
    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- Page Loader -->
        <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="{{asset('user-assets/images/svg/rings.svg')}}" alt="loader">
            </div>
        </div>

        
        <!-- W1 start here -->
        <div class="w1">
            @include('training.layouts.user-page-layouts.header')
            <main id="mt-main">

                @if (session('success'))
                <div id="snackbar" class="success-alert">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div id="snackbar" class="error-alert">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
            @include('training.layouts.user-page-layouts.footer')

        </div><!-- W1 end here -->
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>

    <!-- include jQuery -->
    <script src="{{asset('user-assets/js/jquery.js')}}"></script>

    <script src="{{asset('user-assets/js/jquery.validate.min.js')}}"></script>
    <!-- include jQuery -->
    <script src="{{asset('user-assets/js/plugins.js')}}"></script>
    <!-- include jQuery -->
    <script src="{{asset('user-assets/js/jquery.main.js')}}"></script>

    
    <script>

    function closeSnackbar() {
        var x = document.getElementById("snackbar");
        if (x.classList.contains("show")) {
            x.classList.remove("show");
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Select the snackbar element
        var snackbar = document.getElementById('snackbar');

        // If the snackbar element is present, set a timeout to hide it after 3000 milliseconds
        if (snackbar) {
            setTimeout(function () {
                // Add a class to hide the snackbar
                snackbar.classList.add('hide');

                // Optional: Remove the 'show' class after a short delay for smooth animation
                setTimeout(function () {
                    snackbar.classList.remove('show');
                }, 300);
            }, 3000);
        }
    });
    </script>
    

    @yield('script')
</body>

</html>
