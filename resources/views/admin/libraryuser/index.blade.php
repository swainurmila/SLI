@extends('layouts.user_layout.header')
@section('content')
    <style>
        .out-of-stock {
            filter: blur(5px);
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <?php

                        ?>
                        <h4 class="mb-0">{{ @$cat_list->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                    <div class="col-12">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Book Lists</h4>
                                        </div>
                                    </div>

                                <form action="{{ route('library.indexsearch') }}" method="POST" id="searchForm"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $id }}" name="cat_value" id="cat_value">
                                    <label>Search:<input type="search" name="search_value" id="search_value"
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="datatable"></label>
                                </form>
                                {{-- {{dd($book_list )}} --}}
                                @foreach ($book_list as $book)
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="product-box">
                                            <div class="product-img">
                                                <?php

                                                $book_request_count = App\Models\BookRequest::where('book_id', $book->id)
                                                    ->whereIn('issue_status', [0, 1, 3])
                                                    ->count();

                                                $book_request_issue_count = App\Models\BookRequest::where('book_id', $book->id)
                                                    ->where('user_id', Auth::user()->id)
                                                    ->whereIn('issue_status', [1, 3])
                                                    ->orderBy('id', 'desc')
                                                    ->count();

                                                //   dd($book->quantity);
                                                $book_status = 'Reserve';
                                                if (isset($book->bookRequest->id)) {
                                                    $book_status = 'Reserved';
                                                }

                                                if ($book_request_issue_count > 0) {
                                                    $book_status = 'Issued';
                                                }
                                                if ($book_status != 'Reserved') {
                                                    if ($book_request_count >= $book->quantity) {
                                                        $book_status = 'Out of Stock';
                                                    }
                                                }

                                                $image_parth = @$book->image->file_name;

                                                ?>
                                                <img src="{{ asset(@$image_parth) }}" alt=""
                                                    class="img-fluid{{ $book_status === 'Out of Stock' ? ' out-of-stock' : '' }}">
                                            </div>

                                            <div class="text-center p-3">
                                                <h5 class="mb-1"> <a
                                                        href="{{ route('library.bookUserPreview', ['id' => $book->id]) }}">{{ $book->name }}<i></i></a>
                                                </h5>
                                                <button type="button"
                                                    @if ($book_status != 'Out of Stock' && $book_status != 'Issued' && $book_status != 'Reserved') onclick="requestbook({{ @$book->id }})" @endif
                                                    class="btn btn-info waves-effect waves-light">{{ $book_status }}</button>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <div class="row mt-4">

                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-end">
                                        <ul class="pagination pagination-rounded mb-sm-0">
                                            @if ($book_list->lastPage() > 1)
                                                @for ($i = 1; $i <= $book_list->lastPage(); $i++)
                                                    <a class="{{ $i == $book_list->currentPage() ? 'active' : '' }}"
                                                        href="{{ $book_list->url($i) }}">{{ $i }}</a>
                                                    @if ($i < $book_list->lastPage())
                                                        <span class="pagination-space"> </span> {{-- Add a space between page numbers --}}
                                                    @endif
                                                @endfor
                                            @endif


                                            {{ $book_list->onEachSide(1)->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // function requestbook(e) {

        //     var userConfirmed = confirm("You sure want to Reserve this Book!");

        //     if (userConfirmed) {
        //         // var book_id = e;


        //         $.ajax({
        //             type: 'post',
        //             url: "{{ route('library.bookRequest') }}",
        //             data: {

        //                 book_id: e,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function(data) {
        //                 location.reload();

        //             }
        //         });
        //     } else {

        //     }
        // }

        function requestbook(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You sure want to Reserve this Book!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reserve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: 'post',
                    url: "{{ route('library.bookRequest') }}",
                    data: {

                        book_id: e,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        location.reload();

                    }
                });
                }
            })
        }

        $(document).ready(function() {
            $('#search_value').keypress(function(e) {
                if (e.which === 13) {
                    // Enter key pressed
                    $('#searchForm').submit();
                }
            });
        });
    </script>
@endsection
