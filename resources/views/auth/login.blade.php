<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Basic Page Needs
  ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- For Search Engine Meta Data  -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="yoursite.com" />

    <title>Admin Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="{{ asset('assets/images/favicon-16x16.png') }}" />

    <!-- Main structure css file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('sli_assets/css/login8-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sli_assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sli_assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sli_assets/css/custom.css') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <style>
        .brand-logo {
            /* margin: 35px auto; */
            margin: 0;
            margin-bottom: 20px;
        }
        .login-bg{
            background: url('../../../../sli_assets/images/sli_login.jpg');
            object-fit:cover;
        }
        .authfy-login{
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- Start Preloader -->
    <div id="preload-block">
        <div class="square-block"></div>
    </div>
    <!-- Preloader End -->

    <div class="container-fluid login-bg">



            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-2"></div>
                <div class="col-lg-4 col-md-6 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-2"
                    style="height: 100vh">
                    <!-- brand-logo start -->
                    {{-- <div class="brand-logo text-center">
                <img src="{{ asset('assets/images/logo-olic1.png') }}" width="120" alt="brand-logo">
              </div> --}}
                    <!-- ./brand-logo -->
                    <!-- authfy-login start -->
                    <div class="authfy-login">
                        <!-- panel-login start -->
                        <div class="authfy-panel panel-login text-start active">
                            <div class="brand-logo text-start">
                                <img src="{{ asset('sli_assets/images/logo/SLI-logo.png') }}" width="270"
                                    alt="brand-logo">
                            </div>
                            <div class="authfy-heading">
                                <h3 class="auth-title">Login to your account</h3>
                                {{-- <p>Don’t have an account? <a class="lnk-toggler" data-panel=".panel-signup" href="#">Sign Up Free!</a></p> --}}
                            </div>
                            <!-- social login buttons start -->
                            {{-- <div class="row social-buttons">
                    <div class="col-xs-4 col-sm-4">
                      <a href="#" class="btn btn-lg btn-block btn-facebook">
                      <i class="fa fa-facebook"></i>
                      </a>
                    </div>
                    <div class="col-xs-4 col-sm-4">
                      <a href="#" class="btn btn-lg btn-block btn-twitter">
                      <i class="fa fa-twitter"></i>
                      </a>
                    </div>
                    <div class="col-xs-4 col-sm-4">
                      <a href="#" class="btn btn-lg btn-block btn-google">
                      <i class="fa fa-google-plus"></i>
                      </a>
                    </div>
                  </div> --}}
                            <!-- ./social-buttons -->
                            {{-- <div class="row loginOr">
                    <div class="col-xs-12 col-sm-12">
                      <hr class="hrOr">
                      <span class="spanOr">or</span>
                    </div>
                  </div> --}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
    
                                    <form method="POST" action="{{ route('login') }}" id="login-form">
                                        @csrf
    
                                        @error('email')
                                            <div class="alert alert-danger" id="errorAlert">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @enderror
    
                                        <div class="form-group wrap-input">
                                            <input type="email" class="form-control email" name="email"
                                                placeholder="Email address"
                                                pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" autocomplete="off">
                                            <span class="focus-input"></span>
                                        </div>
                                        <div class="form-group wrap-input">
                                            <div class="pwdMask">
                                                <input type="password" class="form-control password" name="password"
                                                    placeholder="Password">
                                                <span class="focus-input"></span>
                                                <span class="fa fa-eye-slash pwd-toggle"></span>
                                            </div>
                                        </div>
                                        <div class="row remember-row">
                                            <div class="col-xs-6 col-sm-6">
                                                <label class="checkbox text-left">
                                                    <input type="checkbox" value="remember-me"><span
                                                        class="label-text">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">
                                                {{-- <p class="forgotPwd">
                              <a class="lnk-toggler" data-panel=".panel-forgot" href="#">Forgot password?</a>
                            </p> --}}
                                            </div>
                                        </div> <!-- ./remember-row -->
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Login with
                                                email</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- ./panel-login -->
                        <!-- panel-signup start -->
                        <div class="authfy-panel panel-signup text-center">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="authfy-heading">
                                        <h3 class="auth-title">Sign up for free!</h3>
                                    </div>
                                    <form id="signupForm" name="signupForm" class="signupForm" action="#"
                                        method="POST">
                                        <div class="form-group wrap-input">
                                            <input type="email" class="form-control" name="username"
                                                placeholder="Email address">
                                            <span class="focus-input"></span>
                                        </div>
                                        <div class="form-group wrap-input">
                                            <input type="text" class="form-control" name="fullname"
                                                placeholder="Full name">
                                            <span class="focus-input"></span>
                                        </div>
                                        <div class="form-group wrap-input">
                                            <div class="pwdMask">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password">
                                                <span class="focus-input"></span>
                                                <span class="fa fa-eye-slash pwd-toggle"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p class="term-policy text-muted small">I agree to the <a
                                                    href="#">privacy policy</a> and <a href="#">terms of
                                                    service</a>.</p>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up with
                                                email</button>
                                        </div>
                                    </form>
                                    <a class="lnk-toggler" data-panel=".panel-login" href="#">Already have an
                                        account?</a>
                                </div>
                            </div>
                        </div> <!-- ./panel-signup -->
                        <!-- panel-forget start -->
                        <div class="authfy-panel panel-forgot">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="authfy-heading">
                                        <h3 class="auth-title">Recover your password</h3>
                                        <p>Fill in your e-mail address below and we will send you an email with further
                                            instructions.</p>
                                    </div>
                                    <form name="forgetForm" class="forgetForm" action="#" method="POST">
                                        <div class="form-group wrap-input">
                                            <input type="email" class="form-control" name="username"
                                                placeholder="Email address">
                                            <span class="focus-input"></span>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Recover your
                                                password</button>
                                        </div>
                                        <div class="form-group">
                                            <a class="lnk-toggler" data-panel=".panel-login" href="#">Already have
                                                an account?</a>
                                        </div>
                                        <div class="form-group">
                                            <a class="lnk-toggler" data-panel=".panel-signup" href="#">Don’t have
                                                an account?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- ./panel-forgot -->
                    </div> <!-- ./authfy-login -->
                </div>
            </div> <!-- ./row -->
            


    </div> <!-- ./container -->

    <!-- Javascript Files -->

    <!-- initialize jQuery Library -->
    <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>

    <!-- for Bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom js-->
    <script src="{{ asset('assets/js/custom.js') }}"></script>




    <script>
        $(document).ready(function() {
            $.validator.addMethod("firstLetterNotNumeric", function(value, element) {
                return this.optional(element) || /^[^\d].*$/.test(value);
            }, "First character cannot be a number");

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");



            $("#login-form").validate({
                rules: {
                    password: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        noSpace: true,
                        firstLetterNotNumeric: true
                    }
                },
                messages: {
                    password: {
                        required: "Please enter a password"
                    },
                    email: {
                        required: "Please enter a valid email address",
                        email: "Please enter a valid email address",
                        noSpace: "Email cannot contain only spaces"
                    }

                },
                submitHandler: function(form) {
                    if ($("#login-form").valid()) {
                        form.submit();
                    }
                }
            });
        });
    </script>

</body>

</html>
