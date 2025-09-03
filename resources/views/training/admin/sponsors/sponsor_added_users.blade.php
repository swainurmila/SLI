
@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        {{-- <h4 class="mb-0">Details</h4> --}}

                        <div class="page-title-right">

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>User Details</h5>
                            <div class="table-responsive">
                                <table class="table table-centered table-bordered table-nowrap mb-0 datatable">
                                    <thead class="table-light ">
                                        <tr class="text-center">
                                            <th>Sl. No.</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Contact No.</th>
                                            <th>Qualification</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($training_details->trainingOrder as $key => $value)
                                       
                                            <tr>
                                                <td style="text-align: center;">
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $value->user->first_name }} {{ $value->user->last_name }}
                                                </td>
                                                <td>{{$value->user->email}}</td>
                                                <td>{{$value->user->contact_no}}</td>
                                                <td>
                                                    {{ isset($value->user->education) && isset($value->user->course_name) ? $value->user->education . '(' . $value->user->course_name . ')' : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><br>
                            <h5>Training Details</h5>
                            <div class="row g-0 align-items-center">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h5 class="card-title">Title: {{$training_details->training->name}}</h5>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <p>Training Duration</p>  
                                            </div>
                                            <div class="col-md-6">
                                                : {{$training_details->training->training_duration}}{{$training_details->training->training_duration_type}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <p>Training Time</p>  
                                            </div>
                                            <div class="col-md-6">
                                                : {{$training_details->batch->start_time}} - {{$training_details->batch->end_time}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <p>Description </p>  
                                            </div>
                                            <div class="col-md-9">
                                                : {{$training_details->training->description}}
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col-->
                                {{-- <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div><!-- end card body -->
                                </div><!-- end col --> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endsection

