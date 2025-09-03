@extends('layouts.backend.header')

@section('content')
    <?php

    $locations = App\Models\BookLocation::where('book_id', $book->id)->get();

    $book_request_count = App\Models\BookRequest::where('book_id', $book->id)
        ->whereIn('issue_status', [0, 1, 3])
        ->count();
    $balance_qun = $book->quantity - $book_request_count;
    // dd($balance_qun);
    ?>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('book.index') }}"><i></i>Book Details</a>
                                </li>
                                <li class="breadcrumb-item active text-custom-primary">View Book Details</li>
                            </ol>
                        </div>

                        <div class="page-title-right">
                            <a href="{{ URL::previous() }}" class="btn custom-btn btn-sm">Go to Back<i
                                    class="uil-arrow-circle-left text-white font-size-18 ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="background-color : #c5f7cd;">
                            View Book Details
                        </div>
                        {{-- <div class="card-body">
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
                                    <span id="" class="">{{ @$balance_qun }}</span>
                            </div>
                        </div>
                    </div> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="product-detail">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                    aria-orientation="vertical">
                                                    <?php
                                                    $j = 0;
                                                    ?>

                                                    @foreach ($book->images as $image)
                                                        <?php
                                                        $j++;
                                                        $image_parth = @$image->file_name;
                                                        ?>

                                                        @if ($j == 1)
                                                            <a class="nav-link active" id="product-{{ $image->id }}-tab"
                                                                data-bs-toggle="pill" href="#product-{{ $image->id }}"
                                                                role="tab">
                                                                <img src="{{ asset($image_parth) }}" alt=""
                                                                    class="img-fluid mx-auto d-block tab-img rounded">
                                                            </a>
                                                        @else
                                                            <a class="nav-link" id="product-{{ $image->id }}-tab"
                                                                data-bs-toggle="pill" href="#product-{{ $image->id }}"
                                                                role="tab">
                                                                <img src="{{ asset(@$image_parth) }}" alt=""
                                                                    class="img-fluid mx-auto d-block tab-img rounded">
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-9">
                                                <div class="tab-content position-relative" id="v-pills-tabContent">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @foreach ($book->images as $image)
                                                        <?php
                                                        $i++;
                                                        $image_parth = @$image->file_name;
                                                        ?>
                                                        @if ($i == 1)
                                                            <div class="tab-pane fade show active"
                                                                id="product-{{ $image->id }}" role="tabpanel">
                                                                <div class="product-img">
                                                                    <img src="{{ asset(@$image_parth) }}" alt=""
                                                                        class="img-fluid mx-auto d-block"
                                                                        data-zoom="{{ asset('asset/images/img-02-book') }}">
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="tab-pane fade" id="product-{{ $image->id }}"
                                                                role="tabpanel">
                                                                <div class="product-img">
                                                                    <img src="{{ asset(@$image_parth) }}" alt=""
                                                                        class="img-fluid mx-auto d-block"
                                                                        data-zoom="{{ asset('asset/images/img-02-book') }}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div style="text-align: center;">
                                        <h1>{{ $book->name }}</h1>
                                    </div>

                                    <h4 class="font-size-18 mb-3">Book Description:</h4>

                                    <?php

                                    $book_tec = App\Models\CategoryMaster::where('id', $book->category_id)->first();
                                    ?>
                                    <h5 class="mt-4 pt-2"><span
                                            class="text-danger font-size-16">{{ @$book_tec->name }}</span></h5>

                                    <p class="mt-4 text-muted">{{ @$book->book_description }}</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">

                                                <h5 class="font-size-14">Author :{{ @$book->author }}</h5>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <h5 class="font-size-14">Edition :{{ @$book->edition }}</h5>


                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="background-color: #c5f7cd;">
                            <span>Location Details</span>
                            <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add New Book Location</button>
                        </div>
                        <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add New Book Location
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="refreshPage()"
                                            aria-label="Close" >
                                        </button>
                                    </div>

                                    <form action="{{ route('add-newbook') }}" method="POST" id="master_save"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="mb-4 row">
                                                <div class="col-sm-12 col-lg-3">
                                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                    <label for="" class="col-form-label">Rack
                                                        No</label>
                                                    <input class="form-control form-valid" type="text" value=""
                                                        id="rack_nox" name="rack_no" placeholder="Rack No">
                                                </div>
                                                <div class="col-sm-12 col-lg-3">
                                                    <label for="" class="col-form-label">Row</label>
                                                    <input class="form-control form-valid" type="text" value=""
                                                        name="row_no" placeholder="Row No">
                                                </div>
                                                <div class="col-sm-12 col-lg-3">
                                                    <label for="" class="col-form-label">Column</label>
                                                    <input class="form-control form-valid" type="text" value=""
                                                        name="column_no" placeholder="Column No">
                                                </div>
                                                <div class="col-sm-12 col-lg-3">
                                                    <label for="" class="col-form-label">Unique Registration
                                                        No</label>
                                                    <input class="form-control form-valid{{ @$book->id }}"
                                                        type="text" value=""
                                                        placeholder="Unique Registration No" id="unique_req_number"
                                                        name="unique_req_number">
                                                    @if ($errors->has('unique_req_number'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('unique_req_number') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            {{-- <button type='submit' id="sub_btn">submit</button> --}}
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                                            <button type="button" onclick="saveForm()"
                                                class="btn custom-btn">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Rack No.</th>
                                        <th>Row</th>
                                        <th>Column</th>
                                        <th>Unique Book Registration No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($book->location as $location_data)
                                        <tr>

                                            <td>{{ $location_data->rack_no }}</td>

                                            <td>{{ $location_data->row_no }}</td>

                                            <td>{{ $location_data->column_no }}</td>
                                            <?php
                                            $book_issue_count = App\Models\BookRequest::where('book_id', $book->id)
                                                ->where('book_location_id', $location_data->id)
                                                ->whereIn('issue_status', [0, 1, 3])
                                                ->count();

                                            ?>

                                            <td
                                                @if ($book_issue_count > 0) class="fw-lighter text-muted text-danger" @else class="fw-bold" @endif>
                                                {{ $location_data->unique_req_number }} </td>

                                            <td><a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                    title="Edit" data-bs-toggle="modal"
                                                    data-bs-target="#editTranModal{{ @$location_data->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a></td>
                                        </tr>

                                        <div class="modal fade" id="editTranModal{{ @$location_data->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Book
                                                            Location
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"onClick="refreshPage()"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>

                                                    <form action="{{ route('book.editlocation', $location_data->id) }}"
                                                        method="POST" id="book_edit{{ @$location_data->id }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <div class="mb-4 row">
                                                                <input type="hidden" value="{{ @$location_data->id }}"
                                                                    name="id">
                                                                <div class="col-sm-12 col-lg-3">
                                                                    <label for="" class="col-form-label">Rack
                                                                        No</label>

                                                                    <input type="text"
                                                                        class="form-control form-valid{{ @$location_data->id }}"
                                                                        type="text"
                                                                        value="{{ $location_data->rack_no }}"
                                                                        id="rack_no" name="rack_no">
                                                                </div>
                                                                <div class="col-sm-12 col-lg-3">
                                                                    <label for=""
                                                                        class="col-form-label">Row</label>
                                                                    <input
                                                                        class="form-control form-valid{{ @$location_data->id }}"
                                                                        type="text"
                                                                        value="{{ $location_data->row_no }}"
                                                                        id="row_no" name="row_no">
                                                                </div>
                                                                <div class="col-sm-12 col-lg-3">
                                                                    <label for=""
                                                                        class="col-form-label">Column</label>
                                                                    <input
                                                                        class="form-control form-valid{{ @$location_data->id }}"
                                                                        type="text"
                                                                        value="{{ $location_data->column_no }}"
                                                                        id="column_no" name="column_no">
                                                                </div>
                                                                <div class="col-sm-12 col-lg-3">
                                                                    <label for="" class="col-form-label">Unique
                                                                        Registration No</label>
                                                                    <input
                                                                        class="form-control form-valid{{ @$location_data->id }}"
                                                                        type="text"
                                                                        value="{{ $location_data->unique_req_number }}"
                                                                        id="unique_req_number" name="unique_req_number"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal"onClick="refreshPage()">Close</button>
                                                            <button type="button"
                                                                onclick="saveFormedit({{ @$location_data->id }})"
                                                                class="btn custom-btn">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        $('#unique_req_number').focusout(function() {
    var regno = $(this).val();
    $.ajax({
        type: 'POST',
        url: "{{ route('check-reg') }}",
        data: {
            _token: "{{ csrf_token() }}",
            regno: regno
        },
        success: function(response) {
            // Remove existing error message and class before adding a new one
            $('#unique_req_number').removeClass('error-text');
            $('#unique_req_number').next('span').remove();

            if (response.location_count > 0) {
                $('#unique_req_number').addClass('error-text');
                $('#unique_req_number').after('<span style="color:red">This registration number already exists</span>');
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                if (errors && errors.unique_req_number) {
                    $('#unique_req_number').addClass('error-text');
                    $('#unique_req_number').next('span').remove();
                    $('#unique_req_number').after('<span style="color:red">' + errors.unique_req_number[0] + '</span>');
                }
            }
        }
    });
});


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
//         function saveForm() {
//     const form = document.getElementById('master_save');
//     const formData = new FormData(form);

//     fetch('{{ route('add-newbook') }}', {
//         method: 'POST',
//         body: formData,
//         headers: {
//             'X-CSRF-TOKEN': '{{ csrf_token() }}',
//         },
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Update the available quantity in the table
//             const bookId = formData.get('book_id');
//             const availableQuantityCell = document.querySelector(`#book-row-${bookId} .available-quantity`);
//             availableQuantityCell.textContent = data.new_available_quantity;

//             // Close the modal
//             const modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
//             modal.hide();

//             // Optionally, show a success message
//             alert('Book location added successfully and available quantity updated.');
//         } else {
//             // Handle validation errors or other errors
//             alert('Error adding book location.');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('Error adding book location.');
//     });
// }
        function saveFormedit(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    $(this).after('<span class="error-span' + e +
                        ' "style="color:red">This field is required</span>');
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
        function refreshPage() {
            window.location.reload();
        }
    </script>
@endsection
