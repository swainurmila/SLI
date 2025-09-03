@extends('workshop.user.layouts.main')
<style>
    body {
        overflow-x: hidden;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row list-box">
            <!-- sidebar of the Page start here -->
            <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                <!-- shop-widget filter-widget of the Page start here -->
                <section class="shop-widget filter-widget bg-grey">
                    <div>
                        <h2>FILTER
                            <a class="btn-type3" href="{{ route('user.workshop.list') }}" style="margin-left: 8rem;">ALL</a>
                        </h2>
                    </div>
                    <form action="{{ route('user.course.list') }}" method="POST" id="workshop_list"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <span class="sub-title">Workshop Type</span>

                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form" style="display: flow">
                            <li style="display: flow">
                                <label for="type1" >
                                    <input id="type1" name="type[]" value="Boiler Management" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Boiler Management</span>
                                </label>
                                <span class="num">{{ @$countBoiler }}</span>
                            </li>
                            <li style="display: flow">
                                <label for="type2">
                                    <input id="type2" name="type[]" value="Stress Management"
                                        {{ isset($filteredData['type']) ? (in_array('1', $filteredData['type']) ? 'checked' : '') : '' }}
                                        type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Stress Management</span>
                                </label>
                                <span class="num">{{ @$countStress }}</span>
                            </li>
                            <li style="display: flow">
                                <label for="type3">
                                    <input id="type3" name="type[]" value="Organizational Behaviour"
                                        {{ isset($filteredData['type']) ? (in_array('1', $filteredData['type']) ? 'checked' : '') : '' }}
                                        type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Organizational Behavior</span>
                                </label>
                                <span class="num">{{ @$countOg }}</span>
                            </li>
                        </ul><!-- nice-form end here -->

                    </form>
                </section><!-- shop-widget filter-widget of the Page end here -->
            </aside><!-- sidebar of the Page end here -->

            <div class="product-detail-tab course-tab">
                <div class="row mt-3">
                    <div class="col-xs-12">
                        <ul class="mt-productlisthold list-inline training-list-container">
                            @if (count($workshop) > 0)
                                @foreach ($workshop as $ws)
                                    <li>
                                        <div class="mt-product1 large">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">

                                                        @if (@$ws->image)
                                                            <a href="{{ route('user.workshop.details', @$ws['id']) }}"><img
                                                                    src="{{ asset(@$ws['image']) }}" alt="image"
                                                                    style="height: 100%" class="img-box-vh"></a>
                                                        @else
                                                            <a href="#"><img
                                                                    src="{{ asset('assets/images/dummy-img.jpg') }}"
                                                                    alt="image" style="height: 100%"
                                                                    class="img-box-vh"></a>
                                                        @endif
                                                        <ul class="links">
                                                            @if ($current_date < $ws->end_date)
                                                                @if (@$ws['UserCourseCart']['enroll_status'] == 'completed')
                                                                    <li><a
                                                                            href="{{ route('user.workshop.checkout', @$ws['id']) }}"><i
                                                                                class="fa fa-briefcase"
                                                                                aria-hidden="true"></i><span>Enrolled</span></a>
                                                                    </li>
                                                                @else
                                                                    <div class="row-val product-form d-flex"
                                                                        style="display: flex">
                                                                        @if (@$ws['UserCourseCart'])
                                                                            <li><a
                                                                                    href="{{ route('user.workshop.showCart') }}">
                                                                                    <i class="fa fa-shopping-cart"
                                                                                        aria-hidden="true"></i><span>Go
                                                                                        to
                                                                                        Cart</span></a>
                                                                            @else
                                                                            <li><a
                                                                                    href="{{ route('user.workshop.addCart', $ws['id']) }}">
                                                                                    <i class="fa fa-shopping-cart"
                                                                                        aria-hidden="true"></i><span>Add
                                                                                        to
                                                                                        Cart</span></a>
                                                                            </li>
                                                                        @endif

                                                                        <li><a
                                                                                href="{{ route('user.workshop.checkout', @$ws['id']) }}"><i
                                                                                    class="fa fa-shopping-bag"
                                                                                    aria-hidden="true"></i><span>Enroll
                                                                                    Now</span></a></li>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <li><a href="#"><i class="fa fa-hourglass-end"
                                                                            aria-hidden="true"></i><span>Expired</span></a>
                                                                </li>
                                                            @endif

                                                            {{-- <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li> --}}


                                                        </ul>
                                                        {{-- @endif --}}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a
                                                        href="{{ route('user.workshop.details', @$ws['id']) }}">{{ $ws['title'] }}</a></strong>

                                                @if (@$ws['price'] == 0 || @$ws['price'] == '')
                                                    <span class="price"><span>Free</span></span>
                                                @else
                                                    <span class="price"><span>₹</span>
                                                        <span>{{ number_format(@$ws['price'], 2, '.', ',') }}</span></span>
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
        $(document).ready(function() {

            $('input[type=checkbox]').change(function() {
                $.ajax({
                    url: "{{ route('user.workshop.list.search') }}",
                    type: 'POST',
                    data: $('#workshop_list').serialize(),

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
