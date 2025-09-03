@extends('training.admin.layouts.page-layouts.main')
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
                            <form method="POST" action="{{ route('admin.training.profile.update') }}" id="profile_save"
                                enctype="multipart/form-data" onsubmit="">
                                @method('PATCH')
                                @csrf
                                <x-profile-view :profile="$data" :statesdata="$states" :citiesdata="$cities" />

                                <div class="float-end">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="profile_photo_old" value="{{ $data->profile_photo }}">
                                    <a href="{{ route('admin.training.dashboard') }}" type="button"
                                        class="btn btn-danger waves-effect waves-light">Back</a>
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                </div>
                                <!-- end table-responsive -->
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#state_id').on('change', function() {
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
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Select District</option>');
                    $.each(result.city, function(key, value) {
                        $("#district_id").append('<option value= "' + value
                            .id +
                            '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
    // function saveForm() {
    //     var errcount = 0;
    //     $(".error-span").remove();

    //     $("span").remove();
    //     $('.form-valid').each(function() {
    //         if ($(this).val() == '') {
    //             errcount++;
    //             $(this).addClass('error-text');
    //             $(this).removeClass('success-text');
    //             $(this).after('<span style="color:red">This field is required</span>');
    //         } else {
    //             $(this).removeClass('error-text');
    //             $(this).addClass('success-text');
    //         }
    //     });
    //     // alert(errcount);
    //     if (errcount == 0) {
    //         // $.blockUI({ message: '<h1> Loading...</h1>' });

    //         $('#user_details_save').submit();
    //         // $.unblockUI();
    //     } else {
    //         return false;
    //     }
    // }


    $(document).ready(function() {


        $.validator.addMethod('filesize_max', function(value, element, param) {
            if (element.files.length > 0) {
                return element.files[0].size <= param;
            }
            return true;
        }, 'File size must be less than 1 MB');

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

        $("#profile_save").validate({

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
                    minlength: 10,
                    maxlength: 10,
                    noSpace: true,
                    digits: true
                },
                email: {
                    required: true,
                    email: true,
                    noSpace: true,
                    customEmailDomain: true
                },
                profile_photo: {
                    required: function(element) {
                        return $('#profile_photo').val() != '';
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

                first_name: {
                    required: "First Name Is Required"
                },
                last_name: {
                    required: "Last Name Is Required"
                },
                user_name: {
                    required: "User Name Is Required"
                },
                contact_no: {
                    required: "Contact Number Is Required "
                },
                email: {
                    required: "Email Is Required"

                },
                profile_photo: {
                    required: "Profile Photo  Is Required "
                },
                state_id: {
                    required: "State Is Required"
                },
                district_id: {
                    required: "District Is Required"
                },
                present_address: {
                    required: "Present Address Is Required"
                },
                permanent_address: {
                    required: "Permanent Address Is Required",
                },
            },
        })
    });
</script>
