@extends('course.user.layouts.main')
@section('profile-content')
<div class="col-xl-9 col-lg-9 col-md-12">
    <div class="dashboard__content__wraper" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="dashboard__section__title">
            <h4>My Courses</h4>
        </div>
        <div class="row table-responsive">

            @if(count(@$enrolledCourses) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Reviews</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>



                    @foreach($enrolledCourses as $key => $enrolledCourse)

                        @php
                            $totalRatings = App\Models\Course\CrCourseRating::where('course_id',$enrolledCourse->course_id)->count()
                        @endphp
                        <tr>
                            <td><a href="{{route('user.course.details',@$enrolledCourse->course->id)}}">{{@$enrolledCourse->course->course_name}}</a></td>
                            <td>{{@$enrolledCourse->course->course_start_date}}</td>

                            <td>{{@$enrolledCourse->course->course_end_date}}</td>
                            
                            <td>
                                @if(@$enrolledCourse->course->course_price == 0 || @$enrolledCourse->course->course_price == '')
                                    <div class="gridarea__price green__color">
                                            <span> <del class="del__2">Free</del></span>
                                    </div>
                                @else
                                    <div class="gridarea__price">
                                        ₹{{number_format(@$enrolledCourse->course->course_price, 2, '.', ',')}}
                                    </div>
                                @endif
                            </td>
                            <td>( {{@$totalRatings}} )</td>
                            <td>
                                <a class="btn btn-sm btn-success" style="margin-bottom: 10px" href="{{route("user.course.view-course-syllabus", @$enrolledCourse->course->id)}}">View Syllabus</a>
                                {{-- @if($completedClassPercentage == 100)
                                    <a class="btn btn-sm btn-success" href="{{ route('training-user.class.Certificate', ['id' => $order->id]) }}">Download Certificate</a>
                                @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No Course Found !</p>
            @endif
        </div>
    </div>

</div>
@endsection