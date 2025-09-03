@extends('workshop.layouts.backend.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">USERS</h4>

                        <div class="page-title-right">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add User Details</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
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
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#enr-tab" role="tab">
                                            <span class="d-none d-sm-block">Enrolled</span>
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
                                                        {{-- <th>Regd No</th> --}}
                                                        <th>Contact No</th>
                                                        <th>Created By</th>
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
                                                            <td>{{ $value->createdBy->role ?? '-' }}</td>
                                                            <td> Pending</td>
                                                            <td>
                                                                <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                    title="Edit" data-bs-toggle="modal"
                                                                    data-bs-target="#editTranModal"
                                                                    data-user-id="{{ $value->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <div class="modal fade" id="editTranModal"
                                                                data-user-id="{{ @$value->id }}" data-bs-backdrop="static"
                                                                data-bs-keyboard="false" tabindex="-1" role="dialog"
                                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="staticBackdropLabel">User Details</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>

                                                                        <form
                                                                            action="{{ route('workshop.users.update', ['id' => $value->id, 'status' => $value->status]) }}"
                                                                            method="POST" id="user_edit{{ @$value->id }}"
                                                                            enctype="multipart/form-data"
                                                                            onsubmit="return edit_user({{ @$value->id }})">
                                                                            {{ csrf_field() }}
                                                                            <div class="modal-body">
                                                                                <div class="mb-3 row">
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">First
                                                                                            Name:</label>
                                                                                        <input class="form-control"
                                                                                            type="text" autofocus
                                                                                            value="{{ $value->first_name }}"
                                                                                            name="first_name" readonly>
                                                                                        @error('first_name')
                                                                                            <div class="error text-danger"
                                                                                                style="color: red;">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Last
                                                                                            Name:</label>
                                                                                        <input class="form-control"
                                                                                            type="text" autofocus
                                                                                            value="{{ $value->last_name }}"
                                                                                            name="last_name" readonly>
                                                                                        @error('last_name')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">User
                                                                                            Name:</label>
                                                                                        <input class="form-control"
                                                                                            type="text" autofocus
                                                                                            value="{{ $value->user_name }}"
                                                                                            name="user_name" readonly>
                                                                                        @error('user_name')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    {{-- <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Password</label>
                                                                                        <input class="form-control"
                                                                                            type="text" value=""
                                                                                            name="password">
                                                                                    </div> --}}
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Email:</label>
                                                                                        <input class="form-control"
                                                                                            type="mail" autofocus
                                                                                            value="{{ $value->email }}"
                                                                                            name="email" readonly>
                                                                                        @error('email')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Contact
                                                                                            No:</label>
                                                                                        <input class="form-control"
                                                                                            type="text" autofocus
                                                                                            value="{{ $value->contact_no }}"
                                                                                            name="contact_no" readonly>
                                                                                        @error('contact_no')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label
                                                                                            class="col-form-label">State:</label>
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
                                                                                        @error('state_id')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label
                                                                                            class="col-form-label">District:</label>
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

                                                                                        @error('district_id')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label
                                                                                            class="col-form-label">Qualification:</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="qualification" readonly
                                                                                            id="qualification"
                                                                                            value="{{ $value->education }}">

                                                                                        @error('qualification')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Course:</label>
                                                                                        <input class="form-control"
                                                                                            type="text" autofocus
                                                                                            value="{{ $value->course_name }}"
                                                                                            name="course_name" readonly>
                                                                                        @error('course_name')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Passing
                                                                                            Year:</label>
                                                                                        <input class="form-control"
                                                                                            type="text" autofocus
                                                                                            value="{{ $value->passing_year }}"
                                                                                            name="passing_year" readonly>
                                                                                        @error('passing_year')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Present
                                                                                            Address:</label>
                                                                                        <textarea name="present_address" autofocus readonly class="form-control">{{ $value->present_address }}</textarea>
                                                                                        @error('present_address')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror

                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">Permanent
                                                                                            Address:</label>
                                                                                        <textarea name="permanent_address" autofocus readonly class="form-control">{{ $value->permanent_address }}</textarea>
                                                                                        @error('permanent_address')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for="avatar"
                                                                                            class="col-md-4 col-form-label text-md-right">Profile
                                                                                            Photo:</label><br>

                                                                                        {{-- <input type="file"
                                                                                            class="form-control"
                                                                                            name="profile_photo" readonly> --}}
                                                                                        <img class=""
                                                                                            src="{{ $value->profile_photo }}"
                                                                                            style="height: 150px;width: 144;">
                                                                                        @error('profile_photo')
                                                                                            <div class="error text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>

                                                                                    @if ($value->status == 0)
                                                                                        <div class="col-sm-12 col-lg-4">
                                                                                            <label for=""
                                                                                                class="col-form-label"
                                                                                                id="user_mode">Verify
                                                                                                User: <span
                                                                                                    class="text-danger">*</span></label>
                                                                                            <select class="form-select"
                                                                                                name="verify_user"
                                                                                                id="verify_user" >
                                                                                                <option value="">
                                                                                                    Select</option>
                                                                                                <option value="1"
                                                                                                    {{ $value->status == '1' ? 'selected' : '' }}>
                                                                                                    Approve
                                                                                                </option>
                                                                                                <option value="2"
                                                                                                    {{ $value->status == '2' ? 'selected' : '' }}>
                                                                                                    Reject
                                                                                                </option>
                                                                                            </select>
                                                                                            <div id="verify_user_error{{ @$value->id }}"
                                                                                                class="text-danger error-text"
                                                                                                style="display: none;">
                                                                                                Please select an option.
                                                                                            </div>
                                                                                            @error('verify_user')
                                                                                                <div class="error text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <input type="hidden"
                                                                                    name="profile_photo_old"
                                                                                    value="{{ $value->profile_photo }}">
                                                                                <button type="submit"
                                                                                    class="btn custom-btn">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                        <th>Contact No</th>
                                                        <th>Created By</th>
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
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td>{{ $value->createdBy->role ?? '-' }}</td>
                                                            <td> Approved</td>
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
                                                        <th>Contact No</th>
                                                        <th>Created By</th>
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
                                                            <td>{{ $value->contact_no }}</td>
                                                            <td>{{ $value->createdBy->role ?? '-' }}</td>
                                                            <td> Rejected</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="enr-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable_3" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Workshop</th>
                                                        <th>Paid Amount</th>
                                                        <th>Date</th>

                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($enrolled_student as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->user->first_name }}
                                                                {{ $value->user->last_name }}</td>
                                                            <td>{{ $value->workshop->title }}</td>
                                                            <td>{{ $value->transaction->amount ?? '-' }}</td>
                                                            <td>{{ $value->created_at->format('d-m-Y') }}</td>
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

    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>


                <form action="{{ route('user.store-user') }}" method="POST" class="user_details_save"
                    id="user_details_save" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="first_name" pattern="[a-zA-Z\s]+" onkeypress="return validateKeyPress(event)" maxlength="50"
                                        autocomplete="off">
                                    @if ($errors->has('first_name'))
                                        <div class="error text-danger">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="last_name" pattern="[a-zA-Z\s]+" onkeypress="return validateKeyPress(event)"maxlength="50"
                                        autocomplete="off">
                                    @if ($errors->has('last_name'))
                                        <div class="error text-danger">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="user_name" pattern="[a-zA-Z\s]+" onkeypress="return validateKeyPress(event)"
                                        autocomplete="off" maxlength="100">
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
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="state_id" id="add_state_dropdown">
                                        <option value="">Select State</option>
                                        @foreach ($states as $item)
                                            <option value="{{ $item->id }}">{{ $item->state_title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('state_id'))
                                        <div class="error text-danger">{{ $errors->first('state_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">District<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="district_id" id="district_dropdown">
                                        <option value="">Select District</option>
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <div class="error text-danger">{{ $errors->first('district_id') }}</div>
                                    @endif
                                </div>
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
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <label class="col-form-label">Course</label>
                                    <input type="text" class="form-control" name="course_name" id="course_name">
                                    @error('course_name')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <label class="col-form-label">Passing Year</label>
                                    <input type="text" class="form-control" name="passing_year" id="passing_year" maxlength="4"
                                        placeholder="e.g.2024" pattern="\d{4}">
                                    @error('passing_year')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="present_address" class="form-control" autocomplete="off" autofocus></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error text-danger">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" class="form-control" autocomplete="off" autofocus></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error text-danger">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Mode<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="user_mode" id="user_mode">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @if ($errors->has('user_mode'))
                                        <div class="error text-danger">{{ $errors->first('user_mode') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo<span class="text-danger">*</span></label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" id="profile_photo"
                                            name="profile_photo" accept="image/*" onchange="Filevalidation()">
                                    </div>

                                    @if ($errors->has('profile_photo'))
                                        <div class="error text-danger">{{ $errors->first('profile_photo') }}</div>
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
    <!-- Add this script in the head section of your HTML -->
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('#verify_user').on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption !== '') {

                    $('.error-text').css('display', 'none');
                }
            });
            function clearFormFields() {
                $("#user_details_save")[0].reset(); // Reset the form
                $("#user_details_save").validate().resetForm(); // Reset the validation state
            }


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
            // $.validator.addMethod("validPassingYear", function(value, element) {
            //     var currentYear = new Date().getFullYear();
            //     return this.optional(element) || (value <= currentYear);
            // }, "The passing year must be less than or equal to the current year");
            // $('#profile_photo').on('input', function() {
            //         const size = (this.files[0].size / 1024 / 1024).toFixed(2);

            //         if (size > 1) {
            //             alert("Please upload a file size less than or equal to 1MB");
            //             $(this).val('');
            //         } else {
            //             $("#output").html('<b>' +
            //                 'This file size is: ' + size + " MB" + '</b>');
            //         }
            //     });
            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');

            $.validator.addMethod('filetype', function(value, element, param) {
                if (element.files.length > 0) {
                    var fileType = element.files[0].type;
                    var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    return allowedTypes.includes(fileType);
                }
                return true;
            }, 'Only JPEG, PNG, JPG files are allowed');

            var passingYearInput = document.getElementById('passing_year');

        passingYearInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

            $("#user_details_save").validate({
                rules: {
                    first_name: {
                        required: true,
                        // noSpace: true,
                        // lettersOnly: true,

                    },
                    last_name: {
                        required: true,
                        // noSpace: true,
                        // lettersOnly: true,

                    },
                    user_name: {
                        required: true,
                        // noSpace: true,
                        // lettersOnly: true,

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
                    status: {
                        required: true
                    },
                    profile_photo: { // New rule for profile photo
                        required: true,
                        filesize_max: 1048576,
                        filetype :true, // Max file size 1 MB (in bytes)
                    },
                    user_mode: {
                    //  required: true,
                    }
                    // passing_year: { // New rule for passing year
                    //     required: true,
                    //     digits: true,
                    //     validPassingYear: true
                    // }
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "First name cannot contain only spaces",

                    },
                    last_name: {
                        required: "Please enter your last name",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "Last name cannot contain only spaces",

                    },
                    user_name: {
                        required: "Please enter a username",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "User name cannot contain only spaces",

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
                    status: {
                        required: "Please select a verify user"
                    },
                    profile_photo: {
                        required: "Please select a Profile photo",
                        filetype: "Please select a valid  file",
                        filesize_max: "Image size must be less than 1 MB"
                    },
                    user_mode: {
                    //  required: "Please select User Mode"
                    },
                    // passing_year: {
                    //     required: "Please enter your passing year",
                    //     digits: "Please enter a valid year",
                    //     validPassingYear: "The passing year must be less than or equal to the current year"
                    // }
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
            $('#profile_photo').on('change', function() {
                $(this).valid(); // Trigger validation on file input change
            });



            // $('input[type="file"][name="profile_photo"]').on('change', function() {
            //     $(this).data('changed', true);
            // });


            $('[id^=editTranModal]').on('show.bs.modal', function() {
                var form = $(this).find('form')[0];
                var initialState = $(form).serializeArray();
                $(this).data('initialState', initialState);

                // Save the initial value of select fields
                $(this).find('select').each(function() {
                    $(this).data('initialValue', $(this).val());
                });
            });

            // Event listener for modal hidden event to reset the form
            $('[id^=editTranModal]').on('hidden.bs.modal', function() {
                var form = $(this).find('form')[0];
                form.reset();

                // Restore the initial values of select fields
                $(this).find('select').each(function() {
                    var initialValue = $(this).data('initialValue');
                    $(this).val(initialValue).trigger('change');
                });

                // Reset the file input and image preview
                $(this).find('input[type="file"]').val(null);
                var defaultImageSrc = $(this).find('input[name="profile_photo_old"]').val();
                $(this).find('img').attr('src', defaultImageSrc);
            });

            function updateDistricts(stateId, districtDropdownId) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.get_city') }}",
                    data: {
                        state_id: stateId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $(districtDropdownId).empty();
                        $(districtDropdownId).append('<option value="">' + "Select District" +
                            '</option>');
                        $.each(result.city, function(key, value) {
                            $(districtDropdownId).append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            }

            $(document).ready(function() {
                // For add form
                $('#add_state_dropdown').on('change', function() {
                    var stateId = $(this).val();
                    updateDistricts(stateId, '#district_dropdown');
                });

                // For edit forms
                $('select[id^="state_dropdown_"]').on('change', function() {
                    var stateId = $(this).val();
                    var districtDropdownId = '#district_dropdown_' + $(this).attr('id').split('_')
                        .pop();
                    updateDistricts(stateId, districtDropdownId);
                });
            });





            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();

            $('#datatable_3').DataTable();
        });
    </script>
    <script>
        function edit_user(e) {
            var data = $("#verify_user").val();
            // alert(issue_date);
            if (!data) {
                // alert("Please verify the user.");
                $('#verify_user_error' + e).show();
                return false;
            }
        }
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
