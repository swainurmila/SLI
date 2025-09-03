<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register Panel</title>
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
@php
    $states = DB::table('states')->get();
@endphp

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
                        <h5>Shri. Naveen Patnaik <span>Hon'ble Chief Minister</span></h5>
                        <img src="{{ asset('user-assets/images/cm.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-end mt-5">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <div>
                                        <img src="{{ asset('assets/images/e-Library.png') }}" class="img-fluid"
                                            style="height: 45px;">
                                    </div>
                                    <h5 class="text-dark">Join Us !</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('library.store-register') }}"
                                        id="library-register-form" enctype="multipart/form-data"
                                        onsubmit="return sign_up_user()">
                                        @csrf
                                        <div class="mb-2 row">
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="first_name">First Name</label>
                                                <input type="text" class="form-control form-valid name-validation"
                                                    name="first_name" id="first_name" placeholder="First Name">
                                                @if ($errors->has('first_name'))
                                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="last_name">Last Name</label>
                                                <input type="text" class="form-control form-valid name-validation"
                                                    name="last_name" id="last_name" placeholder="Last Name">
                                                @if ($errors->has('last_name'))
                                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="user_name">User Name</label>
                                                <input type="text"
                                                    class="form-control form-valid username-validation" name="user_name"
                                                    id="user_name" placeholder="User Name">
                                                @if ($errors->has('user_name'))
                                                    <div class="error">{{ $errors->first('user_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" class="form-control form-valid" name="email"
                                                    id="email" placeholder="Email">
                                                @if ($errors->has('email'))
                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="contact_no">Contact No</label>
                                                <input type="text"
                                                    class="form-control form-valid contract-number-validation"
                                                    name="contact_no" id="contact_no" placeholder="Contact No"
                                                    maxlength="10">
                                                @if ($errors->has('contact_no'))
                                                    <div class="error">{{ $errors->first('contact_no') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="profile_photo">Upload Photo</label>
                                                <input type="file" class="form-control form-valid"
                                                    name="profile_photo" id="profile_photo">
                                                @if ($errors->has('profile_photo'))
                                                    <div class="error">{{ $errors->first('profile_photo') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="col-form-label" for="state_dropdown">State</label>
                                                <select class="form-select select2 form-valid" name="state_id"
                                                    id="state_dropdown">
                                                    <option value="">Select</option>
                                                    @foreach ($states as $item)
                                                        <option value="{{ $item->id }}">{{ $item->state_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('state_id'))
                                                    <div class="error">{{ $errors->first('state_id') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="col-form-label" for="district_dropdown">District</label>
                                                <select class="form-select select2 form-valid" name="district_id"
                                                    id="district_dropdown">
                                                    <option value="">Select District</option>
                                                </select>
                                                @if ($errors->has('district_id'))
                                                    <div class="error">{{ $errors->first('district_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-md-12">
                                                <label class="form-label" for="present_add">Present Address</label>
                                                <textarea name="present_address" id="present_add" class="form-control form-valid"></textarea>
                                                @if ($errors->has('present_address'))
                                                    <div class="error">{{ $errors->first('present_address') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="paddress" name="chk"
                                                        value="chk" {{ old('chk') == 'chk' ? 'checked' : '' }}>
                                                    <label class="custom-control-label text-muted mb-0 fs-xs"
                                                        for="paddress">Click if same with permanent address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-md-12">
                                                <label class="form-label" for="permanent_add">Permanent
                                                    Address</label>
                                                <textarea name="permanent_address" id="permanent_add" class="form-control form-valid"></textarea>
                                                @if ($errors->has('permanent_address'))
                                                    <div class="error">{{ $errors->first('permanent_address') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password"
                                                    class="form-control form-valid password-validation"
                                                    name="password" id="password" placeholder="">
                                                @if ($errors->has('password'))
                                                    <div class="error">{{ $errors->first('password') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <label class="form-label" for="password_confirmation">Confirm
                                                    Password</label>
                                                <input type="password" class="form-control form-valid"
                                                    name="password_confirmation" id="password_confirmation"
                                                    placeholder="">
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="error">{{ $errors->first('password_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn login-btn">{{ __('Register') }}</button>
                                    </form>
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
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <!-- JAVASCRIPT -->

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
            $('#email').on('input', function() {
                var emailValue = $(this).val();
                var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

                if (!emailRegex.test(emailValue)) {
                    // Invalid email format, show an error message
                    $('#email-error').text('Invalid email format');
                } else {
                    // Valid email format, clear the error message
                    $('#email-error').text('');
                }
            });
            $('#contact_no').on('input', function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                if (inputId === 'contact_no') {
                    // Validate for mobile number
                    var mobileRegex = /^[0-9]{10}$/;
                    errorId = '#mobile-error';

                    if (!mobileRegex.test(inputValue)) {
                        // Invalid mobile number format, show an error message
                        $(errorId).text('Please enter a valid mobile number');
                    } else {
                        // Valid mobile number format, clear the error message
                        $(errorId).text('');
                    }
                }
            });
            $('#state_dropdown').on('change', function() {
                //alert(123);
                var state_id = this.value;
                //alert(state_id);
                $.ajax({
                    url: "{{ route('library.get_city') }}",
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
                        $("#district_dropdown").append('<option value="">' + "Select District" +
                            '</option>');
                        $.each(result.city, function(key, value) {
                            $("#district_dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $.validator.addMethod("maxsize", function(value, element, param) {
                    if (element.files.length > 0) {
                        var fileSize = element.files[0].size / 1024 / 1024; // in MB
                        return fileSize <= param;
                    }
                    return true;
                }, "File size must be less than {0} MB.");

                $.validator.addMethod("filetype", function(value, element, param) {
                    if (element.files.length > 0) {
                        var fileType = element.files[0].type;
                        var validTypes = param.split(',');
                        return validTypes.includes(fileType);
                    }
                    return true;
                }, "Invalid file type.");

                $("#library-register-form").validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        last_name: {
                            required: true
                        },
                        user_name: {
                            required: true
                        },
                        contact_no: {
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                            digits: true
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        profile_photo: {
                            required: true,
                            maxsize: 2, // Size in MB
                            filetype: 'image/jpeg,image/png,image/webp' // Allowed file types
                        },
                        state_id: {
                            required: true
                        },
                        district_id: {
                            required: true
                        },
                        present_address: {
                            required: true
                        },
                        permanent_address: {
                            required: true
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password",
                        }
                    },
                    messages: {
                        first_name: "First name is required",
                        last_name: "Last name is required",
                        user_name: "User name is required",
                        contact_no: {
                            required: "Contact number is required",
                            minlength: "Contact number must be 10 digits",
                            maxlength: "Contact number must be 10 digits",
                            digits: "Contact number must be digits only"
                        },
                        email: {
                            required: "Email is required",
                            email: "Email must be a valid email address"
                        },
                        password: {
                            required: "Password is required",
                            minlength: "Password must be at least 8 characters"
                        },
                        profile_photo: {
                            required: "Profile photo is required",
                            maxsize: "File size must be less than 2 MB.",
                            filetype: "Please upload a valid image file (JPEG, PNG, webp)."
                        },
                        state_id: "State is required",
                        district_id: "District is required",
                        present_address: "Present address is required",
                        permanent_address: "Permanent address is required",
                        password_confirmation: {
                            required: "Confirm password is required",
                            equalTo: "Passwords do not match"
                        }
                    }
                });

                $('#profile_photo').on('change', function() {
                    $(this).siblings('.error').hide();
                });
            });

            function sign_up_user() {
                var form = $("#library-register-form");
                if (form.valid()) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>--}}

</body>

</html>