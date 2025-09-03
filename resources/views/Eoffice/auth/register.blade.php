@extends('Eoffice.layouts.user-auth-layouts')
@section('content')
    @php
        $states = DB::table('states')->get();
    @endphp
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -60px;
            margin-left: -60px;
            z-index: 9999;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center">
                    <div>
                        <img src="{{ asset('assets/images/e-Office.png') }}" class="img-fluid" style="height: 45px;">
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
                <div class="loader" id="loader"></div>
                <div class="p-2">
                    <form method="POST" id="e_office_register" action="{{ route('office.register.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">First Name</label>
                                <input type="text" class="form-control" maxlength="15" name="first_name" id="first_name"
                                    placeholder="First Name" pattern="^[A-Za-z]+$"
                                    oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                @error('first_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Last Name</label>
                                <input type="text" class="form-control" maxlength="15" name="last_name" id="last_name"
                                    placeholder="Last Name" pattern="^[A-Za-z]+$"
                                    oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                @error('last_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">User Name</label>
                                <input type="text" class="form-control" maxlength="15" name="user_name" id="user_name"
                                    placeholder="User Name" pattern="^[A-Za-z]+$"
                                    oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                @error('user_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Email</label>
                                <input type="mail" class="form-control" name="email" id="email"
                                    placeholder="Email">
                                @error('email')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Contact No</label>
                                <input type="text" class="form-control" onkeypress="return /^[0-9]*$/.test(event.key)"
                                    maxlength="10" name="contact_no" id="contact_no" placeholder="Contact No">
                                @error('contact_no')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Upload Photo</label>
                                <input type="file" class="form-control" accept=".png,.jpg,.jpeg" name="profile_photo"
                                    id="profile_photo" placeholder="Contact No">
                                @error('profile_photo')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Company / Organization</label>
                                <input type="text" class="form-control" name="company" id="company"
                                    placeholder="Company / Organization" maxlength="20" pattern="^[A-Za-z]+$"
                                    oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                @error('company')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation"
                                    placeholder="Designation" maxlength="20" pattern="^[A-Za-z]+$"
                                    oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                @error('designation')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="col-form-label">State</label>
                                <select class="form-select select2" name="state_id" id="state_dropdown">
                                    <option value="">Select</option>
                                    @foreach ($states as $item)
                                        <option value="{{ $item->id }}">{{ $item->state_title }}
                                        </option>
                                    @endforeach
                                </select>


                                @error('state_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="col-form-label">District</label>
                                <select class="form-select select2" name="district_id" id="district_dropdown">
                                    <option value="">Select District</option>
                                </select>

                                @error('district_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h6><b>Present Address</b></h6>
                        <div class="mb-2 row">
                            <div class="col-md-12">
                                <label class="form-label" for="">Address</label>
                                <textarea name="present_address" maxlength="25" id="present_add" class="form-control"></textarea>
                                @error('present_address')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="custom-checkbox mb-2">
                                    <input autocomplete="off" type="checkbox" class="" id="paddress"
                                        name="chk" value="chk" {{ old('chk') == 'chk' ? 'checked' : '' }}>
                                    <label class="custom-control-label text-muted mb-0 fs-xs" for="paddress">Click if same
                                        with permanent address</label>
                                </div>
                            </div>
                        </div>
                        <h6><b>Permanent Address</b></h6>
                        <div class="mb-2 row">
                            <div class="col-md-12">
                                <label class="form-label" for="">Address</label>
                                <textarea name="permanent_address" maxlength="25" id="permanent_add" class="form-control"></textarea>


                                @error('permanent_address')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Password</label>
                                <input type="password" class="form-control" minlength="8" maxlength="15"
                                    name="password" id="eoffice_userpassword" placeholder="">
                                @error('password')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Confirm Password</label>
                                <input type="password" class="form-control" minlength="8" maxlength="15"
                                    name="password_confirmation" id="password" placeholder="">

                                @error('password_confirmation')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Aadhaar Card Number</label>
                                <input type="text" class="form-control" name="identity_number" id="identity_number"
                                    minlength="12" onkeypress="return /^[0-9]*$/.test(event.key)" maxlength="12"
                                    placeholder="">
                                @error('identity_number')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <button type="button" class="btn custom-btn btn-sm" id="send-otp">SEND OTP</button>
                                    <button type="button" class="btn custom-btn btn-sm" id="resend-otp"
                                        style="display:none;">RESEND OTP</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6" id="verify_otp" style="display: none">
                                <label class="form-label" for="">Verify Otp</label>
                                <input type="number" class="form-control" name="otp" id="otp"
                                    placeholder="">
                                <div class="mt-2">
                                    <button type="button" class="btn custom-btn btn-sm" id="verify_otp_btn">VERIFY
                                        OTP</button>
                                </div>
                            </div>
                        </div>
                        <p id="adhaar-message">&nbsp;</p>
                        <input type="hidden" class="txn">
                        <input type="hidden" class="uid">
                        <button type="submit" id="submit_button" disabled
                            class="btn login-btn sbmt">{{ __('Register') }}</button>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account? <a href="{{ route('office.login.show') }}"
                                    class="fw-medium text-custom-primary"> Sign in here </a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('script')
    <script>
        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z]+$/.test(value);
        }, "Letters only please");


        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "This field is required.");

        $.validator.addMethod("strongPassword", function(value, element) {
                return this.optional(element) ||
                    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,])(?=.*[^\da-zA-Z]).{8,}$/
                    .test(value);
            },
            "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and minimum 8 characters."
        );

        $.validator.addMethod("customEmailDomain", function(value, element) {
                // Regular expression to match the email ending with specific domains
                return this.optional(element) ||
                    /[a-zA-Z0-9.-]+\@(?:[a-zA-Z0-9-]+\.)+(com|org|net|ind|edu|gov|co|ac|uk|in)$/
                    .test(value);
            },
            "Please enter an email address with a domain of .com, .org, .net, .ind, .edu, .gov, .co, .ac, .uk, or .in"
        );


        $.validator.addMethod('filesize_max', function(value, element, param) {
            if (element.files.length > 0) {
                return element.files[0].size <= param;
            }
            return true;
        }, 'File size must be less than 1 MB');

        //Check adhaar already exist or not
        $('#identity_number').on('blur', function() {
            let identity = $('#identity_number').val();
            $.ajax({
                type: 'post',
                url: "{{ route('register-checkadhaar') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "identity": identity,
                },
                success: function(data) {
                    console.log(data);
                    if (data.adhaarExists == 1) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Aadhaar Number already exists!',
                        });
                        $('.sbmt').addClass('disabled');
                        $('#identity_number').val('');
                    } else {
                        $('.sbmt').removeClass('disabled');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
        $("#e_office_register").validate({
            rules: {
                first_name: {
                    required: true,
                    noSpace: true,
                    lettersOnly: true,
                    maxlength: 15
                },
                last_name: {
                    required: true,
                    noSpace: true,
                    lettersOnly: true,
                    maxlength: 15
                },
                user_name: {
                    required: true,
                    noSpace: true,
                    lettersOnly: true,
                    maxlength: 15
                },
                password: {
                    required: true,
                    strongPassword: true
                },
                email: {
                    required: true,
                    email: true,
                    noSpace: true,
                    customEmailDomain: true
                },
                contact_no: {
                    required: true,
                    digits: true,
                    noSpace: true,
                },
                state_id: {
                    required: true
                },
                district_id: {
                    required: true
                },
                present_address: {
                    required: true,
                    noSpace: true,
                    maxlength: 100
                },
                permanent_address: {
                    required: true,
                    noSpace: true,
                    maxlength: 100
                },
                profile_photo: {
                    required: true,
                    filesize_max: 1048576,
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    lettersOnly: "Please enter only alphabetic characters",
                    noSpace: "First name cannot contain only spaces",
                    maxlength: "It cannot be more than 15 characters long"
                },
                last_name: {
                    required: "Please enter your last name",
                    lettersOnly: "Please enter only alphabetic characters",
                    noSpace: "Last name cannot contain only spaces",
                    maxlength: "It cannot be more than 15 characters long"
                },
                user_name: {
                    required: "Please enter a username",
                    lettersOnly: "Please enter only alphabetic characters",
                    noSpace: "User name cannot contain only spaces",
                    maxlength: "It cannot be more than 15 characters long"
                },
                password: {
                    required: "Please enter a password"
                },
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address",
                    noSpace: "Email cannot contain only spaces"
                },
                contact_no: {
                    required: "Please enter a valid contact number",
                    digits: "Please enter only digits"
                },
                state_id: {
                    required: "Please choose a state"
                },
                district_id: {
                    required: "Please choose a District"
                },
                present_address: {
                    required: "Please enter your present address",
                    noSpace: "Present address cannot contain only spaces",
                    maxlength: "It cannot be more than 100 characters long"
                },
                permanent_address: {
                    required: "Please enter your permanent address",
                    noSpace: "Permanent address cannot contain only spaces",
                    maxlength: "It cannot be more than 100 characters long"
                },
                profile_photo: {
                    required: "Please select a profile photo",
                    accept: "Please select a valid image file",
                    filesize_max: "Profile photo size must be less than 1 MB"
                }
            },
            submitHandler: function(form) {
                if ($("#user_details_save").valid()) {
                    form.submit();
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var otpVerified = false;

            function toggleSendOTPVisibility() {
                var identityNumber = $("#identity_number").val();
                if (identityNumber.length === 12) {
                    $("#send-otp").show();
                } else {
                    $("#send-otp").hide();
                }
            }

            toggleSendOTPVisibility();

            $("#identity_number").on("input", function(e) {
                toggleSendOTPVisibility();
            });

            function showLoader() {
                $("#loader").show();
            }

            function hideLoader() {
                $("#loader").hide();
            }

            $(document).off('click', '#send-otp').on('click', '#send-otp', function(e) {
                e.preventDefault();
                var aadhaarno = $('#identity_number').val();

                showLoader();

                $.ajax({
                    type: "POST",
                    url: "{{ route('appointments.adhaar.otp') }}",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'aadhaarno': aadhaarno
                    },
                    dataType: 'json',
                    success: function(data) {
                        hideLoader();
                        if (data.ret == 'y') {
                            $('#identity_number').prop('readonly', true);
                            $('.uid').val(data.uid);
                            $('.txn').val(data.txn);
                            $('#send-otp').hide();
                            $('#verify_otp').show();
                            $('#adhaar-message').html('OTP has been sent on Mobile Number ' +
                                data.mobileNumber + ' (Register with UIDAI)');
                            startResendOTPCountdown();
                        } else {
                            $('#adhaar-message').html(
                                '<span class="error-message">Please provide a valid aadhaar no.</span>'
                                );
                        }
                    },
                    error: function(data) {
                        hideLoader();
                        console.log(data);
                    }
                });
            });

            $(document).off('click', '#resend-otp').on('click', '#resend-otp', function(e) {
                e.preventDefault();
                var aadhaarno = $('#identity_number').val();

                showLoader();

                $.ajax({
                    type: "POST",
                    url: "{{ route('appointments.adhaar.otp') }}",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'aadhaarno': aadhaarno
                    },
                    dataType: 'json',
                    success: function(data) {
                        hideLoader();
                        if (data.ret == 'y') {
                            $('#adhaar-message').html('OTP has been resent on Mobile Number ' +
                                data.mobileNumber + ' (Register with UIDAI)');
                            startResendOTPCountdown();
                        } else {
                            $('#adhaar-message').html(
                                '<span class="error-message">Please provide a valid aadhaar no.</span>'
                                );
                        }
                    },
                    error: function(data) {
                        hideLoader();
                        console.log(data);
                    }
                });
            });

            $(document).off('click', '#verify_otp_btn').on('click', '#verify_otp_btn', function(e) {
                e.preventDefault();
                var otp = $('#otp').val();

                if (otp == '') {
                    $('#adhaar-message').html(
                        '<span class="error-message">Please enter a valid otp no</span>');
                    return false;
                } else {
                    $('#adhaar-message').html('');
                }

                showLoader();

                $.ajax({
                    type: "POST",
                    url: "{{ route('appointments.adhaar.otp.verify') }}",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'otp': otp,
                        'uid': $('.uid').val(),
                        'txn': $('.txn').val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        hideLoader();
                        $('#adhaar-message').html('');
                        if (data.ret == 'y') {
                            $('#adhaar-message').html(
                                '<span class="success-message">Aadhaar Number is verified</span>'
                                );
                            $('#verify_otp').hide();
                            $('#submit_button').prop('disabled', false);
                            otpVerified = true; // Set flag to true
                            $('#resend-otp').hide(); // Hide resend button permanently
                        } else {
                            $('#adhaar-message').html(
                                '<span class="error-message">Invalid OTP.</span>');
                            $('#verify_otp').show();
                        }
                    },
                    error: function(data) {
                        hideLoader();
                        console.log(data);
                    }
                });
            });

            function startResendOTPCountdown() {
                if (!otpVerified) {
                    $('#resend-otp').hide();
                    setTimeout(function() {
                        if (!otpVerified) {
                            $('#resend-otp').show();
                        }
                    }, 60000);
                }
            }
        });
    </script>
@endsection
