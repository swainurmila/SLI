@extends('course.layouts.user.main')
@section('content')

<div class="container-fluid" style="background: #000;">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h4 class="" style="color: #000;">Cart</h4>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="mt-drop-sub">
            <!-- mt side widget start here -->
            <div class="mt-side-widget">

                @if(!$enrolledCourses->isEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Sl.No</th>
                                        <th scope="col">Course Image</th>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Course Price</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrolledCourses as $key => $cart)
                                            <tr>
                                                <th scope="row">{{++ $key}}</th>
                                                <td>
                                                    <a href="{{route('user.course.details',@$cart->id)}}" class="img">
                                                        @if (@$cart->course->course_image)
                                                            <img style="height:70px;width:100px" src="{{asset(@$cart->course->course_image)}}" alt="image" class="img-responsive">
                                                        @else
                                                            <img style="height:70px;width:100px" src="{{ asset('assets/images/dummy-img.jpg') }}" alt="image" class="img-responsive">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>{{@$cart->course->course_name}}</td>
                                                <td>₹ {{number_format(@$cart->course->course_price, 2, '.', ',')}}</td>
                                                <td>
                                                    <button class="btn-type3" onclick="window.location.href='{{ route('user.course.details.removeCart',@$cart->id) }}'">Remove</button>
                                                    <button class="btn-type2" onclick="window.location.href='{{ route('user.course.checkout',@$cart->course_id) }}'">Enroll Now</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                <div class="cart-row-total">
                    <span class="mt-total">Sub Total</span>
                    <span class="mt-total-txt">₹ {{number_format(@$totalSumOfPrices, 2, '.', ',')}}</span>
                </div>
                @else
                        <h4 class="text-danger text-center"><b>Your Cart is Empty !</b></h4>

                @endif
                
                
                <!-- cart row total end here -->
                {{-- <div class="cart-btn-row checkout-page-btn">
                    <a href="#" class="btn-type3">CHECKOUT</a>
                </div> --}}
            </div><!-- mt side widget end here -->
        </div>
    </div>
</div>

@endsection