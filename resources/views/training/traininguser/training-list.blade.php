@extends('training.layouts.user-page-layouts.main')
@section('content')

    @php
        // $countFreeTraining = App\Models\Training\TrTraining::where('payment_type','0')->count();
        $countPaidTraining = App\Models\Training\TrTraining::where('payment_type', '1')->count();

        $countCertificateTraining = App\Models\Training\TrTraining::where('training_type', '0')->count();
        $countWithoutCertificateTraining = App\Models\Training\TrTraining::where('training_type', '1')->count();
        $countpaid = App\Models\Training\TrTraining::where('payment_type', '1')->count();
        $countfree = App\Models\Training\TrTraining::where('payment_type', '0')->count();

    @endphp



    <div class="container-fluid">
        <div class="row list-box">
            <!-- sidebar of the Page start here -->
            <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                <!-- shop-widget filter-widget of the Page start here -->
                <section class="shop-widget filter-widget bg-grey">
                    <div>
                        <h2>FILTER
                            <a class="btn-type3" id="clearFilters" href="#" style="margin-left: 8rem;">Clear</a>
                        </h2>
                    </div>
                    <form action="{{ route('training.list') }}" method="POST" id="traing_list"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <span class="sub-title">Refine by</span>
                <ul class="list-unstyled nice-form">
                    <li>
                        <label for="refine_by1">
                            <input id="refine_by1" name="refine_by[]" {{isset($filteredData['refine_by']) ? in_array("0", $filteredData['refine_by']) ? 'checked' : '' : ''}} value="0" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Free</span>
                        </label>
                        <span class="num">{{@$countFreeTraining}}</span>
                    </li>
                    <li>
                        <label for="refine_by2">
                            <input id="refine_by2" name="refine_by[]" {{isset($filteredData['refine_by']) ? in_array("1", $filteredData['refine_by']) ? 'checked' : '' : ''}} value="1" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Paid</span>
                        </label>
                        <span class="num">{{@$countPaidTraining}}</span>
                    </li>
                </ul> --}}
                        <span class="sub-title">Filter by type</span>

                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            <li>
                                <label for="type1">
                                    <input id="type1" name="type[]" value="0"
                                        {{ isset($filteredData['type']) ? (in_array('0', $filteredData['type']) ? 'checked' : '') : '' }}
                                        type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Training with Certificate</span>
                                </label>
                                <span class="num">{{ @$countCertificateTraining }}</span>
                            </li>
                            {{-- <li>
                        <label for="type2">
                            <input id="type2" name="type[]" value="1" {{isset($filteredData['type']) ? in_array("1", $filteredData['type']) ? 'checked' : '' : ''}} type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Training without Certificate</span>
                        </label>
                        <span class="num">{{@$countWithoutCertificateTraining}}</span>
                    </li> --}}
                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Categories / Subject</span>
                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            @foreach ($tr_categores as $tr_cat)
                                <li>
                                    <label for="training_category_id{{ $tr_cat->id }}">
                                        <input id="training_category_id{{ $tr_cat->id }}" name="training_category_id[]"
                                            value="{{ $tr_cat->id }}"
                                            {{ isset($filteredData['training_category_id']) ? (in_array($tr_cat->id, $filteredData['training_category_id']) ? 'checked' : '') : '' }}
                                            type="checkbox">
                                        <span class="fake-input"></span>
                                        <span class="fake-label">{{ $tr_cat->name }}</span>
                                    </label>
                                    <span class="num">{{ count($tr_cat->trainings) }}</span>
                                </li>
                            @endforeach

                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Filter by Language</span>
                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">

                            @foreach ($languages as $lan)
                                <li>
                                    <label for="language_id-{{ $lan->id }}">
                                        <input id="language_id-{{ $lan->id }}"
                                            {{ isset($filteredData['language_id']) ? (in_array($lan->id, $filteredData['language_id']) ? 'checked' : '') : '' }}
                                            value="{{ $lan->id }}" name="language_id[]" type="checkbox">
                                        <span class="fake-input"></span>
                                        <span class="fake-label">{{ $lan->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Filter by Payment Type</span>
                        <ul class="list-unstyled nice-form">
                            <li>
                                <label for="payment_type1">
                                    <input id="payment_type1" name="payment_type[]" value="1"
                                        {{ isset($filteredData['payment_type']) ? (in_array('1', $filteredData['payment_type']) ? 'checked' : '') : '' }}
                                        type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Paid</span>
                                </label>
                                <span class="num">{{ @$countpaid }}</span>
                            </li>
                            <li>
                                <label for="payment_type2">
                                    <input id="payment_type2" name="payment_type[]" value="0"
                                        {{ isset($filteredData['payment_type']) ? (in_array('0', $filteredData['payment_type']) ? 'checked' : '') : '' }}
                                        type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Free</span>
                                </label>
                                <span class="num">{{ @$countfree }}</span>
                            </li>
                            </ul<!-- nice-form end here -->
                    </form>
                </section><!-- shop-widget filter-widget of the Page end here -->
            </aside><!-- sidebar of the Page end here -->
            <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">

                <div class="row" style="margin: 20px 0px;">
                    <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7">&nbsp;</div>
                    <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                        <form action="{{ route('training.list') }}" method="POST" style="display: flex">
                            @csrf
                            <input class="form-control search-training search-inp-box" name="search" type="text"
                                placeholder="Search">
                            <button class="search-btn-training"><i class="fa fa-search search-icon-training"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
                <div class="product-detail-tab course-tab">
                    <div class="row mt-3">
                        <div class="col-xs-12">
                            <ul class="mt-productlisthold list-inline training-list-container">

                                @if (count($training_lists) > 0)
                                    @foreach ($training_lists as $training)
                                        <li>
                                            <?php
                                            
                                            $training_image = App\Models\Training\TrainingImages::where('training_id', $training->id)->first();
                                            $image_parth = 'public/upload/training/training_image/' . @$training_image->file_name;
                                            
                                            $training_order = App\Models\Training\TrTrainingOrder::with('trainingDetails')
                                                ->where('training_id', $training->id)
                                                ->where('user_id', Auth::user()->id)
                                                ->orderBy('id', 'desc')
                                                ->first();
                                            
                                            $training_order_cart = App\Models\Training\TrAddToCart::where('training_id', $training->id)
                                                ->where('user_id', Auth::user()->id)
                                                ->first();
                                            
                                            // dd($training_order);
                                            
                                            $todayDate = Carbon\Carbon::now();
                                            $trainingCreatedDate = @$training->created_at;
                                            $newItemsMaxDay = $trainingCreatedDate->addDays(10);
                                            
                                            ?>
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            @if (@$training_image)
                                                                <a
                                                                    href="{{ route('training-user.course-details', @$training->id) }}"><img
                                                                        src="{{ asset(@$image_parth) }}" alt="image"
                                                                        style="height: 100%" class="img-box-vh"></a>
                                                            @else
                                                                <a
                                                                    href="{{ route('training-user.course-details', @$training->id) }}"><img
                                                                        src="{{ asset('assets/images/dummy-img.jpg') }}"
                                                                        alt="image" style="height: 100%"
                                                                        class="img-box-vh"></a>
                                                            @endif
                                                            @if ($todayDate <= @$newItemsMaxDay)
                                                                <span class="caption">
                                                                    <span class="new">NEW</span>
                                                                </span>
                                                            @endif

                                                            {{-- @if (@$training->TrainingCategory->trainingEnrollment->enrollment_end_date > Carbon\Carbon::today()->format('Y-m-d')) --}}
                                                            @if (
                                                                @$training->enroll_end_date >= Carbon\Carbon::today()->format('Y-m-d') &&
                                                                    @$training->enroll_start_date <= Carbon\Carbon::today()->format('Y-m-d'))
                                                                <ul class="links">
                                                                    {{-- !@$training_order->batch_id &&  --}}
                                                                    @if (
                                                                        !@$training_order->batch_id ||
                                                                            Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <
                                                                                Carbon\Carbon::parse(@$training->enroll_start_date)->format('Y-m-d'))
                                                                        {{-- @if (Carbon\Carbon::today()->format('Y-m-d') <= @$training->enroll_end_date && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >= Carbon\Carbon::parse(@$training->enroll_start_date)->format('Y-m-d') && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <= Carbon\Carbon::parse(@$training->enroll_end_date)->format('Y-m-d')) --}}
                                                                        @if ($training_order_cart)
                                                                            <li><a
                                                                                    href="{{ route('training-user.cart') }}"><i
                                                                                        class="fa fa-cart-plus"
                                                                                        aria-hidden="true"></i><span>Go to
                                                                                        Cart</span></a></li>
                                                                        @else
                                                                            <li><a
                                                                                    href="{{ route('training-user.add-cart', ['id' => $training->id]) }}">
                                                                                    <i class="fa fa-shopping-cart"
                                                                                        aria-hidden="true"></i><span>Add to
                                                                                        Cart</span></a></li>
                                                                        @endif

                                                                        <li><a
                                                                                href="{{ route('training-user.enroll', @$training->id) }}"><i
                                                                                    class="fa fa-shopping-bag"
                                                                                    aria-hidden="true"></i><span>Enroll
                                                                                    Now</span></a></li>
                                                                        {{-- <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li> --}}
                                                                    @else
                                                                        <li><a
                                                                                href="{{ route('training-user.enroll', @$training->id) }}"><i
                                                                                    class="fa fa-briefcase"
                                                                                    aria-hidden="true"></i><span>Enrolled</span></a>
                                                                        </li>
                                                                    @endif

                                                                </ul>
                                                            @else
                                                                <ul class="links">
                                                                    @if (@$training->enroll_end_date < Carbon\Carbon::today()->format('Y-m-d'))
                                                                        <li><a href="#">
                                                                                <i class="fa fa-clock-o"
                                                                                    aria-hidden="true"></i><span>Expired
                                                                                    !</span></a></li>
                                                                    @else
                                                                        <li><a href="#">
                                                                                <i class="fa fa-clock-o"
                                                                                    aria-hidden="true"></i><span>Enroll :
                                                                                    {{ @$training->enroll_start_date }} to
                                                                                    {{ @$training->enroll_end_date }}</span></a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title training-name-trim"
                                                        title="{{ $training->name }}"><a
                                                            href="{{ route('training-user.course-details', @$training->id) }}">{{ $training->name }}</a></strong>

                                                    @if (@$training->price == 0 || @$training->price == '' || @$training->price == null)
                                                        <span class="price"><span>Free</span></span>
                                                    @else
                                                        <span class="price"><span>₹</span>
                                                            <span>{{ number_format(@$training->price, 2, '.', ',') }}</span></span>
                                                    @endif
                                                </div>
                                            </div><!-- mt product1 center end here -->
                                        </li>
                                    @endforeach
                                @else
                                    <P class="text-center">No Records Found !</P>
                                @endif

                                <!-- mt pagination start here -->
                                <nav class="mt-pagination">
                                    <ul class="list-inline">
                                        {{-- <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                        </ul> --}}
                                        <div class="m-4">
                                            {!! $training_lists->withQueryString()->links('pagination::bootstrap-5') !!}
                                        </div>
                                </nav><!-- mt pagination end here -->

                            </ul><!-- mt productlisthold end here -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection


@section('script')
    <script>
        // var slider = document.getElementById("myRange");
        // var output = document.getElementById("price-range-value");
        // output.innerHTML = slider.value;

        // slider.oninput = function() {
        //     output.innerHTML = this.value;
        // }
        $(document).ready(function() {

            $('input[type=checkbox], #myRange').change(function() {
                $.ajax({
                    url: "{{ route('training.list.search') }}",
                    type: 'POST',
                    data: $('#traing_list').serialize(),

                    // data: $('#traing_list').serialize() + '&price_min=' + $('#myRange').val(),
                    success: function(response) {
                        console.log(response)
                        $('.training-list-container').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('clearFilters').addEventListener('click', function(event) {
                event.preventDefault();
                location.reload();
            });
        });
    </script>
@endsection
