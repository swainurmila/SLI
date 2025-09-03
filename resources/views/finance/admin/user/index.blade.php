@extends('finance.layouts.main')
@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4>Finance User</h4>
                        </div>
                        <div class="page-title-right">
                            <button class="btn btn-md finance-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add Finance User</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-4 table-responsive">
                                    <table id="datatable_1" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>User Name</th>
                                                <th>E-Mail</th>
                                                <th>Role</th>
                                                <th>Contact No.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($finance_user as $key => $value)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>
                                                        @if (@$value->status == '0')
                                                            Finance Admin
                                                        @else
                                                            Finance User
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->contact_no }}</td>
                                                    <td> <a class="btn finance-btn btn-sm edit waves-effect waves-light"
                                                            title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#editTranModal{{ @$value->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a></td>

                                                </tr>
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
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>


    @foreach ($finance_user as $key => $value)
        <div class="modal fade" id="editTranModal{{ @$value->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">User
                            Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('admin.update-finance-user', $value->id) }}" method="POST"
                        id="finance_user_edit{{ @$value->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus pattern="^[A-Za-z\s]*$"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                                        value="{{ $value->first_name }}" name="first_name" maxlength="15">
                                    @if ($errors->has('first_name'))
                                        <div class="error text-danger">
                                            {{ $errors->first('first_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus pattern="^[A-Za-z\s]*$"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                                        value="{{ $value->last_name }}" name="last_name" maxlength="15">
                                    @if ($errors->has('last_name'))
                                        <div class="error text-danger">
                                            {{ $errors->first('last_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus pattern="^[A-Za-z\s]*$"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                                        value="{{ $value->user_name }}" name="user_name" maxlength="15">
                                    @if ($errors->has('user_name'))
                                        <div class="error text-danger">
                                            {{ $errors->first('user_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control" type="text" value="" name="password">
                                    @if ($errors->has('password'))
                                        <div class="error text-danger">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="mail" autofocus value="{{ $value->email }}"
                                        name="email">
                                    @if ($errors->has('email'))
                                        <div class="error text-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus
                                        value="{{ $value->contact_no }}" name="contact_no" maxlength="10">
                                    @if ($errors->has('contact_no'))
                                        <div class="error text-danger">
                                            {{ $errors->first('contact_no') }}
                                        </div>
                                    @endif
                                </div>


                                <div class="col-sm-12 col-lg-6">
                                    <label for="" class="col-form-label">Present
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="present_address" maxlength="25" autofocus class="form-control">{{ $value->present_address }}</textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error text-danger">
                                            {{ $errors->first('present_address') }}
                                        </div>
                                    @endif

                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label for="" class="col-form-label">Permanent
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" maxlength="25" autofocus class="form-control">{{ $value->permanent_address }}</textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error text-danger">
                                            {{ $errors->first('permanent_address') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label for="" class="col-form-label">Assign
                                        Role</label>
                                    <select class="form-select" name="assigned_role">
                                        <option value="">Select</option>
                                        <option value="25" {{ $value->role_id == '25' ? 'selected' : '' }}>
                                            Finance Admin
                                        </option>
                                        <option value="26" {{ $value->role_id == '26' ? 'selected' : '' }}>
                                            Finance User
                                        </option>
                                        @if ($errors->has('assigned_role'))
                                            <div class="error text-danger">
                                                {{ $errors->first('assigned_role') }}
                                            </div>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right" style="width:200px">Profile
                                        Photo ( With in 1mb) <span class="text-danger">*</span></label>

                                    <input type="file" accept=".jpg,.jpeg,.png" class="form-control"
                                        name="profile_photo">
                                    <img class="mt-4" src="{{ $value->profile_photo }}"
                                        style="height: 150px;width: 144;">
                                    @if ($errors->has('profile_photo'))
                                        <div class="error text-danger">
                                            {{ $errors->first('profile_photo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="old_profile_photo"
                                value="{{ $value->profile_photo }}">

                            <button type="submit" class="btn finance-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Finance User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ route('admin.store-finance-user') }}" method="POST" class="user_details_save"
                    id="user_details_save" enctype="multipart/form-data">
                    {{-- {{ csrf_field() }} --}}
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="first_name"
                                        autocomplete="off" pattern="^[A-Za-z\s]*$"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" maxlength="15">
                                    @if ($errors->has('first_name'))
                                        <div class="error text-danger">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="last_name"
                                        autocomplete="off" pattern="^[A-Za-z\s]*$"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" maxlength="15">
                                    @if ($errors->has('last_name'))
                                        <div class="error text-danger">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="user_name"
                                        autocomplete="off" pattern="^[A-Za-z\s]*$"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" maxlength="15">
                                    @if ($errors->has('user_name'))
                                        <div class="error text-danger">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="password" autofocus value="" name="password"
                                        autocomplete="off">
                                    @if ($errors->has('password'))
                                        <div class="error text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" autocomplete="off" autofocus>
                                    @if ($errors->has('email'))
                                        <div class="error text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" pattern="[6-9]\d{9}"
                                        title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        maxlength="10" autocomplete="off" autofocus>
                                    @if ($errors->has('contact_no'))
                                        <div class="error text-danger">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <label for="" class="col-form-label">Present
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="present_address" class="form-control" maxlength="25" autocomplete="off" autofocus></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error text-danger">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label for="" class="col-form-label">Permanent
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" class="form-control" maxlength="25" autocomplete="off" autofocus></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error text-danger">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right" style="width:200px">Profile Photo ( With in 1mb) <span class="text-danger">*</span></label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" id="profile_photo"
                                            name="profile_photo" accept="image/*" onchange="Filevalidation()">
                                    </div>

                                    @if ($errors->has('profile_photo'))
                                        <div class="error text-danger">{{ $errors->first('profile_photo') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Mode<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="user_mode">
                                        <option value="">Select</option>
                                        <option value="2">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error text-danger">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Assigned Role<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="assigned_role">
                                        <option value="">Select</option>
                                        <option value="25">Finance Admin</option>
                                        <option value="26">Finance User</option>
                                    </select>
                                    @if ($errors->has('assigned_role'))
                                        <div class="error text-danger">{{ $errors->first('assigned_role') }}</div>
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
                $("#user_details_save")[0].reset(); // Reset the form
                $("#user_details_save").validate().resetForm(); // Reset the validation state

            }


            // $.validator.addMethod('filesize_max', function(value, element, param) {
            //     if (element.files.length > 0) {
            //         return element.files[0].size <= param;
            //     }
            //     return true;
            // }, 'File size must be less than 1 MB');


            $.validator.addMethod("filesize_max", function(value, element, param) {
                if (element.files.length === 0) {
                    return true;
                }
                return element.files[0].size <= param;
            }, 'File size must be less than {0} bytes.');

            $.validator.addMethod('filetype', function(value, element, param) {
                if (element.files.length > 0) {
                    var fileType = element.files[0].type;
                    var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    return allowedTypes.includes(fileType);
                }
                return true;
            }, 'Only JPEG, PNG, JPG files are allowed');

            $.validator.addMethod("strongPassword", function(value, element) {
                    return this.optional(element) ||
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+}{"':;?/>.<,])(?=.*[^\da-zA-Z]).{8,}$/
                        .test(value);
                },
                "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and minimum 8 characters."
            );

            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/.test(value);
            }, "Letters only please");

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");

            $.validator.addMethod("customEmailDomain", function(value, element) {
                    // Regular expression to match the email ending with specific domains
                    return this.optional(element) ||
                        /[a-zA-Z0-9.-]+\@(?:[a-zA-Z0-9-]+\.)+(com|org|net|ind|edu|gov|co|ac|uk|in)$/
                        .test(value);
                },
                "Please enter an email address with a domain of .com, .org, .net, .ind, .edu, .gov, .co, .ac, .uk, or .in"
            );

            $("#user_details_save").validate({
                rules: {
                    first_name: {
                        required: true,
                        lettersOnly: true

                    },
                    last_name: {
                        required: true,
                        lettersOnly: true

                    },
                    user_name: {
                        required: true,
                        lettersOnly: true

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
                        minlength: 10
                    },
                    present_address: {
                        required: true,
                        noSpace: true,
                        maxlength: 25
                    },
                    permanent_address: {
                        required: true,
                        noSpace: true,
                        maxlength: 25
                    },
                    status: {
                        required: true
                    },
                    profile_photo: { // New rule for profile photo
                        required: true,
                        filesize_max: 1048576,
                        filetype: true, // Max file size 1 MB (in bytes)
                    },
                    user_mode: {
                        required: true
                    },
                    assigned_role: {
                        required: true
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
                    status: {
                        required: "Please select a status"
                    },
                    profile_photo: {
                        required: "Please select a profile photo",
                        filetype: "Please select a valid image file",
                        filesize_max: "Profile photo size must be less than 1 MB"
                    },
                    // user_mode: {
                    //     required: "Please Choose user mode"
                    // },
                    assigned_role: {
                        required: "Please choose role",
                    }
                },
                submitHandler: function(form) {
                    if ($("#user_details_save").valid()) {
                        form.submit();
                    }
                }
            });



            $('form[id^="finance_user_edit"]').each(function() {
                $(this).validate({
                    rules: {
                        first_name: {
                            required: true,
                            lettersOnly: true,
                            noSpace: true,
                            maxlength: 15
                        },
                        last_name: {
                            required: true,
                            lettersOnly: true,
                            noSpace: true,
                            maxlength: 15
                        },
                        user_name: {
                            required: true,
                            lettersOnly: true,
                            noSpace: true,
                            maxlength: 15
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
                            minlength: 10
                        },
                        present_address: {
                            required: true,
                            noSpace: true,
                            maxlength: 25
                        },
                        permanent_address: {
                            required: true,
                            noSpace: true,
                            maxlength: 25
                        },
                        profile_photo: { // New rule for profile photo
                            filesize_max: 1048576,
                            filetype: true, // Max file size 1 MB (in bytes)
                        },
                        assigned_role: {
                            required: true
                        }

                    }

                });



                $(this).find('input[name="profile_photo"]').on('change', function() {
                    var profilePhotoInput = $(this);
                    if (profilePhotoInput.val()) {
                        profilePhotoInput.rules('add', {
                            required: true,
                            messages: {
                                required: "Profile photo is required"
                            }
                        });
                    } else {
                        profilePhotoInput.rules('remove', 'required');
                    }
                });
            });

            $('#profile_photo').on('change', function() {
                $(this).siblings('.error').hide();
            });













            $('#addModal').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });
            $('#profile_photo').on('change', function() {
                $(this).valid(); // Trigger validation on file input change
            });



            $('input[type="file"][name="profile_photo"]').on('change', function() {
                $(this).data('changed', true);
            });



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


            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();

            $('#datatable_3').DataTable();
        });
    </script>
@endsection
