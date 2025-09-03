@extends('course.layouts.user.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('user-assets/css/profile-style.css') }}">
@endsection
@section('content')

    @php
        $user = App\Models\User::with('enrolledCourses')
            ->where('id', Auth::user()->id)
            ->first();

        $current_date = Carbon\Carbon::now()->format('Y-m-d');
        $courseNotifications = App\Models\Course\CrCourseCart::with(['courseNotification.Exam', 'course'])
            ->where('enroll_status', 'completed')
            ->where('user_id', Auth::user()->id)
            ->whereHas('courseNotification', function ($query) use ($current_date) {
                $query->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date);
            })
            ->get();

        $exam = App\Models\Course\CrExam::with('CrCart', 'Notification.Result', 'course')
            ->whereHas('CrCart', function ($query) {
                $query->where('user_id', auth()->id())->where('enroll_status', 'completed');
            })
            ->whereHas('Notification.Result', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('id', 'DESC')
            ->get();
    @endphp
    @if (!$courseNotifications->isEmpty())
        <div class="hot-news" style="color:white; font-size: 15px; padding:0px 0px;">
            <div class="left_head"> Examination Announcements {{ date('Y') . '-' . date('Y') + 1 }}</div>
            <div class="right_marq">
                <marquee style="margin-top: 5px" scrollamount="3"
                    onmouseout="this.setAttribute('scrollamount', 3, 0);this.start();"
                    onmouseover="this.setAttribute('scrollamount', 0, 0);this.stop();">

                    @foreach ($courseNotifications as $key => $notification)
                        @if (@$notification->courseNotification)
                            @foreach ($notification->courseNotification as $item)
                                <form action="{{ route('user.course.exam.apply', @$item->id) }}" method="POST"
                                    style="display: inline-block; margin-right: 20px;">
                                    @csrf
                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>
                                        {{-- <i class="fa fa-arrow-circle-right" style="font-size:18px;color:#9B0000"></i> --}}
                                        {{ @$notification->course->course_name }} ( {{ @$item->Exam->exam_title }} ) -
                                        ({{ Carbon\Carbon::parse(@$item->start_date)->toFormattedDateString() }}
                                        -
                                        {{ Carbon\Carbon::parse(@$item->end_date)->toFormattedDateString() }})
                                    </span>

                                    <button class="btn btn-danger btn-sm">Apply Now</button>
                                    {{-- <span type="submit" class="badge bg-danger"><a class="btn  btn-danger btn-sm" type="submit"></a></span> --}}
                                    {{-- <button type="submit" class="btn"><span class="apply-now badge bg-danger">Apply
                                        Now</span></button> --}}
                                </form>
                            @endforeach
                        @endif
                    @endforeach
                    {{-- <b>dddddd (9999) &nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;</b> --}}
                </marquee>
            </div>
        </div>
    @endif
    <div class="dashboardarea sp_bottom_100">
        <div class="dashboard">
            <div class="container-fluid">
                <div class="row profile-user-content">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="dashboard__inner sticky-top"
                            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="dashboard__nav__title">
                                <h6>Welcome, {{ @$user->user_name }} </h6>
                            </div>
                            @include('course.user.layouts.sidebar')

                        </div>
                    </div>
                    @yield('profile-content')


                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endsection
