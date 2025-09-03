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
                            <h4>Master | Sub-Scheme</h4>
                        </div>
                        <div class="page-title-right d-flex">
                            {{-- <div class="">
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
                            <form action="{{ route('sub-category-master-store') }}" method="POST" id="subcategory_save">
                                @csrf
                                <div class="repeater" enctype="multipart/form-data">
                                    <div data-repeater-item class="row mb-3" style="position: relative;">
                                        <div class="col-sm-12 col-lg-3">
                                            <div class="">
                                                <label class="form-label">Scheme<sup class="text-danger">
                                                        *</sup></label>
                                                <select name="cat_id" id="cat_id" class="form-select" required>
                                                    <option value="">--Select--</option>
                                                    @foreach ($category as $value)
                                                        <option value="{{ $value->id }}">{{ $value->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('cat_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-3">
                                            <div class="">
                                                <label class="form-label">Sub-Scheme <sup class="text-danger">
                                                        *</sup></label>
                                                <input type="text" name="subcategory_name" id="subcategory_name"
                                                    class="form-control" placeholder="Sub-Scheme Name"
                                                    pattern="^[A-Za-z][A-Za-z\s]*$"
                                                    oninput="this.value = this.value.replace(/^[\s\d]+/, '').replace(/[\d]+/g, '')"
                                                    maxlength="30"required>
                                                @error('subcategory_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-3">
                                            <div class="">
                                                <label class="form-label">Account Number<sup class="text-danger">
                                                        *</sup></label>
                                                <select name="acc_no" id="acc_no" class="form-select" required>
                                                    <option value="">--Select--</option>
                                                    @foreach ($bank as $value)
                                                        <option value="{{ $value->account_number }}">
                                                            {{ $value->account_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('acc_no')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <div class="">
                                                <label class="form-label">Status<sup class="text-danger">
                                                        *</sup></label>
                                                <select name="sub_cat_status" id="sub_cat_status" class="form-select"
                                                    required>
                                                    <option value="">--Select--</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                @error('sub_cat_status')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-1">
                                            <div class="ms-auto text-end mt-4 pe-3">
                                                <button class="btn finance-btn" type="submit">Submit</button>
                                            </div>
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
                                                <th>Scheme Name</th>
                                                <th>Sub-Scheme Name</th>
                                                <th>Account No.</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subcategory as $key => $val)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $val->Category->category_name }}</td>
                                                    <td>{{ $val->sub_category_name }}</td>
                                                    <td>{{ $val->account_number ?? '-' }}</td>
                                                    <td class="text-capitalize">{{ $val->status }}</td>
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

    @foreach ($subcategory as $key => $val)
        <div class="modal fade" id="editTranModal{{ @$val->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit
                            Sub Scheme
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            onClick="refreshPage()"aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('sub-category-master-update', $val->id) }}" method="POST"
                        id="sub_category_master_update_edit{{ @$val->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Scheme
                                            Name:<sup><span style="color: red;">*</span></sup></label>
                                        <select name="cat_id_edit" id="cat_id_edit" class="form-select" required>
                                            <option value="">--Select--
                                            </option>
                                            @foreach ($category as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $val->category_id ? 'selected' : '' }}>
                                                    {{ $value->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cat_id_edit'))
                                            <span class="text-danger">{{ $errors->first('cat_id_edit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Sub-Scheme
                                            Name:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="exampleInputUsername"
                                            class="form-control name-validation" name="subcategory_name_edit"
                                            placeholder="Sub-Scheme" value="{{ @$val->sub_category_name }}"
                                            maxlength="30">
                                        @if ($errors->has('subcategory_name_edit'))
                                            <span class="text-danger">{{ $errors->first('subcategory_name_edit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Account
                                            No.:<sup><span style="color: red;">*</span></sup></label>
                                        <select name="acc_no_edit" id="acc_no_edit" class="form-select" required>
                                            <option value="">--Select--
                                            </option>
                                            @foreach ($bank as $value)
                                                <option value="{{ $value->account_number }}"
                                                    {{ $value->account_number == $val->account_number ? 'selected' : '' }}>
                                                    {{ $value->account_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('acc_no_edit'))
                                            <span class="text-danger">{{ $errors->first('acc_no_edit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Status:<sup><span
                                                    style="color: red;">*</span></sup></label>
                                        <select class="form-select form-valid" name="sub_cat_status_edit"
                                            id="sub_cat_status_edit">
                                            <option value="">Select
                                            </option>
                                            <option value="active"{{ $val->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"{{ $val->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>

                                        </select>
                                        @if ($errors->has('sub_cat_status_edit'))
                                            <span class="text-danger">{{ $errors->first('sub_cat_status_edit') }}</span>
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


                $('#subcategory_save').validate({
                    rules: {
                        cat_id: {
                            required: true
                        },
                        subcategory_name: {
                            required: true,
                            noLeadingZero: true
                        },
                        acc_no: {
                            required: true
                        },
                        sub_cat_status: {
                            required: true
                        },
                    },
                    messages: {
                        cat_id: {
                            required: "Please select the scheme name"
                        },
                        subcategory_name: {
                            required: "Please select the sub scheme name"
                        },
                        acc_no: {
                            required: "Please select account number"
                        },
                        sub_cat_status: {
                            required: "Please select status",
                        }
                    }
                });


                $('form[id^="sub_category_master_update_edit"]').each(function() {
                    $(this).validate({
                        rules: {
                            cat_id_edit: {
                                required: true,
                            },
                            subcategory_name_edit: {
                                required: true,
                                noLeadingZero: true
                            },
                            acc_no_edit: {
                                required: true
                            },
                            sub_cat_status_edit: {
                                required: true
                            }
                        },
                        messages: {
                            cat_id_edit: {
                                required: "Please select the scheme name"
                            },
                            subcategory_name_edit: {
                                required: "Please enter the sub scheme name"
                            },
                            acc_no_edit: {
                                required: "Please select account number"
                            },
                            sub_cat_status_edit: {
                                required: "Please select status",
                            }
                        },
                    });
                });

            }

        });

        function refreshPage() {
            location.reload();
        }
    </script>
@endsection
