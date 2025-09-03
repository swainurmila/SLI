@extends('course.layouts.admin.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">Trainers</h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Add Trainer</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-4">
                                    <div class="" id="app-tab" role="">
                                        <div class="table-responsive">
                                            <table id="datatable_1" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        <th>Regd No</th>
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user_detail_approve as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>{{ $value->registration_no }}</td>
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td> <?php if ($value->is_delete == 2) {
                                                                echo 'Active';
                                                            } else {
                                                                echo 'Inactive';
                                                            } ?></td>
                                                            <td>

                                                                <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                    title="Edit" data-bs-toggle="modal"
                                                                    data-bs-target="#editTranModal{{ @$value->id }}">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>


                                                                <a href="{{ route('trainer.courseAssignClass', ['id' => $value->id]) }}"
                                                                    class="btn custom-btn btn-sm edit waves-effect waves-light">
                                                                    View Class</a>
                                                            </td>


                                                        </tr>

                                                        <div class="modal fade" id="editTranModal{{ @$value->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            Trainer
                                                                            Details
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('trainer.userUpdate', $value->id) }}"
                                                                        method="POST" id="book_edit{{ @$value->id }}"
                                                                        enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 row">
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">First
                                                                                        Name</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        value="{{ $value->first_name }}"
                                                                                        name="first_name" maxlength="50">
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">Last
                                                                                        Name</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        value="{{ $value->last_name }}"
                                                                                        name="last_name"maxlength="50">
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">User
                                                                                        Name</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        value="{{ $value->user_name }}"
                                                                                        name="user_name"maxlength="50">
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">Password</label>
                                                                                    <input class="form-control"
                                                                                        type="text" value=""
                                                                                        name="password">
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">Email</label>
                                                                                    <input class="form-control"
                                                                                        type="mail"
                                                                                        value="{{ $value->email }}"
                                                                                        name="email">
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">Contact
                                                                                        No</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        value="{{ $value->contact_no }}"
                                                                                        name="contact_no" maxlength="10>
                                                                                </div>

                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label
                                                                                        class="col-form-label">State</label>
                                                                                    <select class="form-select"
                                                                                        name="state_id"
                                                                                        id="state_dropdown_{{ $value->id }}">
                                                                                        <option>Select</option>
                                                                                        {{-- <option>Odisha</option> --}}
                                                                                        @foreach ($states as $val)
                                                                                            <option
                                                                                                value="{{ $val->id }}"
                                                                                                {{ $val->id == $value->state_id ? 'selected' : '' }}>
                                                                                                {{ $val->state_title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label
                                                                                        class="col-form-label">District</label>
                                                                                    <select class="form-select"
                                                                                        name="district_id"
                                                                                        id="district_dropdown_{{ $value->id }}">
                                                                                        <option>Select</option>
                                                                                        @foreach ($cities as $val)
                                                                                            <option
                                                                                                value="{{ $val->id }}"
                                                                                                {{ $val->id == $value->district_id ? 'selected' : '' }}>
                                                                                                {{ $val->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">Present
                                                                                        Address</label>
                                                                                    <textarea name="present_address" class="form-control">{{ $value->present_address }}</textarea>
                                                                                    {{-- <input class="form-control" type="text"
                                                                                    value="" id=""> --}}
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for=""
                                                                                        class="col-form-label">Permanent
                                                                                        Address</label>
                                                                                    <textarea name="permanent_address" class="form-control">{{ $value->permanent_address }}</textarea>
                                                                                </div>

                                                                                <div class="col-sm-12 col-lg-4">
                                                                                    <label for="avatar"
                                                                                        class="col-md-4 col-form-label text-md-right">Profile
                                                                                        Photo</label>

                                                                                    <div class="">
                                                                                        <input type="file"
                                                                                            class="form-control"
                                                                                            name="profile_photo">
                                                                                    </div>

                                                                                    <?php

                                                                                    // $image_parth = 'upload/user_profile_trainer/'.@$value->profile_photo;
                                                                                    ?>
                                                                                    <img src="{{ asset(@$value->profile_photo) }}"
                                                                                        style="height: 100px;width: 100px;">
                                                                                </div>

                                                                                @if ($value->status == 0)
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Verify
                                                                                            User</label>
                                                                                        <select class="form-select"
                                                                                            name="status" required>
                                                                                            <option value="">Select
                                                                                            </option>
                                                                                            <option
                                                                                                value="1"{{ $value->status == 1 ? 'selected' : '' }}>
                                                                                                Approve
                                                                                            </option>
                                                                                            <option
                                                                                                value="2"{{ $value->status == 2 ? 'selected' : '' }}>
                                                                                                Reject
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                @endif
                                                                                @if ($value->status == 1)
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">User
                                                                                            Status</label>
                                                                                        <select class="form-select"
                                                                                            name="user_mode" required>
                                                                                            <option value="">Select
                                                                                            </option>
                                                                                            <option
                                                                                                value="2"{{ $value->is_delete == 2 ? 'selected' : '' }}>
                                                                                                Active
                                                                                            </option>
                                                                                            <option
                                                                                                value="1"{{ $value->is_delete == 1 ? 'selected' : '' }}>
                                                                                                Inactive
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <input type="hidden" name="profile_photo_old"
                                                                                value="">
                                                                            <button type="submit"
                                                                                class="btn custom-btn">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Trainer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('trainer.store') }}" method="POST" id="trainer_details_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <input type="hidden" name="is_course" value="1">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="first_name" maxlength="50"
                                        autocomplete="off" autofocus required>
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name" maxlength="50"
                                        autocomplete="off" autofocus required>
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="user_name" maxlength="50"
                                        autocomplete="off" autofocus required>
                                    @if ($errors->has('user_name'))
                                        <div class="error">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="password" value="" name="password" required
                                        minlength="8" autocomplete="off" autofocus>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" autocomplete="off" autofocus maxlength="50"
                                        required>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" pattern="[6-9]\d{9}"
                                        title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        maxlength="10" autocomplete="off" autofocus required>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="state_id" id="add_state_dropdown"
                                        autocomplete="off" autofocus required>
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
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">District<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="district_id" id="district_dropdown"
                                        autocomplete="off" autofocus required>
                                        <option value="">Select District</option>
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <div class="error">{{ $errors->first('district_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="present_address" class="form-control" autocomplete="off" autofocus required></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" class="form-control" autocomplete="off" autofocus required></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Mode<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="user_mode" required>
                                        <option value="">Select</option>
                                        <option value="2">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile Photo<span
                                            class="text-danger">*</span></label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="profile_photo" accept="image/*"
                                            required>
                                    </div>
                                    @if ($errors->has('profile_photo'))
                                        <div class="error">{{ $errors->first('profile_photo') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn custom-btn">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            function clearFormFields() {
                $("#trainer_details_save")[0].reset(); // Reset the form
                $("#trainer_details_save").validate().resetForm(); // Reset the validation state
            }

            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();
            $('#datatable_3').DataTable();

            $('#add_state_dropdown').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.get_city') }}",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#district_dropdown').empty();
                        $("#district_dropdown").append('<option value="">' + "Select District" +
                            '</option>');
                        $.each(result.city, function(key, value) {
                            $("#district_dropdown").append('<option value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });


            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');




            $.validator.addMethod("tenDigitNumber", function(value, element) {
                return this.optional(element) || /^[0-9]{10}$/i.test(value);
            }, "Please enter a 10-digit number.");

            $.validator.addMethod("strongPassword", function(value, element) {
                    return this.optional(element) ||
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,])(?=.*[^\da-zA-Z]).{8,}$/
                        .test(value);
                },
                "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and minimum 8 characters."
            );

            $("#trainer_details_save").validate({

                rules: {
                    first_name: {
                        required: true,
                        noSpace: true,
                        lettersOnly: true,
                    },
                    last_name: {
                        required: true,
                        noSpace: true,
                        lettersOnly: true,
                    },
                    user_name: {
                        required: true,
                        noSpace: true,
                        lettersOnly: true,
                    },
                    contact_no: {
                        required: true,
                        tenDigitNumber: true,
                        contactNumber: true
                    },
                    email: {
                        required: true,
                        email: true,
                        noSpace: true,
                        customEmailDomain: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        strongPassword: true
                    },
                    profile_photo: {
                        required: true,
                        filesize_max: 1048576,
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
                    user_mode: {
                        required: true
                    },

                },
                messages: {
                    first_name: {
                        required: "Please Enter First Name",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "First name cannot contain only spaces",
                        maxlength: "It cannot be more than 15 characters long"
                    },
                    last_name: {
                        required: "Please Enter Last Name",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "Last name cannot contain only spaces",
                        maxlength: "It cannot be more than 15 characters long"
                    },
                    user_name: {
                        required: "Please Enter User Name",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "User name cannot contain only spaces",
                        maxlength: "It cannot be more than 15 characters long"
                    },
                    state_id: {
                        required: "Please Choose State",
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 8 characters",
                    },
                    district_id: {
                        required: "Please Choose a District",
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
                    user_mode: {
                        reuired: "User Status Is Required",
                    },
                    profile_photo: {
                        required: "Please select a profile photo",
                        accept: "Please select a valid image file",
                        filesize_max: "Profile photo size must be less than 1 MB"
                    },
                },
                submitHandler: function(form) {
                    if ($("#user_details_save").valid()) {
                        form.submit();
                    }
                }
            });


            $('#addModal').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });
        });

    </script>
@endsection
