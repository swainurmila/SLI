@extends('research..auth.layouts.main')
<style>
    .error {
        color: red;
    }
</style>
@section('content')
    @php
        $states = DB::table('states')->get();
    @endphp

    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body p-4">
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
                                role="tab" aria-controls="tab1" aria-selected="true">Research & Case Studies</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-2 tabs" id="2-tab" data-bs-toggle="pill" href="#tab2" role="tab"
                                aria-controls="tab2" aria-selected="false" tabindex="-1">Research & Publication</a>
                        </li>
                    </ul>



                    

                    <div class="tab-content mb-3 m-2">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('research.case-studies.register.store') }}" id="research-register-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2 row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">First Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                placeholder="First Name" maxlength="50" pattern="[a-zA-Z\s]+"
                                                onkeypress="return validateKeyPress(event)" autocomplete="off" autofocus>
                                            @error('first_name')
                                                <div class="error" style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                placeholder="Last Name" pattern="[a-zA-Z\s]+"
                                                onkeypress="return validateKeyPress(event)" maxlength="50" autocomplete="off" autofocus>
                                            @error('last_name')
                                                <div class="error" style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">User Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="user_name" id="user_name"
                                                placeholder="User Name" pattern="[a-zA-Z\s]+"
                                                onkeypress="return validateKeyPress(event)" maxlength="50" autocomplete="off" autofocus>
                                            @error('user_name')
                                                <div class="error" style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
            
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">Email<span class="text-danger">*</span></label>
                                            <input type="mail" class="form-control" name="email" id="email" placeholder="Email"
                                                pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" autocomplete="off" autofocus>
                                            @error('email')
                                                <div class="error" style="color:red;">{{ $message }}</div>
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
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                                            <label class="form-label" for="researchPassword">Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" id="researchPassword"
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
                                        <p class="mb-0">Already have an account? <a href="{{ route('research.login.show') }}"
                                                class="fw-medium text-custom-primary"> Sign in here </a> </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('research.register.store') }}" id="research-register-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2 row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">First Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                placeholder="First Name" maxlength="50" pattern="[a-zA-Z\s]+"
                                                onkeypress="return validateKeyPress(event)" autocomplete="off" autofocus>
                                            @error('first_name')
                                                <div class="error" style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                placeholder="Last Name" pattern="[a-zA-Z\s]+"
                                                onkeypress="return validateKeyPress(event)" maxlength="50" autocomplete="off" autofocus>
                                            @error('last_name')
                                                <div class="error" style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">User Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="user_name" id="user_name"
                                                placeholder="User Name" pattern="[a-zA-Z\s]+"
                                                onkeypress="return validateKeyPress(event)" maxlength="50" autocomplete="off" autofocus>
                                            @error('user_name')
                                                <div class="error" style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
            
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="form-label" for="">Email<span class="text-danger">*</span></label>
                                            <input type="mail" class="form-control" name="email" id="email" placeholder="Email"
                                                pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" autocomplete="off" autofocus>
                                            @error('email')
                                                <div class="error" style="color:red;">{{ $message }}</div>
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
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                                            <label class="form-label" for="researchPassword">Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" id="researchPassword"
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
                                        <p class="mb-0">Already have an account? <a href="{{ route('research.login.show') }}"
                                                class="fw-medium text-custom-primary"> Sign in here </a> </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $.validator.addMethod("tenDigitNumber", function(value, element) {
                return this.optional(element) || /^[0-9]{10}$/i.test(value);
            }, "Please enter a 10-digit number.");

            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');

            $.validator.addMethod("strongPassword", function(value, element) {
                    return this.optional(element) ||
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,])(?=.*[^\da-zA-Z]).{8,}$/
                        .test(value);
                },
                "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and minimum 8 characters."
            );

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");

            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/.test(value);
            }, "Letters only please");


            $("#research-register-form").validate({

                rules: {
                    first_name: {
                        required: true,

                    },
                    last_name: {
                        required: true,

                    },
                    user_name: {
                        required: true,

                    },
                    contact_no: {
                        required: true,
                        digits: true,
                        tenDigitNumber: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        strongPassword: true,
                    },
                    profile_photo: {
                        required: true,
                        filesize_max: 1048576,
                    },
                    state_id: {
                        required: true,
                    },
                    district_id: {
                        required: true,
                    },
                    present_address: {
                        required: true,
                    },
                    permanent_address: {
                        required: true,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password",
                    },

                },
                messages: {
                    first_name: {
                        required: "Please Enter First Name",

                    },
                    last_name: {
                        required: "Please Enter Last Name",

                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 8 characters"
                    },
                    profile_photo: {
                        required: "Profile photo is required",
                        accept: "Please upload a valid image file",
                    },
                    district_id: {
                        required: "Please choose a District"
                    },
                    password_confirmation: {
                        required: "Confirm password is required",
                        equalTo: "Password do not match"
                    },
                    profile_photo: {
                        required: "Please select a profile photo",
                        accept: "Please select a valid image file",
                        filesize_max: "Profile photo size must be less than 1 MB"
                    }
                },
            });
            $('#profile_photo').on('change', function() {
                $(this).siblings('.error').hide();
            });
        });
    </script>
    <script>
        function validateKeyPress(event) {
            // Prevent spaces at the beginning of the input
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }

            // Allow only letters and spaces
            const regex = /^[a-zA-Z\s]*$/;
            return regex.test(event.key);
        }
    </script>
@endsection
