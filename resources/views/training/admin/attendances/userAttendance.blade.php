@extends('training.traininguser.profile.layouts.main')
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper">
            <div class="dashboard__section__title">
                <h4>My Attendance</h4>
            </div>
            <div class="row">



                <div class="tab-content tab__content__wrapper aos-init aos-animate" id="myTabContent" data-aos="fade-up">

                    <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">
                        <div class="row">


                            @if (!$attendance_data->isEmpty())
                                <div class="table-responsive">

                                    <?php
                                    $showActionColumn = false;
                                    
                                    foreach ($attendance_data as $attendance) {
                                        if (!is_null($attendance->regularization_remark)) {
                                            $showActionColumn = true;
                                            break;
                                        }
                                    }
                                    ?>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl No
                                                </th>
                                                <th>Training Name
                                                </th>
                                                <th>Batch
                                                </th>
                                                <th>Class Name</th>
                                                <th>Attendance Type </th>

                                                <th>Class Date </th>

                                                <?php if ($showActionColumn) : ?>
                                                    <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $i = 0;
                                            ?>
                                            @foreach ($attendance_data as $attendance)
                                                <tr>
                                                    <?php
                                                    ?>
                                                    <td>
                                                        {{ ++$i }}

                                                    </td>

                                                    <td>
                                                        {{ @$attendance->TrainingDetails->training->name }}

                                                    </td>

                                                    <td>
                                                        {{ @$attendance->Batch->batch_name }}
                                                    </td>

                                                    <td>
                                                        {{ @$attendance->ClassDetails->class_name }}
                                                    </td>

                                                    <td>
                                                        <?php if (@$attendance->attendance_type == '1') {
                                                            echo 'Present';
                                                        } else {
                                                            echo 'Absent';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td> {{ date('d-m-Y', strtotime(@$attendance->ClassDetails->class_date)) }}
                                                    </td>


                                                    <td>

                                                        @if (@$attendance->attendance_type == 0 && @$attendance->regularization_remark == null)
                                                            <button type="button"
                                                                onclick="returnRequest({{ @$attendance->id }})"
                                                                class="btn btn-info btn-sm edit waves-effect waves-light">Request
                                                                Regularization</button>
                                                        @endif
                                                        {{ @$attendance->regularization_remark }}

                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No Attendance Found !</p>
                            @endif

                        </div>
                    </div>


                </div>




            </div>
        </div>

    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function returnRequest(e) {

        var userConfirmed = confirm("Are you sure you want to reject this request?");

        if (userConfirmed) {
            var remark = prompt("Please enter your remarks:");

            // Now 'remark' contains the text entered by the user.
            if (remark !== null) {

                $.ajax({
                    type: 'post',
                    url: "{{ route('training-user.userAttendanceregularizationRequest') }}",
                    data: {

                        id: e,
                        remark: remark,

                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        location.reload();

                    }
                });
            }
        }
    }
</script>
