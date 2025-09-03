<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin | Research & Publication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="e-Course" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{ asset('asset/images/favicon.png') }}">
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>
        div#liveToast {
            position: absolute;
            top: 0;
            z-index: 9999;
            left: 268px;
            max-width: 345px;
            width: 100%;
            border-radius: 0 0 5px 5px;
            text-align: center;
            padding: 15px 20px;
            display: block;
        }

        div#liveToast h4 {
            margin: 0;
            font-size: 14px;
        }

        div#liveToast.success-box {
            background-color: #e6fdb4;
            border: 1px solid #bdde72;
        }

        div#liveToast.error-box {
            background-color: #fce4e4;
            border: 1px solid #fcc2c3;
        }

        div#liveToast h4.success-text {
            color: #179229;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 13px;
            font-weight: bold;
            line-height: 20px;
            text-shadow: 1px 1px rgba(250, 250, 250, .3);
        }

        div#liveToast h4.error-text {
            color: #cc0033;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 13px;
            font-weight: bold;
            line-height: 20px;
            text-shadow: 1px 1px rgba(250, 250, 250, .3);
        }
    </style>

    @yield('styles')



</head>

<body data-sidebar="colored">

    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="uil-shutter-alt spin-icon"></i>
            </div>
        </div>
    </div> --}}
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('research.layouts.header')
        @include('research.layouts.sidebar')
        <div class="main-content">
            <main class="">

                @if (session()->has('success'))
                    <div id="liveToast" class="success-box" role="alert" aria-live="assertive" aria-atomic="true">
                        <h4 class="success-text"> {{ session()->get('success') }}</h4>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div id="liveToast" class="error-box" role="alert" aria-live="assertive" aria-atomic="true">
                        <h4 class="error-text"> {{ session()->get('error') }}</h4>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @include('research.layouts.footer')


    @yield('script')


    <script>


        document.addEventListener('DOMContentLoaded', function() {
            var toastElement = document.getElementById('liveToast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
            setTimeout(function() {
                toast.hide();
            }, 8000);
        });


        $(document).ready(function() {


            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");

            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/.test(value);
            }, "Letters only please");

            $.validator.addMethod("contactNumber", function(value, element) {
                    return this.optional(element) ||
                        /^[6-8]\d{9}$/
                        .test(value);
                },
                "Please enter a valid contact number starting with 6, 7, or 8 and having 10 digits."
            );

            $.validator.addMethod("customEmailDomain", function(value, element) {
                    return this.optional(element) ||
                        /[a-zA-Z0-9.-]+\@(?:[a-zA-Z0-9-]+\.)+(com|org|net|ind|edu|gov|co|ac|uk|in)$/
                        .test(value);
                },
                "Please enter an email address with a domain of .com, .org, .net, .ind, .edu, .gov, .co, .ac, .uk, or .in"
            );





            $('.add_state_dropdown').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.get_city') }}",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('.district_dropdown').empty();
                        $(".district_dropdown").append('<option value="">Select District</option>');
                        $.each(result.city, function(key, value) {
                            $(".district_dropdown").append('<option value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
