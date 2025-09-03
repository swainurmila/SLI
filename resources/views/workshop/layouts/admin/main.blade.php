<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | e-workshop - Workshop Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" class="text-white" href="{{ asset('asset/images/favicon.png') }}">

</head>
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
        height: 80px;
        margin-top: 10px;
    }

    .authentication-bg {
        object-fit: cover;
        object-position: center;
        background-image: url({{ asset('assets/images/bg-02.jpg') }});
    }
</style>

<body class="authentication-bg">
    <div class="account-pages">
        <div class="container-fluid login-header">
            <div class="row">
                <div class="col-lg-7">
                    <a href="" class="login-header-left">
                        <img src="{{ asset('user-assets/images/sli.png') }}" class="img-fluid">
                    </a>
                </div>
                <div class="col-lg-5">
                    <div class="login-header-right">
                    {{-- <h5>Shri. Naveen Patnaik <span>Hon'ble Chief Minister</span></h5>
                    <img src="{{asset('user-assets/images/cm.png')}}" class="img-fluid"> --}}
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-end mt-5">
                    @yield('content')
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>


        <script>
            $(document).ready(function() {
                $(".select2").select2();
            });
            $(document).ready(function() {


                $.validator.addMethod("noSpace", function(value, element) {
                    return value.trim().length !== 0;
                }, "Field cannot contain only spaces");
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
                        $("#district_dropdown").append('<option>' + 'Select District' + '</option>');
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
