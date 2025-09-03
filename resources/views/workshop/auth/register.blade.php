@extends('workshop.layouts.admin.main')

@section('content')
    <style>
        select#state_dropdown {
            color: black;
        }

        select#district_dropdown {
            color: black;
        }
    </style>

    @php
        $states = DB::table('states')->get();
    @endphp

    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h4>Workshop Registration </h4>
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
                    <form method="POST" action="{{ route('workshop.register.store') }}" id="workshop-register-form"
                        enctype="multipart/form-data" onsubmit=" return sign_up_user()">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">First Name:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                    onkeypress="return /[a-z A-Z\.]/i.test(event.key)" maxlength="30"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" placeholder="First Name"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">Last Name:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="last_name"
                                    id="last_name"onkeypress="return /[a-z A-Z\.]/i.test(event.key)" maxlength="30"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" placeholder="Last Name"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">User Name:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="user_name" id="user_name" maxlength="30"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" placeholder="User Name"
                                    value="{{ old('user_name') }}">
                                @error('user_name')
                                    <div class="error text-danger">{{ $message }}</div>
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
                                <label class="form-label" for="">Contact No:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="contact_no" id="contact_no"
                                    onkeypress="return /[0-9]/.test(event.key)" placeholder="Contact No" maxlength="10"
                                    value="{{ old('contact_no') }}">
                                @error('contact_no')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="form-label" for="">Upload Photo:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="file" class="form-control" name="profile_photo" id="profile_photo"
                                    placeholder="" value="{{ old('profile_photo') }}" accept="image/*">
                                @error('profile_photo')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">Qualification:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <select class="form-select select2" name="qualification" id="qualification"
                                    value="{{ old('qualification') }}">
                                    <option value="">Select</option>
                                    <option value="10th">10th</option>
                                    <option value="12th">12th</option>
                                    <option value="Graduation">Graduation</option>
                                    <option value="Post Graduation">Post Graduation</option>
                                </select>
                                @error('qualification')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">Course:<sup><span style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="course_name"
                                    id="course_name"oninput="this.value = this.value.replace(/^\s+/, '')"
                                    value="{{ old('course_name') }}">
                                @error('course_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="col-form-label">Passing Year:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" class="form-control" name="passing_year" id="passing_year"
                                    value="{{ old('passing_year') }}" placeholder="e.g.2024">
                                @error('passing_year')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="col-form-label">State:<sup><span style="color: red;">*</span></sup></label>
                                <select class="form-select select2" name="state_id" id="state_dropdown"
                                    value="{{ old('state_id') }}">
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
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="col-form-label">District:<sup><span style="color: red;">*</span></sup></label>
                                <select class="form-select select2" name="district_id" id="district_dropdown"
                                    value="{{ old('district_id') }}">
                                    <option value="">Select</option>
                                </select>

                                @error('district_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="">Present Address:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <textarea name="present_address" id="present_add" class="form-control"></textarea>
                                @error('present_address')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                                <div class="custom-checkbox mb-2 mt-2">
                                    <input autocomplete="off" type="checkbox" class="" id="paddress"
                                        name="chk" value="chk" {{ old('chk') == 'chk' ? 'checked' : '' }}>
                                    <label class="custom-control-label text-muted mb-0 fs-xs" for="paddress">Click if same
                                        with permanent address</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="">Permanent Address:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <textarea name="permanent_address" id="permanent_add" class="form-control"></textarea>


                                @error('permanent_address')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Password:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="password" class="form-control" name="password" id="password"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" placeholder="">
                                @error('password')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="">Confirm Password:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password"oninput="this.value = this.value.replace(/^\s+/, '')" placeholder="">

                                @error('password_confirmation')
                                    <div class="error text-danger">{{ $message }}</div>
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
                            <p class="mb-0">Already have an account? <a href="{{ route('workshop.login.show') }}"
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
        $("#workshop-register-form").validate({
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
        var form = $("#workshop-register-form");
        if (form.valid()) {
            return true;
        } else {
            return false;
        }
    }
    </script>



    {{-- <script>
        $(document).ready(function() {
            // $.validator.addMethod("tenDigitNumber", function(value, element) {
            //     return this.optional(element) || /^[0-9]{10}$/i.test(value);
            // }, "Please enter a 10-digit number.");

            // $.validator.addMethod("strongPassword", function(value, element) {
            //         return this.optional(element) ||
            //             /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,])(?=.*[^\da-zA-Z]).{8,}$/
            //             .test(value);
            //     },
            //     "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and minimum 8 characters."
            // );
                // alert(1);


            $('#profile_photo').on('change', function() {
                $(this).siblings('.error').hide();
            });
            $('#paddress').click(function() {
                if ($('#paddress').is(':checked')) {
                    let pre_add = $('#present_add').val();
                    $('#permanent_add').val(pre_add);
                    $('#permanent_add').siblings('.error').hide(); // Hide error message
                } else {
                    $('#permanent_add').val('');
                }
            });
            window.onload = function() {
                document.getElementById('workshop-register-form').reset();
            };
        });
        $('#profile_photo').change(function() {
            var inputFile = $(this)[0].files[0];

            // Check if file was uploaded
            if (inputFile) {
                var fileSize = inputFile.size;
                var fileType = inputFile.type;

                // Allowed file types (you can customize this array)
                var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                // Maximum file size in bytes (adjust as per your requirement)
                var maxSize = 2 * 1024 * 1024; // 5 MB

                // Validate file type
                if (allowedTypes.indexOf(fileType) === -1) {
                    $('#fileValidationMessage').html('File type not supported. Kindly send a legitimate picture file, such as a jpg, jpeg, or png, that is no larger than 2 MB.');
                    $(this).val('');
                    return;
                }

                // Validate file size
                // if (fileSize > maxSize) {
                //     $('#fileValidationMessage').html(
                //         'File size exceeds the limit. Please upload an image less than 5MB.');
                //     $(this).val(''); // Clear the file input
                //     return;
                // }

                // If the file passes validation, you can display a success message or perform any other action
                $('#fileValidationMessage').html(); // Example success message
            }
        });
    </script> --}}
@endsection
