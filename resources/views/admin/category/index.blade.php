@extends('layouts.backend.header')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Category</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">Category List</h4>
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Add Category</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lang as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->name }}</td>
                                                {{-- <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}"
                                                        onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('delete-category', [$item->id]) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('POST')
                                                    </form>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                                <div class="modal fade" id="editTranModal{{ @$item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Category
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"onClick="refreshPage()"
                                                                    aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('update-category', $item->id) }}"
                                                                method="POST"
                                                                enctype="multipart/form-data"  onsubmit="return validateForm({{ @$item->id }})">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Category
                                                                                    Title:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="text"
                                                                                    id="cat_name{{ @$item->id }}"
                                                                                    class="form-control" name="name"pattern="[a-zA-Z\s]+"
                                                                                    onkeypress="return validateKeyPress(event)"
                                                                                    placeholder="Category Title"oninput="capitalizeFirstLetter(this)"
                                                                                    value="{{ @$item->name }}">
                                                                                    <span id="category_error{{ $item->id }}" class="text-danger"></span>
                                                                                @if ($errors->has('name'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Description:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <textarea class="form-control" name="description" onkeypress="return validateKeyPress(event)" id="cat_description{{ @$item->id }}">{{ @$item->description }}</textarea>
                                                                                <span id="category_error_description{{ $item->id }}" class="text-danger"></span>
                                                                                @if ($errors->has('description'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('description') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal"onClick="refreshPage()">Close</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        onClick="refreshPage()"aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('add-category') }}" method="POST" id="master_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Category Title:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Category Title" maxlength="30" pattern="[a-zA-Z\s]+"
                                        onkeypress="return validateKeyPress(event)" oninput="capitalizeFirstLetter(this)">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Description:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <textarea class="form-control" name="description" onkeypress="return validateKeyPress(event)" id="description"
                                        oninput="capitalizeFirstLetter(this)"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onClick="refreshPage()">Close</button>
                        <button type="submit" class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            $("#master_save").validate({
                rules: {
                    name: {
                        required: true
                    },
                    description: {
                        required: true,
                        maxlength: 500
                    },
                },
                messages: {
                    name: {
                        required: "Please enter category name."
                    },
                    description: {
                        required: "Description  is required.",
                        maxlength: "Description cannot exceed 500 characters."
                    },
                },
                // submitHandler: function(form) {
                //     form.submit();
                // }


            });
        });
    </script>
     <script>
        function validateForm(itemId) {
            var isValid = true;

            // Validate Category Title
            var categoryName = document.getElementById('cat_name' + itemId).value.trim();
            var categoryError = document.getElementById('category_error' + itemId);
            if (categoryName === '') {
                categoryError.textContent = 'Category title is required.';
                isValid = false;
            } else {
                categoryError.textContent = '';
            }

            // Validate Description
            var categoryDescription = document.getElementById('cat_description' + itemId).value.trim();
            var categoryErrorDescription = document.getElementById('category_error_description' + itemId);
            if (categoryDescription === '') {
                categoryErrorDescription.textContent = 'Description is required.';
                isValid = false;
            } else {
                categoryErrorDescription.textContent = '';
            }

            return isValid;
        }

        function validateKeyPress(event) {
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }

            // Allow only letters and spaces
            const regex = /^[a-zA-Z\s]*$/;
            return regex.test(event.key);
        }

        function capitalizeFirstLetter(input) {
            var start = input.selectionStart;
            var end = input.selectionEnd;
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
            input.setSelectionRange(start, end);
        }

        function refreshPage() {
            window.location.reload();
        }
    </script>
{{-- <script>
    function  () {
        let name = document.getElementById('name').value;
        let token = document.querySelector('input[name="_token"]').value;

        if (name.length > 0) {
            fetch("{{ route('check-category-name') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ name: name })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    document.getElementById('name-error').textContent = 'Category name already exists.';
                } else {
                    document.getElementById('name-error').textContent = '';
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('name-error').textContent = '';
        }
    }
</script> --}}


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
