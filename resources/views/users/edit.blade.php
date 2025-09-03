@extends('layouts.backend.header')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Users</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">Add User</h4>
                                </div>

                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    {!! Form::model($user, ['method' => 'POST', 'route' => ['users.update', $user->id]]) !!}
                                    {{ method_field('PUT') }}
                                    {{-- error --}}
                                    @if (\Session::has('error'))
                                        <div id="error" class="text-danger">
                                            {!! \Session::get('error') !!}
                                        </div>
                                    @endif

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">First Name:</label>
                                                <input type="text" id="exampleInputUsername"
                                                    onkeypress="return /[a-z A-Z]/i.test(event.key)" class="form-control"
                                                    name="first_name" placeholder="First Name"
                                                    value="{{ $user->first_name }}">
                                                @if ($errors->has('first_name'))
                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Last Name:</label>
                                                <input type="text" id="exampleInputUsername"
                                                    onkeypress="return /[a-z A-Z]/i.test(event.key)" class="form-control"
                                                    name="last_name" placeholder="Last Name" value="{{ $user->last_name }}">
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Role:</label>
                                                <select name="role_id" id="role_id" class="form-control"
                                                    required="required">
                                                    <option value="">Please select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('role'))
                                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2" id="user_for_container">
                                            <div class="form-group">
                                                <label class="form-label">User For:<sup><span
                                                            style="color: red;">*</span></sup></label>
                                                <select name="user_for" id="user_for" class="form-control form-valid"
                                                    required="required">
                                                    <option value="">Please select user</option>
                                                    <option value="library" {{ $user->is_library == '1' ? 'selected' : '' }}>Library</option>
                                                    <option value="training" {{ $user->is_training == '1' ? 'selected' : '' }}>Training</option>
                                                    <option value="course" {{ $user->is_course == '1' ? 'selected' : '' }}>Course</option>
                                                    <option value="workshop" {{ $user->is_workshop == '1' ? 'selected' : '' }}>Workshop</option>
                                                </select>
                                                @if ($errors->has('user_for'))
                                                    <span class="text-danger">{{ $errors->first('user_for') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2" id="trainer_for_container">
                                            <div class="form-group">
                                                <label class="form-label">Trainer For:<sup><span
                                                            style="color: red;">*</span></sup></label>
                                                <select name="trainer_for" id="trainer_for" class="form-control form-valid"
                                                    required="required">
                                                    <option value="">Please select trainer</option>
                                                    <option value="training" {{ $user->is_training == '1' ? 'selected' : '' }}>Training</option>
                                                    <option value="course" {{ $user->is_course == '1' ? 'selected' : '' }}>Course</option>
                                                </select>
                                                @if ($errors->has('trainer_for'))
                                                    <span class="text-danger">{{ $errors->first('trainer_for') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4 mb-2">
                                            <div class="form-group">
                                                <label class="form-label">User Name:</label>
                                                <input type="text" id="exampleInputUsername" class="form-control"
                                                    name="user_name" placeholder="User Name"
                                                    value="{{ @$user->user_name }}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email:</label>
                                                <input type="text" id="exampleInputUsername" class="form-control"
                                                    name="email" placeholder="User mail" value="{{ $user->email }}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group">
                                                <label class="form-label">Contact No: <sup><span
                                                            style="color: red;">*</span></sup></label>
                                                <input type="text" id="exampleInputPassword" class="form-control"
                                                    name="contact_no" placeholder="Contact No" required="required"
                                                    maxlength="10" value="{{ @$user->contact_no }}">
                                                @if ($errors->has('contact_no'))
                                                    <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group">
                                                <label class="form-label">Employee ID: <sup><span
                                                            style="color: red;">*</span></sup></label>
                                                <input type="text" id="exampleInputEmpId" class="form-control"
                                                    name="registration_no" placeholder="Employee Id"
                                                    value="{{ @$user->registration_no }}"required>
                                                @if ($errors->has('registration_no'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('registration_no') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-themed">UPDATE
                                                    USER</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        {{-- </div> --}}
    @endsection


    @section('scripts')
        <script>
            function showDropdown(selectedRole) {
                if (selectedRole == '5') { // Assuming role_id 5 is User For
                    $('#user_for_container').show();
                    $('#user_for').prop('required', true);
                    $('#trainer_for_container').hide();
                    $('#trainer_for').prop('required', false);
                    $('#trainer_for').val(null);

                } else if (selectedRole == '6') { // Assuming role_id 6 is Trainer For
                    $('#trainer_for_container').show();
                    $('#trainer_for').prop('required', true);
                    $('#user_for_container').hide();
                    $('#user_for').prop('required', false);
                    $('#user_for').val(null);

                } else {
                    $('#user_for_container').hide();
                    $('#trainer_for_container').hide();
                    $('#user_for').prop('required', false);
                    $('#trainer_for').prop('required', false);
                }
            }

            var selectedRoleId = $('#role_id').val();

            showDropdown(selectedRoleId);

            $('#role_id').change(function() {
                var selectedRole = $(this).val();
                if (selectedRole == '5') {
                    $('#user_for_container').show();
                    $('#user_for').prop('required', true);
                    $('#trainer_for_container').hide();
                    $('#trainer_for').prop('required', false);
                    $('#trainer_for').val(null);

                } else if (selectedRole == '6') {
                    $('#trainer_for_container').show();
                    $('#trainer_for').prop('required', true);
                    $('#user_for_container').hide();
                    $('#user_for').prop('required', false);
                    $('#user_for').val(null);

                } else {
                    $('#user_for_container').hide();
                    $('#trainer_for_container').hide();
                    $('#user_for').prop('required', false);
                    $('#trainer_for').prop('required', false);
                }
            });
        </script>
    @endsection
