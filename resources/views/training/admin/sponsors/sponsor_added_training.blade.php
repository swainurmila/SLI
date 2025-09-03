@extends('training.admin.layouts.page-layouts.main')

@section('content')
    
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training List By Sponsors</h4>

                        <div class="page-title-right">

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-bordered table-nowrap mb-0 datatable">
                                    <thead class="table-light ">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Sponsor Name</th>
                                            <th>Training Name</th>
                                            <th>Batch</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($training_data as $key => $val)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $val->users->first_name }} {{ $val->users->last_name }}</td>
                                                <td>{{ $val->training_name }}</td>
                                                <td>{{ $val->batch->batch_name }}</td>
                                                <td>{{ $val->training_det->start_date }}</td>
                                                <td>{{ $val->training_det->end_date }}</td>
                                                <td>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light" href="{{route('training.admin.view-user-list', $val->batch_id)}}"
                                                        title="Edit">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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