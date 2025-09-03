@extends('research.layouts.main')
<style>
    .apex-charts{
        height: 330px !important;
    }
</style>
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
           


                    


           
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{@$total_papers}}</span></h4>
                                    <p class="text-muted mb-0">Total Papers</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    

                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{@$published_papers}}</span></h4>
                                    <p class="text-muted mb-0">Published Papers</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->
                </div>
          
            {{-- <div class="row">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Course Wise Report</h4>
                            
                            <div id="column_chart" data-colors='["--bs-success", "--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>                                      
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Course Analysis</h4>
                            
                            <div id="radial_chart" data-colors='["--bs-primary", "--bs-success", "--bs-info" ,"--bs-warning"]' class="apex-charts" dir="ltr"></div>  
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
{{-- </div> --}}
@endsection
