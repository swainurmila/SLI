<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Finance Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/style.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" class="text-white" href="{{ asset('asset/images/favicon.png') }}">


    <style>
        .login-header {
            background: linear-gradient(90deg, #f7ffbf 0%, #3ea82e 100%);
            max-height: 90px;
            height: 100vh;
            position: relative;
            top: 0rem;
            z-index: 999;
        }
    
        a.login-header-left {
            display: inline-flex;
            align-items: center;
            padding-top: 15px;
        }
    
        .login-header-left img {
            height: 60px;
            filter: grayscale(1);
        }
    
        .login-header-right {
            display: flex;
            align-items: center;
            justify-content: right;
        }
    
        .login-header-right h5 {
            margin: 0 0.5rem 0 0;
        }
    
        .login-header-right h5 span {
            display: block;
            font-size: 13px;
            line-height: 20px;
        }
    
        .login-header-right img {
            height: 90px;
          
        }
    
        .authentication-bg {
            object-fit: cover;
            object-position: center;
            background-image: url({{ asset('assets/images/e-office-back.png') }});
        }
    </style>
</head>


<body class="authentication-bg">


    <div class="container-fluid login-header">
        <div class="row">
            <div class="col-lg-7">
                <a href="" class="login-header-left">
                    <img src="{{ asset('user-assets/images/sli.png') }}" class="img-fluid">
                </a>
            </div>
            {{-- <div class="col-lg-5">
                <div class="login-header-right">
                    <h5>Shri. Mohan Charan Majhi <span>Hon'ble Chief Minister</span></h5>
                    <img src="{{ asset('user-assets/images/new_cm.png') }}" class="img-fluid">
                </div>
            </div> --}}
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-end mt-5">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- <div class="account-pages my-3">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h2 class="text-custom-primary fw-bold">e-Office</h2>
                                <h5 class="text-dark">Join Us !</h5>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="p-2 mt-4">
                                @yield('content')

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div> --}}

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });

        $('#paddress').click(function() {
            if ($('#paddress').is(':checked')) {
                let pre_add = $('#present_add').val();
                $('#permanent_add').val(pre_add);
            } else {
                $('#permanent_add').val('');
            }
        });
        $('#state_dropdown').on('change', function() {
            //alert(123);
            var state_id = this.value;
            //alert(state_id);
            $.ajax({
                url: "{{ url('/get_city') }}",
                type: "get",
                data: {
                    state_id: state_id,
                },
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                dataType: 'json',
                success: function(result) {
                    console.log(result)
                    $('#district_dropdown').empty();
                    $.each(result.city, function(key, value) {
                        $("#district_dropdown").append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>

    @yield('script')
</body>

</html>