@extends('workshop.layouts.backend.main')
<style>
    .text-left {
        text-align: left;
        margin-left: 14px;
        display: block;
    }
</style>
@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-md-8">
                    <div class="">
                        <h4 class="mb-0"><b>ATTENDANCE</b> </h4>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div style="display: flex; justify-content: flex-end;">
                                        <a href="{{url()->previous()}}"
                                            class="btn custom-btn">Back</a>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Workshop Mode :
                                                    <span class="text-capitalize">{{ @$workshop->workshop_mode }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Schedule Title :
                                                    <span
                                                        class="text-capitalize">{{ @$workshop->schedule_title }}</span></label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Workshop Date :
                                                    {{ @$workshop->schedule_date }}</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if ($class_count != 0 && $attendance_count == 0)
                                <form action="{{ route('workshop.store-attendance') }}" method="POST" id="attendance_save"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                            @endif
                            <input type="hidden" id="workshop_id" value="{{ @$workshop->workshop_id }}" name="workshop_id">
                            <input type="hidden" id="schedule_id" value="{{ @$workshop->id }}" name="schedule_id">
                            <h1>{{ $formattedDate }}</h1>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Student Name</th>
                                            <th><?php if ($class_count != 0){?> <span class="text-success me-1">P</span>
                                                <input type="checkbox" id="checkbox1" name="checkbox1"> <span
                                                    class="text-danger me-1">A</span><input type="checkbox" id="checkbox2"
                                                    name="checkbox2"><?php }  ?>

                                            </th>
                                            <th>Check-In/Out Time</th>

                                        </tr>
                                    </thead>
                                    {{-- {{dd($workshop->attendance)}} --}}
                                    @if ($workshop->attendance->isEmpty())
                                        <tbody>
                                            {{-- @foreach ($workshop->enrollDetails as $key => $value)
                                                <tr>
                                                    <td style="text-align: center;">{{ ++$key }} </td>


                                                </tr>
                                            @endforeach --}}
                                            @php
                                                $counter = 0;
                                            @endphp
                                            @foreach ($workshop->enrollDetails as $key => $value)
                                                <tr>
                                                    <td style="text-align: center;">{{ ++$counter }}</td>
                                                    <td style="text-align: center;">{{ $value->user->first_name }}</td>
                                                    <td style="text-align: center;">
                                                        <label>
                                                            <input type="radio"
                                                                onchange="changeClass(this, {{ $counter }})"
                                                                id="attendance_type{{ $counter }}"
                                                                name="attendance_type_{{ $key }}" value="1"
                                                                {{ $counter == 1 ? 'checked' : '' }}
                                                                class="present-student"> P
                                                        </label>
                                                        <label>
                                                            <input type="radio"
                                                                onchange="changeClass(this, {{ $counter }})"
                                                                id="attendance_type{{ $counter }}"
                                                                name="attendance_type_{{ $key }}" value="0"
                                                                {{ $counter != 1 ? 'checked' : '' }}
                                                                class="absent-student"> A
                                                        </label>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <label for="clock_in_time{{ $counter }}">Check-In
                                                            time:</label>
                                                        <input type="time" id="clock_in_time{{ $counter }}"
                                                            class="form-valid checkpre"
                                                            name="clock_in_time_{{ $key }}"
                                                            onchange="validateTimes({{ $counter }})">
                                                        <label for="clock_out_time{{ $counter }}">Check-Out
                                                            time:</label>
                                                        <input type="time" id="clock_out_time{{ $counter }}"
                                                            class="form-valid checkpre"
                                                            name="clock_out_time_{{ $key }}"onchange="validateTimes({{ $counter }})">
                                                        <input type="hidden" id="student_id{{ $counter }}"
                                                            value="{{ $value->user->id }}"
                                                            name="student_id_{{ $key }}">
                                                        <span id="time_error{{ $counter }}"
                                                            style="color:red; display:none;">Check-out time must be greater than check-in time. </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            @foreach ($workshop->attendance as $key => $value)
                                                <tr>
                                                    <td style="text-align: center;">{{ ++$key }} </td>

                                                    <td style="text-align: center;"> {{ $value->user->first_name }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        @if ($value->attendance_type == 1)
                                                            Present
                                                        @else
                                                            Absent
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center;">
                                                        @if ($value->attendance_type == 1)
                                                            Check-in:{{ $value->check_in }}
                                                            <br>
                                                            Check-out:{{ $value->check_out }}
                                                        @else
                                                            @if ($value->regularization_remark != null)
                                                                @if (Auth::user()->role_id == 10)
                                                                    <a class="btn custom-btn btn-sm" title="Edit"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editTranModal{{ @$value->id }}">
                                                                        <span>R</span>
                                                                    </a>
                                                                @else
                                                                    <a class="btn custom-btn btn-sm" title="Edit"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#noteditTranModal{{ @$value->id }}">
                                                                        <span>R</span>
                                                                    </a>
                                                                @endif
                                                                <div class="modal fade"
                                                                    id="editTranModal{{ @$value->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-m modal-dialog-centered"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">
                                                                                    Regularization
                                                                                </h5>

                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                            <div class="text-left">
                                                                                <h6
                                                                                    style="display: inline; margin-right: 5px;">
                                                                                    User Remark: </h6>
                                                                                <p style="display: inline;">
                                                                                    {{ $value->regularization_remark }}</p>
                                                                            </div>

                                                                            <form
                                                                                action="{{ route('workshop.submit-regularization', @$value->id) }}"
                                                                                method="POST"
                                                                                id="regularization{{ @$value->id }}"
                                                                                enctype="multipart/form-data">
                                                                                {{ csrf_field() }}
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3 row">
                                                                                        <div
                                                                                            class="col-sm-12 col-lg-12 mb-2 text-start">
                                                                                            <label for=""
                                                                                                class="col-form-label">Attendance
                                                                                                Type</label>
                                                                                            <select
                                                                                                class="form-select form-valid{{ $value->id }}"
                                                                                                id="attendance_type"
                                                                                                onchange="changeClassregu(this,{{ $value->id }})"
                                                                                                name="attendance_type">
                                                                                                <option value="">
                                                                                                    Select
                                                                                                </option>
                                                                                                <option value="1">
                                                                                                    Present
                                                                                                </option>
                                                                                                <option value="0">
                                                                                                    Absent
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>

                                                                                        <div
                                                                                            class="col-sm-12 col-lg-12 mb-2 text-start">
                                                                                            <label
                                                                                                for="clock_out_time">Check-In
                                                                                                time:</label>
                                                                                            <input type="time"
                                                                                                id="clock_in_time{{ $value->id }}"
                                                                                                class="form-control"
                                                                                                name="clock_in_time">
                                                                                        </div>

                                                                                        <div
                                                                                            class="col-sm-12 col-lg-12 text-start">
                                                                                            <label
                                                                                                for="clock_out_time">Check-Out
                                                                                                time:</label>
                                                                                            <input type="time"
                                                                                                id="clock_out_time{{ $value->id }}"
                                                                                                class="form-control"
                                                                                                name="clock_out_time">
                                                                                        </div>

                                                                                        <div
                                                                                            class="col-sm-12 col-lg-12 text-start">
                                                                                            <label for=""
                                                                                                class="col-form-label">Remarks</label>
                                                                                            <input
                                                                                                class="form-control form-valid{{ $value->id }}"
                                                                                                type="text"
                                                                                                value=""
                                                                                                id="remark{{ $value->id }}"
                                                                                                name="remark">
                                                                                        </div>


                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="button"
                                                                                        onclick="saveFormedit({{ $value->id }})"
                                                                                        class="btn custom-btn">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <br>
                            <br>
                            @if ($workshop->attendance->isEmpty())
                                <button type="submit" onclick="attendanceSave()" id=""
                                    class="btn custom-btn">Save</button>
                            @endif
                            </form>

                            <!-- end table-responsive -->
                        </div>


                    </div>
                    {{-- @if ($class_count != 0 && $attendance_count == 0 && count($student_order) != 0)
                        <button type="button" onclick="attendanceSave()" id=""
                            class="btn custom-btn">Save</button>
                        </form>
                    @endif --}}


                    <div class="m-4">

                    </div>
                </div>
            </div>



            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <script>
        const checkbox1 = document.getElementById('checkbox1');
        const checkbox2 = document.getElementById('checkbox2');

        checkbox1.addEventListener('change', function() {
            if (this.checked) {

                const radios_present = document.getElementsByClassName('present-student');
                for (let i = 0; i < radios_present.length; i++) {
                    radios_present[i].checked = true;

                    // var element_in = document.getElementById("clock_in_time" + i);

                    // var element_out = document.getElementById("clock_out_time" + i);

                    // element_in.classList.add("form-valid");

                    // element_out.classList.add("form-valid");
                }

                const radios_absent = document.getElementsByClassName('absent-student');
                for (let i = 0; i < radios_absent.length; i++) {
                    radios_absent[i].checked = false;

                }

                checkbox2.checked = false;
            }
        });

        checkbox2.addEventListener('change', function() {
            if (this.checked) {
                checkbox1.checked = false;


                const radios_present = document.getElementsByClassName('present-student');
                for (let i = 0; i < radios_present.length; i++) {
                    radios_present[i].checked = false;

                    // var element_in = document.getElementById("clock_in_time" + i);

                    // var element_out = document.getElementById("clock_out_time" + i);

                    // element_out.classList.remove("form-valid");

                    // element_in.classList.remove("form-valid");

                }

                const radios_absent = document.getElementsByClassName('absent-student');
                for (let i = 0; i < radios_absent.length; i++) {
                    radios_absent[i].checked = true;

                }


            }
        });
        document.getElementById('attendance_date').addEventListener('blur', function() {
            if ($('#attendance_date').val() != '') {

                document.getElementById('attendance_date_scarch').submit();
            }
        });

        function attendanceSave() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();
            $('.form-valid').each(function() {
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

            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#attendance_save').submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }


        function saveFormedit(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                }
            });

            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });
                $('#regularization' + e).submit();

            } else {
                return false;
            }
        }


        function changeClass(radio, id) {
            var element_in = document.getElementById("clock_in_time" + id);

            var element_out = document.getElementById("clock_out_time" + id);



            if (radio.value === "1") {
                element_in.classList.add("form-valid");

                element_out.classList.add("form-valid");
            } else if (radio.value === "0") {
                element_out.classList.remove("form-valid");

                element_in.classList.remove("form-valid");
            }
        }


        function changeClassregu(radio, id) {
            var element_in = document.getElementById("clock_in_time" + id);

            var element_out = document.getElementById("clock_out_time" + id);



            if (radio.value === "1") {
                element_in.classList.add("form-valid" + id);

                element_out.classList.add("form-valid" + id);
            } else if (radio.value === "0") {
                element_out.classList.remove("form-valid" + id);

                element_in.classList.remove("form-valid" + id);
            }
        }

        function validateTimes(counter) {
            const checkInTime = document.getElementById(`clock_in_time${counter}`).value;
            const checkOutTime = document.getElementById(`clock_out_time${counter}`).value;
            const errorSpan = document.getElementById(`time_error${counter}`);

            if (checkInTime && checkOutTime) {
                if (checkInTime >= checkOutTime) {
                    errorSpan.style.display = 'inline';
                } else {
                    errorSpan.style.display = 'none';
                }
            } else {
                errorSpan.style.display = 'none';
            }
        }
    </script>
    <script>
        function changeClass(radio, counter) {
            var isChecked = radio.value == "1";
            var checkInTime = document.getElementById('clock_in_time' + counter);
            var checkOutTime = document.getElementById('clock_out_time' + counter);

            checkInTime.required = isChecked;
            checkOutTime.required = isChecked;

            checkInTime.disabled = !isChecked;
            checkOutTime.disabled = !isChecked;
        }

        // Initialize the required fields based on the initial state of the radio buttons
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($workshop->enrollDetails as $key => $value)
                changeClass(document.querySelector('input[name="attendance_type_{{ $key }}"]:checked'),
                    {{ $loop->index + 1 }});
            @endforeach
        });
    </script>
@endsection
