@foreach ($courseslist as $course)
    <li>
        <div class="mt-product1 large">
            <div class="box">
                <div class="b1">
                    <div class="b2">
                        @if (@$course['course_image'])
                            <a href="{{ route('user.course.details', @$course['id']) }}"><img
                                    src="{{ asset(@$course['course_image']) }}" alt="image" style="height: 100%"
                                    class="img-box-vh"></a>
                        @else
                            <a href="#"><img src="{{ asset('assets/images/dummy-img.jpg') }}" alt="image"
                                    style="height: 100%" class="img-box-vh"></a>
                        @endif
                        {{-- @if ($todayDate <= @$newItemsMaxDay)
                                                                <span class="caption">
                                                                    <span class="new">NEW</span>
                                                                </span>

                                                            @endif --}}

                        {{-- @if (@$training->TrainingCategory->trainingEnrollment->enrollment_end_date > Carbon\Carbon::today()->format('Y-m-d')) --}}

                        <ul class="links">

                            @if (@$course['UserCourseCart']['enroll_status'] == 'completed')

                                <li><a href="{{ route('user.course.checkout', @$course['id']) }}"><i class="fa fa-briefcase" aria-hidden="true"></i><span>Enrolled</span></a></li>
                            @else
                                <div class="row-val product-form d-flex" style="display: flex">
                                    @if (@$course['UserCourseCart'])
                                        <li><a href="{{ route('user.course.showCart') }}"> <i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i><span>Go to
                                            Cart</span></a>
                                    @else
                                        <li><a href="{{ route('user.course.details.addCart', $course['id']) }}"> <i
                                                    class="fa fa-shopping-cart" aria-hidden="true"></i><span>Add to
                                                    Cart</span></a>
                                        </li>
                                    @endif

                                    <li><a href="{{ route('user.course.checkout', @$course['id']) }}"><i
                                                class="fa fa-shopping-bag" aria-hidden="true"></i><span>Enroll
                                                Now</span></a></li>
                                </div>
                            @endif


                            {{-- <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li> --}}


                        </ul>
                        {{-- @endif --}}

                    </div>
                </div>
            </div>
            <div class="txt">
                <strong class="title"><a
                        href="{{ route('user.course.details', @$course['id']) }}">{{ $course['course_name'] }}</a></strong>

                @if (@$course['course_price'] == 0 || @$course['course_price'] == '')
                    <span class="price"><span>Free</span></span>
                @else
                    <span class="price"><span>₹</span>
                        <span>{{ number_format(@$course['course_price'], 2, '.', ',') }}</span></span>
                @endif
            </div>
        </div><!-- mt product1 center end here -->
    </li>
@endforeach
