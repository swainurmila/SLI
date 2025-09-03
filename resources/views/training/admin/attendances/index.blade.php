@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Attendance</h4>

                        <div class="page-title-right">
                            <a href="{{ route('training.admin.class.list',@$class_data->training_details_id) }}" class="btn btn-sm btn-dark">
                                Back</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <div class="page-title-left d-flex">
                                            <h4><span class="badge bg-success">Class Mode :
                                                    {{ $class_data->class_mode }}</span></h4>
                                            <h4><span class="badge bg-warning mx-3">Class Name :
                                                    {{ $class_data->class_name }}</span></h4>
                                            <h4><span class="badge bg-danger">Class Date :
                                                    {{ $class_data->class_date }}</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @if ($attendance_count != count($student_order))
                                <form action="{{ route('attendance.store') }}" method="POST" id="attendance_save"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="class_id" value="{{ @$class_data->id }}" name="class_id">
                            @endif


                            <div class="table-responsive">
                                <table class="table table-centered table-bordered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Student Name</th>
                                            <th><?php if ($class_count != 0){?> <span class="text-success me-1">P</span> <input
                                                    type="checkbox" id="checkbox1" name="checkbox1"> <span
                                                    class="text-danger me-1">A</span><input type="checkbox" id="checkbox2"
                                                    name="checkbox2"><?php }  ?>

                                            </th>
                                            {{-- <th>Check-In/Out Time</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($student_order) > 0)
                                            <?php
                                            $j = 0;
                                            ?>
                                            @foreach ($student_order as $key => $order)
                                                <?php
                                                $student_data = App\Models\User::where('id', @$order->user_id)->first();
                                                
                                                $attendance_data = App\Models\Training\TrStudentAttendance::where('class_id', @$id)
                                                    ->where('student_id', @$order->user_id)
                                                    ->first();
                                                
                                                // dd($attendance_data);
                                                
                                                ?>
                                                <tr>
                                                    <td style="text-align: center;">{{ ++$key }} </td>

                                                    <td style="text-align: center;"> {{ $student_data->first_name }}</td>

                                                    @if (isset($attendance_data) && $student_data->id == $attendance_data->student_id)
                                                        @if (@$attendance_data->attendance_type == '1')
                                                            <td style="text-align: center;"> Present</td>
                                                        @elseif (@$attendance_data->attendance_type == '0')
                                                            <td style="text-align: center;"> Absent</td>
                                                            @if ($attendance_data->regularization_remark != null)
                                                                <td>

                                                                    @if (Auth::user()->role_id == 3)
                                                                        <a class="btn btn-outline-info btn-sm edit"
                                                                            title="Request" data-bs-toggle="modal"
                                                                            data-bs-target="#editTranModal{{ @$attendance_data->id }}"><i
                                                                                class="uil-edit-alt"></i></a>
                                                                    @else
                                                                        <a class="btn btn-outline-info btn-sm edit"
                                                                            title="Request" data-bs-toggle="modal"
                                                                            data-bs-target="#noteditTranModal{{ @$attendance_data->id }}"><i
                                                                                class="uil-edit-alt"></i></a>
                                                                    @endif
                                                                </td>



                                                                <div class="modal fade"
                                                                    id="editTranModal{{ @$attendance_data->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered"
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

                                                                            <form
                                                                                action="{{ route('training-user.admin.regularizationSubmit', ['id' => $attendance_data->id]) }}"
                                                                                method="POST"
                                                                                id="regularization{{ @$attendance_data->id }}"
                                                                                enctype="multipart/form-data">
                                                                                {{ csrf_field() }}
                                                                                <div class="modal-body">

                                                                                    <div class="col-sm-12 text-start">
                                                                                        <label for=""
                                                                                            class="col-form-label text-start">User
                                                                                            Message </label>
                                                                                        <p>{{ @$attendance_data->regularization_remark }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-start">
                                                                                        <label for=""
                                                                                            class="col-form-label text-start">Attendance
                                                                                            Type</label>
                                                                                        <select
                                                                                            class="form-select form-valid{{ @$attendance_data->id }}"
                                                                                            id="attendance_type"
                                                                                            onchange="changeClassregu(this,{{ $attendance_data->id }})"
                                                                                            name="attendance_type">
                                                                                            <option value="">Select
                                                                                            </option>
                                                                                            <option value="1">Present
                                                                                            </option>
                                                                                            <option value="0">Absent
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>


                                                                                    <div class="col-sm-12 text-start">
                                                                                        <label for=""
                                                                                            class="col-form-label text-start">Remarks</label>
                                                                                        <input
                                                                                            class="form-control form-valid{{ @$attendance_data->id }}"
                                                                                            type="text" value=""
                                                                                            id="remark{{ @$attendance_data->id }}"
                                                                                            name="remark">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="button"
                                                                                        onclick="saveFormedit({{ @$attendance_data->id }})"
                                                                                        class="btn custom-btn">Edit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <td style="text-align: center;"> <label>
                                                                <input type="radio"
                                                                    onchange="changeClass(this,{{ $j }})"
                                                                    id="attendance_type{{ $j }}"
                                                                    name="attendance_type_{{ $j }}"
                                                                    value="1" checked class="present-student"> P
                                                            </label>
                                                            <label>
                                                                <input type="radio"
                                                                    onchange="changeClass(this,{{ $j }})"
                                                                    id="attendance_type{{ $j }}"
                                                                    name="attendance_type_{{ $j }}"
                                                                    value="0" class="absent-student"> A
                                                            </label>
                                                        </td>
                                                    @endif

                                                    {{-- <td style="text-align: center;">
                                                                <label for="clock_out_time">Check-In time:</label>
                                                                <input type="time" id="clock_in_time{{ $j }}"
                                                                    class="form-valid checkpre"
                                                                    name="clock_in_time[{{ $j }}]">

                                                                <label for="clock_out_time">Check-Out time:</label>
                                                                <input type="time" id="clock_out_time{{ $j }}"
                                                                    class="form-valid checkpre"
                                                                    name="clock_out_time[{{ $j }}]">

                                                                <input type="hidden" id="student_id{{ $j }}"
                                                                    value="{{ $order->user_id }}"
                                                                    name="student_id[{{ $j }}]">

                                                            </td> --}}

                                                    <input type="hidden" id="student_id{{ $j }}"
                                                        value="{{ $order->user_id }}"
                                                        name="student_id_{{ $j }}">
                                                    <?php
                                                    $j++;
                                                    ?>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="4">No Student Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- end table-responsive -->
                            <div class="text-end mt-2">
                                @if ($attendance_count != count($student_order))
                                    <button type="button" onclick="attendanceSave()" id=""
                                        class="btn custom-btn btn-md">Save</button>
                                    </form>
                                @endif
                                {{-- @if ($class_count != 0 && $attendance_count == 0 && count($student_order) != 0)
                                    <button type="button" onclick="attendanceSave()" id=""
                                        class="btn custom-btn btn-md">Save</button>
                                @endif --}}
                            </div>
                        </div>


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
            // alert(errcount);
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
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#regularization' + e).submit();
                // $.unblockUI();         
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
    </script>
@endsection
