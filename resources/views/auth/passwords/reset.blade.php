<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login |   Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="/assets/css/style.css" id="app-style" rel="stylesheet" type="text/css" />

</head>
<style>
    .row.mb-0 {
        margin-left: -50px;
    }

    .password-toggle-wrapper {
            display: flex;
            align-items: center;
        }

        .password-toggle-wrapper .form-control {
            flex: 1;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .password-toggle-wrapper .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-control {
            width: 100%;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
</style>

<body class="authentication-bg">
    <div class="account-pages pt-sm-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
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
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="row mb-2">
                                        <label class="form-label" for="username">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row mb-2">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <div class="password-toggle-wrapper">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row mb-2">
                                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                        <div class="password-toggle-wrapper">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                                autocomplete="new-password">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password-confirm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
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

    <!-- JAVASCRIPT -->
    {{-- <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- initialize jQuery Library -->
    <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>

    <!-- for Bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom js-->
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordField = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
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
    </script>
</body>

</html>
