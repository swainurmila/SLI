@extends('course.layouts.user.main')

@section('styles')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }

        .my-active span {
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }

        ul.pager>li {
            display: inline-flex;
            padding: 5px;
        }

        .pager {
            text-align: center
        }


        ul.pager {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        ul.pager li {
            display: inline-block;
            margin-right: 5px;
        }

        ul.pager li a,
        ul.pager li span {
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ddd;
            background-color: #ff8283;
            cursor: pointer;
            border-radius: 20px;
        }

        ul.pager li.active span {
            background-color: #337ab7;
            color: #fff;
        }

        ul.pager li.disabled span,
        ul.pager li.disabled a {
            background-color: #ff8283;
            color: #fff;
            cursor: not-allowed;
        }

        ul.pager li a:hover {
            background-color: #000;
        }

        /* Accordion */
        .w3-black,
        .w3-hover-black:hover {
            color: #200202 !important;
            background-color: #b6f6cf !important;
        }

        /* .product-detail-tab {
                        color: #000;
                        overflow: hidden;
                        padding: 30px 0 60px;
                        font: 300 16px / 21px "Source Sans Pro", sans-serif;
                    }  */
        .w3-black {
            color: #200202 !important;
            background-color: #ffffff !important;
            border: 1px solid #dcdcdc;
            margin-buttom: 8px;
            padding: 15px 17px;
            margin-bottom: 18px;
            font-size: 18px;
            font-weight: 600;
        }

        .w3-black:active {
            color: #cb0c0c !important;
            background-color: #bff4e0 !important;
            border: 1px solid #06dcc7;
            margin-bottom: 8px;
            padding: 15px 17px;
            margin-bottom: 18px;
            font-size: 18px;
            font-weight: 600;
        }

        .w3-button:hover {
            color: #cb0c0c !important;
            background-color: #bff4e0 !important;
            border: 1px solid #06dcc7;
            margin-bottom: 8px;
            padding: 15px 17px;
            margin-bottom: 7px;
            font-size: 18px;
            font-weight: 600;
        }

        .w3-border {
            color: #000 !important;
            border: 1px solid #ccc !important;
            margin-bottom: 5px;
            margin-left: 35px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid" style="background: #000;">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4 class="" style="color: #000"><b>Course Details</b></h4>
            </div>
        </div>
    </div>
    <main id="mt-main">
        <!-- Mt Product Detial of the Page -->
        <section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row" style="padding-top: 30px;">
                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <!-- Slider of the Page -->
                        <div class="" style="max-height: 480px; height:100vh">
                            @if (@$courseDetails['course_image'])
                                <img src="{{ asset(@$courseDetails['course_image']) }}" alt="image"
                                    style="object-fit: cover; object-position:center;">
                            @else
                                <img src="{{ asset('assets/images/dummy-img.jpg') }}" alt="image"
                                    style="object-fit: cover; object-position:center;">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12">
                        <!-- Slider of the Page end -->
                        <!-- Detail Holder of the Page -->
                        <div class="">
                            <h2><b>{{ @$courseDetails->course_name }}</b></h2>
                            <!-- Rank Rating of the Page -->
                            <ul class="d-flex list-unstyled justify-content-between my-4" style="display: flex;">
                                <li>
                                    <a href="#">
                                        <span class="badge text-bg-danger">{{ @$courseDetails->Category->name }}</span>
                                    </a>
                                </li>

                                {{-- @if (!$courseDetails->TrainingClasses->isEmpty())
                                    <li><i class="fa fa-book text-danger" aria-hidden="true"></i><span> Class</span>
                                        <span>({{ $Category->TrainingClasses->count() }})</span></li>
                                @else
                                    <li><i class="fa fa-book text-danger"></i><span> Not Assigned</span></li>
                                @endif --}}
                                <li class="rank-rating mb-0" style="margin-left:40px;">
                                    <ul class="list-unstyled rating-list">
                                        @for ($i = 1; $i <= $roundedAverageRating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75"
                                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path fill="#FFD43B"
                                                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>
                                        @endfor
                                        <li class="ps-2">Rating ( {{ count(@$reviews) }} )</li>
                                    </ul>
                                </li>

                            </ul>
                            <div class="txt-wrap">
                                <p>{!! @$courseDetails->course_description !!}</p>
                            </div>

                            <div class="text-holder">
                                <span class="price">₹ {{ number_format(@$courseDetails->course_price, 2, '.', ',') }}
                                    {{-- <del>5,999.00</del></span> --}}
                            </div>


                            <!-- Product Form of the Page -->
                            {{-- @if (@$training_deatils->TrainingCategory->trainingEnrollment->enrollment_end_date > Carbon\Carbon::today()->format('Y-m-d')) --}}
                            <div class="product-details-btn">
                                @if (@$courseDetails->CourseCart->enroll_status == 'completed')
                                    <div class="row-val product-form">
                                        <button
                                            onclick="window.location.href='{{ route('user.course.checkout', @$courseDetails['id']) }}'">Enrolled</button>
                                    </div>
                                @else
                                    <div class="row-val product-form d-flex" style="display: flex">
                                        @if (@$courseDetails->CourseCart)
                                            <button onclick="window.location.href='{{ route('user.course.showCart') }}'">GO
                                                TO
                                                CART</button>
                                        @else
                                            <button class="ms-4"
                                                onclick="window.location.href='{{ route('user.course.details.addCart', ['id' => $courseDetails->id]) }}'"
                                                type="submit">ADD TO CART</button>
                                        @endif

                                        <button class="ms-4 bg-dark" style="background: #000; color: #fff; margin-left:8px;"
                                            onclick="window.location.href='{{ route('user.course.checkout', @$courseDetails->id) }}'">Enroll
                                            Now</button>
                                    </div>
                                @endif
                            </div>
                            {{-- @endif --}}
                            <!-- Product Form of the Page end -->
                        </div>
                        <!-- Detail Holder of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Product Detial of the Page end -->

        <div class="product-detail-tab wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="mt-tabs text-center text-uppercase">
                            <li><a href="#tab1" class="active">COURSE DETAILS</a></li>
                            <li><a href="#tab2">SYLLABUS</a></li>
                            <li><a href="#tab3">REVIEWS ( {{ count(@$reviews) }} )</a></li>

                        </ul>
                        <div class="tab-content">
                            <div id="tab1">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-3">Start Date :</dt>
                                                <dd class="col-sm-9">
                                                    {{ Carbon\Carbon::parse(@$courseDetails->course_start_date)->toFormattedDateString() }}
                                                </dd>
                                            </dl>

                                            <dl class="row">
                                                <dt class="col-sm-3">End Date :</dt>
                                                <dd class="col-sm-9">
                                                    {{ Carbon\Carbon::parse(@$courseDetails->course_end_date)->toFormattedDateString() }}
                                                </dd>
                                            </dl>

                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-3">Language :</dt>
                                                <dd class="col-sm-9">{{ @$courseDetails->Language->name }}</dd>
                                            </dl>

                                            <dl class="row">
                                                <dt class="col-sm-3">Enrolled :</dt>
                                                <dd class="col-sm-9">{{ count(@$courseDetails->CourseEnrolled) }}</dd>
                                            </dl>
                                        </div>

                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-3">Certificate :</dt>
                                                <dd class="col-sm-9">
                                                    {{ @$courseDetails->certificate_type == 'with' ? 'Yes' : 'No' }} </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab2">
                                <div id="tab2">
                                    @if($courseDetails->Syllabus->isNotEmpty() )

                                        @php
                                            $index = 0;
                                        @endphp
                                        @foreach ($courseDetails->Syllabus as $key => $value)
                                            @php
                                                $index++;
                                            @endphp
                                            <button onclick="myFunction('Demo{{ $index }}')"
                                                class="w3-button w3-block w3-black w3-left-align">
                                                {{ $index }}. {{ $value->syllabus_title }}
                                            </button>
                                            {{-- {{dd($courseDetails->CourseCart->enroll_status)}} --}}
                                            @if ($courseDetails->CourseCart && $courseDetails->CourseCart->enroll_status == 'completed')
                                                <div id="Demo{{ $index }}" class="w3-hide w3-border">
                                                    <ul class="w3-ul">
                                                        @foreach ($value->Class as $subKey => $class)
                                                            <li class="DemoChild"><strong>{{ ++$subKey }}.
                                                                    {{ $class->class_name }}</strong></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                        @else
                                        <h5 class="text-center"><b>The Syllabus Has Not Been Created Yet!!</b></h5>
                                        @endif
                                </div>


                            </div>

                            <div id="tab3">
                                <div class="product-comment">

                                    @if (!$reviews->isEmpty())
                                        @foreach ($reviews as $review)
                                            <div class="mt-box">
                                                <div class="mt-hold">
                                                    <span>
                                                        @for ($i = 1; $i <= $review->rating; $i++)
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="14"
                                                                width="15.75"
                                                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                <path fill="#FFD43B"
                                                                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                                            </svg>
                                                        @endfor
                                                    </span>
                                                    <span class="name">{{ @$review->userDetails->first_name }}</span>
                                                    <time
                                                        datetime="2016-01-01">{{ Carbon\Carbon::parse(@$review->created_at)->format('M d, Y') }}</time>
                                                </div>
                                                <p>{{ @$review->feedback }}</p>
                                            </div>
                                        @endforeach

                                        @if ($reviews->hasPages())
                                            <ul class="pager">
                                                @if ($reviews->onFirstPage())
                                                    <li class="disabled"><span>← Previous</span></li>
                                                @else
                                                    <li><a href="{{ $reviews->previousPageUrl() }}" rel="prev">←
                                                            Previous</a></li>
                                                @endif
                                                @foreach ($reviews as $element)
                                                    @if (is_string($element))
                                                        <li class="disabled"><span>{{ $element }}</span></li>
                                                    @endif
                                                    @if (is_array($element))
                                                        @foreach ($element as $page => $url)
                                                            @if ($page == $reviews->currentPage())
                                                                <li class="active my-active">
                                                                    <span>{{ $page }}</span>
                                                                </li>
                                                            @else
                                                                <li><a href="{{ $url }}">{{ $page }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                @if ($reviews->hasMorePages())
                                                    <li><a href="{{ $reviews->nextPageUrl() }}" rel="next">Next →</a>
                                                    </li>
                                                @else
                                                    <li class="disabled"><span>Next →</span></li>
                                                @endif
                                            </ul>
                                        @endif
                                    @else
                                        <p class="text-center">No Reviews Found !</p>
                                    @endif

                                    @if (@$isEnrolled)
                                        <form action="{{ route('user.course.review.store', @$courseDetails->id) }}"
                                            method="POST" class="p-commentform">
                                            @csrf
                                            <x-review-form />
                                            <button type="submit" class="btn-type4">ADD REVIEW</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- related products Start here -->
        @if (count($related_trainings) > 0)
            <div class="related-products p-0 m-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>RELATED COURSE</h2>
                            <div class="row" style="display: flex;">
                                @foreach ($related_trainings as $related_training)
                                    <div class="col-md-3 col-lg-3 col-sm-12">
                                        <div class=""
                                            style="background: #fff; border: 1px solid #ccc;">
                                            <a href="{{ route('user.course.details', @$related_training->id) }}">
                                                @if (@$related_training->course_image)
                                                    <img style="height: 150px"
                                                        src="{{ asset(@$related_training['course_image']) }}"
                                                        class="card-img-top" alt="Course-image">
                                                @else
                                                    <img src="{{ asset('assets/images/dummy-img.jpg') }}"
                                                        alt="Course-image" style="height: 100%" class="img-box-vh">
                                                @endif
                                            </a>
                                            <div class="panel-body" style="padding: 10px;">
                                                <ul class="d-flex list-unstyled justify-content-between"
                                                    style="display:flex;">
                                                    <li>

                                                        {{-- @if (!$related_training->TrainingClasses->isEmpty())
                                                            <i class="fa fa-book text-primary"></i>
                                                            {{ $related_training->TrainingClasses->count() }} Class
                                                        @else
                                                            <i class="fa fa-book text-primary"></i> Not Assigned
                                                        @endif --}}
                                                    </li>
                                                    <li style="margin-left:30px;">
                                                        @if (@$related_training->training_duration && @$related_training->training_duration_type)
                                                            <i class="fa fa-clock-o text-warning" aria-hidden="true"></i>
                                                            {{ @$related_training->training_duration }}
                                                            {{ @$related_training->training_duration_type }}
                                                        @endif
                                                    </li>
                                                </ul>
                                                <h4 class=""><a
                                                        href="{{ route('user.course.details', @$related_training->id) }}"
                                                        style="color: #000">{{ $related_training->course_name }}</a></h4>
                                                @if (@$related_training->course_price == 0 || @$related_training->course_price == '')
                                                    <h5 class="">Free</h5>
                                                @else
                                                    <h5 class="">₹
                                                        {{ number_format(@$related_training->course_price, 2, '.', ',') }}
                                                    </h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            
        <!-- related products End here -->
    </main>


@endsection


@section('script')
    <script>
        $(document).ready(function() {

            $("#myBtn").click(function() {
                $('.toast').toast('show');
            });
            $('.p-commentform').submit(function(event) {
                // Prevent the form from submitting normally
                event.preventDefault();

                // Reset previous error messages
                $('.error-message').remove();

                // Validation
                var rating = $('input[name="rate"]:checked').val();
                var reviewText = $('textarea[name="feedback"]').val();

                if (!rating) {
                    $('#review-error').html('<span class="error-message">Please select a rating.</span>');
                    return;
                }

                if (!reviewText.trim()) {
                    $('#review-error').html('<span class="error-message">Please enter your review.</span>');
                    return;
                }

                // If all validation passes, submit the form
                $('.p-commentform')[0].submit();
            });
        });
    </script>
    <script>
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
@endsection
