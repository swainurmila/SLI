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
                                <li class="breadcrumb-item active text-custom-primary">Edit Training</li>
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
                                <h4 class="card-title mb-4">Edit Training</h4>
                                <a href="{{ route('training.admin.trainingList') }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('training.editTrainingstore', ['id' => $training_datas->id]) }}"
                                method="POST" id="book_save" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Training Name</label>
                                            <input type="text" class="form-control" autofocus autocomplete="off"
                                                name="name" id="name" value="{{ $training_datas->name }}"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Training Category</label>
                                            <select class="form-select form-valid" name="training_category_id"
                                                id="training_category_id">
                                                <option value="">Select</option>

                                                @foreach ($tr_categores as $tr_category)
                                                    <option <?php if ($training_datas->training_category_id == $tr_category->id) {
                                                        echo 'selected';
                                                    } ?> value="{{ $tr_category->id }}">
                                                        {{ $tr_category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Training Place</label>
                                            <select class="form-select form-valid" autocomplete="off" autofocus
                                                name="training_place_id" id="training_place_id">
                                                <option value="">Select</option>
                                                @foreach ($tr_training_places as $tr_train_place)
                                                    <option <?php if ($training_datas->training_place_id == $tr_train_place->id) {
                                                        echo 'selected';
                                                    } ?> value="{{ $tr_train_place->id }}">
                                                        {{ $tr_train_place->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Training Duration Type</label>
                                                <select class="form-select form-valid" name="training_duration_type"
                                                    id="training_duration_type">
                                                    <option value="">Select</option>
                                                    <option <?php if ($training_datas->training_duration_type == 'Day') {
                                                        echo 'selected';
                                                    } ?> value="Day">Day</option>
                                                    <option <?php if ($training_datas->training_duration_type == 'Week') {
                                                        echo 'selected';
                                                    } ?> value="Week">Week</option>
                                                    <option <?php if ($training_datas->training_duration_type == 'Month') {
                                                        echo 'selected';
                                                    } ?> value="Month">Month</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">Training Duration</label>
                                                <input type="text" onkeypress="return /^[0-9]*$/.test(event.key)"
                                                    maxlength="10" class="form-control form-valid"
                                                    value="{{ $training_datas->training_duration }}"
                                                    name="training_duration" id="training_duration" placeholder="">
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
                                                    <option value="0"{{ $training_datas->payment_type == '0' ? 'selected' : '' }}>Free</option>
                                                    <option value="1"{{ $training_datas->payment_type == '1' ? 'selected' : '' }}>Paid</option>
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
                                                            <option <?php if ($training_datas->language_id == $lan->id) {
                                                                echo 'selected';
                                                            } ?> value="{{ $lan->id }}">
                                                                {{ $lan->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input class="form-control" type="file" id="book_image"
                                                        name="book_image" value="" multiple accept="image/*">

                                                    @if (!empty($training_datas->TrainingImage))
                                                        <!-- Display the current image -->
                                                        <img style="height: 100px; width: 100px"
                                                            src="{{ asset('public/upload/training/training_image/' . @$training_datas->TrainingImage->file_name) }}"
                                                            alt="training-image">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- 
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input class="form-control form-valid"  type="file" name="book_image[]"  multiple>
                                    </div>
                                </div> --}}


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Training Description</label>
                                            <textarea class="form-control" name="description" id="description" value={{ @$training_datas->description }}
                                                name="" id="" cols="5" rows="5">{{ @$training_datas->description }}</textarea>
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Enrollment Start Date</label>
                                            <input type="date" id="enroll_start_date"
                                                value="{{ $training_datas->enroll_start_date }}"
                                                class="form-control form-valid" name="enroll_start_date" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Enrollment End Date</label>
                                            <input type="date" class="form-control form-valid"
                                                value="{{ $training_datas->enroll_end_date }}" name="enroll_end_date"
                                                placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <input class="form-control" type="hidden" value="{{ count(@$batch_datas) }}"
                                    id="total_id">
                                <div id="add_mul_loc">
                                    <div class="mb-3 row mt-5" id="">
                                        <h5 class=" text-custom-primary">Create Batch</h5>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Batch Name</label>
                                            <input class="form-control" type="text" value="" autocomplete="off" name="batch_name"
                                                id="batch_name">
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Start Time</label>
                                            <input class="form-control" type="time" value="" name="start_time"
                                                id="start_time">
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">End Time</label>
                                            <input class="form-control" type="time" value="" id="end_time"
                                                name="end_time">
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Max Student</label>
                                            <input class="form-control check_res" type="text" autocomplete="off" value=""
                                                id="max_student" name="max_student">
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="" class="col-form-label">Total Class</label>
                                            <input class="form-control check_res " type="text" autocomplete="off" value=""
                                                id="total_class" name="total_class">
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <div class="text-center pt-4 mt-3">
                                                <a class="btn custom-btn btn-sm" id="add_reg">Add Batch<span><i
                                                            class="uil-plus-circle ms-2"></i></span></a>

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
                                                <?php $i = 0; ?>
                                                <tbody class="addmedIsssue" id="addmedIsssue">
                                                    @foreach ($batch_datas as $batch_data)
                                                        <tr class="table-heading text-center"
                                                            id="clild_id{{ $i }}">
                                                            <td>
                                                                <input class="form-control form-valid" type="hidden"
                                                                    value="{{ $batch_data->id }}"
                                                                    name="batch_id_{{ $i }}"
                                                                    id="batch_id{{ $i }}">
                                                                <input readonly class="form-control form-valid" type="text"
                                                                    value="{{ $batch_data->batch_name }}"
                                                                    name="batch_name_{{ $i }}"
                                                                    id="batch_name{{ $i }}">
                                                            </td>
                                                            <td>
                                                                <input readonly class="form-control form-valid" type="time"
                                                                    value="{{ $batch_data->start_time }}"
                                                                    name="start_time_{{ $i }}"
                                                                    id="start_time{{ $i }}">
                                                            </td>
                                                            <td>
                                                                <input readonly class="form-control form-valid" type="time"
                                                                    value="{{ $batch_data->end_time }}"
                                                                    name="end_time_{{ $i }}"
                                                                    id="end_time{{ $i }}">
                                                            </td>
                                                            <td>
                                                                <input readonly class="form-control form-valid check_res"
                                                                    type="text" value="{{ $batch_data->max_student }}"
                                                                    name="max_student_{{ $i }}"
                                                                    id="max_student{{ $i }}">
                                                            </td>
                                                            <td>
                                                                <input readonly class="form-control form-valid check_res"
                                                                    type="text" value="{{ $batch_data->total_class }}"
                                                                    name="total_class_{{ $i }}"
                                                                    id="total_class{{ $i }}">
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $count_data = App\Models\Training\TrTrainingOrder::where('batch_id', $batch_data->id)->count();
                                                                ?>
                                                                @if ($count_data == 0)
                                                                    <a onclick="removeDataLocation({{ $batch_data->id }},{{ $i }})"
                                                                        class="btn btn-danger btn-sm mt-1">Remove
                                                                        Batch<span><i
                                                                                class="uil-times-circle ms-2"></i></span></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </tbody>

                                                </tbody>
                                            </table>
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
            $('#training_duration').on('input', function() {
                var value = $(this).val();
                // Remove leading zeros
                var newValue = value.replace(/^0+/, '');
                // Update the input value
                $(this).val(newValue);
            });

            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#enroll_start_date').val();
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
            }, "Enrollment end date must be greater than Enrollment start date");


            $.validator.addMethod('greaterThanZero', function(value, element) {
                return parseFloat(value) > 0;
            }, 'Price must be greater than 0');

            $.validator.addMethod('noLeadingZeros', function(value, element) {
                return /^[1-9][0-9]*$/.test(value);
            }, 'Price cannot have leading zeros');

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");


            $.validator.addMethod("numericOnly", function(value, element) {
                return /^\d+$/.test(value);
            }, "Please enter only numeric characters.");

            $.validator.addMethod("noLeadingZero", function(value, element) {
                return this.optional(element) || /^[^0\s]+.*$/.test(value);
            }, "Name cannot start with a zero or a space.");



            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 1 MB');

            $.validator.addMethod("after", function(value, element, param) {
                var startTime = $(param).val();
                if (!startTime) {
                    return true;
                }
                return value > startTime;
            }, "End time must be greater than start time.");

            $.validator.addMethod("before", function(value, element, param) {
                var endTime = $(param).val();
                if (!endTime) {
                    return true;
                }
                return value < endTime;
            }, "Start time must be smaller than end time.");

            $.validator.addMethod("time", function(value, element) {
                return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/.test(value);
            }, "Please enter a valid time (HH:mm)");


            $("#book_save").validate({
                rules: {
                    name: {
                        required: true,
                        noLeadingZero: true,
                        maxlength: 15,
                    },
                    description: {
                        maxlength: 200
                    },
                    training_category_id: {
                        required: true
                    },
                    training_place_id: {
                        required: true
                    },
                    training_duration_type: {
                        required: true
                    },
                    training_duration: {
                        required: true,
                        number: true,
                        noLeadingZeros: true
                    },
                    language_id: {
                        required: true
                    },
                    book_image: {
                        required: function(element) {
                            return $("#book_image").val().length > 0;
                        },
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

                    enroll_start_date: {
                        required: true,
                    },
                    enroll_end_date: {
                        required: true,
                        greaterThanStartDate: true
                    },

                    start_time: {
                        required: {
                            depends: function(element) {
                                return $("#end_time").val().length > 0;
                            }
                        },
                        time: true,
                        before:"#end_time"
                    },
                    end_time: {
                        // required: true,

                        required: {
                            depends: function(element) {
                                return $("#start_time").val().length > 0;
                            }
                        },
                        time: true,
                        after: "#start_time"
                        // greaterThanStartTime: {
                        //     depends: function(element) {
                        //         return $("#start_time").val().length > 0;
                        //     }
                        // }
                    },
                    batch_name: {
                        noSpace: {
                            depends: function(element) {
                                return $("#batch_name").val().length >
                                    0; // Make it required if something is typed
                            }
                        },
                        maxlength: {
                            depends: function(element) {
                                return $("#batch_name").val().length > 15;
                            }
                        }
                    },
                    max_student: {
                        // noSpace: {
                        //     depends: function(element) {
                        //         var value = $("#max_student0").val();
                        //         return value && value.trim().length > 0;
                        //     }
                        // },
                        // required: {
                        //     depends: function(element) {
                        //         var value = $("#max_student0").val();
                        //         return value && value.trim().length > 0;
                        //     }
                        // },
                        number: true
                    },
                    total_class: {
                        // noSpace: {
                        //     depends: function(element) {
                        //         var value = $("#max_student0").val();
                        //         return value && value.trim().length > 0;
                        //     }
                        // },
                        // required: {
                        //     depends: function(element) {
                        //         var value = $("#total_class0").val();
                        //         return value && value.trim().length > 0;
                        //     }
                        // },
                        number: true
                    },
                    training_duration: {
                        required: true,
                        noSpace: {
                            depends: function(element) {
                                return $("#training_duration").val().length > 0;
                            }
                        }
                    }
                },
                messages: {
                    end_time: {
                        greaterThanStartTime: "End time must be greater than start time"
                    },
                    training_category_id: {
                        required: "This field is required"
                    },
                    training_place_id: {
                        required: "This field is required"
                    },
                    training_duration_type: {
                        required: "This field is required"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "price") {
                        error.appendTo("#price-error");
                    } else {
                        error.insertAfter(element);
                    }
                }

            });



            $("input[name^='end_time'], input[name^='start_time']").blur(function() {
                var rowIndex = $(this).closest("tr")
                    .index(); // Assuming each pair of dates is in its own table row

                var startTimeValue = $("#start_time" + rowIndex).val();
                var endTimeValue = $("#end_time" + rowIndex).val();

                console.log(endTimeValue)

                if (startTimeValue && endTimeValue) {
                    // var start = parseDateFromString(startTimeValue);
                    // var end = parseDateFromString(endTimeValue);

                    // console.log(start)
                    // console.log(end)
                    if (endTimeValue <= startTimeValue) {
                        alert("The end time must be greater than the start time.");
                        // Optionally, clear the end date field
                        $("#end_time" + rowIndex).val('').focus();
                    }
                }
            });



        });



        function saveForm() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();


            console.log(errcount)
            if (errcount == 0) {

                console.log('hjhjhj')
                let isValid = true;

                $('#batch_name').val('');
                $('#start_time').val('');
                $('#end_time').val('');
                $('#max_student').val('');
                $('#total_class').val('');

                // Iterate over each row in the table
                $('.addmedIsssue tr').each(function() {
                    // Find start_time and end_time inputs within this row
                    let startTimeInput = $(this).find('input[name^="start_time"]');
                    let endTimeInput = $(this).find('input[name^="end_time"]');

                    // Check if either input is empty
                    if (!startTimeInput.val() || !endTimeInput.val()) {
                        isValid = false;
                        alert('Please fill in both start and end times for all rows.');
                        return false; // Break the loop
                    }

                    // Additional check for chronological order if needed
                    // Convert startTime and endTime to comparable format if not in YYYY-MM-DD
                    let startTime = startTimeInput.val();
                    let endTime = endTimeInput.val();
                    if (startTime >= endTime) {
                        isValid = false;
                        startTimeInput.val('').focus();
                        alert('Start time always smaller than end time.');
                        return false; // Break the loop
                    }
                });

                if (!isValid) {
                    event.preventDefault(); // Prevent form submission if validation fails
                } else {

                    $('#book_save').submit();
                }

            } else {
                return false;
            }
            $('.form-valid').each(function() {

                console.log('aaa')
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

        }

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
        // function saveFormedit(e) {
        //     var errcount = 0;
        //     $(".error-span" + e).remove();

        //     $("span" + e).remove();
        //     $('.form-valid' + e).each(function() {
        //         if ($(this).val() == '') {
        //             errcount++;
        //             $(this).addClass('error-text' + e);
        //             $(this).removeClass('success-text' + e);
        //             $(this).after('<span style="color:red">This field is required</span>');
        //         } else {
        //             $(this).removeClass('error-text' + e);
        //             $(this).addClass('success-text' + e);
        //         }
        //     });
        //     // alert(errcount);
        //     if (errcount == 0) {
        //         // $.blockUI({ message: '<h1> Loading...</h1>' });

        //         $('#book_edit' + e).submit();
        //         // $.unblockUI();         
        //     } else {
        //         return false;
        //     }
        // }
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

        let counter = {{ count($batch_datas) }};

        function reindexRows() {
            $("#addmedIsssue tr").each(function(index) {
                $(this).attr('id', 'clild_id' + index);
                $(this).find('input, a').each(function() {
                    let name = $(this).attr('name');
                    let id = $(this).attr('id');
                    if (name) {
                        let newName = name.replace(/\d+/, index);
                        $(this).attr('name', newName);
                    }
                    if (id) {
                        let newId = id.replace(/\d+/, index);
                        $(this).attr('id', newId);
                    }
                    if ($(this).hasClass('remove_batch')) {
                        $(this).attr('onclick', 'removeDataLocation(0,' + index + ')');
                    }
                });
            });
            counter = $("#addmedIsssue tr").length;
        }


        $("#add_reg").on("click", function() {

            // alert("fff");
            // var counter = $('#total_id').val();
            var batch_name = $('#batch_name').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();

            var max_student = $('#max_student').val();

            var total_class = $('#total_class').val();


            if (batch_name == '' || start_time == '' || end_time == '' || max_student == '' || total_class == '') {
                alert('please fill the data')
                return false

            }

            if (start_time >= end_time) {
                alert('End time must be greater than start time');
                return false;
            }

            


            // var last_counter = parseInt(counter) + 1;
            cols = '<tr class="table-heading text-center" id="clild_id' + counter +
                '"><td><input class="form-control form-valid" type="text" value="' + batch_name +
                '" name="batch_name_' + counter + '" id="batch_name' + counter +
                '"></td><td><input class="form-control form-valid" type="time" value="' + start_time +
                '" name="start_time_' + counter + '" id="start_time' + counter +
                '"></td><td><input class="form-control form-valid" type="time" value="' + end_time +
                '" name="end_time_' + counter + '" id="end_time' + counter +
                '"></td><td><input class="form-control form-valid check_res"  type="text" value="' + max_student +
                '" name="max_student_' + counter + '" id="max_student' + counter +
                '"></td><td><input class="form-control form-valid check_res"  type="text" value="' + total_class +
                '" name="total_class_' + counter + '" id="total_class' + counter +
                '"></td><td><a onclick="removeDataLocation(0,' + counter +
                ')" class="btn btn-danger btn-sm mt-1">Remove Batch<span><i class="uil-times-circle ms-2"></i></span></a></td></tr>';
            $("#addmedIsssue").append(cols);

            // $('#total_id').val(parseInt(last_counter));

            $('#batch_name').val('');
            $('#start_time').val('');
            $('#end_time').val('');
            $('#max_student').val('');
            $('#total_class').val('');

            serial++;
        });

        function removeDataLocation(id, model) {

            console.log(id, model)
            if (id == 0) {
                $("#clild_id" + model).remove();
                reindexRows()
            } else {
                var userConfirmation = confirm('It will delete permanently . Are you sure you want to delete?');

                if (userConfirmation) {
                    console.log(id, model, "91918918")

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('training.remove.batch') }}",
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            console.log(response)
                            $("#clild_id" + model).remove();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }

        }
    </script>
@endsection
