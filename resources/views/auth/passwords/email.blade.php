<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Login | e-Library - Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <link href="../assets/css/style.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
<style>
    .row.mb-0 {
    margin-left: -58px;
}
</style>
    <body class="authentication-bg">
        <div class="account-pages pt-sm-5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->has('captcha'))
                            <div class="alert alert-danger">
                                {{ $errors->first('captcha') }}
                            </div>
                        @endif
                            <div class="card-body p-4">

                            @if ($errors->has('captcha'))
                            <div class="alert alert-danger">
                                {{ $errors->first('captcha') }}
                            </div>
                            @endif
                                <div class="text-center mt-2">
                                    <img src="{{ asset('assets/images/SLI -logo.png') }}" alt="" height="60">
                                    <h5 class="text-dark mt-2">{{ __('Reset Password') }}</h5>
                                    {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="row mb-3">
                                            <label class="form-label" for="username">{{ __('Email Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Send Password Reset Link') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <script src="assets/js/app.js"></script>



        <!-- initialize jQuery Library -->
        <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>

        <!-- for Bootstrap js -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <script>
            $(document).ready(function () {
               $("#training-login-form").validate({
        
                   rules: {
                       email: {
                           required: true,
                           email: true,
                       },
                       password: {
                           required: true,
                           minlength: 8
                       },
        
                   },
                   messages: {
                       email: {
                           required: "Email is required",
                           email: "Email must be a valid email address",
                       },
                       password: {
                           required: "Password is required",
                           minlength: "Password must be at least 8 characters"
                       },
                   },
                   })
            });
        
            $('#reload').click(function () {
                $.ajax({
                    type: 'GET',
                    url: '{{route('reload-captcha')}}',
                    success: function (data) {
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        </script>
    </body>
</html>
<script>
    $(document).ready(function () {
       $("#training-login-form").validate({

           rules: {
               email: {
                   required: true,
                   email: true,
               },
               password: {
                   required: true,
                   minlength: 8
               },

           },
           messages: {
               email: {
                   required: "Email is required",
                   email: "Email must be a valid email address",
               },
               password: {
                   required: "Password is required",
                   minlength: "Password must be at least 8 characters"
               },
           },
           })
    });

    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '{{route('reload-captcha')}}',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
