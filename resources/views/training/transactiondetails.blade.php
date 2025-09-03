@extends('training.admin.layouts.page-layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b>TRANSACTION LIST</b> </h4>
                    </div>
                </div>
            </div>

            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b></b> </h4>
                    </div>
                </div>
            </div>
            <!-- start page title -->

            <!-- end page title -->
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap datatable"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>Student Name</th>
                                                <th>Training Name</th>
                                                <th>Transaction Amount</th>
                                                <th>Transaction Date</th>
                                                <th>Transaction Reference No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaction as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->User->first_name }}
                                                                {{ $value->User->last_name }}</td>
                                                            <td>{{ $value->Training->name }}</td>
                                                            <td>{{ $value->amount ?? '-' }}</td>
                                                          <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                                          <td>{{$value->bank_ref_no ?? '-'}}</td>

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
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

@endsection

@section('script')

@endsection


