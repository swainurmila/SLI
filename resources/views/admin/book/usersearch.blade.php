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
                            <li class="breadcrumb-item active text-custom-primary">User Management</li>
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
                            <h4 class="card-title mb-4">User Search</h4>
                        </div>

                        <form action="{{ route('book.usersearch') }}" method="POST" id="searchForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-label">Search Regd. No</label>
                            <div class="mb-3 row">
                                <div class="col-md-10 col-8">
                                    <input type="text" class="form-control"  name="search_value" value="{{@$bar_code}}" id="search_value" placeholder="Enter your Barcode no...">
                                    <div class="invalid-feedback">Please enter a valid registration number.</div>
                                </div>
                                <div class="col-md-2 col-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn custom-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php
                    if(isset($user_data->id)){
                        ?>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        Barcode Number : {{@$bar_code}}
                                    </div>

                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-12 col-lg-4">
                                                    <label for="" class="col-form-label">Regd No :</label>
                                                    <span id="" class="">{{@$user_data->registration_no}}</span>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                    <label for="" class="col-form-label">First Name :</label>
                                                    <span id="" class="">{{@$user_data->first_name}}</span>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                    <label for="" class="col-form-label">Last Name :</label>
                                                    <span id="" class="">{{@$user_data->last_name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">

                                            <div class="col-sm-12 col-lg-4">
                                                    <label for="" class="col-form-label">Email :</label>
                                                    <span id="" class="">{{@$user_data->email}}</span>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                    <label for="" class="col-form-label">Contact Number :</label>
                                                    <span id="" class="">{{@$user_data->contact_no}}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 table-responsive" >
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sl No
                                        </th>
                                        <th>Book Reg No</th>
                                        <th>Issue Date</th>
                                        <th>Due Date</th>

                                        <th>Return Date</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                @if(isset($book_request))

                                    <?php
                                    $i=1;
                                    ?>
                                    @foreach ($book_request as $book)
                                    <?php
                                                                        $book_location = App\Models\BookLocation::where('book_id',$book->book_id)->whereNotIn('id', function($query) {
                                                    $query->select('book_location_id')
                                                        ->from('book_requests')
                                                        ->whereIn('issue_status', [0, 1, 3])
                                                        ->whereNotNull('book_location_id');
                                                })->get();

                                    $user_data = App\Models\User::where('id',$book->user_id)->first();

                                    $book_data = App\Models\Book::where('id',$book->book_id)->first();

                                    $book_reg_data = App\Models\BookLocation::where('id',$book->book_location_id)->first();


                                    $resultDate='';
                                    $differenceInDays_th = 0;
                                    if(isset($book->issue_date)){
                                    $dateTime = new DateTime($book->issue_date);

                                    $dateTime->modify('+7 days');

                                    $resultDate = $dateTime->format('Y-m-d');
                                    // ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd



                                    $dateTime_td = new DateTime($book->issue_date);

                                    $dateTime_td->modify('+7 days');

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

                                    ?>
                                    <tr>
                                        <td >
                                            {{$i++}}
                                        </td>

                                         <td >{{@$book_reg_data->unique_req_number}}</td>
                                        <td >{{$book->issue_date}}</td>
                                        <td >{{$resultDate}}</td>
                                        <td >{{$book->return_date}}</td>

                                        <td >

                                            <?php
                                            if($book->issue_status == 1){
                                                ?>
                                                <button type="button"
                                                onclick="returnRequest({{ @$book->id }})" class="btn custom-btn">Return Request</button>

                                            <?php } ?>


                                            <?php
                                            if($book->issue_status == 0){
                                                ?>
                                            <a class="btn custom-btn btn-sm edit waves-effect waves-light" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{$book->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <?php } ?>


                                            <?php
                                            if($book->issue_status == 4){
                                                ?>
                                            <a class="btn custom-btn btn-sm edit waves-effect waves-light" title="Edit" >Returned</i>
                                            </a>
                                            <?php } ?>

                                        </td>


                                        <div class="modal fade" id="editModal{{$book->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Issue & Reject Book</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="mb-3 row">
                                                            <div class="col-sm-12 col-lg-6">
                                                                <label>
                                                                    <input type="radio" name="book_response{{$book->id}}" onClick="block_issue(this.value,{{$book->id}})"  value="1" checked> Issue
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="book_response{{$book->id}}" onClick="block_issue(this.value,{{$book->id}})" value="0"> Reject
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-sm-12 col-lg-4">
                                                                <label for="" class="col-form-label">Library Card Number</label>
                                                                <input class="form-control" type="text" value="{{$user_data->registration_no}}"  readonly id="">
                                                            </div>
                                                            <div class="col-sm-12 col-lg-4">
                                                                <label for="" class="col-form-label">Student Name</label>
                                                                <input class="form-control" type="text" readonly value="{{$user_data->first_name}}" id="">
                                                            </div>
                                                            <div class="col-sm-12 col-lg-4" id="book_reg_div{{$book->id}}">
                                                                <label for="" class="col-form-label">Book Reg No</label>
                                                                <select class="form-select form-valid" id="unique_req_number{{$book->id}}" name="unique_req_number">
                                                                    <option value="">Select</option>
                                                                    @foreach ($book_location as $reg)
                                                                        <option value="{{ @$reg->id }}">{{ @$reg->unique_req_number }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-4" id="issue_date_div{{$book->id}}">
                                                                <label for="" class="col-form-label">Issue Date</label>
                                                                <input class="form-control" type="text"  value="<?php echo date('Y-m-d') ?>" readonly id="issue_date{{$book->id}}">
                                                            </div>

                                                            <div class="col-sm-12 col-lg-4">
                                                                <label for="" class="col-form-label">Phone</label>
                                                                <input class="form-control" type="number" readonly  value="{{$user_data->contact_no}}" id="">
                                                            </div>

                                                            <div class="col-sm-12 col-lg-4" style="display: none;" id="reject_remark_div{{$book->id}}">
                                                                <label for="" class="col-form-label">Reject Remark</label>
                                                                <input class="form-control" type="text"   value="" id="reject_remark{{$book->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                        onclick="saveReject({{ @$book->id }})" class="btn btn-danger" data-bs-dismiss="modal" style="display: none;" id="reject_form{{$book->id}}">Reject</button>
                                                        <button type="button"
                                                        onclick="saveIssue({{ @$book->id }})" id="issue_form{{$book->id}}" class="btn custom-btn">Issue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
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
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        var searchValue = document.getElementById('search_value').value;
        if (searchValue.trim() === "") {
            event.preventDefault();
            document.getElementById('search_value').classList.add('is-invalid');
        } else {
            document.getElementById('search_value').classList.remove('is-invalid');
        }
    });
    </script>
<script>
   function saveIssue(e) {

        var userConfirmed = confirm("You sure want to Issue this Request!");

        if (userConfirmed) {

            var book_id = e;
            var issue_date = $("#issue_date"+e).val();
            // alert(issue_date);
            // return false;

            var unique_req_number = $("#unique_req_number"+e).val();
            if(issue_date == '' || issue_date == null){
                alert("Select issue date")
                return false;
            }
            if(unique_req_number == '' || unique_req_number == null){
                alert("Select Book Reg Number")
                return false;
            }

            // return false;

            $.ajax({
                type: 'post',
                url: "{{ route('book.issueBook') }}",
                data: {

                    book_id: e,
                    issue_date:issue_date,
                    unique_req_number:unique_req_number,

                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();

                }
            });
        }
    }

    function saveReject(e) {

        var userConfirmed = confirm("You sure want to Reject this Request!");

        if (userConfirmed) {
            // var book_id = e;
            var issue_date = $("#issue_date"+e).val()
            var reject_remark = $("#reject_remark"+e).val()

            $.ajax({
                type: 'post',
                url: "{{ route('book.rejectBook') }}",
                data: {

                    book_id: e,
                    issue_date:issue_date,
                    reject_remark:reject_remark,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();

                }
            });
        }
    }

    function returnRequest(e) {

        var userConfirmed = confirm("You sure want to request to return the book !");

        if (userConfirmed) {
            // var book_id = e;
            var issue_date = $("#issue_date"+e).val()

            $.ajax({
                type: 'post',
                url: "{{ route('book.adminBookReturnRequest') }}",
                data: {

                    book_id: e,
                    issue_date:issue_date,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();

                }
            });
        }
    }

    function block_issue(e,id) {
        var element = document.getElementById("issue_date_div"+id);

        var reject_form_element = document.getElementById("reject_form"+id);
        var issue_form_element = document.getElementById("issue_form"+id);
        var book_reg_div_element = document.getElementById("book_reg_div"+id);

        var reject_remark_div = document.getElementById("reject_remark_div"+id);



        if(e == 0){
            book_reg_div_element.style.display = "none";
            element.style.display = "none";
            reject_remark_div.style.display = "block";

            reject_form_element.style.display = "block";

            issue_form_element.style.display = "none";
        }else{
            book_reg_div_element.style.display = "block";
            element.style.display = "block";
            reject_form_element.style.display = "none";

            reject_remark_div.style.display = "none";

            issue_form_element.style.display = "block";
        }

    }

    function returnRequest(e) {

        var userConfirmed = confirm("You sure want to request to return the book !");

        if (userConfirmed) {
            // var book_id = e;
            var issue_date = $("#issue_date"+e).val()

            $.ajax({
                type: 'post',
                url: "{{ route('book.adminBookReturnRequest') }}",
                data: {

                    book_id: e,
                    issue_date:issue_date,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();

                }
            });
        }
    }

</script>
@endsection
