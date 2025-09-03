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
                                {{-- <li class="breadcrumb-item active text-custom-primary">Issue Report</li> --}}
                            </ol>

                        </div>

                        @if ($id != '')
                            <a href="{{ URL::previous() }}" class="btn custom-btn btn-sm">Go to Back<i
                                    class="uil-arrow-circle-left text-white font-size-18 ms-2"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">

                                @if ($id != '')
                                    <h4 class="card-title mb-4">Approval Report</h4>
                                @else
                                    <h4 class="card-title mb-4">Issue Report</h4>
                                @endif
                            </div>
                            <div class="mt-3 table-responsive">
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sl No
                                            </th>
                                            <th>Library Card Number
                                            </th>
                                            <th>Student Name
                                            </th>
                                            <th>Book Name</th>
                                            <th>Book Reg No</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach ($book_request as $key => $book)
                                            <?php
                                            $user_data = App\Models\User::where('id', $book->user_id)->first();
                                            $book_data = App\Models\Book::where('id', $book->book_id)->first();
                                            // $book_location = App\Models\BookLocation::where('book_id',$book->book_id)->get();
                                            $book_reg_data = App\Models\BookLocation::where('id', $book->book_location_id)->first();
                                            $book_data = App\Models\Book::where('id', $book->book_id)->first();
                                            // $reg_data = App\Models\BookLocation::where('book_id',$book->book_id)->get();
                                            $book_location = App\Models\BookLocation::where('book_id', $book->book_id)
                                                ->whereNotIn('id', function ($query) {
                                                    $query
                                                        ->select('book_location_id')
                                                        ->from('book_requests')
                                                        ->whereIn('issue_status', [0, 1, 3])
                                                        ->whereNotNull('book_location_id');
                                                })
                                                ->get();

                                            $resultDate = '';
                                            $differenceInDays_th = 0;
                                            if (isset($book->issue_date)) {
                                                $dateTime = new DateTime($book->issue_date);

                                                $dateTime->modify('+15 days');

                                                $resultDate = $dateTime->format('Y-m-d');

                                                $dateTime_td = new DateTime($book->issue_date);

                                                $dateTime_td->modify('+5 days');

                                                $resultDate_td = $dateTime_td->format('Y-m-d');

                                                $currentDate_td = new DateTime();

                                                if ($currentDate_td > $dateTime_td) {
                                                    // Calculate the difference in days
                                                    $interval = $currentDate_td->diff($dateTime_td);
                                                    $differenceInDays_th = $interval->format('%a');
                                                    // dd($differenceInDays_th);
                                                    // $fine_amount = $differenceInDays * 50;
                                                }
                                            }
                                            //    dd($differenceInDays_th);
                                            ?>
                                            <tr>

                                                <td>{{ ++$key }}</td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    {{ $user_data->registration_no }}</td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    {{ $user_data->first_name }}
                                                </td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    @if($book_data)
                                                    <a
                                                        href="{{ route('book.view-book-details', ['id' => $book_data->id]) }}">{{ $book_data->name }}<i></i></a>
                                                        @else
                                                        -
                                                        @endif
                                                </td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    {{ @$book_reg_data->unique_req_number }}</td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    {{ $book->issue_date }}</td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    {{ $resultDate }}</td>
                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>
                                                    {{ $user_data->contact_no }}</td>

                                                <td <?php if($differenceInDays_th > 4 && $differenceInDays_th != 0){ ?> style="color: red;" <?php } ?>>

                                                    <?php
                                                        if($book->issue_status == 1){
                                                            ?>
                                                    {{-- <button type="button"
                                                            onclick="returnRequest({{ @$book->id }})" class="btn custom-btn">Return Request</button>
                                                         --}}
                                                    <?php } ?>


                                                    <?php
                                                        if($book->issue_status == 0){
                                                            ?>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $book->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <?php }else{
                                                            echo "Issued";
                                                        } ?>

                                                </td>
                                                <div class="modal fade" id="viewTranModal{{ $book->id ?? '' }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-xl modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">View Book
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"   onClick="refreshPage()" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            {{-- <div class="modal-body">
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label class="col-form-label">Category</label>
                                                                        <?php
                                                                        $cat_name = App\Models\CategoryMaster::where('id', $book_data->category_id)->first();
                                                                        $lan_name = App\Models\Language::where('id', $book_data->language_id)->first();
                                                                        ?>

                                                                        <p id="">{{ @$cat_name->name }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="bookName" class="form-label">Name of the
                                                                            Book:</label>
                                                                        <p id="">{{ @$book_data->name }}</p>
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Unique
                                                                            Req
                                                                            Number:</label>
                                                                        <p id="">
                                                                            {{ @$book_data->unigue_req_number }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Author:</label>

                                                                        <p id="">{{ @$book_data->author }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Publisher:</label>

                                                                        <p id="">{{ @$book_data->publisher }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Edition:</label>

                                                                        <p id="">{{ @$book_data->edition }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Publish
                                                                            Year:</label>
                                                                        <p id="">{{ @$book_data->publish_year }}
                                                                        </p>

                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Language:</label>

                                                                        <p id="">{{ @$lan_name->name }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Price:</label>

                                                                        <p id="">{{ @$book_data->price }}</p>

                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Quantity:</label>
                                                                        <p id="">{{ @$book_data->quantity }}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <h5
                                                                        class="text-decoration-underline text-custom-primary">
                                                                        Location</h5>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Rack
                                                                            No:</label>

                                                                        <p id="">{{ @$book_data->rack_no }}</p>

                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Column:</label>

                                                                        <p id="">{{ @$book_data->column_no }}</p>

                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Row:</label>

                                                                        <p id="">{{ @$book_data->row_no }}</p>

                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="modal-body">
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label class="col-form-label">Category</label>
                                                                        <?php
                                                                        if ($book_data) {
                                                                            $cat_name = App\Models\CategoryMaster::where('id', $book_data->category_id)->first();
                                                                            $lan_name = App\Models\Language::where('id', $book_data->language_id)->first();
                                                                        }
                                                                        ?>
                                                                        <p id="">{{ @$cat_name->name ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="bookName" class="form-label">Name of the Book:</label>
                                                                        <p id="">{{ $book_data->name ?? 'N/A' }}</p>
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Unique Req Number:</label>
                                                                        <p id="">{{ $book_data->unigue_req_number ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Author:</label>
                                                                        <p id="">{{ $book_data->author ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Publisher:</label>
                                                                        <p id="">{{ $book_data->publisher ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Edition:</label>
                                                                        <p id="">{{ $book_data->edition ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Publish Year:</label>
                                                                        <p id="">{{ $book_data->publish_year ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Language:</label>
                                                                        <p id="">{{ @$lan_name->name ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Price:</label>
                                                                        <p id="">{{ $book_data->price ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Quantity:</label>
                                                                        <p id="">{{ $book_data->quantity ?? 'N/A' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <h5 class="text-decoration-underline text-custom-primary">Location</h5>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Rack No:</label>
                                                                        <p id="">{{ $book_data->rack_no ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Column:</label>
                                                                        <p id="">{{ $book_data->column_no ?? 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for="" class="col-form-label">Row:</label>
                                                                        <p id="">{{ $book_data->row_no ?? 'N/A' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal fade" id="editModal{{ $book->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Issue &
                                                                    Reject Book</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"  onClick="refreshPage()" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <label>
                                                                            <input type="radio"
                                                                                name="book_response{{ $book->id }}"
                                                                                onClick="block_issue(this.value,{{ $book->id }})"
                                                                                value="1" checked> Issue
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio"
                                                                                name="book_response{{ $book->id }}"
                                                                                onClick="block_issue(this.value,{{ $book->id }})"
                                                                                value="0"> Reject
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Library Card
                                                                            Number</label>
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $user_data->registration_no }}"
                                                                            readonly id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Student Name</label>
                                                                        <input class="form-control" type="text"
                                                                            readonly value="{{ $user_data->first_name }}"
                                                                            id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4"
                                                                        id="book_reg_div{{ $book->id }}">
                                                                        <label for="" class="col-form-label">Book
                                                                            Reg No</label>
                                                                        <select class="form-select form-valid"
                                                                            id="unique_req_number{{ $book->id }}"
                                                                            name="unique_req_number">
                                                                            <option value="">Select</option>
                                                                            @foreach ($book_location as $reg)
                                                                                <option value="{{ @$reg->id }}">
                                                                                    {{ @$reg->unique_req_number }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4"
                                                                        id="issue_date_div{{ $book->id }}">
                                                                        <label for="" class="col-form-label">Issue
                                                                            Date</label>
                                                                        <input class="form-control" type="text"
                                                                            value="<?php echo date('Y-m-d'); ?>" readonly
                                                                            id="issue_date{{ $book->id }}">
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Phone</label>
                                                                        <input class="form-control" type="number"
                                                                            readonly value="{{ $user_data->contact_no }}"
                                                                            id="">
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-4" style="display: none;"
                                                                        id="reject_remark_div{{ $book->id }}">
                                                                        <label for=""
                                                                            class="col-form-label">Reject Remark</label>
                                                                        <input class="form-control" type="text"
                                                                            value=""
                                                                            id="reject_remark{{ $book->id }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button"
                                                                    onclick="saveReject({{ @$book->id }})"
                                                                    class="btn btn-danger" data-bs-dismiss="modal"
                                                                    style="display: none;"
                                                                    id="reject_form{{ $book->id }}">Reject</button>
                                                                    <button type="button" onclick="saveIssue({{ @$book->id }})" id="issue_form{{ $book->id }}" class="btn custom-btn">Issue</button> --}}
                                                                    <button type="button" onclick="saveReject({{ @$book->id }})" class="btn btn-danger" data-bs-dismiss="modal" style="display: none;" id="reject_form{{ $book->id }}">Reject</button>
<button type="button" onclick="saveIssue({{ @$book->id }})" id="issue_form{{ $book->id }}" class="btn custom-btn">Issue</button>


                                                            </div>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>


        function saveIssue(e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You sure want to Issue this Request!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, issue it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var book_id = e;
            var issue_date = $("#issue_date" + e).val();
            var unique_req_number = $("#unique_req_number" + e).val();

            if (issue_date == '' || issue_date == null) {
                Swal.fire('Error', 'Select issue date', 'error');
                return false;
            }
            if (unique_req_number == '' || unique_req_number == null) {
                Swal.fire('Error', 'Select Book Reg Number', 'error');
                return false;
            }

            $.ajax({
                type: 'post',
                url: "{{ route('book.issueBook') }}",
                data: {
                    book_id: e,
                    issue_date: issue_date,
                    unique_req_number: unique_req_number,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    Swal.fire('Issued!', 'The book has been issued.', 'success').then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}


        // function saveReject(e) {

        //     var userConfirmed = confirm("You sure want to Reject this Request!");

        //     if (userConfirmed) {
        //         // var book_id = e;
        //         var issue_date = $("#issue_date" + e).val()
        //         var reject_remark = $("#reject_remark" + e).val()

        //         $.ajax({
        //             type: 'post',
        //             url: "{{ route('book.rejectBook') }}",
        //             data: {

        //                 book_id: e,
        //                 issue_date: issue_date,
        //                 reject_remark: reject_remark,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function(data) {
        //                 location.reload();

        //             }
        //         });
        //     }
        // }
        function saveReject(e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You sure want to Reject this Request!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reject it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var issue_date = $("#issue_date" + e).val();
            var reject_remark = $("#reject_remark" + e).val();

            $.ajax({
                type: 'post',
                url: "{{ route('book.rejectBook') }}",
                data: {
                    book_id: e,
                    issue_date: issue_date,
                    reject_remark: reject_remark,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    Swal.fire('Rejected!', 'The request has been rejected.', 'success').then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}


        function returnRequest(e) {

            var userConfirmed = confirm("You sure want to request to return the book !");

            if (userConfirmed) {
                // var book_id = e;
                var issue_date = $("#issue_date" + e).val()

                $.ajax({
                    type: 'post',
                    url: "{{ route('book.adminBookReturnRequest') }}",
                    data: {

                        book_id: e,
                        issue_date: issue_date,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        location.reload();

                    }
                });
            }
        }


        function refreshPage() {
            window.location.reload();
        }

        function block_issue(e, id) {
            var element = document.getElementById("issue_date_div" + id);

            var reject_form_element = document.getElementById("reject_form" + id);
            var issue_form_element = document.getElementById("issue_form" + id);
            var book_reg_div_element = document.getElementById("book_reg_div" + id);

            var reject_remark_div = document.getElementById("reject_remark_div" + id);



            if (e == 0) {
                book_reg_div_element.style.display = "none";
                element.style.display = "none";
                reject_remark_div.style.display = "block";

                reject_form_element.style.display = "block";

                issue_form_element.style.display = "none";
            } else {
                book_reg_div_element.style.display = "block";
                element.style.display = "block";
                reject_form_element.style.display = "none";

                reject_remark_div.style.display = "none";

                issue_form_element.style.display = "block";
            }

        }
    </script>
@endsection
