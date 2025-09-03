@extends('workshop.user.layouts.main')
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper"
            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="dashboard__section__title">
                <h4>My Workshops</h4>
            </div>
            <div class="row table-responsive">

                @if (count(@$enrolledCourses) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Reviews</th>
                                <th>Progress</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($enrolledCourses as $key => $enrolledCourse)
                                {{-- {{dd($enrolledCourse->schedule)}} --}}
                                @php
                                    $completedClassPercentage = 0;
                                    // if($enrolledCourse->schedule){
                                    //     if(count($enrolledCourse->schedule) > 0){
                                    //         foreach ($enrolledCourse->schedule as $key => $classes) {
                                    //                 if($classes->userAttendance){
                                    //                     $completedClassPercentage++;
                                    //                 }
                                    //             }
                                    //         }
                                    //         $completedClassPercentage = ($completedClassPercentage / count($enrolledCourse->schedule)) * 100;

                                    //     }

                                    if ($enrolledCourse->schedule && count($enrolledCourse->schedule) > 0) {
                                        foreach ($enrolledCourse->schedule as $key => $classes) {
                                            if ($classes->userAttendance) {
                                                $completedClassPercentage++;
                                            }
                                        }

                                        $completedClassPercentage =
                                            ($completedClassPercentage / count($enrolledCourse->schedule)) * 100;
                                    } else {
                                        $completedClassPercentage = 0;
                                    }

                                @endphp

                                <tr>
                                    <td><a
                                            href="{{ route('user.workshop.details', @$enrolledCourse->workshop->id) }}">{{ @$enrolledCourse->workshop->title }}</a>
                                    </td>
                                    <td>{{ @$enrolledCourse->workshop->start_date }}</td>

                                    <td>{{ @$enrolledCourse->workshop->end_date }}</td>

                                    <td>
                                        @if (@$enrolledCourse->workshop->price == 0 || @$enrolledCourse->workshop->price == '')
                                            <div class="gridarea__price green__color">
                                                <span> <del class="del__2">Free</del></span>
                                            </div>
                                        @else
                                            <div class="gridarea__price">
                                                ₹{{ number_format(@$enrolledCourse->workshop->price, 2, '.', ',') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>( 0 )</td>
                                    <td>
                                        <div class="progress ">
                                            <div class="progress-bar bg-success training-progress-bar" role="progressbar"
                                                aria-valuenow="{{ round(@$completedClassPercentage, 2) }}" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 100%;">
                                                {{ round(@$completedClassPercentage, 2) }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" style="margin-bottom: 10px"
                                            href="{{ route('user.workshop.view-workshop-schedule', @$enrolledCourse->workshop->id) }}">View
                                            Schedule</a>
                                        @if ($completedClassPercentage == 100)
                                            <a class="btn btn-sm btn-success" style="margin-bottom: 10px"
                                                href="{{ route('user.workshop.Certificate', ['id' => $enrolledCourse->workshop->id]) }}">
                                                Certificate</a>
                                        @endif

                                        {{-- @if ($completedClassPercentage == 100)
                                    <a class="btn btn-sm btn-success" href="{{ route('training-user.class.Certificate', ['id' => $order->id]) }}">Download Certificate</a>
                                @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Workshop Found !</p>
                @endif
            </div>
        </div>

    </div>
@endsection
