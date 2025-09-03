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
                                    <form action="{{ route('users.store') }}" method="post" id="form_submit"
                                        class="comm_frm">
                                        @csrf
                                        {{-- error --}}
                                        @if (\Session::has('error'))
                                            <div id="error" class="text-danger">
                                                {!! \Session::get('error') !!}
                                            </div>
                                        @endif

                                        <div class="row mb-4">
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">First Name:<sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    <input type="text" id="exampleInputUsername"
                                                        class="form-control name-validation form-valid" name="first_name"
                                                        placeholder="First Name" oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')" maxlength="30" required="required">
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">Last Name:<sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    <input type="text" id="exampleInputPassword"
                                                        class="form-control name-validation form-valid" name="last_name"  oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')" maxlength="30"
                                                        placeholder="Last Name" required>
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">Role:<sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    <select name="role_id" id="role_id" class="form-control form-valid"
                                                        required="required">
                                                        <option value="">Please select Role</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                                                        <option value="library">Library</option>
                                                        <option value="training">Training</option>
                                                        <option value="course">Course</option>
                                                        <option value="workshop">Workshop</option>
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
                                                    <select name="trainer_for" id="trainer_for"
                                                        class="form-control form-valid" required="required">
                                                        <option value="">Please select trainer</option>
                                                        <option value="training">Training</option>
                                                        <option value="course">Course</option>
                                                    </select>
                                                    @if ($errors->has('trainer_for'))
                                                        <span class="text-danger">{{ $errors->first('trainer_for') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">User Name:</label>
                                                    <input type="text" id="exampleInputUsername"
                                                        class="form-control name-validation form-valid" name="user_name"  oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')" maxlength="30"
                                                        placeholder="User Name">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Email: <sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required']) !!}
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">Contact No: <sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    <input type="text" id="exampleInputPassword"
                                                        class="form-control contract-number-validation form-valid"
                                                        name="contact_no" placeholder="Contact No" required="required"
                                                        maxlength="10">
                                                    @if ($errors->has('contact_no'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('contact_no') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">Password: <sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    {!! Form::password('password', [
                                                        'placeholder' => 'Password',
                                                        'class' => 'form-control',
                                                        'required' => 'required',
                                                        'id'=>'password'
                                                    ]) !!}
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label">Confirm Password: <sup><span
                                                                style="color: red;">*</span></sup></label>
                                                    {!! Form::password('confirm-password', [
                                                        'placeholder' => 'Confirm Password',
                                                        'class' => 'form-control',
                                                        'required' => 'required',
                                                    ]) !!}
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">

                                                <button type="submit"
                                                    class="btn custom-btn ms-2">ADD
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
        $(document).ready(function() {
        // Initially hide the fields
        $('#user_for_container').hide();
        $('#trainer_for_container').hide();

        // Show/hide fields based on the selected role
        $('#role_id').change(function() {
            var selectedRole = $(this).val();
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
        });

        // jQuery Validation
        $("#form_submit").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                user_name:{
                    required: true
                },
                role_id: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                contact_no: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                password: {
                    required: true
                },
                "confirm-password": {
                    required: true,
                    equalTo: "#password"
                },
                user_for: {
                    required: function(element) {
                        return $('#role_id').val() == '5';
                    }
                },
                trainer_for: {
                    required: function(element) {
                        return $('#role_id').val() == '6';
                    }
                }
            },
            messages: {
                first_name: "Please enter your first name",
                last_name: "Please enter your last name",
                user_name :"Please enter user name",
                role_id: "Please select a role",
                email: "Please enter a valid email address",
                contact_no: {
                    required: "Please enter your contact number",
                    digits: "Please enter a valid contact number",
                    minlength: "Contact number must be 10 digits",
                    maxlength: "Contact number must be 10 digits"
                },
                password: "Please enter your password",
                "confirm-password": {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                user_for: "Please select user for",
                trainer_for: "Please select trainer for"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>
@endsection

{{-- <script>
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

            $('#form_submit').submit();
            // $.unblockUI();
        } else {
            return false;
        }
    }




</script> --}}
