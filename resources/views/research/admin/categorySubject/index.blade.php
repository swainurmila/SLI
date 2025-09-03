@extends('research.layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Category Subject</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-10">&nbsp;
                                    {{-- <h4 class="card-title mb-4">Category Subject List</h4> --}}
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Add Category Subject</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Category Subject Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cat as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->category_name }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('delete-cat-sub', [$item->id]) }}"
                                                         onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>

                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('delete-cat-sub', [$item->id]) }}" method="POST"
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
                                                <div class="modal fade editTranModalclass"
                                                    id="editTranModal{{ @$item->id }}" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Category Subject
                                                                </h5>
                                                                <button type="button" class="btn-close" id="reloadButton"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('update-cat-sub', $item->id) }}"
                                                                method="POST" id="master_save_edit{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Categoty Subject
                                                                                    Name:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="text"
                                                                                    id="exampleInputUsername"
                                                                                    class="form-control form-valid{{ @$item->id }} name-validation"
                                                                                    name="category_name"
                                                                                    placeholder="Category Subject Name"
                                                                                    value="{{ @$item->category_name }}">
                                                                                {{-- @if ($errors->has('name'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('name') }}</span>
                                                                                @endif --}}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Status:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <select
                                                                                    class="form-control form-valid{{ @$item->id }}"
                                                                                    name="status">
                                                                                    <option value="1"
                                                                                        {{ isset($item) && $item->status == 1 ? 'selected' : '' }}>
                                                                                        Active</option>
                                                                                    <option value="0"
                                                                                        {{ isset($item) && $item->status == 0 ? 'selected' : '' }}>
                                                                                        Inactive</option>
                                                                                </select>
                                                                                {{-- Display validation error message if needed --}}
                                                                                {{-- @if ($errors->has('status'))
                                                                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                                                                @endif --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        id="reloadclose"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button
                                                                        type="button"onclick="saveFormedit({{ @$item->id }})"
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add Category </h5>
                    <button type="button" id="closeModalBtn" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('add-cat-sub') }}" method="POST" id="master_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Category Subject Name:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" id="category_name"
                                        class="form-control form-valid name-validation" name="category_name"
                                        placeholder="Category Subject Name" pattern="[a-zA-Z\s]+"
                                        title="The category subject name must contain only letters and spaces."
                                        onkeypress="return validateKeyPress(event)" maxlength="50">
                                        <span id="category_name_error" class="text-danger" style="display: none;">This category name already exists.</span>
                                    @if ($errors->has('category_name'))
                                        <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Status:<sup><span style="color: red;">*</span></sup></label>
                                    <select class="form-control form-valid" name="status">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <!-- You can include validation error message if needed -->
                                    <!-- @if ($errors->has('status'))
    <span class="text-danger">{{ $errors->first('status') }}</span>
    @endif -->
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
    <script>
        $(document).ready(function() {

            $('#reloadButton, #reloadclose').on('click', function() {
                location.reload();
            });
        });

        $('#category_name').on('blur', function() {
            var categoryName = $(this).val();

            $.ajax({
                url: '{{ route('check-category-name') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    category_name: categoryName
                },
                success: function(response) {
                    if (response.msg === 'true') {
                        $('#category_name_error').show();
                    } else {
                        $('#category_name_error').hide();
                    }
                }
            });
        });

        $('#addModal').on('hidden.bs.modal', function() {
            location.reload();
        })
        $("#master_save").validate({
            rules: {
                category_name: {
                    required: true,
                },
                status: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: "Category is required",
                },
                status: {
                    required: "Status is required",
                }
            },
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var closeModalBtn = document.getElementById('closeModalBtn');
            closeModalBtn.addEventListener('click', function() {
                document.getElementById('master_save').reset();
            });
        });

        // function saveForm() {
        //     var errcount = 0;
        //     $(".error-span").remove();

        //     $("span").remove();
        //     $('.form-valid').each(function() {
        //         if ($(this).val() == '') {
        //             errcount++;
        //             $(this).addClass('error-text');
        //             $(this).removeClass('success-text');
        //             $(this).after('<span style="color:red">This field is required</span>');
        //         } else {
        //             $(this).removeClass('error-text');
        //             $(this).addClass('success-text');
        //         }
        //     });
        //     // alert(errcount);
        //     if (errcount == 0) {
        //         // $.blockUI({ message: '<h1> Loading...</h1>' });

        //         $('#master_save').submit();
        //         // $.unblockUI();
        //     } else {
        //         return false;
        //     }
        // }

        function saveFormedit(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            // $(".error-span").remove();

            $("span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    $(this).after('<span class="error-span' + e +
                        '" style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                }
            });

            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#master_save_edit' + e).submit();
                // $.unblockUI();
            } else {
                return false;
            }
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
