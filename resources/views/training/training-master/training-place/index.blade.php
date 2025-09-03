@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training Place</h4>

                        <div class="page-title-right">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add Place</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr class="">
                                            <th>Sl. No</th>
                                            <th>Training Place Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $item)
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}"
                                                       onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('training-delete-place', [$item->id]) }}"
                                                        method="POST" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
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
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    @foreach ($datas as $key => $item)
        <div class="modal fade" id="editTranModal{{ @$item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit
                            Training Place
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <form action="{{ route('training-place-update', $item->id) }}" method="POST"
                        id="training_place_edit{{ @$item->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Training Place
                                            Name:<sup><span style="color: red;">*</span></sup></label>
                                        <input type="text" id="exampleInputUsername" class="form-control" name="name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)"
                                        oninput="this.value = this.value.replace(/^\s+/, '')"
                                            value="{{ @$item->name }}" placeholder="Training Place Name"
                                            required="required" autocomplete="off">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Description:<sup><span
                                                    style="color: red;">*</span></sup></label>
                                        <textarea class="form-control" name="description" id="description" value="{{ @$item->description }}" autocomplete="off"
                                            cols="30" rows="10">{{ @$item->description }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn custom-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Training Place</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training-place-store') }}" method="POST" id="trtaining_place_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Training Place Name:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" id="exampleInputUsername" class="form-control" name="name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)" maxlength="50"
                                        oninput="this.value = this.value.replace(/^\s+/, '')"
                                        placeholder="Training Place Name" required="required" autocomplete="off">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Description:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                        autocomplete="off"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {

            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Field cannot contain only spaces");

            $("#trtaining_place_save").validate({
                rules: {
                    name: {
                        required: true,

                    },
                    description: {
                        required: true,

                    }

                },
                messages: {
                    name: {
                        required: "Training Place Name is required",

                    },
                    description: {
                        required: "Description is required",

                    }
                },
            })


            $('form[id^="training_place_edit"]').each(function() {
                $(this).validate({
                    rules: {
                        name: {
                            required: true,
                            noSpace: true,
                            maxlength: 15
                        },
                        description: {
                            required: true,
                            noSpace: true,
                            maxlength: 50
                        }

                    },
                    messages: {
                        name: {
                            required: "Training Place Name is required",
                            noSpace: "Name cannot contain only spaces"
                        },
                        description: {
                            required: "Description is required",
                            noSpace: "Name cannot contain only spaces"
                        }
                    },
                });
            });
        });
    </script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
@endsection
