@extends('course.layouts.admin.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h5>Study Material</h5>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{route('course.admin.courseList')}}">Course</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">{{ @$course->course_name }}</a></li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <h4 class="card-title">{{ @$data->Course->course_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            @include('course.admin.course.study_material.about')
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
                            @yield('course-about')
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection