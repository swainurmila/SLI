@extends('training.layouts.user-page-layouts.main')

@section('styles')
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
        .my-active span{
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }
        
        ul.pager>li {
            display: inline-flex;
            padding: 5px;
        }
        .pager{
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
    </style>
@endsection
@section('content')
    <main id="mt-main">
        <!-- Mt Product Detial of the Page -->
        <section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row" style="padding-top: 70px;">
                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <!-- Slider of the Page -->
                        <div class="training-details-imgbox">

                            @if (@$training_deatils->TrainingImage)
                                
                                <img src="{{ asset('public/upload/training/training_image/' . @$training_deatils->TrainingImage->file_name) }}" alt="image" class="img-fluid">
                            @else
                                <img src="{{ asset('assets/images/dummy-img.jpg') }}" alt="image" class="img-fluid">
                                
                            @endif

                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12">
                        <!-- Slider of the Page end -->
                        <!-- Detail Holder of the Page -->
                        <div class="traing-details-content">
                            <h2>{{ @$training_deatils->name }}</h2>
                            <!-- Rank Rating of the Page -->
                            {{-- <div class="category-rating-sec">
                                <span class="category-name">{{@$training_deatils->TrainingCategory->name}}</span>
                                <span class="training-class-nm">
                                    @if (!$training_deatils->TrainingClasses->isEmpty())
                                        <span>({{$training_deatils->TrainingClasses->count()}})</span>
                                    @else
                                        <span>Not Assigned</span>
                                </span>
                                <span class="rating-count-training">
                                    @for ($i = 1; $i <= $roundedAverageRating; $i++)
                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                    @endfor
                                        <span class="">Rating ({{count(@$reviews)}})</span> 
                                </span>   
                            </div> --}}
                            <ul class="list-unstyled" style="display: flex;">
                                <li>
                                    <a href="#">
                                        <span class="badge-category">{{@$training_deatils->TrainingCategory->name}}</span>
                                    </a>
                                </li>

                                @if (!$training_deatils->TrainingClasses->isEmpty())
                                    <li><span class="training-class-badge"><i class="fa fa-book" aria-hidden="true"></i><span> Class</span> <span>({{$training_deatils->TrainingClasses->count()}})</span></span></li>
                                @else
                                    <li><span class="training-class-badge"><i class="fa fa-book"></i><span> Not Assigned</span></span></li>


                                @endif
                            </ul>
                            <div class="rank-rating">
                                <ul class="list-unstyled rating-list">
                                    @for ($i = 1; $i <= $roundedAverageRating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                    @endfor
                                    <li class="">Rating ({{count(@$reviews)}})</li>
                                </ul>
                            </div>
                            <div class="txt-wrap">
                                <p>{!! @$training_deatils->description !!}</p>
                            </div>
                            <div class="text-holder">
                                <span class="price">₹ {{ number_format(@$training_deatils->price, 2, '.', ',') }}
                                    {{-- <del>5,999.00</del></span> --}}
                            </div>

                            
                            <!-- Product Form of the Page -->
                            {{-- @if (@$training_deatils->TrainingCategory->trainingEnrollment->enrollment_end_date > Carbon\Carbon::today()->format('Y-m-d')) --}}
                            @if (@$training_deatils->enroll_end_date >= Carbon\Carbon::today()->format('Y-m-d') && @$training_deatils->enroll_start_date <= Carbon\Carbon::today()->format('Y-m-d'))
                            
                            <div class="product-details-btn">
                                {{-- @if (Carbon\Carbon::today()->format('Y-m-d') <= @$training_deatils->enroll_end_date && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >= Carbon\Carbon::parse(@$training_deatils->enroll_start_date)->format('Y-m-d') &&
                                Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <= Carbon\Carbon::parse(@$training_deatils->enroll_end_date)->format('Y-m-d')) --}}

                                @if (@$training_order->batch_id && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >= Carbon\Carbon::parse(@$training_deatils->enroll_start_date)->format('Y-m-d') &&
                                Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <= Carbon\Carbon::parse(@$training_deatils->enroll_end_date)->format('Y-m-d'))
                                    <fieldset>
                                        <div class="row-val product-form">
                                            <button
                                                onclick="window.location.href='{{ route('training-user.enroll', @$training_deatils->id) }}'">Enrolled</button>
                                        </div>
                                    </fieldset>
                                @else
                                <div class="row-val product-form d-flex" style="display: flex">
                                    @if (@$training_deatils->TrainingCart)
                                            <button onclick="window.location.href='{{ route('training-user.cart') }}'">GO TO
                                                CART</button>
                                    @else
                                            <button class="ms-4"
                                                    onclick="window.location.href='{{ route('training-user.add-cart', ['id' => $training_deatils->id]) }}'"
                                                    type="submit">ADD TO CART</button>
                                    @endif

                                            <button class="ms-4 bg-dark" style="background: #000; color: #fff; margin-left:8px;"
                                                onclick="window.location.href='{{ route('training-user.enroll', @$training_deatils->id) }}'">Enroll
                                                Now</button>
                                    @endif
                                </div>


                            </div>

                            @else
                                <div>
                                    @if (@$training_deatils->enroll_end_date < Carbon\Carbon::today()->format('Y-m-d'))
                                        <h4> Training Expired Please wait for a new date </h4>
                                    @else
                                        <h4>Enrollment Started form {{@$training_deatils->enroll_start_date}} to {{@$training_deatils->enroll_end_date}} </h4>
                                    @endif
                                </div>
                            @endif

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
                            <li><a href="#tab2">DESCRIPTION</a></li>
                            <li><a href="#tab3">REVIEWS ({{count(@$reviews)}})</a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div id="tab1">
                                <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-3">Total Duration :</dt>
                                            <dd class="col-sm-9">{{@$training_deatils->training_duration}} {{@$training_deatils->training_duration_type}}</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">Language :</dt>
                                            <dd class="col-sm-9">{{@$training_deatils->language->name}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-6">Enrolled Students :</dt>
                                            <dd class="col-sm-6">{{count(@$training_deatils->TrainingEnrolls)}}</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-6">Certificate :</dt>
                                            <dd class="col-sm-6">{{@$training_deatils->training_type == 0 ? 'Yes' : 'No'}} </dd>
                                        </dl>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div id="tab2">
                                {!! @$training_deatils->description !!}
                            </div>
                                    
                                <div id="tab3">
                                    <div class="product-comment">
                                        @foreach($reviews as $review)
                                        <div class="mt-box">
                                            <div class="mt-hold">
                                                <span>
                                                    @for ($i = 1; $i <= $review->rate; $i++)
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                                    @endfor
                                                </span>
                                                <span class="name">{{@$review->userDetails->first_name}}</span>
                                                <time datetime="2016-01-01">{{Carbon\Carbon::parse(@$review->created_at)->format('M d, Y')}}</time>
                                            </div>
                                            <p>{{@$review->feedback}}</p>
                                        </div>
                                        @endforeach

                                        @if ($reviews->hasPages())
                                            <ul class="pager">
                                                @if ($reviews->onFirstPage())
                                                    <li class="disabled"><span>← Previous</span></li>
                                                @else
                                                    <li><a href="{{ $reviews->previousPageUrl() }}" rel="prev">← Previous</a></li>
                                                @endif
                                                @foreach ($reviews as $element)
                                                    @if (is_string($element))
                                                        <li class="disabled"><span>{{ $element }}</span></li>
                                                    @endif
                                                    @if (is_array($element))
                                                        @foreach ($element as $page => $url)
                                                            @if ($page == $reviews->currentPage())
                                                                <li class="active my-active"><span>{{ $page }}</span></li>
                                                            @else
                                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                @if ($reviews->hasMorePages())
                                                    <li><a href="{{ $reviews->nextPageUrl() }}" rel="next">Next →</a></li>
                                                @else
                                                    <li class="disabled"><span>Next →</span></li>
                                                @endif
                                            </ul>
                                        @endif
                                        @if(@$training_order)
                                        <form action="{{route('training-user.store.review',@$training_deatils->id)}}" method="POST" class="p-commentform">
                                            @csrf
                                            <x-review-form  />
                                            {{-- <fieldset>
                                                <h2>Add a Review</h2>
                                                <div class="mt-row">
                                                    <label>Rating</label>
                                                    <ul class="mt-star">
                                                        <div class="rate">
                                                            <input type="radio" id="star5" class="rate"
                                                                name="rate" value="5" />
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio"  id="star4"
                                                                class="rate" name="rate" value="4" />
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" class="rate"
                                                                name="rate" value="3" />
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" class="rate"
                                                                name="rate" value="2">
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" class="rate"
                                                                name="rate" value="1" />
                                                            <label for="star1" title="text">1 star</label>
                                                        </div>
                                                    </ul>
                                                    
                                                </div>
                                                <div class="mt-row">
                                                    <label>Review</label>
                                                    <textarea class="form-control" name="feedback"></textarea>
                                                    
                                                </div>
                                                <div style="margin-left: 80px;margin-bottom:20px;color:red" id="review-error"></div>
                                            </fieldset> --}}
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
                    <h2>RELATED TRAININGS</h2>
                        <div class="row">
                            <div class="slick-slider pagg-slider">
                            @foreach ($related_trainings as $related_training)
                            <div class="col-md-3 col-lg-3 col-sm-12 col-xl-3">
                                <div class="panel-related">
                                    <div class="img-related-box">
                                        <a href="{{ route('training-user.course-details', @$related_training->id) }}">
                                            <img src="{{ asset('public/upload/training/training_image/' . @$related_training->TrainingImage->file_name) }}" class="img-related-fix-box" alt="Training-image">
                                        </a>
                                    </div>
                                    
                                    <div class="panel-body" style="padding: 10px;">
                                        <ul class="d-flex list-unstyled justify-content-between" style="display:flex;">
                                            <li>
                                                @if (!$related_training->TrainingClasses->isEmpty())
                                                    <i class="fa fa-book text-primary"></i> {{$related_training->TrainingClasses->count()}} Class
                                                
                                                @else
                                                    <i class="fa fa-book" style="color: #5cb85c;"></i> Not Assigned

                                                @endif
                                            </li>
                                            <li style="margin-left:30px;">
                                                @if (@$related_training->training_duration && @$related_training->training_duration_type)
                                                    
                                                <i class="fa fa-clock-o" aria-hidden="true" style="color: #ffb707;"></i> {{@$related_training->training_duration}} {{@$related_training->training_duration_type}}
                                                @endif
                                            </li>
                                        </ul>
                                        <h4 class="training-name-trim" title="{{ $related_training->name }}"><a
                                            href="{{ route('training-user.course-details', @$related_training->id) }}" style="color: #000"><b>{{ $related_training->name }}</b></a></h4>
                                        @if (@$related_training->price == 0 || @$related_training->price == '')
                                            <h5 class="" style="color: #ff8283;">Free</h5>
                                        @else
                                            <h5 class="" style="color: #ff8283;">₹ {{ number_format(@$related_training->price, 2, '.', ',') }}</h5>
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
        </div>

        @endif

        <!-- related products End here -->
    </main>


@endsection


@section('script')

<script>
    $(document).ready(function() {

        $("#myBtn").click(function(){
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

@endsection