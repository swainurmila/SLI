@extends('training.traininguser.profile.layouts.main')
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper">
            <div class="dashboard__section__title">
                <h4>My Profile</h4>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('training-user.profile.settings.info.update') }}" method="POST"
                        id="profile-update-form">
                        @method('PUT')
                        @csrf


                        <x-user-profile :userdata="@$user" />
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="dashboard__form__button">
                                    <button class="default__button">Update Info</button>
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
            $.validator.addMethod("differentFromCurrent", function(value, element) {
                return value !== $("#current_password").val();
            }, "New password must be different from the current password");
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
                    present_address: {
                        required: true,
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
                        minlength: 8,
                        differentFromCurrent: true 
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
                    first_name: {
                        required: "First Name Is Required",
                    },
                    last_name: {
                        required: "Last Name Is Required",
                    },
                    user_name: {
                        required: "User Name Is Required",
                    },
                    email: {
                        required: "Email Is Required",
                    },

                    contact_no: {
                        required: "Please Enter Your Contact Number",
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
                    },
                    present_address: {
                        required: "Present Address Is Required "
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
