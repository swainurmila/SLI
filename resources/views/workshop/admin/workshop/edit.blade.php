@extends('workshop.layouts.backend.main')
<style>
    .capitalize-first {
        text-transform: capitalize;
    }
</style>
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Workshop</li>
                                <li class="breadcrumb-item active text-custom-primary">Edit Workshop</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">Edit Workshop</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('workshop.update', $workshop->id) }}" method="POST" id="workshop_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Workshop Title</label>
                                            <input type="text" class="form-control form-valid capitalize-first"
                                                name="title" id="title" placeholder="Workshop Name"
                                                value="{{ $workshop->title }}"oninput="capitalizeFirstLetter(this)"
                                                onkeypress="return /[a-z A-Z\.]/i.test(event.key)" maxlength="50">
                                            @if ($errors->has('title'))
                                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Type of Workshop</label>
                                            <select class="form-select form-valid" name="workshop_type" id="workshop_type">
                                                <option value="">Select</option>
                                                <option
                                                    value="Boiler Management"{{ $workshop->workshop_type == 'Boiler Management' ? 'selected' : '' }}>
                                                    Boiler Management</option>
                                                <option
                                                    value="Stress Management"{{ $workshop->workshop_type == 'Stress Management' ? 'selected' : '' }}>
                                                    Stress Management</option>
                                                <option
                                                    value="Organizational Behaviour"{{ $workshop->workshop_type == 'Organizational Behaviour' ? 'selected' : '' }}>
                                                    Organizational Behaviour</option>
                                            </select>
                                            @error('workshop_type')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Start Date</label>
                                                <input type="date" class="form-control form-valid" name="start_date"
                                                    id="start_date" placeholder="" value="{{ $workshop->start_date }}"
                                                    min="{{ date('Y-m-d') }}">
                                                @error('start_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">End Date</label>
                                                <input type="date" class="form-control form-valid" name="end_date"
                                                    id="end_date" placeholder="" value="{{ $workshop->end_date }}"
                                                    min="{{ date('Y-m-d') }}">
                                                @error('end_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Start Time</label>
                                                <input type="time" class="form-control form-valid" name="start_time"
                                                    id="start_time" value="{{ $workshop->start_time }}" placeholder="">
                                                @error('start_time')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">End Time</label>
                                                <input type="time" class="form-control form-valid" name="end_time"
                                                    id="end_time" placeholder="" value="{{ $workshop->end_time }}">
                                                @error('end_time')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="">Workshop Mode</label>
                                                        <select class="form-select form-valid" name="workshop_mode"
                                                            id="workshop_mode">
                                                            <option value="">Select</option>
                                                            <option
                                                                value="online"{{ $workshop->workshop_mode == 'online' ? 'selected' : '' }}>
                                                                Online</option>
                                                            <option
                                                                value="offline"{{ $workshop->workshop_mode == 'offline' ? 'selected' : '' }}>
                                                                Offline</option>
                                                        </select>
                                                        @error('workshop_mode')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="">Price</label>
                                                        <input type="text" class="form-control form-valid"
                                                            name="price" id="price" placeholder="Enter price"
                                                            value="{{ $workshop->price }}"
                                                            onkeypress="return /[0-9.]/.test(event.key)">
                                                        @error('price')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="">Location</label>
                                                        <input type="text" class="form-control form-valid"
                                                            name="location" id="location" placeholder="Enter Location"
                                                            value="{{ $workshop->location }}">
                                                        @error('location')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="">Image</label>
                                                        <input type="file" class="form-control form-valid"
                                                            name="image" id="image" placeholder="">
                                                        <input type="hidden" name="old_image"
                                                            value="{{ $workshop->image }}">
                                                        <img style="height: 100px; width: 108px"
                                                            src="{{ $workshop->image }}" alt="training-image">
                                                        @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Workshop Description</label>
                                            <textarea class="form-control form-valid" name="description" id="description" name="" id=""
                                                cols="20" rows="10">{{ $workshop->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="text-end mt-4">
                                    <button type="submit" class="btn custom-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            function removeErrorMessages() {
                $('.form-valid').each(function() {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                    $(this).next('span').remove(); // Remove the error message
                });
            }

            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#start_date').val();
                var endDate = value;

                if (!startDate || !endDate) {
                    // If either field is empty, no comparison needed
                    return true;
                }

                // Parse dates to compare
                var startDateParts = startDate.split('-');
                var endDateParts = endDate.split('-');

                var startDateTime = new Date(startDateParts[0], startDateParts[1] - 1, startDateParts[
                    2]); // Month in JavaScript Date object is zero-based
                var endDateTime = new Date(endDateParts[0], endDateParts[1] - 1, endDateParts[2]);

                // Compare dates
                return endDateTime > startDateTime;
            }, "End date must be greater than Start date");


            $.validator.addMethod('greaterThanZero', function(value, element) {
                return parseFloat(value) > 0;
            }, 'Price must be greater than 0');

            $.validator.addMethod('noLeadingZeros', function(value, element) {
                return /^[1-9][0-9]*$/.test(value);
            }, 'Price cannot have leading zeros');


            $('#course_end_date').change(function() {
                var startDate = new Date($('#course_start_date').val());
                var endDate = new Date($(this).val());

                if (endDate <= startDate) {
                    alert('End date must be greater than start date');
                    $(this).val('');
                }
            });

            $('#course_start_date').change(function() {
                $('#course_end_date').trigger('change');
            });

            $("#workshop_save").validate({
                rules: {
                    title: {
                        required: true,
                        noSpace: true
                    },
                    workshop_type: {
                        required: true,
                        noSpace: true
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                        greaterThanStartDate: true
                    },
                    start_time: {
                        required: true,
                    },
                    end_time: {
                        required: true,
                    },
                    workshop_mode: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    location: {
                        required: true,
                    },
                    description: {
                        required: true,
                        noSpace: true
                    },
                    image: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 1048576 // 1 MB in bytes
                    }
                },
                messages: {
                    title: {
                        required: "Please enter a title.",
                        noSpace: "Title cannot contain spaces."
                    },
                    workshop_type: {
                        required: "Please select a workshop type.",
                        noSpace: "Workshop type cannot contain spaces."
                    },
                    start_date: {
                        required: "Please select a start date."
                    },
                    end_date: {
                        required: "Please select an end date.",
                        greaterThanStartDate: "End date must be greater than start date."
                    },
                    start_time: {
                        required: "Please select a start time."
                    },
                    end_time: {
                        required: "Please select an end time."
                    },
                    workshop_mode: {
                        required: "Please select an mode of workshop."
                    },
                    price: {
                        required: "Please enter price."
                    },
                    location: {
                        required: "Please enter a location."
                    },
                    description: {
                        // required: "Please enter a description."
                    },
                    image: {
                    extension: "Please upload a valid image file (JPG, JPEG, PNG).",
                    filesize: "Image must be less than 1 MB."
                }
                },
                submitHandler: function(form) {
                    removeErrorMessages();
                    form.submit();
                }
            });
        });
        $('#image').change(function() {
            var inputFile = $(this)[0].files[0];

            // Check if file was uploaded
            if (inputFile) {
                var fileSize = inputFile.size;
                var fileType = inputFile.type;

                // Allowed file types (you can customize this array)
                var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/pdf'];

                // Maximum file size in bytes (adjust as per your requirement)
                var maxSize = 1* 1024 * 1024; // 1 MB

                // Validate file type
                if (allowedTypes.indexOf(fileType) === -1) {
                    $('#fileValidationMessage').html('Invalid file type. Please upload a valid image file.');
                    $(this).val(''); // Clear the file input
                    return;
                }

                // Validate file size
                if (fileSize > maxSize) {
                    $('#fileValidationMessage').html(
                        'File size exceeds the limit. Please upload an image less than 1MB.');
                    $(this).val(''); // Clear the file input
                    return;
                }

                // If the file passes validation, you can display a success message or perform any other action
                $('#fileValidationMessage').html('File is valid.'); // Example success message
            }
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

                    // if($('#payment_type').val() == '0'){
                    //     errcount--;
                    // }
                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            //  alert(errcount);
            if (errcount == 0) {
                $('#workshop_save').submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }
    </script>
    <script>
        function validateTime() {
            var startTime = document.getElementById('start_time').value;
            var endTime = document.getElementById('end_time').value;

            // Check if both start and end times are provided
            if (startTime && endTime && startTime >= endTime) {
                alert('End time should be greater than start time');
                document.getElementById('end_time').value = '';
            }
        }
        document.getElementById('start_time').addEventListener('change', validateTime);
        document.getElementById('end_time').addEventListener('change', validateTime);
    </script>
    <script>
        function capitalizeFirstLetter(input) {
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
        }
    </script>
@endsection
