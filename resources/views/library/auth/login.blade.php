<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | e-Library </title>
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
        background-image: url({{ asset('assets/images/e-library-back.png') }});
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
                {{-- <div class="col-lg-5">
                    <div class="login-header-right">
                        <h5>Shri. Naveen Patnaik <span>Hon'ble Chief Minister</span></h5>
                        <img src="{{ asset('user-assets/images/cm.png') }}" class="img-fluid">
                    </div>
                </div> --}}
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-end mt-5">
                    <div class="col-md-10 col-lg-8 col-xl-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div>
                                        <img src="{{asset('assets/images/e-Library.png')}}" class="img-fluid" style="height: 45px;">
                                    </div>
                                    <h5 class="text-custom-primary mt-2">Join Us !</h5>
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
                                <div class="p-2">
                                    <form method="POST" action="{{ route('library.login-attempt') }}" id="login-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="username">{{ __('Email Address') }}</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            {{-- <div class="float-end">
                                                <a href="auth-recoverpw.html" class="text-muted">Forgot password?</a>
                                            </div> --}}
                                            <label class="form-label" for="userpassword">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-5 ">
                                                <input type="text" id="captcha" name="captcha" class="form-control"
                                                    placeholder="Enter Captcha">
                                            </div>
                                            <div class="captcha col-md-5 captcha-img">
                                                <span>{!! Captcha::img('black_white') !!}</span>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger" class="reload"
                                                    id="reload">
                                                    &#x21bb;
                                                </button>
                                            </div>
                                        </div>

                                        {{-- <div class="mt-3">
                                            <a  class="btn login-btn" type="submit">Log In</a>
                                        </div> --}}
                                        <button type="submit" class="btn login-btn mt-3">
                                            {{ __('Login') }}
                                        </button>

                                        <div class="col-md-8 offset-md-4">


                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="{{ route('library.register') }}"
                                                    class="fw-medium text-custom-primary"> Signup now </a> </p>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                $("#login-form").validate({

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

            $('#reload').click(function() {

                $.ajax({
                    type: 'GET',
                    url: '{{ route('reload-captcha') }}',
                    success: function(data) {

                        console.log(data)
                        $(".captcha span").html(data.captcha);
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            });
        </script>
</body>

</html>
