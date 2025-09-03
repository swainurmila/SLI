@extends('layouts.backend.header')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active text-custom-primary">Book Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">Book List</h4>

                                <a href="{{ route('book.add') }}" class="btn ms-auto custom-btn" type="button">Add New
                                    Book</a>
                            </div>
                            <div class="mt-3 table-responsive">

                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Name Of The Book
                                            </th>
                                            <th>Book Request Pending
                                            </th>
                                            <th>Category
                                            </th>
                                            <th>Author</th>

                                            <th>Available Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>

                                        @foreach ($book_data as $book)
                                            {{-- {{dd($book)}} --}}
                                            <tr>
                                                <?php

                                                $book_request_count = App\Models\BookRequest::where('book_id', $book->id)
                                                    ->whereIn('issue_status', [0])
                                                    ->count();

                                                $book_request_pending_count = App\Models\BookRequest::where('book_id', $book->id)
                                                    ->whereIn('issue_status', [0, 1, 3])
                                                    ->count();

                                                $balance_qun = $book->quantity - $book_request_pending_count;
                                                ?>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    {{ @$book->name }}
                                                </td>
                                                <td <?php if($book_request_count > 0){  ?>style="color: red;" <?php } ?>>
                                                    {{ @$book_request_count }}
                                                </td>
                                                <td>
                                                    {{ @$book->BookCategory->name }}
                                                </td>
                                                <td>

                                                    {{ @$book->author }}
                                                </td>
                                                <td class="available-quantity">{{ @$balance_qun }}</td>

                                                <td><a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$book->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="{{ route('book.view-book-details', ['id' => $book->id]) }}"
                                                        class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="view book">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('book.bookIssueRequest', ['id' => $book->id]) }}"
                                                        class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="view">
                                                        <i class="fa fa-info"></i>
                                                    </a> --}}

                                                </td>

                                                <div class="modal fade" id="editTranModal{{ @$book->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Book
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" onClick="refreshPage()"    aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('book.edit', ['id' => $book->id]) }}"
                                                                method="POST" id="book_edit{{ @$book->id }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="mb-3 row">
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label class="col-form-label">Category</label>
                                                                            <select
                                                                                class="form-select form-valid{{ @$book->id }}"
                                                                                id="category_id" name="category_id">
                                                                                <option value="">Select</option>
                                                                                @foreach ($category_list as $cat)
                                                                                    <option
                                                                                        {{ $book->category_id == $cat->id ? 'selected' : '' }}
                                                                                        value="{{ @$cat->id }}">
                                                                                        {{ @$cat->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Name Of The
                                                                                Book</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }}"
                                                                                type="text" value="{{ @$book->name }}"
                                                                                id="name" name="name">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Author</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }}"
                                                                                type="text" value="{{ @$book->author }}"
                                                                                id="author" name="author">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Publisher</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }}"
                                                                                type="text"
                                                                                value="{{ @$book->publisher }}"
                                                                                id="publisher" name="publisher">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Edition</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }}"
                                                                                type="text"
                                                                                value="{{ @$book->edition }}"
                                                                                id="edition" name="edition">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Publish Year</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }} year"
                                                                                type="text"
                                                                                value="{{ @$book->publish_year }}"
                                                                                id="publish_year" name="publish_year">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Language</label>
                                                                            <select
                                                                                class="form-select form-valid{{ @$book->id }}"
                                                                                id="language_id" name="language_id">
                                                                                <option value="">Select</option>
                                                                                @foreach ($language_list as $lan)
                                                                                    <option
                                                                                        {{ $book->language_id == $lan->id ? 'selected' : '' }}
                                                                                        value="{{ @$lan->id }}">
                                                                                        {{ @$lan->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Price</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }} price-validation"
                                                                                type="text"
                                                                                value="{{ @$book->price }}"
                                                                                id="price" name="price">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Quantity</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }} number-validation"
                                                                                readonly type="text"
                                                                                value="{{ @$book->quantity }}"
                                                                                id="quantity" name="quantity">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Upload File</label>
                                                                            <input
                                                                                class="form-control"
                                                                                type="file" value=""
                                                                                id="book_image" name="book_image[]" multiple>
                                                                            @if (isset($book) && $book->images)
                                                                                @foreach ($book->images as $image)
                                                                                    <img src="{{ $image->file_name}}"
                                                                                        alt="Book Image"
                                                                                        style="height: 100px;width: 100px;">
                                                                                @endforeach
                                                                            @endif


                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Book
                                                                                Instruction</label>
                                                                            <input
                                                                                class="form-control form-valid{{ @$book->id }}"
                                                                                type="text"
                                                                                value="{{ @$book->book_instruction }}"
                                                                                id="book_instruction"
                                                                                name="book_instruction">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-4">
                                                                            <label for=""
                                                                                class="col-form-label">Book
                                                                                Description</label>
                                                                            <textarea class="form-control form-valid{{ @$book->id }}" id="book_description" name="book_description">{{ @$book->book_description }}</textarea>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="button"
                                                                        onclick="saveFormedit({{ @$book->id }})"
                                                                        class="btn custom-btn">Edit</button>
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
    <div class="modal fade mode_vid" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('book.store') }}" method="POST" id="book_save" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <div class="col-sm-12 col-lg-4">
                                <label class="col-form-label">Category</label>
                                <select class="form-select form-valid" id="category_id" name="category_id">
                                    <option value="">Select</option>
                                    @foreach ($category_list as $cat)
                                        <option value="{{ @$cat->id }}">{{ @$cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Name Of The Book</label>
                                <input class="form-control form-valid" type="text" value="" id="name"
                                    name="name">
                            </div>

                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Author</label>
                                <input class="form-control form-valid" type="text" value="" id="author"
                                    name="author">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Publisher</label>
                                <input class="form-control form-valid" type="text" value="" id="publisher"
                                    name="publisher">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Edition</label>
                                <input class="form-control form-valid" type="text" value="" id="edition"
                                    name="edition">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Publish Year</label>
                                <input class="form-control form-valid year" type="text" value=""
                                    id="publish_year" name="publish_year">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Language</label>
                                <select class="form-select form-valid" id="language_id" name="language_id">
                                    <option value="">Select</option>
                                    @foreach ($language_list as $lan)
                                        <option value="{{ @$lan->id }}">{{ @$lan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Price</label>
                                <input class="form-control form-valid price-validation" type="text" value=""
                                    id="price" name="price">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="" class="col-form-label">Quantity</label>
                                <input class="form-control form-valid number-validation" type="text" value=""
                                    id="quantity" name="quantity">
                            </div>

                            <div class="col-sm-12 col-lg-8">
                                <label for="" class="col-form-label">Upload File</label>
                                <input class="form-control" type="file" name="book_image[]" value="" multiple>
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

    @foreach ($book_data as $book)
        <?php

        $locations = App\Models\BookLocation::where('book_id', $book->id)->get();

        $book_request_count = App\Models\BookRequest::where('book_id', $book->id)
            ->whereIn('issue_status', [0, 1, 3])
            ->count();
        $balance_qun = $book->quantity - $book_request_count;

        ?>
        <div class="modal fade" id="viewTranModal{{ $book->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">View Book
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header" style="background-color : c5f7cd;">
                                Book Details
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Category :</label>
                                        <span id="" class="">{{ @$book->category_name }}</span>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Name of the Book :</label>
                                        <span id="" class="">{{ @$book->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Author :</label>
                                        <span id="" class="">{{ @$book->author }}</span>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Publisher :</label>
                                        <span id="" class="">{{ @$book->publisher }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Edition :</label>
                                        <span id="" class="">{{ @$book->edition }}</span>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Publish Year :</label>
                                        <span id="" class="">{{ @$book->publish_year }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Language :</label>
                                        <span id="" class="">{{ @$book->language }}</span>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Price :</label>
                                        <span id="" class="">{{ @$book->price }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Quantity :</label>
                                        <span id="" class="">{{ @$book->quantity }}</span>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <label for="" class="col-form-label">Balance Quantity :</label>
                                        <span id="" class="">{{ @$book->balance_qun }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="background-color : c5f7cd;">
                                Location Details
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Rack No.</th>
                                            <th>Row</th>
                                            <th>Column</th>
                                            <th>Unique Regestration No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($locations as $location_data)
                                            <tr>
                                                <td>{{ $location_data->rack_no }}</td>

                                                <td>{{ $location_data->row_no }}</td>

                                                <td>{{ $location_data->column_no }}</td>

                                                <td>{{ $location_data->unique_req_number }}</td>
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
    @endforeach






    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function openVerifyMpodal(id) {
            $('#hid').val(id);

            $('#viewTranModal' + id).modal('show');;
        }

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

                $('#book_save').submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }

        function saveFormedit(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#book_edit' + e).submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }
        $('.year').blur(function() {
            //   alert($(this).val());
            var yearInput = $(this).val();
            // $("#publish_year").val();
            var enteredYear = parseInt(yearInput, 10);

            // Get the current year
            var currentYear = new Date().getFullYear();

            // Check if the entered year is within the valid range
            if (enteredYear >= 1900 && enteredYear <= currentYear) {
                // Display a success message or take appropriate action
                console.log('Year is valid');
            } else {
                // Display an error message or take appropriate action
                alert('Please enter a valid year between 1900 and ' + currentYear);
                // $("#publish_year").val('')
                $(this).val('')
            }

        });
        $('.number-validation').blur(function() {
            var inputValue = $(this).val()
            var regex = /^[0-9]+$/;

            // Test the input against the regular expression
            if (regex.test(inputValue)) {

            } else {
                $(this).val('')
                alert('Please enter only numbers')
            }

        });

        $('.price-validation').blur(function() {
            var inputValue = $(this).val();
            // Use a regular expression to allow both integers and decimal numbers
            var regex = /^-?\d*\.?\d+$/;

            // Test the input against the regular expression
            if (regex.test(inputValue)) {
                // The input is a valid number or decimal
            } else {
                // Clear the input value
                $(this).val('');
                alert('Please enter only numbers or decimals');
            }
        });

        function refreshPage() {
            window.location.reload();
        }
    </script>
@endsection
