@extends('course.layouts.admin.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b>Transaction List</b> </h4>
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
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>Student Name</th>
                                                <th>Course Name</th>
                                                <th>Transaction Amount</th>
                                                <th>Transaction Date</th>
                                                <th>Transaction Ref. No.</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                           @foreach ($transaction as $key=>$item)
                                               <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->User->first_name ?? '-'}}</td>
                                                <td>{{$item->Course->course_name ?? '-'}}</td>
                                                <td>{{$item->amount ?? '-'}}</td>
                                                <td>{{$item->txn_dt ?? '-'}}</td>
                                                <td>{{$item->bank_ref_no ?? '-'}}</td>
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
    
    <!-- Add this script in the head section of your HTML -->

    
    
    
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_1').DataTable();
        $('#datatable_2').DataTable();

        $('#datatable_3').DataTable();
    });
</script>
@endsection
