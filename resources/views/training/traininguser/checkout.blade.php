@extends('training.layouts.user-page-layouts.main')

@section('styles')
    <style>
        .batch-seat-full {
            text-decoration: line-through;
            color: red;
        }

        .hasTimingDetails {
            background: cornflowerblue;
            color: white;
            text-align: center;
        }

        .disabled {
            text-decoration: line-through;
            color: red;
        }
    </style>
@endsection
@section('content')

    <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s"
        style="background-image: url({{ asset('user-assets/images/Banner.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1 class="">Secure Checkout Experience</h1>
                </div>
            </div>
        </div>
    </section><!-- Mt Contact Banner of the Page end -->

    <section class="mt-contact-detail content-info wow fadeInUp" data-wow-delay="0.4s">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="checkout-order">
                        <div class="checkout-title">
                            <h4 class="title">Your Purchase Details</h4>
                        </div>

                        <form action="{{ route('training-user.order', $training_details->id) }}" id="user-checkout-form"
                            method="POST">
                            @csrf
                            <div class="checkout-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="Product-name">
                                                Training
                                            </th>

                                            <th class="Product-name">
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="Product-name">
                                                <p>
                                                    Training Name
                                                </p>
                                            </td>
                                            <td class="Product-price">
                                                <p>{{ @$training_details->name }}</p>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="Product-name">
                                                <p>
                                                    Training Language
                                                </p>
                                            </td>
                                            <td class="Product-price">
                                                <p>{{ @$training_details->language->name }}</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="Product-name">
                                                <p>
                                                    Training Duration
                                                </p>
                                            </td>
                                            <td class="Product-price">
                                                <p>{{ @$training_details->training_duration . ' ' . @$training_details->training_duration_type }}
                                                </p>
                                            </td>
                                        </tr>



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="Product-name">
                                                <p>Total</p>
                                            </td>
                                            <td class="total-price">

                                                @if (@$training_details->payment_type == 0)
                                                    <p>Free</p>
                                                @else
                                                    <p>₹{{ number_format(@$training_details->price, 2, '.', ',') }}</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                @if (count(@$training_batches) > 0)
                                    <div class="">
                                        <label for="batch_timing" class="col-sm-2 col-form-label">Batch Timing:</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                {{-- @php $hasTimingDetails = false; @endphp --}}
                                                @foreach ($training_batches as $batch)
                                                    {{-- @if ($batch->trainingDetailsAccBatch) --}}
                                                    {{-- @php $hasTimingDetails = true; @endphp --}}
                                                    <div class="form-check form-check-inline col-sm-3">
                                                        <input type="radio" id="batch_time_{{ @$batch->id }}"
                                                            name="batch_time" {{-- {{ @$training_order->checkTrainingDetailsData ? 'checked' : '' }} --}}
                                                            {{ @$training_order->batch_id == @$batch->id ? 'checked' : '' }}
                                                            {{ @$training_order &&
                                                            Carbon\Carbon::today()->format('Y-m-d') <= @$training_details->enroll_end_date &&
                                                            Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >=
                                                                Carbon\Carbon::parse(@$training_details->enroll_start_date)->format('Y-m-d') &&
                                                            Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <=
                                                                Carbon\Carbon::parse(@$training_details->enroll_end_date)->format('Y-m-d')
                                                                ? 'disabled'
                                                                : '' }}
                                                            {{-- Carbon\Carbon::parse(@$training_details->start_date)->format('Y-m-d')  >  Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d')  ? '' : 'disabled' --}} value="{{ @$batch->id }}"
                                                            class="form-check-input batch-radio">
                                                        <label class="form-check-label"
                                                            for="batch_time_{{ @$batch->id }}">
                                                            {{ @$batch->start_time }} - {{ @$batch->end_time }}
                                                        </label>
                                                    </div>

                                                    {{-- <div class="form-check form-check-inline col-sm-3">
                                                            <input type="radio" id="batch_time_{{ @$batch->id }}"
                                                                name="batch_time"
                                                                {{@$batch->max_student == count(@$batch->trainingOrder) ? 'disabled' : ''}}
                                                                {{@$training_order->batch_id == @$batch->id ? 'checked' : ''  }}

                                                                {{@$training_order->trainingDetails ? 'disabled' : ''}}
                                                                value="{{ @$batch->id }}" class="form-check-input">
                                                            <label class="form-check-label {{ @$batch->max_student == count(@$batch->trainingOrder) ? 'batch-seat-full' : '' }}"
                                                                for="batch_time_{{ @$batch->id }}">
                                                                {{ @$batch->start_time }} - {{ @$batch->end_time }}
                                                            </label>
                                                        </div> --}}

                                                    {{-- @endif --}}
                                                @endforeach

                                                {{-- @if (!$hasTimingDetails)
                                                            <div>
                                                                <p class="hasTimingDetails">Please Wait For Batch Timing To Update</p>
                                                            </div>
                                                        @endif --}}
                                            </div>

                                            @error('batch_time')
                                                <span class="invalid-feedback" style="color:red;" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>


                            {{-- @if (Carbon\Carbon::today()->format('Y-m-d') <= @$training_details->enroll_end_date && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >= Carbon\Carbon::parse(@$training_details->enroll_start_date)->format('Y-m-d') && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <= Carbon\Carbon::parse(@$training_details->enroll_end_date)->format('Y-m-d'))
                                &nbsp;
                            @else --}}
                            @if (Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <
                                    Carbon\Carbon::parse(@$training_details->enroll_start_date)->format('Y-m-d') || !@$training_order)
                                <div class="checkout-payment">
                                    @if (@$training_details->payment_type == 1)
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
                                            <li>
                                                <div class="single-payment">
                                                    <div class="payment-radio radio">
                                                        <input type="radio" name="radio" id="check">
                                                        <label for="check"><span></span> UPI
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
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
                                    @endif

                                    @if (count(@$training_batches) > 0)
                                        <div class="single-form text-right">
                                            <button id="buy-button" class="btn btn-custom modal-btn-success">Buy</button>
                                        </div>
                                    @else
                                        <div class="single-form text-right">
                                            <p>Wait For Batch Timing !</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- @if (@$training_order && Carbon\Carbon::today()->format('Y-m-d') <= @$training_details->enroll_end_date && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >= Carbon\Carbon::parse(@$training_details->enroll_start_date)->format('Y-m-d') && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <= Carbon\Carbon::parse(@$training_details->enroll_end_date)->format('Y-m-d')) --}}

            @if (
                @$training_order &&
                    Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >=
                        Carbon\Carbon::parse(@$training_details->enroll_start_date)->format('Y-m-d') &&
                    Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <=
                        Carbon\Carbon::parse(@$training_details->enroll_end_date)->format('Y-m-d'))
                <div class="" id="" role="" aria-labelledby="" style="margin-top: 30px">
                    <div class="">
                        <div class="" style="text-align: center">
                            <div class="">
                                <h2 class="text-success">Successfully Enrolled !</h2>
                                <p>Thank You For Your Enrolled ! You will receive a mail regarding the training timing
                                    shortly.</p>
                            </div>
                            <div class="">
                                <a href="{{ route('training.list') }}" class="btn btn-custom" aria-label="Close">Back to
                                    Training</a>


                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>



    </section>


@endsection


@section('script')
    <script>
        $(document).ready(function() {
            toggleBuyButton();
            $('.batch-radio').on('change', function() {
                toggleBuyButton();
            });

            function toggleBuyButton() {
                if ($('input[name="batch_time"]:checked').length > 0) {
                    $('#buy-button').prop('disabled', false);
                } else {
                    $('#buy-button').prop('disabled', true);
                }
            }
        });
    </script>
@endsection
