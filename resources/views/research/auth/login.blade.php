@extends('research..auth.layouts.main')
@section('content')

    <div class="col-md-10 col-lg-8 col-xl-5">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center">
                    <h3>Research</h3>
                    {{-- <div>
                        <img src="{{ asset('assets/images/trai-logo.png') }}" class="img-fluid" style="height: 45px;">
                    </div> --}}

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





                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-2 active tabs" id="1-tab" data-bs-toggle="pill" href="#tab1"
                                role="tab" aria-controls="tab1" aria-selected="true" tabindex="0">Case Studies</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-2 tabs" id="2-tab" data-bs-toggle="pill" href="#tab2" role="tab"
                                aria-controls="tab2" aria-selected="false" tabindex="0">Publication</a>
                        </li>
                    </ul>


                    <form method="POST" class="mt-3" id="research-login-form" action="{{ route('research.login.check') }}">
                        @csrf
                        <input type="hidden" value="case_studies" name="research_for">
                        <div class="mb-3">
                            <label class="form-label text-start" for="username">{{ __('Email Address') }}</label>
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
                            <label class="form-label" for="userpassword">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password">

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
                                <input type="text" id="captcha" name="captcha" class="form-control"
                                    placeholder="Enter Captcha">

                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="captcha col-md-5 captcha-img">
                                <span>{!! Captcha::img('black_white') !!}</span>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn login-btn btn-sm" class="reload"
                                    id="reload">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn login-btn mt-3">
                            {{ __('Login') }}
                        </button>

                        <div class="col-md-8 offset-md-4 mt-3">


                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-custom-primary"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="mb-0">Don't have an account ? <a
                                    href="{{ route('research.register.create') }}"
                                    class="fw-medium text-custom-primary"> Signup now </a> </p>
                        </div>
                    </form>

                    
                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {


            $('.tabs').on('shown.bs.tab', function(e) {
                // Get the ID of the active tab
                var activeTabId = $(e.target).attr('id');

                // Check if the active tab ID is '1-tab' (Office)
                if (activeTabId === '1-tab') {
                    $('#research_for').val('case_studies');
                } else if (activeTabId === '2-tab') { // Check if the active tab ID is '2-tab' (Appointment)
                    $('#research_for').val('publication');
                }
            });

            $("#research-login-form").validate({

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
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endsection
