@extends('layouts.backend.header')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">User Management</li>
                                <li class="breadcrumb-item active text-custom-primary">User Approval</li>
                            </ol>
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
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">User Approval</h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Add User Details</button>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#app-tab" role="tab">
                                            <span class="d-none d-sm-block">Pending </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pen-tab" role="tab">
                                            <span class="d-none d-sm-block">Approved</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#rej-tab" role="tab">
                                            <span class="d-none d-sm-block">Rejected</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content mt-4">
                                    <div class="tab-pane active" id="app-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable_1" class= "table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        {{-- <th>Regd No</th> --}}
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user_detail_pending as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            {{-- <td>{{ $value->registration_no }}</td> --}}
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td> Pending</td>
                                                            <td>

                                                                <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                    title="Edit" data-bs-toggle="modal"
                                                                    data-bs-target="#editTranModal{{ @$value->id }}">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                    <div class="tab-pane" id="pen-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        <th>Regd No</th>
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                        {{-- <th>Action</th> --}}
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
                                                            <td> Approved</td>
                                                            {{-- <td>

                                                                <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                    title="Edit" data-bs-toggle="modal"
                                                                    data-bs-target="#editTranModal{{ @$value->id }}">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            </td> --}}


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="rej-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable_3" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        <th>Regd No</th>
                                                        <th>Contact No</th>

                                                        <th>Status</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user_detail_reject as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>{{ $value->registration_no }}</td>
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td> Rejected</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
    @foreach ($user_detail as $key => $value)
        <div class="modal fade" id="editTranModal{{ @$value->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">User
                            Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"  onClick="refreshPage()" aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('user.update-user-details', $value->id) }}" method="POST"
                        id="book_edit{{ @$value->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name</label>
                                    <input class="form-control name-validation" type="text" value="{{ $value->first_name }}"
                                        name="first_name">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name</label>
                                    <input class="form-control name-validation" type="text" value="{{ $value->last_name }}"
                                        name="last_name">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name</label>
                                    <input class="form-control username-validation" type="text" value="{{ $value->user_name }}"
                                        name="user_name">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control password-validation" type="text" value="" name="password">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email</label>
                                    <input class="form-control" type="mail" value="{{ $value->email }}"
                                        name="email">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No</label>
                                    <input class="form-control contract-number-validation" type="text" value="{{ $value->contact_no }}"
                                        name="contact_no">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Registration
                                        No</label>
                                    <input class="form-control" type="text" value="{{ $value->registration_no }}"
                                        readonly>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State</label>
                                    <select class="form-select" name="state_id" id="state_dropdown_{{ $value->id }}">
                                        <option>Select</option>
                                        {{-- <option>Odisha</option> --}}
                                        @foreach ($states as $val)
                                            <option value="{{ $val->id }}"
                                                {{ $val->id == $value->state_id ? 'selected' : '' }}>
                                                {{ $val->state_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">District</label>
                                    <select class="form-select" name="district_id"
                                        id="district_dropdown_{{ $value->id }}">
                                        <option>Select</option>
                                        @foreach ($cities as $val)
                                            <option value="{{ $val->id }}"
                                                {{ $val->id == $value->district_id ? 'selected' : '' }}>
                                                {{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address</label>
                                    <textarea name="present_address" class="form-control">{{ $value->present_address }}</textarea>
                                    {{-- <input class="form-control" type="text"
                                    value="" id=""> --}}
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address</label>
                                    <textarea name="permanent_address" class="form-control">{{ $value->permanent_address }}</textarea>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo</label>

                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="profile_photo">
                                    </div>
                                    <img src="{{ $value->profile_photo }}" style="height: 100px;width: 100px;">
                                </div>

                                @if ($value->status == 0)
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Verify User</label>
                                        <select class="form-select" name="status" required>
                                            <option value="">Select</option>
                                            <option value="1"{{ $value->status == 1 ? 'selected' : '' }}>Approve
                                            </option>
                                            <option value="2"{{ $value->status == 2 ? 'selected' : '' }}>Reject
                                            </option>
                                        </select>
                                    </div>
                                @endif
                                @if ($value->status == 1)
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">User Mode</label>
                                        <select class="form-select" name="user_mode" required>
                                            <option value="">Select</option>
                                            <option value="2"{{ $value->is_delete == 2 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="1"{{ $value->is_delete == 1 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                            <input type="hidden" name="profile_photo_old" value="{{ $value->profile_photo }}">
                            <button type="submit" class="btn custom-btn">Update</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="refreshPage()" >
                    </button>
                </div>

                <form action="{{ route('user.add-user-details') }}" method="POST" id="user_details_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name</label>
                                    <input class="form-control name-validation form-valid" type="text" name="first_name"
                                         maxlength="25">
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name</label>
                                    <input class="form-control name-validation form-valid" type="text" name="last_name" maxlength="25" required>
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name</label>
                                    <input class="form-control name-validation form-valid" type="text" name="user_name" maxlength="25"
                                        required>
                                    @if ($errors->has('user_name'))
                                        <div class="error">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control password-validation form-valid" type="password" value=""
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email</label>
                                    <input type="email"  id="add_email" name="email" class="form-control form-valid"
                                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No</label>
                                    <input class="form-control contract-number-validation form-valid" type="text"
                                        name="contact_no" pattern="[6-9]\d{9}"
                                        title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        maxlength="10" required>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State</label>
                                    <select class="form-select select2 form-valid" name="state_id" id="add_state_dropdown" required>
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
                                    <label class="col-form-label">District</label>
                                    <select class="form-select select2 form-valid" name="district_id" id="district_dropdown"
                                        required>
                                        <option value="">Select District</option>
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <div class="error">{{ $errors->first('district_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address</label>
                                    <textarea name="present_address" class="form-control form-valid" required></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address</label>
                                    <textarea name="permanent_address" class="form-control form-valid" required></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Mode</label>
                                    <select class="form-select form-valid" name="user_mode" required>
                                        <option value="">Select</option>
                                        <option value="2">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo</label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control form-valid" name="profile_photo" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                            <button type="button" onclick="saveForm()" class="btn custom-btn">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add this script in the head section of your HTML -->

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
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
                        $.each(result.city, function(key, value) {
                            $("#district_dropdown").append('<option value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
        function saveForm() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();
            $('.form-valid').each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text');
                    $(this).removeClass('success-text');
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#user_details_save').submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }
        function refreshPage() {
            window.location.reload();
        }

        $('#add_email').on('blur', function() {
            let useremail = $('#add_email').val();
            $.ajax({
                type: 'post',
                url: "{{ route('register-checkmail') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "useremail": useremail,
                },
                success: function(data) {
                    console.log(data);
                    if (data.mailExists == 1) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Email already exists!',
                        });
                        $('.sbmt').addClass('disabled');
                        $('#add_email').val('');
                    } else {
                        $('.sbmt').removeClass('disabled');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();

            $('#datatable_3').DataTable();
        });
    </script>
    <!-- Add this script after including the jQuery Validation Plugin -->
    {{-- <script>
    $(document).ready(function () {
        $("#user_details_save").validate({
            rules: {
                first_name: {
                    required: true
                    lettersOnly: true
                },
                last_name: {
                    required: true
                    lettersOnly: true
                },
                user_name: {
                    required: true
                },
                password: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                contact_no: {
                    required: true,
                    digits: true
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
                status: {
                    required: true
                }
            },
            messages: {
                // Specify custom error messages for each field
                first_name: {
                    required: "Please enter your first name",
                    lettersOnly: "Please enter only alphabetic characters",
                },
                last_name: {
                    required: "Please enter your last name",
                    lettersOnly: "Please enter only alphabetic characters"
                },
                user_name: {
                    required: "Please enter a username"
                },
                password: {
                    required: "Please enter a password"
                },
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                },
                contact_no: {
                    required: "Please enter a valid contact number",
                    digits: "Please enter only digits"
                },
                state_id: {
                    required: "Please select a state"
                },present_address
                district_id: {
                    required: "Please select a district"
                },
                present_address: {
                    required: "Please enter your present address"
                },
                permanent_address: {
                    required: "Please enter your permanent address"
                },
                status: {
                    required: "Please select a status"
                }
            },
            submitHandler: function (form) {
                // Handle the form submission here
                form.submit();
            }
        });
    });
</script> --}}

@endsection
