@extends('training.admin.layouts.page-layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Training</li>
                                <li class="breadcrumb-item active text-custom-primary">Create New Training</li>
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
                                <h4 class="card-title mb-4">Add New Training</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('training.createTrainingstore') }}" method="POST" id="book_save"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Training Name</label>
                                            <input type="text" class="form-control form-valid" autocomplete="off"
                                                name="name" id="name" placeholder="Training Name"
                                                onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                                oninput="this.value = this.value.replace(/^\s+/, '')" autofocus>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Training Category</label>
                                            <select class="form-select form-valid" name="training_category_id"
                                                id="training_category_id">
                                                <option value="">Select</option>

                                                @foreach ($tr_categores as $tr_category)
                                                    <option value="{{ $tr_category->id }}">{{ $tr_category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('training_category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Training Place</label>
                                            <select class="form-select form-valid" name="training_place_id"
                                                id="training_place_id">
                                                <option value="">Select</option>
                                                @foreach ($tr_training_places as $tr_train_place)
                                                    <option value="{{ $tr_train_place->id }}">{{ $tr_train_place->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('training_place_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Training Duration Type</label>
                                                <select class="form-select form-valid" name="training_duration_type"
                                                    id="training_duration_type">
                                                    <option value="">Select</option>
                                                    <option value="Day">Day</option>
                                                    <option value="Week">Week</option>
                                                    <option value="Month">Month</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Training Duration</label>
                                                <input type="text" maxlength="10"
                                                    onkeypress="return /^[0-9]*$/.test(event.key)" autocomplete="off"
                                                    autofocus class="form-control form-valid" name="training_duration"
                                                    id="training_duration" placeholder="">
                                                @error('training_duration')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class=" col-md-6">
                                                <label class="form-label">Payment Type</label>
                                                <select class="form-select form-valid" name="payment_type"
                                                    id="payment_type">
                                                    <option value="">Select</option>
                                                    <option value="0">Free</option>
                                                    <option value="1">Paid</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3 div-price" style="display: none;">
                                                <label class="form-label" for="">Training Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control form-valid" autofocus
                                                        autocomplete="off" name="price" id="price" placeholder="">
                                                    <span class="input-group-text">.00</span>
                                                    @error('price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="text-danger" id="price-error"></div>

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
                                                    @error('language_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Training Image</label>
                                                    <input class="form-control form-valid" type="file"
                                                        name="book_image" value="" multiple accept="image/*">
                                                    @error('book_image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Training Description</label>
                                            <textarea class="form-control form-valid" autofocus autocomplete="off" name="description" id="description"
                                                cols="5" rows="5"></textarea>
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Enrollment Start Date</label>
                                            <input type="date" id="enroll_start_date" class="form-control form-valid"
                                                name="enroll_start_date" placeholder="">
                                            @error('enroll_start_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Enrollment End Date</label>
                                            <input type="date" class="form-control form-valid" name="enroll_end_date"
                                                placeholder="">
                                            @error('enroll_end_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <input class="form-control" type="hidden" value="0" id="total_id">
                                <div id="add_mul_loc">
                                    <div class="mb-3 row mt-5" id="">
                                        <h5 class=" text-custom-primary">Create Batch</h5>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Batch Name</label>
                                            <input class="form-control form-valid" autofocus autocomplete="off"
                                                type="text" value="" name="batch_name" id="batch_name"
                                                pattern="[a-zA-Z\s]+" onkeypress="return validateKeyPress(event)">
                                            @error('batch_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Start Time</label>
                                            <input class="form-control form-valid" name="start_time" type="time"
                                                value="" id="start_time">
                                            @error('start_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">End Time</label>
                                            <input class="form-control form-valid" name="end_time" type="time"
                                                value="" id="end_time">
                                            @error('end_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Max Student</label>
                                            <input class="form-control form-valid check_res" type="number"
                                                value="" id="max_student" name="max_student" autofocus
                                                autocomplete="off">
                                            @error('max_student0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Total Class</label>
                                            <input class="form-control form-valid check_res" type="number"
                                                value="" id="total_class" name="total_class" autofocus
                                                autocomplete="off">
                                            @error('total_class0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <div class="text-center pt-4 mt-3">
                                                <a class="btn custom-btn btn-sm" id="add_reg">Add Batch<span><i
                                                            class="uil-plus-circle ms-2"></i></span></a>
                                                @error('total_class0')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <table class="table table-sm m-0 table-bordered">
                                                <thead class="">
                                                    <tr class="table-heading text-center">
                                                        <th>Batch Name</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Max Student</th>
                                                        <th>Total Class</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="addmedIsssue" id="addmedIsssue">


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-end mt-4">
                                        <button type="submit" id="add_reg" class="btn custom-btn">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        var serial = 0;
        $(document).ready(function() {
            $('#payment_type').change(function() {
                    if ($(this).val() === '1') {
                        $('#price').removeClass('form-valid');
                        $('.div-price').css('display', 'block');
                    } else {
                        $('#price').removeClass('form-valid');
                        $('.div-price').css('display', 'none');
                    }
                });
            function removeErrorMessages() {
                $('.form-valid').each(function() {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                    $(this).next('span').remove(); // Remove the error message
                });
            }


            $.validator.addMethod("greaterThanStartTime", function(value, element) {
                var startTime = $('#start_time').val();
                var endTime = value;

                if (!startTime || !endTime) {
                    // If either field is empty, no comparison needed
                    return true;
                }

                // Parse times to compare
                var startTimeParts = startTime.split(':');
                var endTimeParts = endTime.split(':');

                var startDateTime = new Date(0, 0, 0, startTimeParts[0], startTimeParts[1]);
                var endDateTime = new Date(0, 0, 0, endTimeParts[0], endTimeParts[1]);

                // Compare times
                return endDateTime > startDateTime;
            }, "End time must be greater than start time");

            $.validator.addMethod("greaterThanStartTime", function(value, element) {
                var startTime = $('#start_time').val();
                var endTime = value;

                if (!startTime || !endTime) {
                    // If either field is empty, no comparison needed
                    return true;
                }

                // Parse times to compare
                var startTimeParts = startTime.split(':');
                var endTimeParts = endTime.split(':');

                var startDateTime = new Date(0, 0, 0, startTimeParts[0], startTimeParts[1]);
                var endDateTime = new Date(0, 0, 0, endTimeParts[0], endTimeParts[1]);

                // Compare times
                return endDateTime > startDateTime;
            }, "End time must be greater than start time");

            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#enroll_start_date').val();
                var endDate = value;

                if (!startDate || !endDate) {
                    // If either field is empty, no comparison needed
                    return true;
                }

                // Parse dates to compare
                var startDateTime = Date.parse(startDate);
                var endDateTime = Date.parse(endDate);

                if (isNaN(startDateTime) || isNaN(endDateTime)) {
                    // If either date is invalid, validation should fail
                    return false;
                }

                // Compare dates
                return endDateTime > startDateTime;
            }, "End date must be greater than start date");

            // Usage example








            $.validator.addMethod('greaterThanZero', function(value, element) {
                return parseFloat(value) > 0;
            }, 'Price must be greater than 0');

            $.validator.addMethod('noLeadingZeros', function(value, element) {
                return /^[1-9][0-9]*$/.test(value);
            }, 'Price cannot have leading zeros');

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "This field is required.");

            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');

            $("#book_save").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    training_category_id: {
                        required: true,
                    },
                    training_place_id: {
                        required: true,
                    },
                    description: {
                        maxlength: 200
                    },
                    training_duration: {
                        required: true,
                        number: true,
                        noLeadingZeros: true
                    },
                    start_time: {
                        // required: true,
                    },
                    book_image: {
                        required: true,
                        filesize_max: 1048576, // Max file size 1 MB (in bytes)
                    },
                    price: {
                        noSpace: true,
                        required: true,
                        greaterThanZero: true,
                        noLeadingZeros: true,
                        number: true,
                    },
                    description: {
                        noSpace: true,
                        maxlength: 200
                    },
                    end_time: {
                        // required: true,
                        greaterThanStartTime: true
                    },
                    enroll_start_date: {
                        required: true,
                    },
                    enroll_end_date: {
                        required: true,
                        greaterThanStartDate: true
                    },
                    batch_name: {
                        // noSpace: true,
                        maxlength: 15
                    },
                    max_student: {
                        // required: true,
                        number: true,
                    },
                    total_class: {
                        // required: true,
                        number: true,
                    },
                    training_duration_type: {
                        required: true,
                    },
                    language_id: {
                        required: true,
                    }


                },
                messages: {
                    end_time: {
                        greaterThanStartTime: "End time must be greater than start time"
                    },
                    enroll_end_date: {
                        greaterThanStartDate: "End date must be greater than start date"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "price") {
                        error.appendTo("#price-error");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    removeErrorMessages();
                    form.submit();
                }

            });
        });


        function checkRegAjax(val) {
            //alert(123);
            var state_id = this.value;
            //alert(state_id);

            $.ajax({
                type: 'post',
                url: "{{ route('book.bookRegCheck') }}",
                data: {
                    max_student: val,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {

                    console.log(result);
                    console.log(result.location_count);
                    if (result.location_count == 1) {
                        errcount++;
                        alert("inside")
                    }

                }
            });
            return result.location_count;

        }

        function ckeckreg(val) {

            var errcount = 0;

            $('.check_res').each(function() {
                if ($(this).val() == val) {
                    errcount++;


                }

            });
            // var result_ajax = checkRegAjax(val);
            // alert(result_ajax);


            // alert("outside")
            if (errcount > 1) {
                alert("alredy exiting");
                $(this).val('')
            }
        }


        $('.year').blur(function() {
            //   alert($(this).val());
            var yearInput = $(this).val();
            // $("#publish_year").val();
            var enteredYear = parseInt(yearInput, 10);

            // Get the current year
            var currentYear = new Date().getFullYear();

            // Check if the entered year is within the valid range
            if (enteredYear >= 1900 && enteredYear <= currentYear) {
                // Display a success message or take appropriate action
                console.log('Year is valid');
            } else {
                // Display an error message or take appropriate action
                alert('Please enter a valid year between 1900 and ' + currentYear);
                // $("#publish_year").val('')
                $(this).val('')
            }

        });



        $("#add_reg").on("click", function() {

            // alert("fff");
            var counter = $('#total_id').val();
            var batch_name = $('#batch_name').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();

            var max_student = $('#max_student').val();

            var total_class = $('#total_class').val();


            if (batch_name == '' || start_time == '' || end_time == '' || max_student == '' || total_class == '') {
                alert('please fill the data')
                return false

            }


            var last_counter = parseInt(counter) + 1;
            cols = '<tr class="table-heading text-center" id="clild_id' + counter +
                '"><td><input class="form-control form-valid" autocomplete="off" type="text" value="' + batch_name +
                '" name="batch_name_' + serial + '" id="batch_name' + counter +
                '"></td><td><input class="form-control form-valid" type="text" value="' + start_time +
                '" name="start_time_' + serial + '" id="start_time' + counter +
                '"></td><td><input class="form-control form-valid" type="text" value="' + end_time +
                '" name="end_time_' + serial + '" id="end_time' + counter +
                '"></td><td><input class="form-control autocomplete="off" form-valid check_res"  type="number" value="' +
                max_student +
                '" name="max_student_' + serial + '" id="max_student' + counter +
                '"></td><td><input class="form-control autocomplete="off" form-valid check_res"  type="number" value="' +
                total_class +
                '" name="total_class_' + serial + '" id="total_class' + counter +
                '"></td><td><a onclick="removeDataLocation(0,' + counter +
                ')" class="btn btn-danger btn-sm mt-1">Remove Batch<span><i class="uil-times-circle ms-2"></i></span></a></td></tr>';
            $("#addmedIsssue").append(cols);
            $("#batch_name").val('');
            $("#start_time").val('');
            $("#end_time").val('');
            $("#max_student").val('');
            $("#total_class").val('');

            $('#total_id').val(parseInt(last_counter));
            serial++;

        });

        function removeDataLocation(id, model) {
            var userConfirmation = confirm('Are you sure you want to delete?');

            if (userConfirmation) {


                $("#clild_id" + model).remove();
            }

        }
        // document.getElementById('add_reg').addEventListener('click', function() {
        //     // Get the form elements
        //     var batchName = document.getElementById('batch_name');
        //     var startTime = document.getElementById('start_time');
        //     var endTime = document.getElementById('end_time');
        //     var maxStudent = document.getElementById('max_student');
        //     var totalClass = document.getElementById('total_class');

        //     // Reset the form fields
        //     batchName.value = '';
        //     startTime.value = '';
        //     endTime.value = '';
        //     maxStudent.value = '';
        //     totalClass.value = '';
        // });
    </script>
    <script>
        function validateKeyPress(event) {
            // Prevent spaces at the beginning of the input
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }

            // Allow only letters and spaces
            const regex = /^[a-zA-Z\s]*$/;
            return regex.test(event.key);
        }
    </script>
@endsection
