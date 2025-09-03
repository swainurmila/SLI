@extends('workshop.user.layouts.main')
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
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl No </th>
                                            <th>Workshop Name</th>
                                            <th>Schedule Name</th>
                                            <th>Attendance Type </th>
                                            <th>SChedule Date </th>
                                            <th>Clock-In/Out Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $key => $val)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $val->Workshop->title }}</td>
                                                <td>{{ $val->schedule->schedule_title }}</td>
                                                <td>{{ $val->attendance_type == 1 ? 'Present' : 'Absent' }}</td>
                                                <td>{{ $val->schedule->schedule_date }}</td>
                                                <td>Check In: {{ $val->check_in }}<br>
                                                    Check Out: {{ $val->check_out }}
                                                </td>
                                                <td>
                                                    @if ($val->attendance_type == 0 && $val->regularization_remark == null)
                                                        <button type="button" onclick="returnRequest({{ $val->id }})"
                                                            class="btn btn-info btn-sm edit waves-effect waves-light">Request
                                                            Regularization</button>
                                                    @elseif ($val->attendance_type == 1)
                                                        N/A
                                                    @endif
                                                    {{ $val->regularization_remark }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

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

            if (remark !== null) {

                $.ajax({
                    type: 'post',
                    url: "{{ route('user.attendance-regularization') }}",
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
