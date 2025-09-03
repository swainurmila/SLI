@extends('finance.layouts.main')
@section('styles')
<style>
    .report-csv-btn{
        margin-right: 10px !important;
    }
</style>
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4>Budget Report</h4>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.budget-report-filter') }}" method="POST" id="budget_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row mb-3" style="position: relative;">
                                    <div class="col-3">
                                        <div class="">
                                            <label class="form-label">Scheme</label>
                                            <select class="form-select" name="category_id" id="category_dropdown">
                                                <option value="">Select</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_dropdown')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <label class="form-label">Sub-Scheme</label>
                                            <select class="form-select" name="subcategory_id" id="subcategory_dropdown">
                                                <option value="">Select</option>
                                            </select>
                                            @if ($errors->has('subcategory_dropdown'))
                                                <div class="text-danger">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <label class="form-label">Financial Year</label>
                                            <select class="form-select" name="financial_year" id="financial_year">
                                                <option value="">Select</option>
                                                @foreach ($years as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('financial_year')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <label class="form-label">Account(Pay From)</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    onkeypress="return /[0-9.]/.test(event.key)" name="account_no"
                                                    id="amount" maxlength="20">
                                                {{-- <span class="input-group-text">.00</span> --}}
                                                @error('amount')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-end mt-4">
                                        <button class="btn finance-btn">Filter</button>
                                        <a href="{{ route('report.budget-report') }}" class="btn finance-btn">Refresh</a>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="mt-4 table-responsive">
                                    <table id="finance-reports" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>Financial Year</th>
                                                <th>Scheme Name</th>
                                                <th>Sub Scheme Name</th>
                                                <th>Account(Pay from)</th>
                                                <th>Account(Pay to)</th>
                                                <th>Expense</th>
                                                <th>Expense Date</th>
                                                {{-- <th>Opening Amount</th>
                                                <th>Closing Amount</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach ($expenses as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ @$item->budget_type ?? '-' }}</td>
                                                    <td>{{ @$item->Category->category_name ?? '-' }}</td>
                                                    <td>{{ @$item->SubCategory->sub_category_name }}</td>
                                                    <td>{{ @$item->pay_form }}</td>
                                                    <td>{{ @$item->account_number }}</td>
                                                    <td>{{ number_format( @$item->amount, 2, '.', ',')   }}</td>
                                                    <td>{{@$item->expense_date ? @$item->expense_date : '---'}}</td>
                                                    {{-- <td>{{ number_format( @$item->amount + @$item->previous_amount, 2, '.', ',')}}</td>
                                                    <td>{{ number_format( @$item->previous_amount, 2, '.', ',') }}</td> --}}
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
@endsection
@section('script')
    <script>
        var documentReadyExecuted = false;
        $(document).ready(function() {
            if (!documentReadyExecuted) {
                // $('#finance-reports').DataTable({
                //     dom:'Bfrtip',
                //     buttons : [
                //         'csv', 'pdf'
                //     ]
                // });
                $('#finance-reports').DataTable({
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
                                columns: [0, 1, 2,3,4, 5,6,7]
                            }
                        }
                    ]
                });
                documentReadyExecuted = true;
                $('#category_dropdown').on('change', function() {
                    //alert(123);
                    var category_id = this.value;
                    //alert(state_id);
                    $.ajax({
                        url: "{{ route('budget.get-sub-category') }}",
                        type: "get",
                        data: {
                            category_id: category_id,
                        },
                        dataType: 'json',
                        success: function(result) {
                            console.log(result)
                            $('#subcategory_dropdown').empty();
                            $("#subcategory_dropdown").append('<option value="">' + "Select" +
                                '</option>');
                            $.each(result.sub_category, function(key, value) {
                                $("#subcategory_dropdown").append('<option value="' +
                                    value
                                    .id +
                                    '">' + value.sub_category_name + '</option>');
                            });
                        }
                    });
                });


            }

        });
    </script>
@endsection
