<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>e-Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="e-Training" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('eoffice/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('eoffice/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('eoffice/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('eoffice/assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('eoffice/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('eoffice/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('eoffice/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <style>
        .view-file-doc i {
            font-size: 50px;
            color: #279242;
        }

        .form-select {
            color: black;
        }

        .form-control {
            color: black;
        }


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
        @include('Eoffice.admin.layouts.page-layouts.header')
        @include('Eoffice.admin.layouts.page-layouts.sidebar')
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
    @include('Eoffice.admin.layouts.page-layouts.footer')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElement = document.getElementById('liveToast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
            setTimeout(function() {
                toast.hide();
            }, 8000);
        });


        $('.add_state_dropdown').on('change', function() {
            var state_id = this.value;
            $.ajax({
                type: 'get',
                url: "{{ route('get_city') }}",
                data: {
                    state_id: state_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    $('.district_dropdown').empty();
                    $(".district_dropdown").append('<option value="">' + "Select District" +
                        '</option>');
                    $.each(result.city, function(key, value) {
                        $(".district_dropdown").append('<option value="' + value
                            .id +
                            '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>



    @yield('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script> --}}

</body>

</html>
