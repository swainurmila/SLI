@extends('course.layouts.admin.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->


            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>Exam Result</b> </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('course.admin.store-exam-result', $notification_id->id) }}" method="POST"
                                id="attendance_save" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0 datatable">
                                        <thead class="table-secondary">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>Course Name</th>
                                                <th>Exam Title</th>
                                                <th>Student Name</th>
                                                <th>Total Mark</th>
                                                <th>Pass Mark</th>
                                                <th>Score</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $showSubmitButton = false;
                                            @endphp
                                            @foreach ($data as $key => $val)
                                                <tr>

                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="text-center">
                                                        {{ $val->notification->Exam->Course->course_name }}</td>
                                                    <td class="text-center">{{ $val->notification->Exam->exam_title }}</td>
                                                    <td class="text-center">{{ $val->user->first_name }}
                                                        {{ $val->user->last_name }}</td>
                                                    <td class="text-center">{{ $val->notification->Exam->exam_mark }}</td>
                                                    <td class="text-center">{{ $val->notification->Exam->passing_mark }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($val->score == '')
                                                            @php
                                                                $showSubmitButton = true;
                                                            @endphp
                                                            <input type="number" name="exam_score[{{ $key }}]"
                                                                id="exam_score" required>
                                                            <input type="hidden" name="student_id[{{ $key }}]"
                                                                value="{{ $val->user_id }}">
                                                            <input type="hidden" name="pass_mark[{{ $key }}]"
                                                                value="{{ $val->notification->Exam->passing_mark }}">
                                                        @else
                                                            {{ $val->score }}
                                                            @if ($val->score > +$val->notification->Exam->passing_mark)
                                                                <span class="badge bg-success">Pass</span>
                                                            @else
                                                                <span class="badge bg-danger">Fail</span>
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($showSubmitButton)
                                    <button type="submit" onclick="attendanceSave()" id="submitBtn"
                                        class="btn custom-btn">Submit</button>
                                @endif
                            </form>

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

    {{-- </div> --}}
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll('input[type="number"]');

            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    var tr = this.closest('tr');

                    var examMarkCell = tr.querySelector('td:nth-child(5)');
                    var examMark = parseFloat(examMarkCell.textContent);

                    // Retrieve the entered score value
                    var enteredScore = parseFloat(this.value);

                    // Perform validation
                    if (enteredScore > examMark) {
                        alert('Exam score cannot exceed ' + examMark);
                        this.value = '';
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("endDateGreaterThanStartDate", function(value, element) {
                var startDate = $('#start_date').val();
                var endDate = value;

                return startDate <= endDate;
            }, "End date must be greater than or equal to start date");


            $.validator.addMethod("examDateGreaterThanEndDate", function(value, element) {
                var examDate = $('#exam_date').val();
                var endDate = $('#end_date').val();


                return examDate > endDate;
            }, "Exam date must be greater than apply end date");

            // Initialize the validation plugin for the form
            $("#course-category-form").validate({
                rules: {
                    course_id: {
                        required: true,
                    },
                    exam_id: {
                        required: true,
                    },
                    exam_date: {
                        required: true,
                        examDateGreaterThanEndDate: true
                    },
                    exam_location: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                        endDateGreaterThanStartDate: true // Apply custom validation rule
                    },
                },
                messages: {
                    course_id: {
                        required: "Course Name field is required",
                    },
                    exam_id: {
                        required: "Notification Title field is required",
                    },
                    exam_date: {
                        required: "Exam Date field is required",
                    },
                    exam_location: {
                        required: "Exam Location field is required",
                    },
                    start_date: {
                        required: "Start Date field is required",
                    },
                    end_date: {
                        required: "End Date field is required",
                    },
                },
            });

            $('#add_course_id').on('change', function() {
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
                        $('#exam_id').empty();
                        $("#exam_id").append('<option>' + 'Select' + '</option>');
                        $.each(result.exam, function(key, value) {
                            $("#exam_id").append('<option value="' + value.id +
                                '">' + value.exam_title + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
