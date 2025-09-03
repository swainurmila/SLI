@extends('finance.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">My Profile</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.finance.profile.update') }}" id="profile_save"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <x-profile-view :profile="$data" :statesdata="$states" :citiesdata="$cities" />

                                <div class="float-end">
                                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                                    <input type="hidden" name="profile_photo_old" value="{{ $data['profile_photo'] }}">
                                    @if ($errors->has('profile_photo'))
                                        <div class="error">{{ $errors->first('profile_photo') }}</div>
                                    @endif
                                    <a href="{{ route('finance.dashboard.show') }}" type="button"
                                        class="btn btn-danger waves-effect waves-light">Back</a>
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');

            $.validator.addMethod('filetype', function(value, element, param) {
                if (element.files.length > 0) {
                    var fileType = element.files[0].type;
                    var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    return allowedTypes.includes(fileType);
                }
                return true;
            }, 'Only JPEG, PNG, JPG files are allowed');



            // Form validation
            $("#profile_save").validate({
                rules: {
                    first_name: {
                        required: true,
                        noSpace: true,
                    },
                    last_name: {
                        required: true,
                        noSpace: true, // Fixed syntax error
                    },
                    user_name: {
                        required: true
                    },
                    contact_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    profile_photo: {
                        // required: true,
                        filesize_max: 1048576,
                        filetype: true,
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
                    }
                }
            });
            $('#profile_photo').on('change', function() {
                $(this).valid(); // Trigger validation on file input change
            });
        });
    </script>
@endsection
