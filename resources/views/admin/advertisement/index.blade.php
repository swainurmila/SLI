@extends('layouts.backend.header')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Advertisement</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">Advertisement List</h4>
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Create</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>end Date</th>
                                            <th>Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($advt as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->from_date }}</td>
                                                <td>{{ $item->to_date }}</td>
                                                <td>{{ $item->details }}</td>
                                                {{-- <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$item->id }}">
                                                        <i class="fas fa-calendar"></i>
                                                    </a>
                                                    <a href="{{ route('delete-advertisement', [$item->id]) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('delete-advertisement', [$item->id]) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('POST')
                                                    </form>

                                                </td>
                                                <div class="modal fade" id="editTranModal{{ @$item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Reschedule
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('update-advertisement', $item->id) }}"
                                                                method="POST" id="book_edit{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        {{-- <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Catagory Title:<sup><span style="color: red;">*</span></sup></label>
                                                                                <input type="text" id="exampleInputUsername" class="form-control"
                                                                                    name="name" placeholder="Category Title" value="{{@$item->name}}">
                                                                                @if ($errors->has('name'))
                                                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div> --}}
                                                                        {{-- <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Description:<sup><span style="color: red;">*</span></sup></label>
                                                                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{@$item->description}}</textarea>
                                                                                @if ($errors->has('description'))
                                                                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div> --}}
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">From
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="from_date" required="required"
                                                                                    value="{{ @$item->from_date }}">
                                                                                @if ($errors->has('from_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('from_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">To Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="to_date" required="required"
                                                                                    value="{{ @$item->to_date }}">
                                                                                @if ($errors->has('to_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('to_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn custom-btn">Update</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add advertisement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('add-advertisement') }}" method="POST" id="master_save"
                    enctype="multipart/form-data" onsubmit="return validateForm();">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Advertisement Title:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" id="exampleInputUsername"
                                        class="form-control name-validation form-valid" name="title"
                                        placeholder="Advertisement Title" required="required">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label">From Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control form-valid" name="from_date" id="from_date"
                                        required="required">
                                    @if ($errors->has('from_date'))
                                        <span class="text-danger">{{ $errors->first('from_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label">To Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control form-valid" name="to_date" id="to_date"
                                        required="required">
                                    @if ($errors->has('to_date'))
                                        <span class="text-danger">{{ $errors->first('to_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Details:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <textarea class="form-control form-valid" name="details" id="details" cols="3" rows="1"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="saveForm()" class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection

<script>
    function saveForm() {
        var errcount = 0;
        $(".error-span").remove();

        $("span").remove();
        $('.form-valid').each(function() {
            if ($(this).val() == '') {
                errcount++;
                $(this).addClass('error-text');
                $(this).removeClass('success-text');
                $(this).after('<span style="color:red">This field is required</span>');
            } else {
                $(this).removeClass('error-text');
                $(this).addClass('success-text');
            }
        });

        // alert(errcount);
        if (errcount == 0) {
            // $.blockUI({ message: '<h1> Loading...</h1>' });

            $('#master_save').submit();
            // $.unblockUI();
        } else {
            return false;
        }
    }

    function validateForm() {
        var fromDate = new Date(document.getElementById('from_date').value);
        var toDate = new Date(document.getElementById('to_date').value);
        var today = new Date();

        if (fromDate < today) {
            alert("From Date must be today's date or a future date.");
            return false;
        }
        if (toDate < fromDate) {
            alert("To Date must be greater than From Date");
            return false;
        }
        return true;
    }
</script>
