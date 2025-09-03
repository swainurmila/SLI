@extends('training.admin.layouts.page-layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Users</h4>

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
                                            <table id="datatable_2" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
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
                                                            <td>{{ $value->contact_no }}</td>
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
                                                        <th>Status</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                {{-- {{dd($user_detail_reject)}} --}}

                                                <tbody>
                                                    @foreach ($user_detail_reject as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('user.update-user-details', $value->id) }}" method="POST"
                        id="user_edit{{ @$value->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus value="{{ $value->first_name }}"
                                        name="first_name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                        oninput="this.value = this.value.replace(/^\s+/, '')" maxlength="50">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" onkeypress="return /[a-z A-Z\.]/i.test(event.key)" maxlength="50"
                                    oninput="this.value = this.value.replace(/^\s+/, '')" autofocus value="{{ $value->last_name }}"
                                        name="last_name" required>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text"onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                    oninput="this.value = this.value.replace(/^\s+/, '')"  maxlength="50" autofocus value="{{ $value->user_name }}"
                                        name="user_name" required>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control" type="text" value="" name="password">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="mail" autofocus value="{{ $value->email }}"
                                        name="email" required>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" minlength="10" type="text" autofocus pattern="[6-9]\d{9}"
                                    title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        value="{{ $value->contact_no }}" maxlength="10" name="contact_no" required>
                                </div>
                                {{-- <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Registration
                                        No</label>
                                    <input class="form-control" type="text" value="{{ $value->registration_no }}"
                                         readonly>
                                </div> --}}
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State<span class="text-danger">*</span></label>
                                    <select class="form-select add_state_dropdown" name="state_id" required
                                        >
                                        <option>Select State</option>
                                        {{-- <option>Odisha</option> --}}
                                        @foreach ($states as $val)
                                            <option value="{{ $val->id }}"
                                                {{ $val->id == $value->state_id ? 'selected' : '' }}>
                                                {{ $val->state_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">District<span class="text-danger">*</span></label>
                                    <select class="form-select district_dropdown" name="district_id"
                                         required>
                                        <option>Select District</option>
                                        @foreach ($cities as $val)
                                            <option value="{{ $val->id }}"
                                                {{ $val->id == $value->district_id ? 'selected' : '' }}>
                                                {{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">Qualification</label>
                                    <select class="form-select select2" name="qualification" id="qualification">
                                        <option value="">Select</option>
                                        <option value="10th" {{ $value->education == '10th' ? 'selected' : '' }}>10th
                                        </option>
                                        <option value="12th" {{ $value->education == '12th' ? 'selected' : '' }}>12th
                                        </option>
                                        <option value="Graduation"
                                            {{ $value->education == 'Graduation' ? 'selected' : '' }}>Graduation</option>
                                        <option value="Post Graduation"
                                            {{ $value->education == 'Post Graduation' ? 'selected' : '' }}>Post Graduation
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Course<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus
                                        value="{{ $value->course_name }}" name="course_name" required>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Passing Year<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus
                                        value="{{ $value->passing_year }}" name="passing_year" required>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="present_address" autofocus required class="form-control">{{ $value->present_address }}</textarea>
                                    {{-- <input class="form-control" type="text"
                                    value="" id=""> --}}
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" autofocus required class="form-control">{{ $value->permanent_address }}</textarea>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo<span class="text-danger">*</span></label>

                                    <input type="file" class="form-control" name="profile_photo">
                                    <img class="mt-4" src="{{ $value->profile_photo }}"
                                        style="height: 150px;width: 144;">
                                </div>

                                @if ($value->status == 0)
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Verify User</label>
                                        <select class="form-select" name="status" required>
                                            <option value="">Select</option>
                                            <option value="1" {{ $value->status == '1' ? 'selected' : '' }}>Approve
                                            </option>
                                            <option value="2" {{ $value->status == '2' ? 'selected' : '' }}>Reject
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
                            <button type="reset" class="btn btn-secondary">Reset</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>


                <form action="{{ route('user.add-user-details') }}" method="POST" class="user_details_save"
                    id="user_details_save" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control"  type="text" autofocus name="first_name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                        oninput="this.value = this.value.replace(/^\s+/, '')" maxlength="50"
                                        autocomplete="off">
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="last_name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                        oninput="this.value = this.value.replace(/^\s+/, '')" maxlength="50"
                                        autocomplete="off">
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" autofocus name="user_name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                        oninput="this.value = this.value.replace(/^\s+/, '')"maxlength="60"
                                        autocomplete="off">
                                    @if ($errors->has('user_name'))
                                        <div class="error">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="password" autofocus value="" name="password"
                                        autocomplete="off">
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" autocomplete="off" autofocus>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" minlength="10" name="contact_no" pattern="[6-9]\d{9}"
                                        title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        maxlength="10"  autocomplete="off" autofocus>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State<span class="text-danger">*</span></label>
                                    <select class="form-select select2 add_state_dropdown" name="state_id">
                                        <option value="">Select State</option>
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
                                    <select class="form-select select2 district_dropdown" name="district_id">
                                        <option value="">Select District</option>
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <div class="error">{{ $errors->first('district_id') }}</div>
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
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="present_address" class="form-control" autocomplete="off" autofocus></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address<span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" class="form-control" autocomplete="off" autofocus></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
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
                                    @if ($errors->has('user_mode'))
                                        <div class="error">{{ $errors->first('user_mode') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo<span class="text-danger">*</span></label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" id="profile_photo"
                                            name="profile_photo" accept="image/*">
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

            $("#user_details_save").validate({
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
                        minlength:10
                    },
                    state_id: {
                        required: true
                    },
                    passing_year: {
                        digits: true,
                        maxlength: 4
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
                        filesize_max: 1048576, // Max file size 1 MB (in bytes)
                    },
                    user_mode: {
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
                    passing_year:{
                        maxlength: "Please enter 4 characters"
                    },
                    status: {
                        required: "Please select a status"
                    },
                    profile_photo: {
                        required: "Please select a profile photo",
                        accept: "Please select a valid image file",
                        filesize_max: "Profile photo size must be less than 1 MB"
                    }
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



            $('input[type="file"][name="profile_photo"]').on('change', function() {
                $(this).data('changed', true);
            });


            $('form[id^="user_edit"]').each(function() {
                $(this).validate({
                    rules: {
                        first_name: {
                            required: true,
                            noSpace: true,
                            lettersOnly: true,
                            maxlength: 15
                        },
                        last_name: {
                            required: true,
                            noSpace: true,
                            lettersOnly: true,
                            maxlength: 15
                        },
                        user_name: {
                            required: true,
                            noSpace: true,
                            lettersOnly: true,
                            maxlength: 15
                        },
                        contact_no: {
                            required: true,
                            digits: true,
                            noSpace: true,
                            minlength:10
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
                            accept: "Please upload a valid image file"
                        },
                        district_id: {
                            required: "Please choose a District"
                        },

                        profile_photo: {
                            required: "Profile photo is required",
                            accept: "Please upload a valid image file (jpg, png, jpeg)"
                        },
                    },
                });
            });




            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();

            $('#datatable_3').DataTable();
        });
    </script>
@endsection
