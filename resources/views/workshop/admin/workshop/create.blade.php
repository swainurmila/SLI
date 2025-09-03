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
                                <li class="breadcrumb-item active text-custom-primary">Create New Workshop</li>
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
                                <h4 class="card-title mb-4">Add New Workshop</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('workshop.store') }}" method="POST" id="workshop_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Workshop Title</label>
                                            <input type="text" class="form-control form-valid capitalize-first"
                                                oninput="capitalizeFirstLetter(this)" name="title" id="title"
                                                placeholder="Workshop Name"
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
                                                <option value="Boiler Management">Boiler Management</option>
                                                <option value="Stress Management">Stress Management</option>
                                                <option value="Organizational Behaviour">Organizational Behaviour</option>
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
                                                    id="start_date" placeholder="" min="{{ date('Y-m-d') }}">
                                                @error('start_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">End Date</label>
                                                <input type="date" class="form-control form-valid" name="end_date"
                                                    id="end_date" placeholder="" min="{{ date('Y-m-d') }}">
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
                                                    id="start_time" placeholder="">
                                                @error('start_time')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">End Time</label>
                                                <input type="time" class="form-control form-valid" name="end_time"
                                                    id="end_time" placeholder="">
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
                                                            <option value="online">Online</option>
                                                            <option value="offline">Offline</option>
                                                        </select>
                                                        @error('workshop_mode')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="">Price</label>
                                                        <input type="text" class="form-control form-valid"
                                                            name="price" id="price" placeholder="Enter price"
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
                                                            name="location" id="location" placeholder="Enter Location">
                                                        @error('location')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="">Image</label>
                                                        <input type="file" class="form-control form-valid"
                                                            name="image" id="image" placeholder=""
                                                            accept="image/*" onchange="Filevalidation()">
                                                            {{-- <div id="fileValidationMessage" class="text-danger"></div> --}}
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
                                                cols="20" rows="10" maxlength="500"></textarea>
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
                    $(this).next('span.').remove(); // Remove the error message
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


            $('#end_date').change(function() {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date($(this).val());

                if (endDate <= startDate) {
                    alert('End date must be greater than start date');
                    $(this).val('');
                } else {
                    $(this).next('div.text-danger').remove(); // Remove error message if valid
                }
            });

            $('#start_date').change(function() {
                $('#end_date').trigger('change');
                $(this).next('div.text-danger').remove();
            });
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
                    image: {
                        required: true,
                        filesize_max: 1048576,
                        filetype :true,
                    },
                    description: {
                        required: true,
                        noSpace: true
                    },
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
                    image: {

                        required: "Please select a Image",
                        filetype: "Please select a valid image file",
                        filesize_max: "Image size must be less than 1 MB"
                    },
                    description: {
                        required: "Please enter a description."
                    },
                },

                submitHandler: function(form) {
                    form.submit();
                }
                
            });
            $('#image').on('change', function() {
                $(this).valid(); // Trigger validation on file input change
            });
            $('#start_date, #end_date').on('change', function() {
                $(this).valid();
            });
            $('#start_time, #end_time').change(function() {
                validateTime();
                // Hide the time picker after selecting a time
                $(this).blur();
            });
        });

    
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
            document.activeElement.blur();
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
