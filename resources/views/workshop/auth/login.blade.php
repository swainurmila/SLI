@extends('workshop.layouts.admin.main')
@section('content')

<div class="col-md-10 col-lg-8 col-xl-5">
    <div class="card">
        <div class="card-body p-4">
            <div class="text-center">
                <div>
                    {{-- <img src="{{asset('assets/images/course-logo.png')}}" class="img-fluid" style="height: 45px;"> --}}
                    <h2>Workshop</h2>
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
                <form method="POST" id="course-login-form" action="{{ route('workshop.login.check') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="username">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                    {{-- <input type="checkbox" onclick="myFunction()" style="float: right;"> Show Password --}}
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="auth-remember-check">
                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                        <label class="form-check-label" for="auth-remember-check"  style="float: right;"> &nbsp;Show Password</label>
                        <input type="checkbox"  class="form-check-input" onclick="myFunction()" style="float: right;">
                    </div>

                    <div class="row">

                        <div class="col-md-5 ">
                            <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter Captcha">
                        </div>
                        <div class="captcha col-md-5 captcha-img">
                            <span>{!! Captcha::img('black_white') !!}</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn login-btn btn-sm" class="reload" id="reload">
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

                    <div class="col-md-8 offset-md-4 mt-3">


                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-custom-primary" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                </div>

                    <div class="text-center">
                        <p class="mb-0">Don't have an account ? <a href="{{ route('workshop.register.create') }}" class="fw-medium text-custom-primary"> Signup now </a> </p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection


@section('script')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
       $("#course-login-form").validate({

           rules: {
               email: {
                   required: true,
                   email: true,
               },
               password: {
                   required: true,
                   minlength: 8,
                   noSpace :true,
               },
               captcha: {
                   required: true
               }

           },
           messages: {
               email: {
                   required: "Email is required",
                   email: "Email must be a valid email address",
               },
               password: {
                   required: "Password is required",
                   minlength: "Password must be at least 8 characters",
                   noSpace: "Password cannot contain only spaces",
               },
               captcha: {
                   required: "Captcha is required"
               }
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

    function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
@endsection
