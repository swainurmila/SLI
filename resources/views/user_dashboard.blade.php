@extends('layouts.user_layout.header')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">DashBoard</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card dash-board-card1">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="total-revenue-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1 text-light"><span></span></h4>
                            <h6 class=" mb-0">Total Book</h6>
                        </div>
                        <p class="mt-3 mb-0 fw-bold">
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card dash-board-card2">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="orders-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1 text-light"><span></span></h4>
                            <h6 class="mb-0">Total Book Issue</h6>
                        </div>
                        <p class="mt-3 mb-0 fw-bold">
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card dash-board-card3">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="customers-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1 text-light"><span></span></h4>
                            <h6 class="mb-0">Total Book Returned</h6>
                        </div>
                        <p class="mt-3 mb-0 fw-bold">
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">

                <div class="card dash-board-card4">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="growth-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1 text-light"><span></span></h4>
                            <h6 class="mb-0">Book Not Returned</h6>
                        </div>

                        <p class="mt-3 mb-0 fw-bold">
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Library Details</h4>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Issue Date</th>
                                        <th>Student Name</th>
                                        <th>Contact</th>
                                        <th>Book Name</th>
                                        <th>Returned Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_data = App\Models\User::where('id',Auth::user()->id)->first();

                                    ?>

                                    @foreach ($book_list as $book)

                                    <?php
                                    // dd($book->return_date);
                                        $dateString = $book->issue_date;
                                        $dateTime = new DateTime($dateString);
                                        $formattedDate = $dateTime->format('j F, Y');
                                        $formattedDate_return='';
                                    if($book->return_date != null ){
                                        //  dd($book->return_date);
                                        $dateString_return = $book->return_date;
                                        $dateTime_return = new DateTime($dateString_return);
                                        $formattedDate_return = $dateTime->format('j F, Y');
                                        }

                                        $book_data = App\Models\Book::where('id',$book->book_id)->first();
                                        if ($book->issue_status == 0) {
                                                        $class_name = 'badge rounded-pill bg-warning-subtle text-black font-size-12';
                                                        $book_status = 'Book issue requested';
                                                    }
                                                    if ($book->issue_status == 1) {
                                                        $class_name = 'badge rounded-pill bg-info-subtle text-success font-size-12';
                                                        $book_status = 'Book request issued';
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
                                    <tr>
                                        <td>
                                            {{$formattedDate}}
                                        </td>
                                        <td>
                                            {{$user_data->first_name}}
                                        </td>
                                        <td>
                                            {{$user_data->contact_no}}
                                        </td>
                                        <td>
                                            {{$book_data->name ?? '-'}}
                                        </td>
                                        <td>
                                            {{$formattedDate_return}}
                                        </td>
                                        <td>
                                            {{-- <span class="badge rounded-pill bg-success-subtle text-success font-size-12">Returned</span> --}}
                                            <span class="{{ @$class_name }}">{{ $book_status }}</span>
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
@endsection
