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
                            <h4>Fund | All Transactions </h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-4 table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Transaction For</th>
                                                <th>Collected Amount</th>
                                                <th>Transaction Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Training</td>
                                                <td>{{ number_format(@$training_amount, 2, '.', ',')}}</td>
                                                <td><a href="{{route("training-index")}}" class="btn finance-btn shadow-sm h-100 ml-2">
                                                        <i class="fa fa-eye"> </i>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Course</td>
                                                <td>{{number_format(@$course_amount, 2, '.', ',')}}</td>
                                                <td><a href="{{route("course-index")}}" class="btn finance-btn shadow-sm h-100 ml-2">
                                                        <i class="fa fa-eye"> </i>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Workshop</td>
                                                <td>{{ number_format(@$workshop_amount, 2, '.', ',')}}</td>
                                                <td><a href="{{route("workshop-index")}}" class="btn finance-btn shadow-sm h-100 ml-2">
                                                        <i class="fa fa-eye"> </i>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Library</td>
                                                <td>{{number_format(@$library_amount, 2, '.', ',')}}</td>
                                                <td><a href="{{route("library-index")}}" class="btn finance-btn shadow-sm h-100 ml-2">
                                                        <i class="fa fa-eye"> </i>
                                                    </a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    {{-- </div> --}}
@endsection
