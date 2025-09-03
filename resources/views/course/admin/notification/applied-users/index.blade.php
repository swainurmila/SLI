@extends('course.layouts.admin.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->


            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>Exam Attendance</b> </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('course.admin.store-exam-attendance', @$notification_id->id) }}"
                                method="POST" id="attendance_save" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>Course Name</th>
                                                <th>Exam Name</th>
                                                <th>User Name</th>
                                                <th>
                                                    <span class="text-success me-1">P</span>
                                                    <input type="checkbox" id="checkbox1" name="checkbox1"
                                                        onchange="toggleAllCheckboxesP(this)">
                                                    <span class="text-danger me-1">A</span>
                                                    <input type="checkbox" id="checkbox2" name="checkbox2"
                                                        onchange="toggleAllCheckboxesA(this)">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $showSubmitButton = false; // Initialize the variable
                                            @endphp

                                            @foreach ($appliedStudents as $key => $appliedStudent)
                                                <tr class="">
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ @$appliedStudent->notification->Exam->Course->course_name }}</td>
                                                    <td class="text-center">
                                                        {{ @$appliedStudent->notification->Exam->exam_title }}</td>
                                                    <td class="text-center">
                                                        {{ @$appliedStudent->user->first_name . ' ' . @$appliedStudent->user->last_name }}
                                                    </td>

                                                    <td style="text-align: center;">
                                                        @if ($appliedStudent->attendance == '')
                                                            @php
                                                                $showSubmitButton = true;
                                                            @endphp
                                                            <input type="hidden" name="student_id[{{ $key }}]"
                                                                value="{{ $appliedStudent->user_id }}">
                                                            <label>
                                                                <input type="radio"
                                                                    onchange="changeClass(this,{{ $key }})"
                                                                    id="attendance_type{{ $key }}"
                                                                    name="attendance_type[{{ $key }}]"
                                                                    value="1" checked
                                                                    class="attendance-radio present-student"> P
                                                            </label>
                                                            <label>
                                                                <input type="radio"
                                                                    onchange="changeClass(this,{{ $key }})"
                                                                    id="attendance_type{{ $key }}"
                                                                    name="attendance_type[{{ $key }}]"
                                                                    value="0" class="attendance-radio absent-student">
                                                                A
                                                            </label>
                                                        @else
                                                            @if ($appliedStudent->attendance == 0)
                                                                <span class="badge bg-danger">Absent</span>
                                                            @else
                                                                <span class="badge bg-success">Present</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($showSubmitButton)
                                    <button type="submit" onclick="attendanceSave()" id=""
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
@endsection


@section('script')
    <script>
        document.getElementById('checkbox1').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('checkbox2').checked = false;
            }
        });

        document.getElementById('checkbox2').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('checkbox1').checked = false;
            }
        });
    </script>
    <script>
        function toggleAllCheckboxesP(checkbox) {
            var radioButtons = document.querySelectorAll('.attendance-radio');

            if (checkbox.checked) {
                radioButtons.forEach(function(radio) {
                    if (radio.value === "1") {
                        radio.checked = true;
                    }
                });
            } else {
                radioButtons.forEach(function(radio) {
                    if (radio.value === "1") {
                        radio.checked = false;
                    }
                });
            }
        }

        function toggleAllCheckboxesA(checkbox) {
            var radioButtons = document.querySelectorAll('.attendance-radio');

            if (checkbox.checked) {
                radioButtons.forEach(function(radio) {
                    if (radio.value === "0") {
                        radio.checked = true;
                    }
                });
            } else {
                radioButtons.forEach(function(radio) {
                    if (radio.value === "0") {
                        radio.checked = false;
                    }
                });
            }
        }
    </script>
@endsection
