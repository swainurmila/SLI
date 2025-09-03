@extends('finance.layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                {{-- <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4>Fund | Training Transactions </h4>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4>Fund | Training Transactions </h4>
                        </div>
                        <div class="page-title-right">
                            <div class="">
                                <span><a href="{{route("fund-collected-sources")}}" class="btn btn-dark btn-sm">Back</a></span>
                            </div>
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
                                    <table id="training-report" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>S.N.</th>
                                                <th>Training Title</th>
                                                <th>Paid By</th>
                                                <th>Amount</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($training_data as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->Training->name }}</td>
                                                    <td>{{ $item->User->first_name }} {{ $item->User->last_name }}</td>
                                                    <td>{{ $item->amount }}</td>
                                                    <td>Profit</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                </tr>
                                            @endforeach

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
@section('script')
    <script>
        var documentReadyExecuted = false;
        $(document).ready(function() {
            if (!documentReadyExecuted) {
                $('#training-report').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'csvHtml5',
                            className: 'report-csv-btn',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3,4,5]
                            }
                        }
                    ]
                });
                documentReadyExecuted = true;
            }

        });
    </script>
@endsection
