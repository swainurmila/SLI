<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLI | Online Exam</title>
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{ asset('user-assets/css/bootstrap.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('user-assets/css/bootstrap.min.css')}}"> --}}
    <!-- include the site stylesheet -->

    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{ asset('user-assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('user-assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user-assets/css/fonts.css') }}">


    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{ asset('user-assets/css/main.css') }}">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="{{ asset('user-assets/css/responsive.css') }}">
    <link rel="icon" class="text-white" href="{{ asset('asset/images/favicon.png') }}">


    <style>
        .exam-tab-warning {
            color: white;
            background: #b31f1f;
            padding: 4px;
            border-radius: 5px;
        }

        /* Count Down  */
        .CountDown {
            position: fixed;
            left: 0;
            top: 0;
            background: #031132b8;
            height: 100vh;
            width: 100vw;
            z-index: 9999;
            display: flex;
            /* display: none; */
            justify-content: center;
            align-items: center;
        }

        .CountDown .CDcard {
            height: 200px;
            width: 400px;
            background: #fff;
            color: rgb(0, 15, 44);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
            border-radius: 10px;
            border: 1px solid #f00;
        }

        .CountDown .CDcard h3 {
            font-weight: bold;
        }

        .CountDown .CDcard #countdown {
            font-size: 45px;
            color: #f00;
            font-weight: bold;
        }

        /* Count Down Ends */


        /* Exam Timer */
        #exam-timer {
            color: white;
            padding: 10px;
            display: inline-block;
            background: #61cd5e;
            border-radius: 20px;
        }

        /* === */


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

        .modal-success {
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



        .success-alert {
            background: #2b932b;
        }

        .error-alert {
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
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .hide {
            display: none
        }

        .pagination {
            margin: 20px 0;
            padding: 0;
            list-style: none;
            text-align: center;
        }

        .pagination li {
            display: inline-block;
            margin-right: 5px;
        }

        .pagination li a,
        .pagination li span {
            color: #333;
            padding: 6px 12px;
            text-decoration: none;
            border: 1px solid #ccc;
        }

        .pagination li.active span {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination li.disabled span {
            color: #999;
        }

        .pagination li a:hover {
            background-color: #f5f5f5;
        }

        .pagination .disabled span {
            pointer-events: none;
            cursor: default;
        }



        .panel-tab {
            float: left;
            width: 50%;
            padding: 15px 15px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #fff;
            background: rgb(63, 114, 251);
            background: #0B4D8B;
        }

        .panel-tab-full {
            width: 100%;
        }

        .panel {
            border-radius: 45px;
            box-shadow: 3px 3px 10px #888888;
            border: 1px solid #0155ad !important;
            width: -webkit-fill-available;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #61cd5e;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
            width: 10px;
        }


        .hot-news {
            display: flex;
            width: 100%;
            align-items: center;
            /* flex-flow: row wrap; */
            margin: 0px 0px;
            box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
            justify-content: space-between;
            border: 0px solid #55cb94;
            /* border-left: none; */
            /* border-right: none; */
            background-color: #000;
        }

        .left_head {
            width: 20%;
            background: #5ba903;
            padding: 10px 10px;
            text-align: center;
            color: #fff;
            text-transform: capitalize;
        }

        .right_marq {
            width: 87%;
            line-height: inherit;
        }

        .apply-now {
            /* -webkit-animation: pulse 400ms infinite alternate; */
            animation: pulse 400ms infinite alternate;
            cursor: pointer;
            padding: 2px 8px;
            width: 50px;
            border-radius: 12px;
            font-size: 12px;
            margin-left: 14px;
            /* font-weight: 600; */
            color: #fff;
            text-align: center;
            height: 19px;
            line-height: 14px;
            background-color: #a50000;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        ul li {
            list-style: none;
        }

        .question {
            display: flex;
            align-items: center;
            gap: 35px;
        }

        .sub-question {
            display: flex;
            align-items: center;
        }

        textarea {
            display: block;
        }
        @media (max-width: 768px){
            .question{
                display: contents;
            }
        }
        @media (max-width: 991px){
            .examImg{
                display: none!important;
            }
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
                <img src="{{ asset('user-assets/images/svg/rings.svg') }}" alt="loader">
            </div>
        </div>


        <!-- W1 start here -->
        <div class="w1">
            <header id="mt-header" class="style4">
                <div class="mt-bottom-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="mt-logo"><a href="#"><img
                                            src="{{ asset('user-assets/images/SLI -logo.png') }}" alt="logo"></a>
                                </div>
                                <nav id="nav">
                                    <ul class="">
                                        <li class="cart-btn-row">
                                            <p class="exam-tab-warning">* Don't close the tab otherwise you loss the
                                                exam</p>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="mt-side-over"></span>
            </header>
            <main id="mt-main">

                @if (session('success'))
                    <div id="snackbar" class="success-alert">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div id="snackbar" class="error-alert">{{ session('error') }}</div>
                @endif
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="dashboard__content__wraper">
                        <div class="dashboard__section__title">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>

        </div><!-- W1 end here -->
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>

    <!-- include jQuery -->
    <script src="{{ asset('user-assets/js/jquery.js') }}"></script>

    <script src="{{ asset('user-assets/js/jquery.validate.min.js') }}"></script>
    <!-- include jQuery -->
    <script src="{{ asset('user-assets/js/plugins.js') }}"></script>
    <!-- include jQuery -->
    <script src="{{ asset('user-assets/js/jquery.main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function closeSnackbar() {
            var x = document.getElementById("snackbar");
            if (x.classList.contains("show")) {
                x.classList.remove("show");
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var snackbar = document.getElementById('snackbar');
            if (snackbar) {
                setTimeout(function() {
                    snackbar.classList.add('hide');
                    setTimeout(function() {
                        snackbar.classList.remove('show');
                    }, 300);
                }, 3000);
            }
        });
    </script>


    @yield('script')


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>
</body>

</html>
