@extends('training.traininguser.profile.layouts.main')
@section('profile-content')
<div class="col-xl-9 col-lg-9 col-md-12">
    <div class="dashboard__content__wraper" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);min-height:480px">
        <div class="dashboard__section__title">
            <h4>Summary</h4>
        </div>


        @php
            $completedCourse = 0;
            $activeCourse = 0;
        @endphp
        @foreach ($user->trainingOrders as $key => $order)
            @php
                $completedClassPercentage = 0;
                if (count($order->trainingClasses) > 0) {
                            foreach ($order->trainingClasses as $key => $classes) {
                                if ($classes->trainingAttendance) {
                                    $completedClassPercentage++;
                                }
                            }
                            $completedClassPercentage =
                                ($completedClassPercentage /
                                    count($order->trainingClasses)) *
                                100;

                            if($completedClassPercentage == 100){
                                $completedCourse++;
                            }

                            if($completedClassPercentage < 100){
                                $activeCourse++;
                            }
                            
                }
            @endphp
        @endforeach
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                <div class="dashboard__single__counter" style="background: #d8ffe8;">
                    <div class="counterarea__text__wraper">
                        <div class="counter__img">
                            <img loading="lazy" src="{{asset('user-assets/images/profile/counter__1.png')}}" alt="counter">
                        </div>
                        <div class="counter__content__wraper">
                            <div class="counter__number">

                                @if(count(@$user->trainingOrders) < 10)
                                    <span class="counter">{{count(@$user->trainingOrders)}}</span>
                                @else
                                    <span class="counter">{{count(@$user->trainingOrders)}}</span>+
                                @endif

                            </div>
                            <p>Enrolled Training</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                <div class="dashboard__single__counter" style="background: #fff8c4;">
                    <div class="counterarea__text__wraper">
                        <div class="counter__img">
                            <img loading="lazy" src="{{asset('user-assets/images/profile/counter__2.png')}}" alt="counter">
                        </div>
                        <div class="counter__content__wraper">
                            <div class="counter__number">
                                <span class="counter">{{@$activeCourse}}</span>

                            </div>
                            <p>Active Training</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                <div class="dashboard__single__counter" style="background: #ffe2d1;">
                    <div class="counterarea__text__wraper">
                        <div class="counter__img">
                            <img loading="lazy" src="{{asset('user-assets/images/profile/counter__3.png')}}" alt="counter">
                        </div>
                        <div class="counter__content__wraper">
                            <div class="counter__number">
                                <span class="counter">{{@$completedCourse}}</span>

                            </div>
                            <p>Completed&nbsp;Training</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
