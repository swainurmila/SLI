@extends('Eoffice.admin.layouts.page-layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    @role('Admin', 'officer')
                                        <h4 class="card-title mb-4">Users</h4>
                                    @else
                                        <h4 class="card-title mb-4">My Team</h4>
                                    @endrole
                                </div>

                                @role('Eoffice Admin', 'officer')
                                    <div class="col-md-2">
                                        <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                            data-bs-target="#addModal">Add User</button>
                                    </div>
                                @endrole
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
                                            <table id="datatable_1" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        <th>Organization</th>
                                                        <th>Designation</th>
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                        @role('Eoffice Admin', 'officer')
                                                            <th>Action</th>
                                                        @endrole
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user_detail_pending as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>{{ @$value->company }}</td>
                                                            <td>{{ @$value->designation }}</td>
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td> <span class="badge bg-warning">Pending</span></td>
                                                            @role('Eoffice Admin', 'officer')
                                                                <td>

                                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                        title="Edit" data-bs-toggle="modal"
                                                                        data-bs-target="#editTranModal{{ @$value->id }}">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </td>
                                                            @endrole

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                    <div class="tab-pane" id="pen-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable_2" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        <th>Organization</th>
                                                        <th>Designation</th>
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($user_detail_approve as $key => $value)
                                                    {{-- {{dd($value)}}  --}}
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>{{ @$value->company ?? '---' }}</td>
                                                            <td>{{ @$value->designation ?? '---' }}</td>
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td> <span class="badge bg-success">Approved</span></td>


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
                                                        <th>Organization</th>
                                                        <th>Designation</th>
                                                        <th>Contact No</th>

                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user_detail_reject as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>{{ @$value->company ?? '---' }}</td>
                                                            <td>{{ @$value->designation ??'---' }}</td>
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td><span class="badge bg-danger">Rejected</span></td>


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

    @foreach ($user_detail_pending as $key => $value)
        <div class="modal fade" id="editTranModal{{ @$value->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            User
                            Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('admin.office.user.update', $value->id) }}" method="POST"
                        id="book_edit{{ @$value->id }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First
                                        Name</label>
                                    <input class="form-control" type="text" value="{{ $value->first_name }}"
                                        name="first_name">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last
                                        Name</label>
                                    <input class="form-control" type="text" value="{{ $value->last_name }}"
                                        name="last_name">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User
                                        Name</label>
                                    <input class="form-control" type="text" value="{{ $value->user_name }}"
                                        name="user_name">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control" type="text" value="" name="password">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email</label>
                                    <input class="form-control" type="mail" value="{{ $value->email }}"
                                        name="email">
                                </div>




                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact
                                        No</label>
                                    <input class="form-control" type="text" value="{{ $value->contact_no }}"
                                        name="contact_no">
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">Company /
                                        Organization</label>
                                    <input type="text" class="form-control" value="{{ @$value->company }}"
                                        name="company">

                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">Designation</label>
                                    <input type="text" class="form-control" value="{{ @$value->designation }}"
                                        name="designation">
                                </div>
                                {{-- <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Registration
                                    No</label>
                                <input class="form-control" type="text" value="{{ $value->registration_no }}"
                                     readonly>
                            </div> --}}
                                {{-- <div class="col-sm-12 col-lg-4">
                                <label class="col-form-label">State</label>
                                <select class="form-select" name="state_id" id="state_dropdown_{{ $value->id }}">
                                    <option>Select</option>
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
                            </div> --}}
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
                                    <input type="file" class="form-control" name="profile_photo">

                                    <img src="{{ asset($value->profile_photo) }}" style="height: 100px;width: 100px;">
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User
                                        Role</label>
                                    <select class="form-select" name="role_id" required>
                                        <option value="">Select
                                        </option>
                                        @foreach ($roles as $role)
                                            <option value="{{ @$role->id }}"
                                                {{ @$value->role_id == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst(@$role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">
                                        User Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="">Select
                                        </option>
                                        <option value="0"{{ $value->status == 0 ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="1"{{ $value->status == 1 ? 'selected' : '' }}>
                                            Approve
                                        </option>
                                        <option value="2"{{ $value->status == 2 ? 'selected' : '' }}>
                                            Reject
                                        </option>
                                    </select>
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Purpose</label>
                                    <select class="form-select" name="login_for" required>
                                        <option value="">Select
                                        </option>
                                        <option value="office" {{ $value->login_for == 'office' ? 'selected' : '' }}>
                                            Office</option>
                                        <option value="appointment"
                                            {{ $value->login_for == 'appointment' ? 'selected' : '' }}>
                                            Appointment</option>
                                    </select>
                                    @if ($errors->has('login_for'))
                                        <div class="error">
                                            {{ $errors->first('login_for') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="hidden" name="profile_photo_old" value="{{ $value->profile_photo }}">
                            <button type="submit" class="btn custom-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- ================= --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('admin.office.user.store') }}" method="POST" id="user_details_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name</label>
                                    <input class="form-control" type="text" name="first_name"
                                        oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')"
                                        maxlength="30" required>
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name"
                                        oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')"
                                        maxlength="30" required>
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name</label>
                                    <input class="form-control" type="text" name="user_name"
                                        oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')"
                                        maxlength="30" required>
                                    @if ($errors->has('user_name'))
                                        <div class="error">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control" type="password" value="" name="password" required>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No</label>
                                    <input class="form-control" type="text" name="contact_no" pattern="[6-9]\d{9}"

                                        maxlength="10" onkeypress="return /[0-9]/.test(event.key)" required>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label class="form-label" for="company">Company / Organization</label>
                                    <input type="text" class="form-control" name="company" id="company"oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')" maxlength="30">
                                    @if ($errors->has('company'))
                                        <div class="error">{{ $errors->first('company') }}</div>
                                    @endif

                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="form-label" for="designation">Designation</label>
                                    <input type="text" class="form-control" name="designation" id="designation" oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')"maxlength="30">
                                    @if ($errors->has('designation'))
                                        <div class="error">{{ $errors->first('designation') }}</div>
                                    @endif
                                </div>
                                {{-- <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State</label>
                                    <select class="form-select select2" name="state_id" id="add_state_dropdown" required>
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
                                    <label class="col-form-label">City</label>
                                    <select class="form-select select2" name="district_id" id="district_dropdown" required>
                                        <option value="">Select</option>
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <div class="error">{{ $errors->first('district_id') }}</div>
                                    @endif
                                </div> --}}
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address</label>
                                    <textarea name="present_address" class="form-control" maxlength="100" required></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address</label>
                                    <textarea name="permanent_address" class="form-control" maxlength="100" required></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Role</label>
                                    <select class="form-select" name="role_id" required>
                                        <option value="">Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ @$role->id }}">{{ ucfirst(@$role->name) }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <div class="error">{{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo</label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="profile_photo"
                                            accept="image/jpeg, image/jpg, image/png" required>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Purpose</label>
                                    <select class="form-select" name="login_for" required>
                                        <option value="">Select</option>
                                        <option value="office">Office</option>
                                        <option value="appointment">Appointment</option>
                                    </select>
                                    @if ($errors->has('login_for'))
                                        <div class="error">{{ $errors->first('login_for') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");

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
            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/.test(value);
            }, "Letters only please");


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
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    user_name: {
                        required: true,
                    },
                    contact_no: {
                        required: true,
                        tenDigitNumber: true
                    },
                    email: {
                        required: true,
                        email: true,
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
                    // state_id: {
                    //     required: true
                    // },
                    // district_id: {
                    //     required: true
                    // },
                    present_address: {
                        required: true
                    },
                    permanent_address: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                    company: {
                        required: true
                    },
                    designation: {
                        required: true
                    }

                },
                messages: {
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
                        accept: "Please upload a valid image file"
                    },
                    // district_id: {
                    //     required: "Please choose a city"
                    // },

                    profile_photo: {
                        required: "Profile photo is required",
                        filesize_max: "Profile photo size must be less than 1 MB"
                    },
                    submitHandler: function(form) {
                        if ($("#user_details_save").valid()) {
                            form.submit();
                        }
                    }
                }
            });
            $('#addModal').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });




            $('input[type="file"][name="profile_photo"]').on('change', function() {
                $(this).data('changed', true);
            });


            $('form[id^="book_edit"]').each(function() {
                $(this).validate({
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
                            tenDigitNumber: true,
                            noSpace: true,
                        },
                        email: {
                            required: true,
                            email: true,
                            noSpace: true,
                            customEmailDomain: true
                        },
                        password: {
                            required: {
                                depends: function(element) {
                                    return $.trim($(element).val()).length > 0;
                                }
                            },
                            minlength: 8,
                            strongPassword: true
                        },
                        profile_photo: {
                            required: {
                                depends: function(element) {
                                    return $(element).data('changed') === true;
                                }
                            },
                            filesize_max: 1048576
                        },
                        // state_id: {
                        //     required: true
                        // },
                        // district_id: {
                        //     required: true
                        // },
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
                        company: {
                            required: true
                        },
                        designation: {
                            required: true
                        },
                        user_mode: {
                            required: true,
                        }

                    },
                    messages: {
                        email: {
                            required: "Email is required",
                            email: "Email must be a valid email address",
                            noSpace: "Email cannot contain only spaces"
                        },
                        password: {
                            required: "Password is required",
                            minlength: "Password must be at least 8 characters",
                        },
                        profile_photo: {
                            required: "Profile photo is required",
                        },
                        // district_id: {
                        //     required: "Please choose a city"
                        // },
                    },
                });
            });
        });


        $(document).ready(function() {
            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();

            $('#datatable_3').DataTable();
        });
    </script>
@endsection
