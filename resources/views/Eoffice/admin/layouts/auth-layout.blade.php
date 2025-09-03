<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | e-Training - Training Panel</title>
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

</head>


<body class="authentication-bg">
    <div class="account-pages my-3">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h2 class="text-custom-primary fw-bold">e-Training</h2>
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
    </div>

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