@if (count($workshop) > 0)

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

@endif