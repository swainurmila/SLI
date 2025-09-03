@extends('layouts.backend.header')

@section('content')
{{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
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
            <!-- end page title -->
            <?php
                $book_request = App\Models\BookRequest::count();
                $book_pending = App\Models\BookRequest::where('issue_status',0)->count();

                $book_approved = App\Models\BookRequest::whereIn('issue_status', [1,4,3])->count();

                $book_reject = App\Models\BookRequest::where('issue_status',2)->count();

            ?>
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$book_request}}</span></h4>
                                <p class="text-muted mb-0">New Booking</p>
                            </div>
                            {{-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1">2.65%</span> since last week
                            </p> --}}
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
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$book_approved}}</span></h4>
                                <p class="text-muted mb-0">Approve</p>
                            </div>
                            {{-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1">0.82%</span> since last week
                            </p> --}}
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
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$book_pending}}</span></h4>
                                <p class="text-muted mb-0">Pending</p>
                            </div>
                            {{-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1">6.24%</span> since last week
                            </p> --}}
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
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$book_reject}}</span></h4>
                                <p class="text-muted mb-0">Cancel / Reject</p>
                            </div>
                            {{-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1">10.51%</span> since last week
                            </p> --}}
                        </div>
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->
            {{-- <div class="row">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Category Wise Report</h4>

                            <div id="column_chart" data-colors='["--bs-success", "--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Booking Analysis</h4>

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
