@extends('training.layouts.user-page-layouts.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="mt-drop-sub">
            <!-- mt side widget start here -->
            <div class="mt-side-widget">

                @if(!$cart_lists->isEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Sl.No</th>
                                        <th scope="col">Training Image</th>
                                        <th scope="col">Training Name</th>
                                        <th scope="col">Training Price</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart_lists as $key => $cart_list)
                                            <tr>
                                                <th scope="row">{{++ $key}}</th>
                                                <td>
                                                    <a href="{{route('training-user.course-details',@$cart_list->training_id)}}" class="img">
                                                        @if (@$cart_list->trainingImage)
                                                            
                                                            <img style="height:70px;width:100px" src="{{asset('public/upload/training/training_image/'.$cart_list->trainingImage->file_name)}}" alt="image" class="img-responsive">
                                                        @else
                                                            <img src="{{ asset('assets/images/dummy-img.jpg') }}" alt="image" style="height:70px;width:100px" class="img-responsive">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>{{@$cart_list->training->name}}</td>
                                                <td>₹ {{number_format(@$cart_list->training->price, 2, '.', ',')}}</td>
                                                <td>
                                                    <button class="btn-type3" onclick="window.location.href='{{ route('training-user.cart.remove',@$cart_list->id) }}'">Remove</button>
                                                    @if (@$cart_list->training->enroll_end_date > Carbon\Carbon::today()->format('Y-m-d'))
                                                        <button class="btn-type2" onclick="window.location.href='{{ route('training-user.enroll',@$cart_list->training_id) }}'">Enroll Now</button>
                                                    @endif
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