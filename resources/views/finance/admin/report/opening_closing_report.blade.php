@extends('finance.layouts.main')
@section('styles')
    <style>
        .report-csv-btn {
            margin-right: 10px !important;
        }

        .input-container {
            display: flex;
            flex-direction: column;
        }

        .text-danger {
            margin-top: 5px;
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
                            <h4>Opening & Closing Balance Report</h4>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.open-report-filter') }}" method="POST" id="budget_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row mb-3" style="position: relative;">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label" for="from_date">From Date</label>
                                            <div class="input-container">
                                                <input type="date" class="form-control" id="from_date" name="from_date">
                                                @error('from_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="form-label" for="to_date">To Date</label>
                                            <div class="input-container">
                                                <input type="date" class="form-control" id="to_date" name="to_date">
                                                @error('to_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2 text-end mt-4">
                                        <button class="btn finance-btn">Filter</button>
                                        <a href="{{ route('report.opening-closing-report') }}"
                                            class="btn finance-btn">Refresh</a>
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
                                                <th>Opening Balance</th>
                                                <th>Closing Balance</th>
                                                <th>Expenses</th>
                                                <th>Expense Date</th>
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
                                                    <td>{{ number_format(@$item->amount + @$item->previous_amount, 2, '.', ',') }}
                                                    </td>
                                                    <td>{{ number_format(@$item->previous_amount, 2, '.', ',') }}</td>
                                                    <td>{{ number_format(@$item->amount, 2, '.', ',') }}</td>
                                                    <td>{{ @$item->expense_date ? @$item->expense_date : '---' }}</td>
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
                            title: function() {
                                return "Opening/Closing Balance Report";
                            },
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            text: 'PDF',
                            titleAttr: 'PDF'


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
            $('#budget_save').validate({
                rules: {
                    from_date: {
                        required: true,
                        date: true
                    },
                    to_date: {
                        required: true,
                        date: true
                    }
                },
                messages: {
                    from_date: {
                        required: "Please select a from date.",
                        date: "Please enter a valid date."
                    },
                    to_date: {
                        required: "Please select a to date.",
                        date: "Please enter a valid date."
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
    </script>
@endsection
