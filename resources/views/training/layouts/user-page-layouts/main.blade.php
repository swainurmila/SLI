<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLI | Training</title>
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/bootstrap.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('user-assets/css/bootstrap.min.css')}}"> --}}
    <!-- include the site stylesheet -->

    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('user-assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('user-assets/css/fonts.css')}}">

    
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/main.css')}}">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{asset('user-assets/css/responsive.css')}}">
    <link rel="icon" class="text-white" href="{{asset('asset/images/favicon.png')}}">
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />


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

        /* .success-alert{
            background: #2b932b;
        }
        .error-alert{
            background: red;
        } */
        #snackbar {
            min-width: 250px;
            max-width: 450px;
            top: 13%;
            right: 0;
            /* color: #429340; */
            background: #f9f9f9;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            text-align: center;
            border-radius: 2px 0px 0px 2px;
            padding: 15px 20px;
            position: fixed;
            z-index: 99;
            font-size: 17px;
        }


        #snackbar.success-alert{
            color: #429340;
        }

        #snackbar.error-alert{
            color: red;
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
            .pagination {     
                margin: 20px 0;     
                padding: 0;     
                list-style: none;     
                text-align: center; } 
                .pagination li {     
                    display: inline-block;     
                    margin-right: 5px; } 
                    .pagination li a, .pagination li span {     color: #333;     padding: 6px 12px;     text-decoration: none;     border: 1px solid #ccc; } 
                    .pagination li.active span {     background-color: #007bff;     color: #fff;     border-color: #007bff; } 
                    .pagination li.disabled span {     color: #999; } 
                    .pagination li a:hover {     background-color: #f5f5f5; } .pagination .disabled span {     pointer-events: none;     cursor: default; }

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
        var snackbar = document.getElementById('snackbar');

        if (snackbar) {
            setTimeout(function () {
                snackbar.classList.add('hide');

                setTimeout(function () {
                    snackbar.classList.remove('show');
                }, 300);
            }, 3000);
        }
    });
    </script>
    

    @yield('script')

<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>



<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
</body>

</html>
