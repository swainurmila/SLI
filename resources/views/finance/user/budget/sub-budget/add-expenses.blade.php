@extends('finance.layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4>Payment</h4>
                        </div>

                        <div class="page-title-right d-flex">
                            <div class="" style="display: flex;justify-content: space-between;gap: 10px;align-items: center;">
                                <span class="badge bg-danger p-2"><span class="font-size-14">Available Amount : ₹
                                        {{ number_format(@$sanctioned_amount->amount - @$balance_available, 2, '.', ',') }}</span></span>

                                <form class="" action="{{ route('subcategory-budget-expenses',['category_id'=>@$category_id,'sub_id'=>@$sub_id]) }}" id="expensesPlanningYearSubForm" method="GET">
                                    <select class="form-select" name="financial_year" id="expensesPlanningYearSubSelect">
                                        <option value="">Select Budget Planning Year</option>
                                        @foreach ($years as $item)
                                            <option value="{{ $item }}"
                                                {{ $item == $financial_year ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                                <span><a href="" class="btn btn-dark btn-md">Back</a></span>
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
                            <form action="{{ route('yearly-budget-expenses.store') }}" id="save_expenses" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <input type="hidden" value="{{ @$category_id }}" name="category">
                                        <input type="hidden" value="{{ @$sub_id }}" name="sub_category"
                                            id="sub_category">
                                        <div class="">
                                            <label class="form-label">Financial Year<sup class="text-danger">
                                                    *</sup></label>
                                            <select class="form-select" name="budget_type">
                                                <option value="">Select</option>
                                                @foreach ($years as $item)
                                                    {{-- <option value="{{ $item }}">{{ $item }}</option> --}}
                                                    <option value="{{ $item }}"
                                                        {{ $item == $financial_year ? 'selected' : '' }}>{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label class="form-label">Scheme<sup class="text-danger"> *</sup></label>
                                            <input type="text" class="form-control"
                                                value="{{ $category_name->category_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label class="form-label">Sub-Scheme<sup class="text-danger"> *</sup></label>
                                            <input type="text" class="form-control" id="sub_category"
                                                value="{{ $sub_category_name->sub_category_name }}" readonly>
                                            @error('sub_category')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label class="form-label">Pay From (Account)<sup class="text-danger">
                                                    *</sup></label>
                                            <input type="text" class="form-control" name="pay_form" id="pay_from"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label class="form-label">Amount<sup class="text-danger"> *</sup></label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="text" name="amount_paid" class="form-control amount-input"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    title="Please enter only integer numbers" maxlength="15">
                                                <span class="input-group-text">.00</span>
                                                <div id="amount_paid_error" class="error-message"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">Pay to<sup class="text-danger">
                                                    *</sup></label>
                                            <input type="text" name="pay_to" class="form-control" id=""
                                                placeholder="" pattern="[a-zA-Z\s]+"
                                                title="The pay to must contain only letters and spaces."
                                                onkeypress="return validateKeyPress(event)" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">Bank Name<sup class="text-danger">
                                                    *</sup></label>
                                            <input type="text" name="bank_name" class="form-control" id=""
                                                placeholder="" pattern="[a-zA-Z\s]+"
                                                title="The bank name must contain only letters and spaces."
                                                onkeypress="return validateKeyPress(event)" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">Account Number<sup
                                                    class="text-danger">
                                                    *</sup></label>
                                            <input type="text" name="account_number" class="form-control"
                                                id="" placeholder="" maxlength="20"
                                                onkeypress="return /[0-9]/.test(event.key)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">IFSC Code<sup class="text-danger">
                                                    *</sup></label>
                                            <input type="text" class="form-control" name="ifsc_code" id=""
                                                placeholder=""
                                                title="The IFSC Code must contain only letters, numbers, and spaces."
                                                pattern="[a-zA-Z0-9\s]+" onkeypress="return validateKeyPressfordig(event)"
                                                maxlength="12">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">Expense Date<sup
                                                    class="text-danger"> *</sup></label>
                                            <input type="date" class="form-control" name="expense_date"
                                                id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">Supporting Documents</label>
                                            <input class="form-control" name="supporting_documents" type="file"
                                                id="">

                                            @error('supporting_documents')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="">
                                            <label for="" class="form-label">Purpose<sup class="text-danger">
                                                    *</sup></label>
                                            <input class="form-control" name="purpose" type="text" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="ms-auto text-end mt-3 pe-3">
                                        {{-- <button type="button" class="btn custom-btn" data-bs-toggle="modal"
                                            data-bs-target="#viewModal">Pay</button> --}}

                                        <button type="submit" class="btn finance-btn">Add Expenses</button>
                                    </div>
                                </div>

                            </form>
                            <div class="row">
                                <div class="mt-4 table-responsive">
                                    <table id="expense-report" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Financial Year
                                                </th>
                                                <th>Scheme Name
                                                </th>
                                                <th>Sub-Scheme Name
                                                </th>
                                                <th>Pay From</th>
                                                <th>Pay to</th>
                                                <th>Bank Name</th>
                                                <th>Account Number</th>
                                                <th>IFSC Code</th>
                                                <th>Amount Paid
                                                </th>
                                                <th>Document</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (!$budgetExpenses->isEmpty())
                                                @foreach ($budgetExpenses as $expense)
                                                    <tr>
                                                        <td>{{ @$expense->budget_type }}</td>
                                                        <td>{{ @$expense->Category->category_name }}
                                                        </td>
                                                        <td>{{ @$expense->SubCategory->sub_category_name }}
                                                        </td>
                                                        <td>{{ @$expense->pay_form }}</td>
                                                        <td>{{ @$expense->pay_to }}</td>
                                                        <td>{{ @$expense->bank_name }}</td>
                                                        <td>{{ @$expense->account_number }}</td>
                                                        <td>{{ @$expense->ifsc_code }}</td>
                                                        <td><span
                                                                class="fw-bold me-2">₹</span>{{ number_format(@$expense->amount, 2, '.', ',') }}
                                                        </td>
                                                        <th>
                                                            @if (!empty($expense->document))
                                                                <a href="{{ url('upload/finance/expenses/' . $expense->document) }}"
                                                                    target="_blank" class="btn btn-warning btn-sm"
                                                                    title="View Document">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            @else
                                                                <span>N/A</span>
                                                            @endif
                                                        </th>
                                                        <td>
                                                            <button class="btn btn-secondary no-print"
                                                                onclick="printRow({{ json_encode($expense) }}, '{{ @$expense->Category->category_name }}', '{{ @$expense->SubCategory->sub_category_name }}')">Print</button>

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">View Expense Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="reloadButton"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Modal body content will be populated by JavaScript -->
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary no-print"
                                                onclick="printRow({{ @$expense }})">Print</button>
                                            <button type="button" class="btn finance-btn" id="closeModalButton"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
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
                documentReadyExecuted = true;


                $('#expensesPlanningYearSubSelect').change(function() {
                    var selectedYear = $(this).val();
                    $('#expensesPlanningYearSubForm').submit();
                });



                $('#expense-report').DataTable({
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
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                            }
                        }
                    ]
                });

                $('#reloadButton').on('click', function() {
                    location.reload();
                });

                $('#closeModalButton').on('click', function() {
                    location.reload(); // Refresh the page
                });
                jQuery.validator.addMethod("filesize", function(value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param);
                }, "File size must be less than 2 MB");

                $.validator.addMethod("contactNumber", function(value, element) {
                        return this.optional(element) ||
                            /^[6-8]\d{9}$/
                            .test(value);
                    },
                    "Please enter a valid contact number starting with 6, 7, or 8 and having 10 digits."
                );

                $('#save_expenses').validate({
                    rules: {
                        budget_type: {
                            required: true
                        },
                        category: {
                            required: true
                        },
                        pay_form: {
                            required: true,
                        },
                        amount_paid: {
                            required: true,
                            number: true
                        },
                        pay_to: {
                            required: true
                        },
                        bank_name: {
                            required: true
                        },
                        account_number: {
                            required: true,
                            number: true,
                            maxlength: 20,
                        },
                        ifsc_code: {
                            required: true
                        },
                        supporting_documents: {
                            filesize: 2 * 1024 * 1024
                        },
                        expense_date: {
                            required: true
                        },
                        purpose: {
                            required: true
                        },
                        sub_category: {
                            required: true
                        },
                    },
                    errorPlacement: function(error, element) {
                        if (element.attr("name") == "amount_paid") {
                            error.insertAfter(element.closest(".input-group"));
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
                $('#main_category').on('change', function() {
                    var category_id = this.value;
                    $.ajax({
                        url: "{{ route('budget.get-sub-category') }}",
                        type: "get",
                        data: {
                            category_id: category_id,
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#sub_category').empty();
                            $("#sub_category").append('<option value="">' + "Select" +
                                '</option>');
                            $.each(result.sub_category, function(key, value) {
                                $("#sub_category").append('<option value="' +
                                    value
                                    .id +
                                    '">' + value.sub_category_name + '</option>');
                            });
                        }
                    });
                });

                var subcategory_id = $('#sub_category').val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ route('budget.get-bank-account') }}",
                        type: "GET",
                        data: {
                            subcategory_id: subcategory_id,
                        },
                        dataType: 'json',
                        success: function(result) {
                            console.log(result.account_number);
                            $('#pay_from').val(result
                                .account_number); // Set the account number in the input field
                        },
                        error: function(xhr, status, error) {
                            console.error("An error occurred: " + error);
                        }
                    });
                } else {
                    console.warn("Sub-category ID is empty.");
                }


                $('#save_expenses').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var formData = new FormData(this);

                    $.ajax({
                        url: '{{ route('yearly-budget-expenses.store') }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            console.log('7878787878787')
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Expenses added successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        displayModal(response.data, response
                                            .category_name, response
                                            .sub_category_name, response
                                            .sanction_amount);
                                        // Show the modal
                                        var viewModal = new bootstrap.Modal(document
                                            .getElementById('viewModal'));
                                        viewModal.show();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                // Display validation errors
                                // let errorMessages = Object.values(xhr.responseJSON.errors)
                                //     .flat().join('\n');
                                // Swal.fire({
                                //     title: 'Validation Errors!',
                                //     // text: errorMessages,
                                //     icon: 'error',
                                //     confirmButtonText: 'OK'
                                // });
                            } else {
                                Swal.fire({
                                    title: 'Budget is not available for the specified category and sub-category.',
                                    // text: errorMessages,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });




                function displayModal(data, category_name, sub_category_name, sanction_amount) {
                    var modalBody = $('#viewModal .modal-body');
                    modalBody.html(`
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Expense Date :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">${data.expense_date}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Budget Type :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">${data.budget_type}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Category Name :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">${category_name}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Sub-Category Name :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">${sub_category_name}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Paid Amount :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">₹ ${data.amount}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Outstanding Amount :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">₹ ${data.previous_amount}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Paid to :</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">${data.pay_to}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label class="form-label">Remark:</label>
                </div>
                <div class="col-8">
                    <p class="mb-2">${data.purpose}</p>
                </div>
            </div>
        </div>
    `);
                    var dataStr = JSON.stringify(data).replace(/"/g, '&quot;');
                    // Update modal footer with correct data
                    $('#viewModal .modal-footer').html(`
        <button class="btn btn-secondary no-print" onclick="printRow('${dataStr}', '${category_name}', '${sub_category_name}')">Print</button>
        <button type="button" class="btn finance-btn" id="closeModalButton" data-bs-dismiss="modal">Close</button>
    `);

                    // Show the modal
                    $('#viewModal').modal('show');
                }

            }
        });

        function printRow(expense, category_name, sub_category_name) {
            if (typeof expense === 'string') {
                expense = JSON.parse(expense);
            }else{
                expense = expense;
            }

            if (expense) {

                const printContents = `
        <div class="container">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Expense Details For Date ( ${expense.expense_date || 'N/A'} )</h1>
            <div class="row">
                <div class="col-4"><label class="form-label">Financial Year:</label></div>
                <div class="col-4"><p>${expense.budget_type || 'N/A'}</p></div>
            </div>
            <div class="row">
                <div class="col-4"><label class="form-label">Category Name:</label></div>
                <div class="col-4"><p>${category_name || 'N/A'}</p></div>
            </div>
            <div class="row">
                <div class="col-4"><label class="form-label">Sub-Category Name:</label></div>
                <div class="col-4"><p>${sub_category_name || 'N/A'}</p></div>
            </div>
            <div class="row">
                <div class="col-4"><label class="form-label">Paid Amount:</label></div>
                <div class="col-4"><p>₹ ${expense.amount}</p></div>
            </div>
            <div class="row">
                <div class="col-4"><label class="form-label">Outstanding Amount:</label></div>
                <div class="col-4"><p>₹ ${expense.previous_amount}</p></div>
            </div>
            <div class="row">
                <div class="col-4"><label class="form-label">Paid to:</label></div>
                <div class="col-4"><p>${expense.account_number || 'N/A'}</p></div>
            </div>
            <div class="row">
                <div class="col-4"><label class="form-label">Remark:</label></div>
                <div class="col-4"><p>${expense.purpose || 'N/A'}</p></div>
            </div>

        </div>
        </div>
        </div>
        `;

                const newWindow = window.open('', '', 'height=500, width=700');
                newWindow.document.write('<html><head><title>Print Expense Detail</title></head><body>');
                newWindow.document.write(printContents);
                newWindow.document.write('</body></html>');
                newWindow.document.close();
                newWindow.print();
            }
        }


        window.addEventListener('afterprint', function() {
            location.reload();
        });


        $('#viewModal').on('hidden.bs.modal', function() {
            location.reload(); // Reload the page
        });
    </script>
    <script>
        function validateKeyPressfordig(event) {
            var char = String.fromCharCode(event.which);
            if (!/[a-zA-Z0-9\s]/.test(char)) {
                event.preventDefault();
            }
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }
        }

        // Prevents dots in the amount_paid field
        $('.amount-input').on('input', function() {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    </script>
    <script>
        function validateKeyPress(event) {
            // Prevent spaces at the beginning of the input
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }

            // Allow only letters and spaces
            const regex = /^[a-zA-Z\s]*$/;
            return regex.test(event.key);
        }
    </script>
@endsection
