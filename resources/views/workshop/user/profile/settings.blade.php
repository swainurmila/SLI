@extends('workshop.user.layouts.main')
</style>
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper"
            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="dashboard__section__title">
                <h4>My Profile</h4>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('user.workshop.settings.info.update') }}" method="POST" id="profile-update-form">
                        @method('PATCH')
                        @csrf
                        {{-- <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">First Name</label>
                                        <input type="text" placeholder="John" name="first_name" value="{{@$user->first_name}}">
                                        @error('first_name')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">Last Name</label>
                                        <input type="text" placeholder="Due" name="last_name" value="{{@$user->last_name}}">
                                        @error('last_name')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">User Name</label>
                                        <input type="text" placeholder="johndue" name="user_name" value="{{@$user->user_name}}">
                                        @error('user_name')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">Email</label>
                                        <input type="email" placeholder="john@example.com" name="email" value="{{@$user->email}}">
                                        @error('email')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">Phone Number</label>
                                        <input type="text" placeholder="+1-202-555-0174" name="contact_no" value="{{@$user->contact_no}}">
                                        @error('contact_no')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">Current Password</label>
                                        <input type="text" placeholder="Current password" id="current_password" name="current_password">
                                        @error('current_password')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">New Password</label>
                                        <input type="text" placeholder="New Password" id="new_password" name="new_password">
                                        @error('new_password')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">Confirm New Password</label>
                                        <input type="text" placeholder="Confirm New Password" id="confirm_password" name="confirm_password">
                                        @error('confirm_password')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="dashboard__form__wraper">
                                    <div class="dashboard__form__input">
                                        <label for="#">Present Address</label>
                                        <textarea name="present_address" value={{@$user->present_address}} id="" cols="5" rows="5">{{@$user->present_address}}</textarea>
                                        @error('present_address')
                                            <span>
                                                <p class="text-danger">{{$message}}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <x-user-profile :userdata="@$user" />
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__button">
                                    <button class="default__button">Update Info</button>
                                    <a class="default__button" href="{{ route('workshop.user.dashboard') }}">Back</a>
                                </div>
                            </div>


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
            // alert(1);
            $("#profile-update-form").validate({
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
                    present_address: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contact_no: {
                        required: true,
                        number: true,
                        minlength: 10, // Adjust the minimum length according to your needs
                        maxlength: 15
                        // You can add more rules for phone number validation
                    },
                    current_password: {
                        required: function(element) {
                            return $("#current_password").val().length > 0;
                        },
                        minlength: 8
                    },
                    new_password: {
                        required: {
                            depends: function(element) {
                                return $("#new_password").val().length > 0;
                            }
                        },
                        minlength: 8
                    },
                    confirm_password: {
                        required: {
                            depends: function(element) {
                                return $("#new_password").val().length > 0;
                            }
                        },
                        equalTo: "#new_password"
                    },
                },
                messages: {
                    contact_no: {
                        required: "Please enter your contact number",
                        number: "Please enter a valid number",
                        minlength: "Contact number must be at least {0} digits",
                        maxlength: "Contact number cannot be more than {0} digits"
                    },

                    current_password: {
                        required: "Please enter your current password",
                        minlength: "Password must be at least {0} characters"
                    },
                    new_password: {
                        required: "Please enter your new password",
                        minlength: "New Password must be at least {0} characters"
                    },
                    confirm_password: {
                        equalTo: "Confirm Password not match"
                    }
                },
                errorClass: "text-danger",
                errorElement: "div",
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
