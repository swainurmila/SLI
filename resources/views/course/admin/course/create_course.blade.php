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
                                <li class="breadcrumb-item active text-custom-primary">Create New Course</li>
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
                                <h4 class="card-title mb-4">Add New Course</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('course.createcoursestore') }}" method="POST" id="course_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Course Name</label>
                                            <input type="text" class="form-control form-valid" name="course_name"
                                                pattern="[a-zA-Z\s]+" maxlength="80" id="name"
                                                placeholder="Course Name">
                                            @if ($errors->has('course_name'))
                                                <span class="text-danger">{{ $errors->first('course_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Course Category</label>
                                            <select class="form-select form-valid" name="course_category_id"
                                                id="course_category_id">
                                                <option value="">Select</option>

                                                @foreach ($cr_category as $cr_cat)
                                                    <option value="{{ $cr_cat->id }}">{{ $cr_cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('course_category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Course Start Date</label>
                                                <input type="date" class="form-control form-valid"
                                                    name="course_start_date" id="course_start_date" placeholder="">
                                                @error('course_start_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Course End Date</label>
                                                <input type="date" class="form-control form-valid" name="course_end_date"
                                                    id="course_end_date" placeholder="">
                                                @error('course_end_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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
                                                            <option value="{{ $lan->id }}">{{ $lan->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('language_id'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('language_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Course Image</label>
                                                    <input class="form-control form-valid" type="file"
                                                        name="course_image" id="course_image" value="" multiple
                                                        accept="image/*" onchange="Filevalidation()">
                                                    @if ($errors->has('course_image'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('course_image') }}</span>
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
                                                <option value="with">With Certificate</option>
                                                <option value="without">Without Certificate</option>
                                            </select>
                                            @if ($errors->has('certificate_type'))
                                                <span class="text-danger">{{ $errors->first('certificate_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Payment Type</label>
                                                <select class="form-select form-valid" name="payment_type"
                                                    id="payment_type">
                                                    <option value="">Select</option>
                                                    <option value="paid">Paid</option>
                                                    <option value="free">Free</option>
                                                </select>

                                                @if ($errors->has('payment_type'))
                                                    <span class="text-danger">{{ $errors->first('payment_type') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-6 div-price" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Course Price</label>
                                                    <input type="text" class="form-control price-validation form-valid"
                                                        name="course_price" id="course_price" placeholder="">


                                                    @if ($errors->has('course_price'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('course_price') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Course Mode</label>
                                                    <select class="form-select form-valid" name="course_mode"
                                                        id="course_mode">
                                                        <option value="">Select</option>
                                                        <option value="online">Online</option>
                                                        <option value="offline">Offline</option>
                                                    </select>
                                                    @if ($errors->has('course_mode'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('course_mode') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4 div-strength" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Student Max Strength</label>
                                                    <input type="number" class="form-control " name="student_strength"
                                                        id="student_strength" placeholder="">
                                                    @if ($errors->has('student_strength'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('student_strength') }}</span>
                                                    @endif
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4 div-strength" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Place</label>
                                                    <select class="form-select" name="place" id="place">
                                                        <option value="">Select</option>
                                                        @foreach ($place as $plc)
                                                            <option value="{{ $plc->id }}">{{ $plc->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('place'))
                                                        <span class="text-danger">{{ $errors->first('place') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Course Description</label>
                                            <textarea class="form-control form-valid" name="course_description" id="course_description" name=""
                                                id="" cols="5" rows="5"></textarea>
                                            @if ($errors->has('course_description'))
                                                <span
                                                    class="text-danger">{{ $errors->first('course_description') }}</span>
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
        var documentReadyExecuted = false;
        $(document).ready(function() {
            if (!documentReadyExecuted) {
                documentReadyExecuted = true;

                function removeErrorMessages() {
                    $('.form-valid').each(function() {
                        $(this).removeClass('error-text');
                        $(this).addClass('success-text');
                        $(this).next('span').remove(); // Remove the error message
                    });
                }
                $('#course_mode').change(function() {
                    if ($(this).val() === 'offline') {
                        $('#place').addClass('form-valid');
                        // $('#student_strength').addClass('form-valid');
                        $('.div-strength').css('display', 'block');
                    } else {
                        $('#place').removeClass('form-valid');
                        // $('#student_strength').removeClass('form-valid');
                        $('.div-strength').css('display', 'none');
                    }
                });
                $('#payment_type').change(function() {
                    if ($(this).val() === 'paid') {
                        $('#course_price').removeClass('form-valid');
                        $('.div-price').css('display', 'block');
                    } else {
                        $('#course_price').removeClass('form-valid');
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

                function validateKeyPress(event) {
                    // Prevent spaces at the beginning of the input
                    if (event.key === ' ' && event.target.value.length === 0) {
                        return false;
                    }

                    // Allow only letters and spaces
                    const regex = /^[a-zA-Z\s]*$/;
                    return regex.test(event.key);
                }
                $("#course_save").validate({
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
                        course_image: {
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
                                    return $("#payment_type").val().length > 0;
                                }
                            },
                            number: true,
                            noSpace: true,
                            greaterThanZero: true,
                            noLeadingZeros: true,
                        },
                    },
                    messages: {

                    },
                    submitHandler: function(form) {
                        removeErrorMessages();

                        form.submit();
                    }
                });

            }
        });
    </script>
@endsection
