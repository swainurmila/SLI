@extends('course.layouts.user.main')
@section('content')
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
                    <form action="{{ route('user.course.list') }}" method="POST" id="course_list"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <span class="sub-title">Refine by</span>
                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            <li>
                                <label for="refine_by1">
                                    <input id="refine_by1" name="refine_by[]" value="free" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Free</span>
                                </label>
                                <span class="num">{{@$countFreeCourse}}</span>
                            </li>
                            <li>
                                <label for="refine_by2">
                                    <input id="refine_by2" name="refine_by[]" value="paid" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Paid</span>
                                </label>
                                <span class="num">{{@$countPaidCourse}}</span>
                            </li>
                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Filter by type</span>

                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            <li>
                                <label for="type1">
                                    <input id="type1" name="type[]" value="with" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Training with Certificate</span>
                                </label>
                                <span class="num">{{@$countCertificateCourse}}</span>
                            </li>
                            <li>
                                <label for="type2">
                                    <input id="type2" name="type[]" value="without"
                                        {{ isset($filteredData['type']) ? (in_array('1', $filteredData['type']) ? 'checked' : '') : '' }}
                                        type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Training without Certificate</span>
                                </label>
                                <span class="num">{{ @$countWithoutCertificateCourse}}</span>
                            </li>
                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Categories</span>
                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            @foreach ($course_categories as $category)
                                <li>
                                    <label for="course_category_id{{ $category->id }}">
                                        <input id="course_category_id{{ $category->id }}" name="course_category_id[]"
                                            value="{{ $category->id }}"
                                            {{ isset($filteredData['course_category_id']) ? (in_array($category->id, $filteredData['course_category_id']) ? 'checked' : '') : '' }}
                                            type="checkbox">
                                        <span class="fake-input"></span>
                                        <span class="fake-label">{{ $category->name }}</span>
                                    </label>
                                    <span class="num">{{count(@$category->courses)}}</span>
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

                        {{-- <span class="sub-title">Filter by Price</span>
                <div class="price-range">
                    <input type="range" min="10" max="10000" value="10" class="slider" id="myRange">
                    <span class="price">Price &nbsp;   ₹ <span id="price-range-value">10</span> &nbsp;  -  &nbsp;   ₹ 10000</span>
                </div> --}}
                    </form>
                </section><!-- shop-widget filter-widget of the Page end here -->
            </aside><!-- sidebar of the Page end here -->
            <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">

                <div class="row" style="margin: 20px 0px;">
                    <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7">&nbsp;</div>
                    <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                        <form action="{{ route('user.course.list') }}" id="search-form" method="GET" style="display: flex">
                            @csrf
                            <input class="form-control search-training search-inp-box" id="searchField" name="search"
                                type="text" placeholder="Search">
                            <button class="search-btn-training"><i class="fa fa-search search-icon-training"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
                <div class="product-detail-tab course-tab">
                    <div class="row mt-3">
                        <div class="col-xs-12">
                            <ul class="mt-productlisthold list-inline training-list-container">
                                @if (count($courses) > 0)
                                    <x-course-list :courseslist="$courses" />
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
                                            {{-- {!! $training_lists->withQueryString()->links('pagination::bootstrap-5') !!} --}}
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

            $('input[type=checkbox]').change(function() {
                $.ajax({
                    url: "{{ route('user.course.list.search') }}",
                    type: 'POST',
                    data: $('#course_list').serialize(),

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
                document.getElementById('searchField').value = '';
                document.querySelector('form').submit();
            });
        });
    </script>
@endsection
