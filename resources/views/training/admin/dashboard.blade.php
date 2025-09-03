@extends('training.admin.layouts.page-layouts.main')

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
            
            if (Auth::user()->role_id == 3) {
                $total_training_count = App\Models\Training\TrTraining::count();
                $total_training_enrolled = App\Models\Training\TrTrainingOrder::count();
                $total_pending_users = App\Models\User::where('status', '0')->where('is_training','1')->count();
                $total_rejected_users = App\Models\User::where('status', '2')->where('is_training','1')->count();
            } else {
                $total_training_count = App\Models\Training\TrTraining::where('created_by', Auth::user()->id)->count();
                $total_training_enrolled = App\Models\Training\TrTraining::withCount('TotalEnrollOrders')
                    ->where('created_by', Auth::user()->id)
                    ->get();


            }
            
            ?>

            @if (Auth::user()->role_id == 3)
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $total_training_count }}</span>
                                    </h4>
                                    <p class="text-muted mb-0">Total Training</p>
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
                                    <h4 class="mb-1 mt-1"><span
                                            data-plugin="counterup">{{ $total_training_enrolled }}</span></h4>
                                    <p class="text-muted mb-0">Enrolled Training</p>
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
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ @$total_pending_users }}</span>
                                    </h4>
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
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ @$total_rejected_users }}</span>
                                    </h4>
                                    <p class="text-muted mb-0">Rejected Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ @$total_training_count }}</span>
                                    </h4>
                                    <p class="text-muted mb-0">Total Training</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">

                                            @if (!$total_training_enrolled->isEmpty())
                                                @php
                                                    $totalEnrolled = 0;
                                                    foreach ($total_training_enrolled as $key => $enrolledTraining) {
                                                        $totalEnrolled += $enrolledTraining->total_enroll_orders_count;
                                                    }
                                                @endphp
                                                <span>{{@$totalEnrolled}}</span>
                                            @else
                                                0
                                            @endif
                                        </span></h4>
                                    <p class="text-muted mb-0">Enrolled Training</p>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col-->


                </div>
            @endif
        </div>
    </div>
    <!-- End Page-content -->
    {{-- </div> --}}
@endsection
