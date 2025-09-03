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
                                <li class="breadcrumb-item active text-custom-primary">Issue & Return Report</li>
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
                                <h4 class="card-title mb-4">Issue & Return</h4>
                            </div>
                            <div class="mt-3 table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Library Id</th>
                                            <th>Student Name</th>
                                            <th>Book Reg No</th>
                                            <th>Book Name</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                            <th>Delay Duration</th>
                                            <th>Fine Amount (Late Return)</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach ($book_request as $book)
                                            <?php
                                            $issueDate = \Carbon\Carbon::parse($book->issue_date)->format('Y-m-d');

                                            $currentDate = \Carbon\Carbon::today();
                                            if ($currentDate > $issueDate) {
                                                $differenceInDays = $currentDate->diffInDays($issueDate);
                                                $fine_amount = $differenceInDays * $setting_data->fine_amount;
                                            }

                                            ?>

                                            <tr>

                                                <td> {{ @$book->UserRequestedBook->registration_no }}</td>
                                                <td>
                                                    {{ @$book->UserRequestedBook->first_name }}
                                                </td>
                                                <td>{{ @$book->BookLocation->unique_req_number }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('book.view-book-details', ['id' => @$book->IssueBook->id]) }}">{{ @$book->IssueBook->name }}<i></i></a>
                                                </td>
                                                <td>{{ @$book->issue_date }}</td>
                                                <td>{{ \Carbon\Carbon::parse($book->issue_date)->addDay(@$setting_data->fine_days)->format('Y-m-d') }}
                                                </td>
                                                <td>{{ $differenceInDays }} Days </td>
                                                <td>₹ {{ $fine_amount }}</td>
                                                {{-- <td>

                                                    @if ($book->issue_status == 3)

                                                    @else
                                                    Returned
                                                    @endif

                                                </td> --}}
                                                <td>

                                                    @if ($book->issue_status == 3)
                                                    @else
                                                        Returned
                                                    @endif
                                                    @if ($book->issue_status == 3)
                                                        <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                            title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $book->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>



                                                    @endif
                                                </td>
                                                <div class="modal fade" id="editModal{{ $book->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Delay &
                                                                    Return Book</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"   onClick="refreshPage()"aria-label="Close" >
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Library
                                                                            Id</label>
                                                                        <input class="form-control" type="text"
                                                                            value="{{ @$book->UserRequestedBook->registration_no }}"
                                                                            id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Student
                                                                            Name</label>
                                                                        <input class="form-control" type="text"
                                                                            value=" {{ @$book->UserRequestedBook->first_name }}"
                                                                            id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Book
                                                                            Reg No</label>
                                                                        <input class="form-control" type="text"
                                                                            value="{{ @$book->BookLocation->unique_req_number }}"
                                                                            id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Phone</label>
                                                                        <input class="form-control" type="number"
                                                                            value="{{ @$book->UserRequestedBook->contact_no }}"
                                                                            id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Issue
                                                                            Date</label>
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $book->issue_date }}"
                                                                            id="">
                                                                    </div>
                                                                    <?php

                                                                    ?>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Due
                                                                            Date</label>
                                                                        <input class="form-control" type="text"
                                                                            value="{{ \Carbon\Carbon::parse($book->issue_date)->addDay(@$setting_data->fine_days)->format('Y-m-d') }}"
                                                                            id="">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Delay
                                                                            Duration</label>
                                                                        <input class="form-control" type="number"
                                                                            value="{{ $differenceInDays }}"
                                                                            id="">
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <label for=""
                                                                            class="col-form-label">Fine
                                                                            Amount (Late Return)</label>
                                                                        <input class="form-control" readonly
                                                                            type="text"
                                                                            value="{{ $fine_amount }}"
                                                                            id="">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button" class="btn custom-btn"
                                                                    onclick="saveIssue({{ @$book->id }})">Accept</button> --}}
                                                                    <button type="button" class="btn custom-btn" onclick="saveIssue({{ @$book->id }})">Accept</button>

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
        // function saveIssue(e) {

        //     var userConfirmed = confirm("You sure want to Accept this Request!");

        //     if (userConfirmed) {
        //         var book_id = e;
        //         var issue_date = $("#issue_date" + e).val()

        //         $.ajax({
        //             type: 'post',
        //             url: "{{ route('book.IssueBookReturnRequest') }}",
        //             data: {

        //                 book_id: e,
        //                 issue_date: issue_date,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function(data) {
        //                 location.reload();

        //             }
        //         });
        //     }
        // }

        function saveIssue(e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You sure want to Accept this Request!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, accept it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var book_id = e;
            var issue_date = $("#issue_date" + e).val();

            $.ajax({
                type: 'post',
                url: "{{ route('book.IssueBookReturnRequest') }}",
                data: {
                    book_id: e,
                    issue_date: issue_date,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    Swal.fire('Accepted!', 'The request has been accepted.', 'success').then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}


        function refreshPage() {
            window.location.reload();
        }
    </script>
@endsection
  