@extends('course.layouts.admin.main')

@section('content')
{{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active text-custom-primary">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @role('Course Admin')
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{count(@$totalCourses)}}</span></h4>
                                <p class="text-muted mb-0">Total Courses</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{count(@$enrolledCourses)}}</span></h4>
                                <p class="text-muted mb-0">Enrolled Courses</p>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{count(@$pendingUsers)}}</span></h4>
                                <p class="text-muted mb-0">Pending Users</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">

                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="growth-chart" data-colors='["--bs-warning"]'></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{count(@$rejectUsers)}}</span></h4>
                                <p class="text-muted mb-0">Rejected Users</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->
            </div>

            @endrole

            @role('Trainer')
            <div class="card dashboard-content-box text-center">
                <div class="card-body dashboard-container">
                    <h2 class="dashboard-heading">Welcome  {{Auth::user()->first_name}} to  our <br><span class="text-primary">Course Module!</span></h2>
                </div>
            </div>
            @endrole

            {{-- <div class="row">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Course Wise Report</h4>

                            <div id="column_chart" data-colors='["--bs-success", "--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Course Analysis</h4>

                            <div id="radial_chart" data-colors='["--bs-primary", "--bs-success", "--bs-info" ,"--bs-warning"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
            </div> --}}
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
{{-- </div> --}}
@endsection
