@extends('layouts.user_layout.header')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Request Reserve</h4>
                        {{-- <div class="page-title-right">
                            <a href="" class="btn btn-primary btn-sm">Go to Back<i class="uil-arrow-circle-left text-white font-size-18 ms-2"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="mt-3 table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Book Name</th>
                                            <th>Book Author</th>
                                            <th>Book Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach ($book_list as $book)
                                            <?php

                                            $user_data = App\Models\User::where('id', $book->user_id)->first();

                                            $setting_data = App\Models\MasterSetting::first();
                                            $book_data = App\Models\Book::where('id', $book->book_id)->first();
                                            $resultDate = '';
                                            $differenceInDays = 0;
                                            $fine_amount = 0;
                                            // dd($book->issue_date);
                                            if (isset($book->issue_date)) {
                                                $dateTime = new DateTime($book->issue_date);

                                                $dateTime->modify('+7 days');

                                                $resultDate = $dateTime->format('Y-m-d');

                                                $currentDate = new DateTime();

                                                if ($currentDate > $dateTime) {
                                                    // Calculate the difference in days
                                                    $interval = $currentDate->diff($dateTime);
                                                    $differenceInDays = $interval->format('%a');
                                                    $fine_amount = $differenceInDays * $setting_data->fine_amount;
                                                }
                                            }

                                            $book_reg_data = App\Models\BookLocation::where('id', $book->book_location_id)->first();

                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                </td>

                                                <td>
                                                    @if ($book_data)
                                                    <a href="{{ route('library.bookUserPreview', ['id' => $book_data->id]) }}">{{ $book_data->name }}<i></i></a>
                                                @else
                                                    Book data not found
                                                @endif
                                                </td>
                                                <td>{{ $book_data->author ?? '-'}}</td>
                                                <td>{{ date('d-m-Y', strtotime(@$book->created_at)) }}</td>

                                                <td>
                                                    <?php
                                                    if ($book->issue_status == 0) {
                                                        $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                        $book_status = 'Book issue requested';
                                                    }
                                                    if ($book->issue_status == 1) {
                                                        $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                        $book_status = 'Book request issued';
                                                    }
                                                    if ($book->issue_status == 2) {
                                                        $class_name = 'badge rounded-pill bg-danger-subtle text-danger font-size-12';
                                                        $book_status = 'Book request rejected';
                                                    }
                                                    if ($book->issue_status == 3) {
                                                        $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                        $book_status = 'Book return requested';
                                                    }
                                                    if ($book->issue_status == 4) {
                                                        $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                        $book_status = 'Book returned';
                                                    }

                                                    ?>
                                                    <span class="{{ @$class_name }}">{{ $book_status }}</span>

                                                </td>
                                                <td>
                                                    @if ($book->issue_status == 1)
                                                        @if ($fine_amount == 0)
                                                            <button type="button"
                                                                onclick="returnRequest({{ @$book->id }})"
                                                                class="btn btn-info btn-sm edit waves-effect waves-light">Return
                                                                Request</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-info btn-sm edit waves-effect waves-light" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $book->id }}">Pay & Return</button>
                                                        @endif
                                                    @endif
                                                    <a href="{{ route('library.bookRequestPreview', ['id' => $book->id]) }}"
                                                        class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <div class="modal fade" id="editModal{{ $book->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered"
                                                        role="document">
                                                        <form action="{{route("library.fine-payment")}}" method="POST">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Pay Fine</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3 row">
                                                                        <input type="hidden" value="{{ $book->id }}" name="book_request_id">
                                                                        <input type="hidden" value="{{ $book->book_id }}" name="book_id">
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <label for=""
                                                                                class="col-form-label">Delay Duration</label>
                                                                            <input class="form-control" type="text"
                                                                                value="{{ $differenceInDays }} Day's"
                                                                                readonly id="">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6">
                                                                            <label for=""
                                                                                class="col-form-label">Fine Amount</label>
                                                                            <input class="form-control" type="text"
                                                                                readonly value="{{ $fine_amount }}"
                                                                                id="" name="amount">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        id="issue_form{{ $book->id }}"
                                                                        class="btn btn-success">Pay</button>
                                                                </div>
                                                            </div>
                                                        </form>

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
        </div> <!-- container-fluid -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function returnRequest(e) {

            var userConfirmed = confirm("You sure want to Return this Book!");

            if (userConfirmed) {
                // var book_id = e;

                $.ajax({
                    type: 'post',
                    url: "{{ route('library.returnbookRequest') }}",
                    data: {
                        book_request_id: e,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        location.reload();

                    }
                });
            } else {

            }
        }
    </script>
@endsection
