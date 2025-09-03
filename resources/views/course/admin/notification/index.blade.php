@extends('course.layouts.admin.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->


            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>Exam Notification</b> </h4>
                    </div>
                </div>

                <div class="col-2">
                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#addModal">Add Notification</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="course-Exam-list" class="table table-centered table-nowrap mb-0">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Exam Title</th>
                                            <th>Exam Mode</th>
                                            <th>Course Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            {{-- {{dd($data)}} --}}
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->Exam->exam_title ?? '-' }}</td>
                                                <td>{{ucfirst(@$item->Exam->exam_mode)}}</td>
                                                <td>{{ $item->course->course_name }}</td>
                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}"
                                                        onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('course-delete-notification', [$item->id]) }}"
                                                        method="POST" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="{{ route('course-notification-applied-students', @$item->id) }}"
                                                        class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Applied Users">Applied Users
                                                    </a>

                                                    @if ($item->Exam->exam_mode == 'online')
                                                        <a href="{{ route('course-notification-answer-list', @$item->id) }}"
                                                            class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                            title="Exam Answers">Exam Answers
                                                        </a>
                                                    @endif
                                                    
                                                    <a href="{{ route('course.admin.exam-result', @$item->id) }}"
                                                        class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Result">Result
                                                    </a>
                                                </td>
                                                <div class="modal fade" id="editTranModal{{ @$item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Course
                                                                    Notification
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form
                                                                action="{{ route('course-notification-update', $item->id) }}"
                                                                method="POST" id="category_edit{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Course
                                                                                    Name:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <select class="form-select form-valid"
                                                                                    name="course_id" id="edit_course_id">
                                                                                    <option value="">Select</option>
                                                                                    @foreach ($course as $cr)
                                                                                        <option
                                                                                            {{ $item->course_id == $cr->id ? 'selected' : '' }}
                                                                                            value="{{ $cr->id }}">
                                                                                            {{ $cr->course_name }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                                @if ($errors->has('course_id'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('course_id') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Exam
                                                                                    Title:<sup><span
                                                                                            style="color: red;">*</span></sup></label>

                                                                                <select class="form-select form-valid"
                                                                                    name="exam_id" id="edit_exam_id">
                                                                                    <option value="">Select</option>
                                                                                    @foreach ($exam as $ex)
                                                                                        <option
                                                                                            {{ $item->exam_id == $ex->id ? 'selected' : '' }}
                                                                                            value="{{ $ex->id }}">
                                                                                            {{ $ex->exam_title }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                                @if ($errors->has('name'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Apply Start
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="add_start_date"
                                                                                    id="edit_start_date"
                                                                                    value="{{ @$item->start_date }}">
                                                                                @if ($errors->has('add_start_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('add_start_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Apply End
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="add_end_date" id="edit_end_date"
                                                                                    value="{{ @$item->end_date }}">
                                                                                @if ($errors->has('add_end_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('add_end_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Exam
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="exam_date" id="edit_exam_date"
                                                                                    value="{{ @$item->exam_date }}">
                                                                                @if ($errors->has('exam_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('exam_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Exam Start
                                                                                    Time:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="time" disabled
                                                                                    class="form-control"
                                                                                    name="exam_start_time"
                                                                                    id="exam_start_time"
                                                                                    value="{{ @$item->exam_start_time }}">
                                                                                @if ($errors->has('exam_start_time'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('exam_start_time') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Total Hours
                                                                                    Needed:<sup><span
                                                                                            style="color: red;">*</span></sup></label>

                                                                                <select class="form-select" disabled
                                                                                    name="hours_needed" id="hours_needed">
                                                                                    <option value="">Select</option>
                                                                                    <option value="1"
                                                                                        {{ @$item->hours_needed == 1 ? 'selected' : '' }}>
                                                                                        1</option>
                                                                                    <option value="2"
                                                                                        {{ @$item->hours_needed == 2 ? 'selected' : '' }}>
                                                                                        2</option>
                                                                                    <option value="3"
                                                                                        {{ @$item->hours_needed == 3 ? 'selected' : '' }}>
                                                                                        3</option>
                                                                                    <option value="4"
                                                                                        {{ @$item->hours_needed == 4 ? 'selected' : '' }}>
                                                                                        4</option>
                                                                                </select>

                                                                                @if ($errors->has('hours_needed'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('hours_needed') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Exam
                                                                                    Location:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <textarea class="form-control" name="exam_location" id="" cols="30" rows="3">{{ @$item->exam_location }}</textarea>
                                                                                @if ($errors->has('exam_location'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('exam_location') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn custom-btn">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>

                    {{-- <div class="m-4">
                        {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div> --}}
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Exam Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('course-notification-store') }}" method="POST" id="course-category-form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Course Name:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <select class="form-select form-valid" name="course_id" id="add_course_id">
                                        <option value="">Select</option>
                                        @foreach ($course as $cr)
                                            <option value="{{ $cr->id }}">{{ $cr->course_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('course_id'))
                                        <span class="text-danger">{{ $errors->first('course_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Exam Title:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <select class="form-select form-valid" name="exam_id" id="exam_id">
                                        <option value="">Select</option>
                                    </select>
                                    @if ($errors->has('exam_id'))
                                        <span class="text-danger">{{ $errors->first('exam_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Apply Start Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" name="add_start_date"
                                        id="add_start_date">
                                    @if ($errors->has('add_start_date'))
                                        <span class="text-danger">{{ $errors->first('add_start_date') }}</span>
                                    @endif
                                </div>
                            </div>




                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Apply End Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" name="add_end_date" id="add_end_date">
                                    @if ($errors->has('add_end_date'))
                                        <span class="text-danger">{{ $errors->first('add_end_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Exam Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" name="exam_date" id="exam_date">
                                    @if ($errors->has('exam_date'))
                                        <span class="text-danger">{{ $errors->first('exam_date') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Exam Start Time:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="time" class="form-control" name="exam_start_time"
                                        id="add_start_time">
                                    @if ($errors->has('exam_start_time'))
                                        <span class="text-danger">{{ $errors->first('exam_start_time') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Total Hours Needed:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <select class="form-select" name="hours_needed" id="hours_needed">
                                        <option value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    @if ($errors->has('hours_needed'))
                                        <span class="text-danger">{{ $errors->first('hours_needed') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Exam Location:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    {{-- <input type="date" class="form-control" name="exam_date" id="exam_date"> --}}
                                    <textarea class="form-control" name="exam_location" id="exam_location" cols="30" rows="3"></textarea>
                                    @if ($errors->has('exam_location'))
                                        <span class="text-danger">{{ $errors->first('exam_location') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn custom-btn">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection


@section('script')
    <script>
        $(document).ready(function() {


            $('#course-Exam-list').DataTable();

            function clearFormFields() {
                $("#course-category-form")[0].reset(); // Reset the form
                $("#course-category-form").validate().resetForm(); // Reset the validation state
            }



            $('#add_course_id').on('change', function() {
                var course_id = this.value;
                //alert(course_id);
                $.ajax({
                    url: "{{ route('get-course') }}",
                    type: "get",
                    data: {
                        course_id: course_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result.course_date.course_start_date);

                        // Set the minimum date for the "Apply Start Date" input field
                        document.getElementById('add_start_date').min = result.course_date
                            .course_start_date;
                    }
                });
                $.ajax({
                    url: "{{ route('get-exam') }}",
                    type: "get",
                    data: {
                        course_id: course_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        $('#exam_id').empty();
                        $("#exam_id").append('<option>' + 'Select' + '</option>');
                        $.each(result.exam, function(key, value) {
                            $("#exam_id").append('<option value="' + value.id +
                                '">' + value.exam_title + '</option>');
                        });
                    }
                });
            });
            $('#edit_course_id').on('change', function() {
                var course_id = this.value;
                //alert(state_id);
                $.ajax({
                    url: "{{ route('get-exam') }}",
                    type: "get",
                    data: {
                        course_id: course_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        $('#edit_exam_id').empty();
                        $("#edit_exam_id").append('<option>' + 'Select' + '</option>');
                        $.each(result.exam, function(key, value) {
                            $("#edit_exam_id").append('<option value="' + value.id +
                                '">' + value.exam_title + '</option>');
                        });
                    }
                });
            });

            $('#add_end_date').change(function() {
                var startDate = new Date($('#add_start_date').val());
                var endDate = new Date($(this).val());

                if (endDate <= startDate) {
                    alert('End date must be greater than start date');
                    $(this).val('');
                }
            });

            $('#add_start_date').change(function() {
                $('#add_end_date').trigger('change');
            });

            $('#edit_end_date').change(function() {
                var startDate = new Date($('#edit_start_date').val());
                var endDate = new Date($(this).val());

                if (endDate <= startDate) {
                    alert('End date must be greater than start date');
                    $(this).val('');
                }
            });

            $('#edit_start_date').change(function() {
                $('#edit_end_date').trigger('change');
            });

            $('#add_exam_date').change(function() {
                var addendDate = new Date($('#add_end_date').val());
                var examDate = new Date($(this).val());

                if (examDate <= addendDate) {
                    alert('Exam date must be greater than end date');
                    $(this).val('');
                }
            });

            $('#add_end_date').change(function() {
                $('#add_exam_date').trigger('change');
            });

            $('#edit_exam_date').change(function() {
                var editendDate = new Date($('#edit_end_date').val());
                var editexamDate = new Date($(this).val());

                if (editexamDate <= editendDate) {
                    alert('Exam date must be greater than end date');
                    $(this).val('');
                }
            });

            $('#edit_end_date').change(function() {
                $('#edit_exam_date').trigger('change');
            });



            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#add_start_date').val();
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
            }, "End date must be greater than start date");


            // Initialize the validation plugin for the form
            $("#course-category-form").validate({
                rules: {
                    course_id: {
                        required: true,
                    },
                    exam_id: {
                        required: true,
                    },
                    add_exam_date: {
                        required: true,
                    },
                    exam_location: {
                        required: true,
                    },
                    add_start_date: {
                        required: true,
                    },
                    exam_date: {
                        required: true
                    },
                    exam_start_time: {
                        required: true
                    },
                    hours_needed: {
                        required: true
                    },
                    add_end_date: {
                        required: true,
                        greaterThanStartDate: true
                    },
                },
                messages: {
                    course_id: {
                        required: "Course Name is Required",
                    },
                    exam_id: {
                        required: "Exam Title is Required",
                    },
                    add_exam_date: {
                        required: "Exam Date is Required",
                    },
                    exam_location: {
                        required: "Exam Location is Required",
                    },
                    exam_date: {
                        required: "Exam Date is Required"
                    },
                    add_start_date: {
                        required: "Start Date is Required",
                    },
                    add_end_date: {
                        required: "End Date is Required",
                    },
                    exam_start_time: {
                        required: "Exam Start Time is Required"
                    },
                    hours_needed: {
                        required: "This field is required"
                    }
                },

            });


            $('#addModal').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });


        });
    </script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
@endsection
