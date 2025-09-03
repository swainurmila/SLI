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
                            <h4>Budget Creation</h4>
                        </div>
                        <div class="page-title-right d-flex">
                            <div class="me-3">
                                <a href="{{ route('subcategory-budget-expenses', ['category_id' => $data->Category->id, 'sub_id' => $data->id]) }}"
                                    class="btn btn-warning">Click for Expenses</a>
                            </div>
                            <div class="">
                                <form class="" action="{{ route('subcategory-budget-creation',@$id) }}"
                                    id="budgetPlanningYearSubForm" method="GET">
                                    <select class="form-select" name="financial_year" id="budgetPlanningYearSubSelect">
                                        <option>Select Budget Planning Year</option>
                                        @foreach ($years as $item)
                                            <option value="{{ $item }}"
                                                {{ $item == $financial_year ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
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
                            <form action="{{ route('yearly-budget-store') }}" method="POST" id="budget_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row mb-3" style="position: relative;">
                                    <div class="col-3">
                                        <div class="">
                                            {{-- {{dd($data->sub_category_name)}} --}}
                                            <label class="form-label">Scheme<sup class="text-danger"> *</sup></label>
                                            <select class="form-select" name="category_id" id="category_dropdown">
                                                <option value="{{ $data->Category->id }}">
                                                    {{ $data->Category->category_name }}
                                                </option>

                                            </select>
                                            @error('category_dropdown')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <label class="form-label">Sub-Scheme<sup class="text-danger"> *</sup></label>
                                            <select class="form-select" name="subcategory_id" id="subcategory_dropdown">
                                                <option value="{{ $data->id }}">{{ $data->sub_category_name }}
                                                </option>
                                            </select>
                                            @if ($errors->has('subcategory_dropdown'))
                                                <div class="text-danger">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <label class="form-label">Financial Year<sup class="text-danger">
                                                    *</sup></label>
                                            <select class="form-select" name="financial_year" id="financial_year">
                                                <option value="">Select</option>
                                                @foreach ($years as $item)
                                                    {{-- <option value="{{ $item }}">{{ $item }}</option> --}}
                                                    <option value="{{ $item }}"
                                                        {{ $item == $financial_year ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('financial_year')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <label class="form-label">Amount<sup class="text-danger"> *</sup></label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="text" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    onkeypress="return /[0-9.]/.test(event.key)" name="amount"
                                                    maxlength="12" id="amount">
                                                @error('amount')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 text-end mt-4">
                                        <button class="btn finance-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="mt-4 table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap datatable"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>Scheme Name</th>
                                                <th>Sub Scheme Name</th>
                                                <th>Financial Year</th>
                                                <th>Sanctioned Amount</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budget as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->Category->category_name ?? '-' }}</td>
                                                    <td>{{ $item->SubCategory->sub_category_name ?? '-' }}</td>
                                                    <td>{{ $item->financial_year }}</td>
                                                    <td><span class="badge bg-danger"><span class="font-size-14">₹
                                                                {{ number_format(@$item->amount, 2, '.', ',') }}</span></span>
                                                    </td>
                                                    <td><span class="badge bg-warning"><span class="font-size-14">₹
                                                                {{ number_format(@$item->amount - @$item->SubCategory->expenses_sum_amount, 2, '.', ',') }}</span></span>
                                                    </td>
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
                documentReadyExecuted = true;

                $('#budgetPlanningYearSubSelect').change(function() {
                    var selectedYear = $(this).val();
                    $('#budgetPlanningYearSubForm').submit();
                });

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

                $('#budget_save').validate({
                    rules: {
                        category_id: {
                            required: true
                        },
                        subcategory_id: {
                            required: true
                        },
                        financial_year: {
                            required: true
                        },
                        amount: {
                            required: true,
                            number: true
                        }
                    },
                    messages: {
                        category_id: {
                            required: "Please select a category"
                        },
                        subcategory_id: {
                            required: "Please select a sub-caegory"
                        },
                        financial_year: {
                            required: "Please select a financial year"
                        },
                        amount: {
                            required: "Please enter an amount",
                            number: "Please enter a valid number"
                        }
                    }
                });
                $('#budget_save').submit(function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var subcategoryId = $('#subcategory_dropdown').val();
                    var financialYear = $('select[name="financial_year"]').val();
                    var amount = $('input[name="amount"]').val();

                    // Check if all necessary fields are filled
                    if (subcategoryId && financialYear && amount) {
                        // Make an AJAX call to check if the record exists
                        $.ajax({
                            url: "{{ route('budget.check-budget-exist') }}",
                            type: "get",
                            data: {
                                subcategory_id: subcategoryId,
                                financial_year: financialYear
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.count > 0) {
                                    // Record exists, show alert
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Duplicate Budget',
                                        text: 'Budget has already been assigned for the selected subcategory and financial year.'
                                    }).then(() => {
                                        $('#amount').val('');
                                    });

                                    $('#amount').val('');
                                } else {
                                    $('#budget_save').off("submit").submit();
                                }
                            }
                        });
                    } else {
                        alert('Please fill all the required fields.');
                    }
                });
            }
        });
    </script>
@endsection
