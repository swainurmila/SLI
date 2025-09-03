@extends('layouts.user_layout.header')
@section('content')
    <style>
        .out-of-stock {
            filter: blur(5px);
        }
        .font-weight-bold {
    font-weight: bold;
}

/* Additional styling to improve the appearance */
.col-form-label {
    margin-bottom: 5px; /* Adjust spacing between label and span */
    display: block; /* Ensure label and span are displayed as block elements */
}

.form-control-plaintext {
    padding-top: 7px; /* Adjust spacing for consistency */
    padding-bottom: 7px; /* Adjust spacing for consistency */
    border: none; /* Remove border */
    background-color: transparent; /* Make background transparent */
    line-height: 1.5; /* Improve line height for readability */
    color: #333; /* Set text color */
}



    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Book Status</li>
                                <li class="breadcrumb-item active text-custom-primary">Book Status Preview</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm">Go to Back<i
                                    class="uil-arrow-circle-left text-white font-size-18 ms-2"></i></a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><b></b></h5>


                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="name" class="col-form-label font-weight-bold">Name Of The Book</label>
                                    <a href="{{ route('library.bookUserPreview', ['id' => $book_data->id]) }}">
                                        <span class="form-control-plaintext" id="name">{{ $book_data->name }}</span>
                                    </a>
                                </div>


                                <div class="col-sm-12 col-lg-4">
                                    <label for="name" class="col-form-label font-weight-bold">Author</label>
                                    <span class="form-control-plaintext" id="name">{{ @$book_data->author }}</span>
                                </div>

                                <div class="col-sm-12 col-lg-4">
                                    <label for="name" class="col-form-label font-weight-bold">Publisher</label>
                                    <span class="form-control-plaintext" id="name">{{ @$book_data->publisher }}</span>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="name" class="col-form-label font-weight-bold">Edition</label>
                                    <span class="form-control-plaintext" id="name">{{ @$book_data->edition }}</span>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="name" class="col-form-label font-weight-bold">Publish Year</label>
                                    <span class="form-control-plaintext" id="name">{{ @$book_data->publish_year }}</span>
                                </div>


                                <div class="col-sm-12 col-lg-4">
                                    <label for="name" class="col-form-label font-weight-bold">Book Instruction</label>
                                    <span class="form-control-plaintext" id="name">{{ @$book_data->book_instruction }}</span>
                                </div>


                                <div class="col-sm-12">
                                    <label for="name" class="col-form-label font-weight-bold">Book Description</label>
                                    <span class="form-control-plaintext" id="name">{{ @$book_data->book_description }}</span>
                                </div>

                            </div>

                            @if ($book->issue_status != 2 && $book->issue_status != 0)
                                <div id="">
                                    <h5 class="text-decoration-underline text-custom-primary">Issue/Return Status</h5>

                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                        <tr class="">

                                                            <th>Book Reg No</th>
                                                            <th>Issue Date</th>
                                                            <th>Due Date</th>

                                                            <th>Delay Duration</th>
                                                            <th>Fine Amount (Late Return)</th>

                                                            <th>Return Date</th>

                                                            <th>Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
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

                                                            <td>{{ @$book_reg_data->unique_req_number }}</td>
                                                            <td>{{ $book->issue_date }}</td>
                                                            <td>{{ $resultDate }}</td>
                                                            <td>
                                                                @if ($book->issue_status != 2)
                                                                    {{ @$differenceInDays }} Day's
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($book->issue_status != 2)
                                                                    ₹ {{ @$fine_amount }}
                                                                @endif
                                                            </td>
                                                            <td>{{ @$book->return_date }}</td>
                                                            <td>
                                                                <?php
                                                                if ($book->issue_status == 0) {
                                                                    $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                                    $book_status = 'Book issue requested';
                                                                }
                                                                if ($book->issue_status == 1) {
                                                                    $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                                    $book_status = 'Issued';
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
                                                                <span
                                                                    class="{{ @$class_name }}">{{ $book_status }}</span>

                                                            </td>


                                                        </tr>

                                                    </tbody>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($book->issue_status != 1 && $book->issue_status != 1 )
                            <div id="">
                                <h5 class="text-decoration-underline text-custom-primary">Issue Status</h5>

                                <div class="row my-4">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr class="">

                                                        <th>Book Reg No</th>
                                                        <th>Issue Date</th>
                                                        <th>Due Date</th>

                                                        <th>Delay Duration</th>
                                                        <th>Fine Amount (Late Return)</th>

                                                        <th>Return Date</th>

                                                        <th>Status</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
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

                                                        <td>{{ @$book_reg_data->unique_req_number }}</td>
                                                        <td>{{ $book->issue_date }}</td>
                                                        <td>{{ $resultDate }}</td>
                                                        <td>
                                                            @if ($book->issue_status != 2)
                                                                {{ @$differenceInDays }} Day's
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($book->issue_status != 2)
                                                                ₹ {{ @$fine_amount }}
                                                            @endif
                                                        </td>
                                                        <td>{{ @$book->return_date }}</td>
                                                        <td>
                                                            <?php
                                                            if ($book->issue_status == 0) {
                                                                $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                                $book_status = 'Book issue requested';
                                                            }
                                                            if ($book->issue_status == 1) {
                                                                $class_name = 'badge rounded-pill bg-success-subtle text-success font-size-12';
                                                                $book_status = 'Issued';
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
                                                            <span
                                                                class="{{ @$class_name }}">{{ $book_status }}</span>

                                                        </td>


                                                    </tr>

                                                </tbody>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            @if ($book->issue_status == 2)
                                <div id="">
                                    <h5 class="text-decoration-underline text-custom-primary">Reject Status</h5>

                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                        <tr class="">

                                                            <th>Reject Date</th>

                                                            <th>Reject Remark</th>


                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php

                                                        $book_reg_data = App\Models\BookLocation::where('id', $book->book_location_id)->first();

                                                        ?>
                                                        <tr>

                                                            <td>{{ @$book->reject_date }}</td>
                                                            <td>{{ @$book->reject_remark }}</td>
                                                        </tr>

                                                    </tbody>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->

    @endsection
