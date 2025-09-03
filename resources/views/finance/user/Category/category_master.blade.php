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
                            <h4>Master | Scheme </h4>
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
                            <form action="{{ route('category-master-store') }}" method="POST" id="category_save">
                                @csrf
                                <div class="repeater" enctype="multipart/form-data">
                                    <div data-repeater-item class="row mb-3" style="position: relative;">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="">
                                                <label class="form-label">Scheme Name<sup class="text-danger">
                                                        *</sup></label>
                                                <input type="text" name="category_name" id="category_name"
                                                    class="form-control" pattern="^[A-Za-z\s]*$"
                                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                                                    maxlength="30">
                                                @error('category_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-5">
                                            <div class="">
                                                <label class="form-label">Status <sup class="text-danger">
                                                        *</sup></label>
                                                <select name="cat_status" id="cat_status" class="form-control" required>
                                                    <option value="">--Select--</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                @error('cat_status')
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
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $key => $val)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $val->category_name }}</td>
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
    <!-- End Page-content -->
    {{-- </div> --}}


    @foreach ($category as $key => $val)
        <div class="modal fade" id="editTranModal{{ @$val->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit
                            Scheme
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="refreshPage()"
                            aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('category-master-update', $val->id) }}" method="POST"
                        id="scheme_master_edit{{ @$val->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Scheme
                                            Name:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="edit_scheme_name_{{ @$val->id }}"
                                            class="form-control name-validation" name="category_name_edit"
                                            placeholder="Scheme Name" pattern="^[A-Za-z\s]*$"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" maxlength="30"
                                            value="{{ @$val->category_name }}">
                                        <span class="text-danger" id="scheme_name_error_{{ @$val->id }}"></span>
                                        @if ($errors->has('category_name_edit'))
                                            <span class="text-danger">{{ $errors->first('category_name_edit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Status:<sup><span
                                                    style="color: red;">*</span></sup></label>
                                        <select class="form-select" name="cat_status_edit"
                                            id="cat_status_edit_{{ @$val->id }}">
                                            <option value="">Select
                                            </option>
                                            <option value="active"{{ $val->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"{{ $val->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>

                                        </select>
                                        <span class="text-danger" id="status_error_{{ @$val->id }}"></span>
                                        @if ($errors->has('cat_status_edit'))
                                            <span class="text-danger">{{ $errors->first('cat_status_edit') }}</span>
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
@endsection
@section('script')
    <script>
        function refreshPage() {
            location.reload();
        }
        var documentReadyExecuted = false;
        $(document).ready(function() {



            if (!documentReadyExecuted) {
                documentReadyExecuted = true;


                $.validator.addMethod("noLeadingZero", function(value, element) {
                    return this.optional(element) || /^[^0\s]+.*$/.test(value);
                }, "Name cannot start with a zero or a space.");


                $('#category_save').validate({
                    rules: {
                        category_name: {
                            required: true,
                            maxlength: 30,
                            noLeadingZero:true
                        },
                        cat_status: {
                            required: true
                        },
                    },
                    messages: {
                        category_name: {
                            required: "Please Enter the Scheme  name"
                        },
                        cat_status: {
                            required: "Please select status",
                        }
                    }
                });



                $('form[id^="scheme_master_edit"]').each(function() {
                    $(this).validate({
                        rules: {
                            category_name_edit: {
                                required: true,
                                maxlength: 30,
                                noLeadingZero:true
                            },
                            cat_status_edit: {
                                required: true
                            }
                        },
                        messages: {
                            category_name_edit: {
                                required: "Please enter the scheme name",
                                maxlength: "Scheme name must be less than 20 characters"
                            },
                            cat_status_edit: {
                                required: "Please select a status"
                            }
                        },
                    });
                });

            }



        });
    </script>
    <script>
        function update(id) {
            var schemeName = document.getElementById('edit_scheme_name_' + id).value.trim();
            var status = document.getElementById('cat_status_edit_' + id).value.trim();
            var schemeNameError = document.getElementById('scheme_name_error_' + id);
            var statusError = document.getElementById('status_error_' + id);

            if (schemeName === '' || schemeName == null) {
                schemeNameError.textContent = "Please enter scheme name";

                return false;
            }

            if (status === '' || status == null) {
                statusError.textContent = "Please enter status";
                return false;
            }


            return true;
        }

        function validateForm(id) {
            var schemeName = document.getElementById('exampleInputUsername' + id).value.trim();
            var status = document.getElementById('cat_status_edit' + id).value.trim();

            if (schemeName === '' || status === '') {
                alert("Please fill out all required fields.");
                return false;
            }
            return true;
        }
    </script>
@endsection
