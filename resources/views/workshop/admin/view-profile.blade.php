@extends('workshop.layouts.backend.main')
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
                            <form method="POST" action="{{ route('admin.workshop.profile.update') }}" id="profile_save"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <x-profile-view :profile="$data" :statesdata="$states" :citiesdata="$cities" />

                                <div class="float-end">
                                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                                    <input type="hidden" name="profile_photo_old" value="{{ $data['profile_photo'] }}">
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
           

            // Event listener for state change
            $('.add_state_dropdown').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.get_city') }}",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result); // Debugging log
                        $('.district_dropdown').empty();
                        $('.district_dropdown').append('<option value="">Select District</option>');
                        $.each(result.city, function(key, value) {
                            $(".district_dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

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
        });
    </script>
@endsection
