@extends('training.admin.layouts.page-layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Submitted Assignment Details</h4>

                        <div class="page-title-right">
                            <a href="{{ route('training.admin.class.view',@$id) }}" class="btn btn-md btn-dark">
                                Back</a>
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
                                    <h4 class="card-title mb-4">&nbsp;</h4>
                                </div>
                                <div class="col-md-2">
                                    &nbsp;

                                </div>
                            </div>
                            <div class="row">
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <form action="{{ route('training.admin.class.assignment.store',['id'=>@$id,'assignment_id'=>@$assignment_id]) }}" method="POST">
                                        @csrf
                                        <table id="datatable_2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="table-light">
                                                <tr class="text-center">
                                                    <th>Sl. No</th>
                                                    <th>Username</th>
                                                    <th>User Email</th>
                                                    <th>Contact No</th>
                                                    <th>Answer File</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!$assignment_answers->isEmpty())
                                                    @foreach ($assignment_answers as $key => $answer)
                                                        <tr class="text-center">
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ @$answer->trainingUser->user_name }}</td>
                                                            <td>{{ @$answer->trainingUser->email }}</td>
                                                            <td>{{ @$answer->trainingUser->contact_no }}</td>
                                                            <td>
                                                                <a href="{{ route('training.admin.class.assignment.download', @$answer->assignment_answer) }}">Download</a>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="users[]" value="{{ @$answer->user_id }}">
                                                                <input type="text" name="results[]" {{@$answer->result ? 'readonly' : ''}} value="{{@$answer->result}}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        @if (!$assignment_answers->isEmpty())
                                        <button type="submit">Submit</button>
                                        @endif
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
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                                    <input class="form-control" type="text" name="first_name" required>
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" required>
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name</label>
                                    <input class="form-control" type="text" name="user_name" required>
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
                                        title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        maxlength="10" required>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State</label>
                                    <select class="form-select select2" name="state_id" id="add_state_dropdown" required>
                                        <option value="">Select</option>

                                    </select>

                                    @if ($errors->has('state_id'))
                                        <div class="error">{{ $errors->first('state_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">District</label>
                                    <select class="form-select select2" name="district_id" id="district_dropdown"
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
                                    <textarea name="present_address" class="form-control" required></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address</label>
                                    <textarea name="permanent_address" class="form-control" required></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Mode</label>
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
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo</label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="profile_photo" required>
                                    </div>
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
    <!-- Add this script in the head section of your HTML -->
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
