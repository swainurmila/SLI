@extends('workshop.user.layouts.main')

@section('content')

    <section class="mt-contact-detail content-info wow fadeInUp" data-wow-delay="0.4s">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="checkout-order">
                        <div class="checkout-title">
                            <h4 class="title">Your Workshop Details</h4>
                        </div>

                        <form action="{{route('user.workshop.enroll',@$courseDetails->id)}}" id="user-checkout-form" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="checkout-order-table table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="Product-name">
                                                <p>
                                                    Workshop Name
                                                </p>
                                            </td>
                                            <td class="Product-price">
                                                <p>{{ @$courseDetails->title }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Product-name">
                                                <p>
                                                    Course Date
                                                </p>
                                            </td>
                                            <td class="Product-price">
                                                <p>{{ \Carbon\Carbon::parse(@$courseDetails->start_date)->toFormattedDateString() . ' - ' . \Carbon\Carbon::parse(@$courseDetails->end_date)->toFormattedDateString() }}
                                                </p>
                                            </td>
                                        </tr>



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="Product-name">
                                                <p>Total</p>
                                            </td>
                                            <td class="Product-price">
                                                    <p>₹{{ number_format(@$courseDetails->price, 2, '.', ',') }}</p>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            @if (@$courseDetails->UserCourseCart->enroll_status == 'pending' || @$courseDetails->UserCourseCart == null)
                                <div class="checkout-payment">

                                        <ul>
                                            <li>
                                                <div class="single-payment">
                                                    <div class="payment-radio radio">
                                                        <input type="radio" name="radio" id="bank">
                                                        <label for="bank"><span></span> Credit / Debit / ATM Card
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            &nbsp;&nbsp; &nbsp;&nbsp;
                                            <li>
                                                <div class="single-payment">
                                                    <div class="payment-radio radio">
                                                        <input type="radio" name="radio" id="check">
                                                        <label for="check"><span></span> UPI
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            &nbsp;&nbsp; &nbsp;&nbsp;
                                            <li>
                                                <div class="single-payment">
                                                    <div class="payment-radio radio">
                                                        <input type="radio" name="radio" id="cash"
                                                            checked="checked">
                                                        <label for="cash"><span></span> Net Banking</label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>


                                </div>
                            @endif
                            @if (@$courseDetails->UserCourseCart->enroll_status == 'pending' || @$courseDetails->UserCourseCart == null)
                                @if (Carbon\Carbon::today()->format('Y-m-d') < Carbon\Carbon::parse(@$courseDetails->end_date)->format('Y-m-d'))
                                    <div class="single-form text-right">
                                        <button class="btn btn-custom modal-btn-success">Pay</button>
                                    </div>
                                @else
                                    <div class="" style="text-align: center">
                                        <div class="">
                                            <h2 class="text-danger">Workshop Expired !</h2>
                                        </div>
                                        <div class="">
                                            <a href="{{ route('user.workshop.list') }}" class="btn btn-custom" aria-label="Close">Check More</a>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            @if (@$courseDetails->UserCourseCart->enroll_status == 'completed' && Carbon\Carbon::parse(@$courseDetails->end_date)->format('Y-m-d'))
                <div class="" id="" role="" aria-labelledby="" style="margin-top: 30px">
                    <div class="">
                        <div class="" style="text-align: center">
                            <div class="">
                                <h2 class="text-success">Successfully Enrolled !</h2>
                                <p>Thank You For Your Enrolled !</p>
                            </div>
                            <div class="">
                                <a href="{{ route('user.workshop.list') }}" class="btn btn-custom" aria-label="Close">Check More </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>



    </section>


@endsection

