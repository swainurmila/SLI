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
                            <h4>Master | Bank Details</h4>
                        </div>
                        <div class="page-title-right d-flex">
                            {{--  <div class="">
                                <select class="form-select">
                                    <option>Select Budget Planning Year</option>
                                    <option>2023-2024</option>
                                    <option>2022-2023</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('bank-details-store') }}" method="POST" id="bank_save">
                                @csrf
                                <div class="repeater" enctype="multipart/form-data">
                                    <div>

                                        <div class="row mb-3" style="position: relative;">
                                            <div class="col-sm-12 col-lg-3">
                                                <div class="">
                                                    <label class="form-label">Bank Name<sup class="text-danger">
                                                            *</sup></label>
                                                    <input type="text" name="bank_name" id="bank_name"
                                                        class="form-control" pattern="[a-zA-Z\s]+"
                                                        title="The Bank name must contain only letters and spaces."
                                                        onkeypress="return validateKeyPress(event)" maxlength="30">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-3">
                                                <div class="">
                                                    <label class="form-label">Account Number<sup class="text-danger">
                                                            *</sup></label>
                                                    <input type="text" name="account_number" id="account_number"
                                                        class="form-control" maxlength="18">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-2">
                                                <div class="">
                                                    <label class="form-label">IFSC Code<sup class="text-danger">
                                                            *</sup></label>
                                                    <input type="text" name="ifsc_code" id="ifsc_code"
                                                        class="form-control" pattern="^[A-Za-z0-9]{11}$" maxlength="11"
                                                        oninput="validateIFSC(this)" required>
                                                    <div class="invalid-feedback" id="ifsc-error">The IFSC code may not be
                                                        greater than 11 characters and must contain only alphanumeric
                                                        characters with no spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-3">
                                                <div class="">
                                                    <label class="form-label">Branch Name<sup class="text-danger">
                                                            *</sup></label>
                                                    <input type="text" name="branch_name" id="branch_name"
                                                        class="form-control" maxlength="40">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-1">
                                                <div class="ms-auto text-end mt-4 pe-3">
                                                    <button class="btn finance-btn" type="submit">Submit</button>
                                                </div>
                                            </div>
                                            {{-- <div class="col-sm-12 col-lg-1">
                                                <div class="d-flex mt-4 pt-2 text-end">
                                                    <span class="">
                                                        <input data-repeater-create type="button" onclick="addRowIfNotEmpty(this)"
                                                            class="btn btn-sm custom-btn" value="+" />
                                                    </span>
                                                    <span class="ms-2">
                                                        <input data-repeater-delete type="button"
                                                            class="btn btn-sm btn-danger" value="x" />
                                                    </span>
                                                </div>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>

                            </form>
                            <div class="row">
                                <div class="mt-4 table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Bank Name</th>
                                                <th>Account Number</th>
                                                <th>IFSC Code</th>
                                                <th>Branch Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bank as $key => $val)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $val->bank_name }}</td>
                                                    <td>{{ $val->account_number }}</td>
                                                    <td>{{ $val->ifsc_code }}</td>
                                                    <td>{{ $val->branch_name }}</td>
                                                    <td><a href=""
                                                            class="btn btn-sm btn-outline-primary btn-icon btn-inline-block mx-2 edit"
                                                            title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#editTranModal{{ @$val->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a></td>

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


    @foreach ($bank as $key => $val)
        <div class="modal fade" id="editTranModal{{ @$val->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit
                            Bank Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onClick="refreshPage()">
                        </button>
                    </div>

                    <form action="{{ route('bank-details-update', $val->id) }}" method="POST"
                        id="bank_edit{{ @$val->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Bank
                                            Name:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="edit_bank_name_{{ @$val->id }}"
                                            class="form-control name-validation" name="bank_name" placeholder="Bank Name"
                                            value="{{ @$val->bank_name }}" pattern="[a-zA-Z\s]+"
                                            onkeypress="return validateKeyPress(event)"
                                            maxlength="30" required>
                                        @if ($errors->has('bank_name'))
                                            <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Account
                                            Number:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="edit_account_number_{{ @$val->id }}"
                                            class="form-control name-validation" name="account_number"
                                            placeholder="Account Number" value="{{ @$val->account_number }}"
                                            maxlength="18" onkeypress="return /[0-9.]/.test(event.key)" required>
                                        @if ($errors->has('account_number'))
                                            <span class="text-danger">{{ $errors->first('account_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">IFSC
                                            Code:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="edit_ifsc_code_{{ @$val->id }}"
                                            class="form-control name-validation" name="ifsc_code" placeholder="IFSC Code"
                                            value="{{ @$val->ifsc_code }}" maxlength="11" oninput="validateIFSC(this)"
                                            required>
                                        @if ($errors->has('ifsc_code'))
                                            <span class="text-danger">{{ $errors->first('ifsc_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Branch
                                            Name:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="edit_branch_name_{{ @$val->id }}"
                                            class="form-control" name="branch_name" placeholder="Branch Name"
                                            value="{{ @$val->branch_name }}" maxlength="40" required>
                                        @if ($errors->has('branch_name'))
                                            <span class="text-danger">{{ $errors->first('branch_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                onClick="refreshPage()">Close</button>
                            <button type="submit" class="btn custom-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End Page-content -->
    {{-- </div> --}}
@endsection
@section('script')
    <script>
        var documentReadyExecuted = false;
        $(document).ready(function() {
            if (!documentReadyExecuted) {
                documentReadyExecuted = true;

                $.validator.addMethod("noLeadingZero", function(value, element) {
                    return this.optional(element) || /^[^0\s]+.*$/.test(value);
                }, "Name cannot start with a zero or a space.");

                $('#bank_save').validate({
                    rules: {
                        bank_name: {
                            required: true,
                        },
                        account_number: {
                            required: true,
                            digits: true
                        },
                        ifsc_code: {
                            required: true
                        },
                        branch_name: {
                            required: true,
                            noLeadingZero: true
                        }
                    },
                    messages: {
                        bank_name: {
                            required: "Please enter bank name"
                        },
                        account_number: {
                            required: "Please enter account number",
                            digits: "Please enter a valid account number"
                        },
                        ifsc_code: {
                            required: "Please enter IFSC code"
                        },
                        branch_name: {
                            required: "Please enter branch name"
                        }
                    }
                });



                $('form[id^="bank_edit"]').each(function() {

                    $(this).validate({
                        rules: {
                            bank_name: {
                                required: true,
                                noLeadingZero: true
                            },
                            account_number: {
                                required: true,
                                digits: true
                            },
                            ifsc_code: {
                                required: true
                            },
                            branch_name: {
                                required: true,
                                noLeadingZero: true
                            }
                        },
                        messages: {
                            bank_name: {
                                required: "Please enter bank name"
                            },
                            account_number: {
                                required: "Please enter account number",
                                digits: "Please enter a valid account number"
                            },
                            ifsc_code: {
                                required: "Please enter IFSC code"
                            },
                            branch_name: {
                                required: "Please enter branch name"
                            }
                        }
                    });
                });


            }
            @if ($errors->any())
                $('#editTranModal{{ @$val->id }}').modal('show');
            @endif

        });

        function update(id) {
            var bankName = document.getElementById('edit_bank_name_' + id).value.trim();
            var accountNumber = document.getElementById('edit_account_number_' + id).value.trim();
            var ifscCode = document.getElementById('edit_ifsc_code_' + id).value.trim();
            var branchName = document.getElementById('edit_branch_name_' + id).value.trim();


            if (bankName === '' || bankName == null) {
                alert("Please enter bank name");
                return false;
            }
            if (accountNumber === '' || accountNumber == null) {
                alert("Please enter account number");
                return false;
            }
            if (ifscCode === '' || ifscCode == null) {
                alert("Please enter IFSC code");
                return false;
            }
            if (branchName === '' || branchName == null) {
                alert("Please enter branch name");
                return false;
            }


            return true;
        }
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

        function validateKeyPressfordig(event) {
            var char = String.fromCharCode(event.which);
            if (!/[a-zA-Z0-9\s]/.test(char)) {
                event.preventDefault();
            }
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }
        }
    </script>
    <script>
        function validateIFSC(input) {
            input.value = input.value.replace(/[^A-Za-z0-9]/g, '');
        }
    </script>
    <script>
        function refreshPage() {
            location.reload();
        }

        function validateForm(id) {
            var bankName = document.getElementById('bank_name' + id).value.trim();
            var accountNumber = document.getElementById('account_number' + id).value.trim();
            var ifscCode = document.getElementById('ifsc_code' + id).value.trim();
            var branchName = document.getElementById('branch_name' + id).value.trim();

            if (bankName === '' || accountNumber === '' || ifscCode === '' || branchName === '') {
                alert("Please fill out all required fields.");
                return false;
            }
            return true;
        }
    </script>
@endsection
