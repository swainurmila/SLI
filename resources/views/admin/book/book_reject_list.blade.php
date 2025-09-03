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
                                <li class="breadcrumb-item active text-custom-primary">Reject Report</li>
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
                                <h4 class="card-title mb-4">Reject</h4>
                            </div>
                            <div class="mt-3 table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Library Id
                                            </th>
                                            <th>Student Name
                                            </th>
                                            <th>Book Name
                                            </th>

                                            <th>Reject Date</th>
                                            <th>Reject Remark</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach ($book_request as $book)
                                            <?php
                                            $setting_data = App\Models\MasterSetting::first();
                                            $user_data = App\Models\User::where('id', $book->user_id)->first();
                                            $book_data = App\Models\Book::where('id', $book->book_id)->first();
                                            
                                            ?>

                                            <tr>

                                                <td> {{ $user_data->registration_no }}</td>
                                                <td>
                                                    {{ $user_data->first_name }}
                                                </td>
                                                <td>
                                                    {{ $book_data->name }}
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime(@$book->reject_date)) }}</td>
                                                <td>
                                                    {{ $book->reject_remark }}
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


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function saveIssue(e) {

            var userConfirmed = confirm("You sure want to Accept this Request!");

            if (userConfirmed) {
                var book_id = e;
                var issue_date = $("#issue_date" + e).val()

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
                        location.reload();

                    }
                });
            }
        }
    </script>
@endsection
