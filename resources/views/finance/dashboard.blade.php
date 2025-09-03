@extends('finance.layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">

            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <div class="page-title-left">
                                <h4>Dashboard</h4>
                            </div>
                            <div class="page-title-right d-flex">
                                <div class="me-3">
                                    <form class="" action="{{ route('finance.dashboard.show') }}" id="expensesDashboardForm" method="GET">
                                        <select class="form-select" name="financial_year" id="expensesDashboardSelect">
                                            <option value="">Select Budget Planning Year</option>
                                            @foreach ($years as $item)
                                                <option value="{{ $item }}" {{ @$item == @$financial_year ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                {{-- <div class="">
                                    <a href="payment.html" class="btn finance-btn">Search</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->






                <div class="row m-2">
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-one">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span
                                            data-plugin="counterup">{{ number_format(@$current_year_budget, 2, '.', ',') }}</span>
                                    </h4>
                                    <p class="text-muted mb-0">Total Sanctioned Amount</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-4">
                        <div class="card card-one">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="orders-chart" data-colors='["--bs-danger"]'></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span
                                            data-plugin="counterup">{{ number_format(@$expense_year_budget, 2, '.', ',') }}</span>
                                    </h4>
                                    <p class="text-muted mb-0">Expenses</p>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-4">
                        <div class="card card-one">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="customers-chart" data-colors='["--bs-success"]'></div>
                                </div>
                                <div>
                                    @if (@$previous_year_remaining && $previous_year_remaining > 0)
                                        <span class="text-black" ><i class="ri-arrow-up-s-fill" ></i>+ {{@$previous_year_remaining}} Previous Year</span>
                                    @endif
                                    <h4 class="mb-1 mt-1 text-success"><span data-plugin="counterup">{{ @$remaining_amount }}</span></h4>
                                    <p class="text-muted mb-0">Remaining Balance</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->


                    


                </div>

                



                <div class="row m-2">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-white">
                                <i class="fa fa-adjust text-primary mr-2"></i>
                                <strong>Balances</strong>
                            </div>
                            <div class="card-body">
                                <canvas id="previus-budgets" ></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-white">
                                <i class="fa fa-adjust text-primary mr-2"></i>
                                <strong>Expenses</strong>
                            </div>
                            <div class="card-body" style="height: 316px;width:310px;margin:auto auto">
                                <canvas id="percent-of-expense" height="200px" width="200px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div> <!-- container-fluid -->
        

    </div>
    <!-- End Page-content -->
    {{-- </div> --}}
@endsection

@section('script')


    <script>
        $('#expensesDashboardSelect').change(function() {
            var selectedYear = $(this).val();
            $('#expensesDashboardForm').submit();
        });
    </script>
    <script src="{{ asset('assets/js/chart-data.js') }}"></script>
@endsection
