@extends('training.admin.layouts.auth-layout')
@section('content')
<form method="POST" id="training-admin-login-form" action="{{ route('admin.training.logincheck') }}">
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
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="auth-remember-check">
        <label class="form-check-label" for="auth-remember-check">Remember me</label>
    </div>
   

    <div class="row">
        <div class="col-md-5 ">
            <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter Captcha">
        </div> 
        <div class="captcha col-md-5">
            <span>{!! Captcha::img('black_white') !!}</span>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger" class="reload" id="reload">
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
</form>

@endsection



@section('script')
<script>
    $(document).ready(function () {
       $("#training-admin-login-form").validate({

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

@endsection