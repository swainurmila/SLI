@extends('workshop.user.layouts.main')
@section('profile-content')
<div class="col-xl-9 col-lg-9 col-md-12">
    <div class="dashboard__content__wraper" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="dashboard__section__title">
            <h4>Summary</h4>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                <div class="dashboard__single__counter" style="background: #d8ffe8;">
                    <div class="counterarea__text__wraper">
                        <div class="counter__img">
                            <img loading="lazy" src="{{asset('user-assets/images/profile/counter__1.png')}}" alt="counter">
                        </div>
                        <div class="counter__content__wraper">
                            <div class="counter__number">
                                <span class="counter">{{count(@$enrolledCourses)}}</span>
                            </div>
                            <p>Enrolled Workshops</p>
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
                                <span class="counter"></span>{{$active_workshop}}</span>

                            </div>
                            <p>Active Workshops</p>
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
                                <span class="counter">{{$completed_workshop}}</span>

                            </div>
                            <p>Completed Workshops</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
