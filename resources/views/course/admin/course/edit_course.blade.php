@extends('course.layouts.admin.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Course</li>
                                <li class="breadcrumb-item active text-custom-primary">Edit Course</li>
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
                                <h4 class="card-title mb-4">Edit Course</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('course.editCourseStore', ['id' => $course_data->id]) }}" method="POST"
                                id="course_edit" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Course Name</label>
                                            <input type="text" class="form-control form-valid" name="course_name"
                                                id="course_name" value="{{ $course_data->course_name }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Course Category</label>
                                            <select class="form-select form-valid" name="course_category_id"
                                                id="course_category_id">
                                                <option value="">Select</option>

                                                @foreach ($cr_categories as $cr_categories)
                                                    <option
                                                        {{ $course_data->course_category_id == $cr_categories->id ? 'selected' : '' }}
                                                        value="{{ $cr_categories->id }}">{{ $cr_categories->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Course Start Date</label>
                                                <input type="date" class="form-control form-valid"
                                                    value="{{ $course_data->course_start_date }}" name="course_start_date"
                                                    id="course_start_date" placeholder="">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Course End Date</label>
                                                <input type="date" class="form-control form-valid"
                                                    value="{{ $course_data->course_end_date }}" name="course_end_date"
                                                    id="course_end_date" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Language</label>
                                                    <select class="form-select form-valid" name="language_id"
                                                        id="language_id">
                                                        <option value="">Select</option>
                                                        @foreach ($languages as $lan)
                                                            <option
                                                                {{ $course_data->language_id == $lan->id ? 'selected' : '' }}
                                                                value="{{ $lan->id }}">{{ $lan->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Course Image</label>
                                                    <input class="form-control form-valid" type="file"
                                                        name="course_image" value="" multiple accept="image/*">
                                                    <input type="hidden" name="old_course_image"
                                                        value="{{ $course_data->course_image }}">
                                                    @if (!empty($course_data->course_image))
                                                        <!-- Display the current image -->
                                                        <img style="height: 100px; width: 108   px"
                                                            src="{{ @$course_data->course_image }}" alt="training-image">
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Certificate Type</label>
                                            <select class="form-select form-valid" name="certificate_type"
                                                id="certificate_type">
                                                <option value="">Select</option>
                                                <option
                                                    value="with"{{ $course_data->certificate_type == 'with' ? 'selected' : '' }}>
                                                    With Certificate</option>
                                                <option
                                                    value="without"{{ $course_data->certificate_type == 'without' ? 'selected' : '' }}>
                                                    Without Certificate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Payment Type</label>
                                                    <select class="form-select form-valid" name="payment_type"
                                                        id="payment_type">
                                                        <option value="">Select</option>
                                                        <option
                                                            value="paid"{{ $course_data->payment_type == 'paid' ? 'selected' : '' }}>
                                                            Paid</option>
                                                        <option
                                                            value="free"{{ $course_data->payment_type == 'free' ? 'selected' : '' }}>
                                                            Free</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 div-price"
                                                style="{{ $course_data->payment_type == 'paid' ? '' : 'display: none;' }}">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Course Price</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $course_data->course_price }}" name="course_price"
                                                        id="course_price" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Course Mode</label>
                                                    <select class="form-select form-valid" name="course_mode"
                                                        id="course_mode">
                                                        <option value="">Select</option>
                                                        <option
                                                            value="online"{{ $course_data->course_mode == 'online' ? 'selected' : '' }}>
                                                            Online</option>
                                                        <option
                                                            value="offline"{{ $course_data->course_mode == 'offline' ? 'selected' : '' }}>
                                                            Offline</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4 div-strength"
                                                style="{{ $course_data->course_mode == 'offline' ? '' : 'display: none;' }}">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Student Max Strength</label>
                                                    <input type="number" class="form-control" name="student_strength"
                                                        id="student_strength" placeholder=""
                                                        value="{{ $course_data->student_strength }}">
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4 div-strength"
                                                style="{{ $course_data->course_mode == 'offline' ? '' : 'display: none;' }}">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Place</label>
                                                    <select class="form-select form-valid" name="place" id="place">
                                                        <option value="">Select</option>
                                                        @foreach ($place as $plc)
                                                            <option {{ $course_data->place == $plc->id ? 'selected' : '' }}
                                                                value="{{ $plc->id }}">{{ $plc->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Course Description</label>
                                            <textarea class="form-control form-valid" name="course_description" id="course_description" name=""
                                                id="" cols="5" rows="5">{{ $course_data->course_description }}</textarea>
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
            $('#course_mode').change(function() {
                if ($(this).val() === 'offline') {

                    $('.div-strength').css('display', 'block');
                    
                } else {
                    $('#student_strength').val('');
                    $('#place').val(null);
                    $('.div-strength').css('display', 'none');
                }
            });
            $('#payment_type').change(function() {
                if ($(this).val() === 'paid') {
                    $('.div-price').css('display', 'block');
                } else {
                    $('#course_price').val('');
                    $('.div-price').css('display', 'none');
                }
            });






            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#course_start_date').val();
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
            }, "Course end date must be greater than Course start date");


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
            $('#course_image').on('input', function() {
                const size = (this.files[0].size / 1024 / 1024).toFixed(2);

                if (size > 1) {
                    alert("Please upload a file size less than or equal to 1MB");
                    $(this).val('');
                } else {
                    $("#output").html('<b>' +
                        'This file size is: ' + size + " MB" + '</b>');
                }
            });
            $("#course_edit").validate({
                rules: {
                    course_name: {
                        required: true,
                        noSpace: true
                    },
                    course_category_id: {
                        required: true,
                        noSpace: true
                    },
                    course_start_date: {
                        required: true,
                    },
                    course_end_date: {
                        required: true,
                        greaterThanStartDate: true
                    },
                    language_id: {
                        required: true,
                    },
                    certificate_type: {
                        required: true,
                    },
                    payment_type: {
                        required: true,
                    },
                    course_mode: {
                        required: true,
                    },
                    course_description: {
                        required: true,
                        noSpace: true
                    },
                    course_price: {
                        required: {
                            depends: function(element) {
                                return $("#payment_type").val() === 'paid';
                            }
                        },
                        number: true,
                        noSpace: true,
                        greaterThanZero: true,
                        noLeadingZeros: true,
                    },
                    student_strength: {
                        required: {
                            depends: function(element) {
                                return $("#course_mode").val() === 'offline';
                            }
                        }
                    },
                    place: {
                        required: {
                            depends: function(element) {
                                return $("#course_mode").val() === 'offline';
                            }
                        }
                    }
                },
                messages: {

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    
@endsection
