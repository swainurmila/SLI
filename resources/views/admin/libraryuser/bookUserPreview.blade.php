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
                        <h4 class="mb-0">Book Details</h4>
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
                                                    @foreach ($book_images as $image)
                                                        <?php
                                                        $j++;
                                                        $image_parth = @$image->file_name;
                                                        ?>

                                                        @if ($j == 1)
                                                            <a class="nav-link active" id="product-{{ $image->id }}-tab"
                                                                data-bs-toggle="pill" href="#product-{{ $image->id }}"
                                                                role="tab">
                                                                <img src="{{ asset(@$image_parth) }}" alt=""
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
                                                    @foreach ($book_images as $image)
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
                                        <h3>{{ $book_data->name }}</h3>


                                    </div>
                                    <?php

                                    $book_tec = App\Models\CategoryMaster::where('id', $book_data->category_id)->first();
                                    ?>



                                    <h5 class="mt-4 pt-2"><span
                                            class="text-danger font-size-26">{{ @$book_tec->name }}</span></h5>

                                    <h4 class="font-size-18 mb-3">Book Description:</h4>


                                    <p class="mt-4 text-muted">{{ @$book_data->book_description }}</p>
                                    <h5> Book Registration Number:</h5>

                                    @foreach ($uniqueBookNumbers as $bookNumber)
                                        {{ $bookNumber->unique_req_number }}
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">

                                                <h5 class="font-size-14">Author :{{ @$book_data->author }}</h5>

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <h5 class="font-size-14">Edition :{{ @$book_data->edition }}</h5>

                                                <?php

                                                $book_request_count = App\Models\BookRequest::where('book_id', $book_data->id)
                                                    ->whereIn('issue_status', [0, 1, 3])
                                                    ->count();

                                                $book_request_issue_count = App\Models\BookRequest::where('book_id', $book_data->id)
                                                    ->where('user_id', Auth::user()->id)
                                                    ->whereIn('issue_status', [1, 3])
                                                    ->orderBy('id', 'desc')
                                                    ->count();

                                                //   dd($book->quantity);
                                                $book_status = 'Reserve';
                                                if (isset($book_data->bookRequest->id)) {
                                                    $book_status = 'Reserved';
                                                }

                                                if ($book_request_issue_count > 0) {
                                                    $book_status = 'Issued';
                                                }
                                                if ($book_status != 'Reserved') {
                                                    if ($book_request_count >= $book_data->quantity) {
                                                        $book_status = 'Out of Stock';
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>

                                        <button type="button"
                                            @if ($book_status != 'Out of Stock' && $book_status != 'Issued' && $book_status != 'Reserved') onclick="requestbook({{ @$book_data->id }})" @endif
                                            class="btn btn-info waves-effect waves-light">{{ $book_status }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection
<script>
    function requestbook(e) {

        var userConfirmed = confirm("You sure want to Reserve this Book!");

        if (userConfirmed) {
            // var book_id = e;


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
        } else {

        }
    }
</script>
