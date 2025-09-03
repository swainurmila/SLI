@extends('training.layouts.user-auth-layouts')
<style>
    .error {
        color: red;
    }
    .form-check-inline {
        display: inline-block;
        margin-right: 10px;
    }

</style>
@section('content')
    @php
        $states = DB::table('states')->get();
    @endphp

    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <div><img src="{{ asset('assets/images/trai-logo.png') }}" class="img-fluid" style="height: 45px;"></div>
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
                <div class="p-2 mt-4">
                    <form method="POST" action="{{ route('training.register.store') }}" id="training-register-form"
                        enctype="multipart/form-data" onsubmit="return sign_up_user()">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-xl-12 mb-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_type" id="formRadios1" checked="" value="5">
                                    <label class="form-check-label" for="formRadios1">
                                        Training User
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_type" id="formRadios2" value="7">
                                    <label class="form-check-label" for="formRadios2">
                                        Sponsor
                                    </label>
                                </div>
                                @error('user_type')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">First Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                    onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" placeholder="First Name"
                                    maxlength="60" autocomplete="off" autofocus>
                                @error('first_name')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                    placeholder="Last Name" maxlength="60"
                                    onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" autocomplete="off" autofocus>
                                @error('last_name')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">User Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="user_name" id="user_name"
                                    placeholder="User Name" maxlength="70"
                                    onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" autocomplete="off" autofocus>
                                @error('user_name')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 row">

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">Email:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">Contact No<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact_no" id="contact_no"
                                    pattern="[6-9]\d{9}"
                                    title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                    maxlength="10" autocomplete="off" autofocus placeholder="Contact No">
                                @error('contact_no')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">Upload Photo<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="profile_photo" id="profile_photo"
                                    placeholder="Contact No" accept="image/*">
                                @error('profile_photo')
                                    <div class="error"style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">State<span class="text-danger">*</span></label>
                                <select class="form-select select2" name="state_id" id="state_dropdown">
                                    <option value="">Select State</option>
                                    @foreach ($states as $item)
                                        <option value="{{ $item->id }}">{{ $item->state_title }}
                                        </option>
                                    @endforeach
                                </select>


                                @error('state_id')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">District<span class="text-danger">*</span></label>
                                <select class="form-select" name="district_id" id="district_dropdown">
                                    <option value="">Select District</option>
                                </select>

                                @error('district_id')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">Qualification</label>
                                <select class="form-select select2" name="qualification" id="qualification">
                                    <option value="">Select</option>
                                    <option value="10th">10th</option>
                                    <option value="12th">12th</option>
                                    <option value="Graduation">Graduation</option>
                                    <option value="Post Graduation">Post Graduation</option>
                                </select>
                                @error('qualification')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">Course</label>
                                <input type="text" class="form-control" name="course_name" id="course_name">
                                @error('course_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">Passing Year</label>
                                <input type="text" class="form-control" name="passing_year" id="passing_year"
                                    placeholder="e.g.2024">
                                @error('passing_year')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="">Present Address<span
                                        class="text-danger">*</span></label>
                                <textarea name="present_address" id="present_add" class="form-control"></textarea>
                                @error('present_address')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                                <div class="custom-checkbox mb-2 mt-2">
                                    <input autocomplete="off" type="checkbox" class="" id="paddress"
                                        name="chk" value="chk" {{ old('chk') == 'chk' ? 'checked' : '' }}>
                                    <label class="custom-control-label text-muted mb-0 fs-xs" for="paddress">Click if same
                                        with permanent address</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="">Permanent Address<span
                                        class="text-danger">*</span></label>
                                <textarea name="permanent_address" id="permanent_add" class="form-control"></textarea>


                                @error('permanent_address')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="">
                                @error('password')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Confirm Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" id="password"
                                    placeholder="">

                                @error('password_confirmation')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="mt-3">
                            <a href="auth-login.html" class="btn login-btn" type="submit">Register</a>
                        </div> --}}
                        <button type="submit" class="btn login-btn">
                            {{ __('Register') }}
                        </button>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account? <a href="{{ route('training.login.show') }}"
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
        $(document).ready(function() {
            // Custom method for file size validation
            $.validator.addMethod("maxsize", function(value, element, param) {
                if (element.files.length > 0) {
                    var fileSize = element.files[0].size / 1024 / 1024; // in MB
                    return fileSize <= param;
                }
                return true;
            }, "File size must be less than {0} MB.");

            // Custom method for file type validation
            $.validator.addMethod("filetype", function(value, element, param) {
                if (element.files.length > 0) {
                    var fileType = element.files[0].type;
                    var validTypes = param.split(',');
                    return validTypes.includes(fileType);
                }
                return true;
            }, "Invalid file type.");

            // Initialize validation on document ready
            $("#training-register-form").validate({
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
                    qualification: {
                        required: true
                    },
                    course_name: {
                        required: true
                    },
                    passing_year: {
                        required: true
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
                    qualification: "Qualification is required",
                    course_name: "Course name is required",
                    passing_year: "Passing year is required",
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
            var form = $("#training-register-form");
            if (form.valid()) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
