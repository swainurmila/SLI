@extends('course.user.layouts.main')
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper">
            <div class="dashboard__section__title">
                <h4>My Examination</h4>
            </div>
            <div class="row">
                <div class="tab-content tab__content__wrapper aos-init aos-animate" id="myTabContent" data-aos="fade-up">

                    <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered dt-responsive nowrap dataTable"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl No </th>
                                            <th>Course Name</th>
                                            <th>Exam Title</th>
                                            <th>Exam Date</th>
                                            <th>Exam Time</th>
                                            <th>Mode</th>
                                            <th>Location </th>
                                            <th>Total Mark</th>
                                            <th>Score</th>
                                            <th>Result</th>
                                            <th>Certificate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->course->course_name }}</td>
                                                <td>{{ $item->exam_title }}</td>
                                                <td>{{ $item->Notification ? $item->Notification->exam_date : '-' }}</td>
                                                <td>{{ $item->Notification ? $item->Notification->exam_start_time : '-' }}</td>
                                                <td class="text-capitalize">{{ $item->exam_mode }}</td>
                                                <td class="text-capitalize">
                                                    {{ $item->Notification ? $item->Notification->exam_location : '-' }}
                                                </td>
                                                <td>{{ $item->exam_mark }}</td>
                                                <td>{{ $item->Notification->Result ? $item->Notification->Result->score : '-' }}
                                                </td>
                                                <td>{{ $item->Notification->Result ? $item->Notification->Result->result : '-' }}
                                                </td>
                                                <td>
                                                    @if ($item->Notification->Result && $item->Notification->Result->result == 'Pass')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('course.admin.course-certificate', $item->id) }}">Download
                                                            Certificate</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (@$item->exam_mode == 'online')
                                                        @php
                                                            $examDateTime = \Carbon\Carbon::parse($item->Notification->exam_date." ".$item->Notification->exam_start_time);

                                                            $examEndTime = $examDateTime->copy()->addHours($item->Notification->hours_needed);
                                                            $now = \Carbon\Carbon::now();

                                                        @endphp


                                                        @if ($now->greaterThan($examEndTime) || !$item->Notification->ExamAnswers->isEmpty())
                                                            <span class="text-danger">Link Expired</span>
                                                        @else
                                                            <a href="{{ route('user.course.examination.timer', @$item->id) }}"
                                                                target="_blank" class="btn btn-success">Start Exam</a>
                                                        @endif
                                                    @else
                                                        Not Required
                                                    @endif
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
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
