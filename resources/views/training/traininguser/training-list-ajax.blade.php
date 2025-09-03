@if (count($training_lists) > 0)
    @foreach ($training_lists as $training)
        <li>
            <?php
            
            $training_image = App\Models\Training\TrainingImages::where('training_id', $training->id)->first();
            $image_parth = 'public/upload/training/training_image/' . @$training_image->file_name;
            
            $training_order = App\Models\Training\TrTrainingOrder::with('trainingDetails')
                ->where('training_id', $training->id)
                ->where('user_id', Auth::user()->id)
                ->orderBy('id','desc')
                ->first();
            
            $training_order_cart = App\Models\Training\TrAddToCart::where('training_id', $training->id)
                ->where('user_id', Auth::user()->id)
                ->first();
            
            $todayDate = Carbon\Carbon::now();
            $trainingCreatedDate = @$training->created_at;
            $newItemsMaxDay = $trainingCreatedDate->addDays(10);
            
            ?>
            <div class="mt-product1 large">
                <div class="box">
                    <div class="b1">
                        <div class="b2">

                            @if (@$training_image)
                                <a href="{{ route('training-user.course-details', @$training->id) }}"><img
                                        src="{{ asset(@$image_parth) }}" alt="image" style="height: 100%"
                                        class="img-box-vh"></a>
                            @else
                                <a href="{{ route('training-user.course-details', @$training->id) }}"><img
                                        src="{{ asset('assets/images/dummy-img.jpg') }}" alt="image"
                                        style="height: 100%" class="img-box-vh"></a>
                            @endif
                            @if ($todayDate <= @$newItemsMaxDay)
                                <span class="caption">
                                    <span class="new">NEW</span>
                                </span>
                            @endif
                            {{-- <ul class="mt-stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </ul> --}}

                            @if (
                                @$training->enroll_end_date >= Carbon\Carbon::today()->format('Y-m-d') &&
                                    @$training->enroll_start_date <= Carbon\Carbon::today()->format('Y-m-d'))
                                <ul class="links">

                                    {{-- @if ( Carbon\Carbon::today()->format('Y-m-d') <= @$training->enroll_end_date && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') > Carbon\Carbon::parse(@$training->enroll_start_date)->format('Y-m-d') &&
                                    Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') < Carbon\Carbon::parse(@$training->enroll_end_date)->format('Y-m-d')) --}}

                                    {{-- @if (!@$training_order->batch_id && Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') >= Carbon\Carbon::parse(@$training->enroll_start_date)->format('Y-m-d') &&
                                    Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') <= Carbon\Carbon::parse(@$training->enroll_end_date)->format('Y-m-d')) --}}

                                    @if (!@$training_order->batch_id || Carbon\Carbon::parse(@$training_order->updated_at)->format('Y-m-d') < Carbon\Carbon::parse(@$training->enroll_start_date)->format('Y-m-d'))
                                        @if ($training_order_cart)
                                            <li><a href="{{ route('training-user.cart') }}"><i
                                                        class="icon-handbag"></i><span>Go to Cart</span></a></li>
                                        @else
                                            <li><a
                                                    href="{{ route('training-user.add-cart', ['id' => $training->id]) }}">
                                                    <i class="icon-bag" aria-hidden="true"></i><span>Add to
                                                        Cart</span></a></li>
                                        @endif

                                        <li><a href="{{ route('training-user.enroll', @$training->id) }}"><i
                                                    class="icon-handbag"></i><span>Enroll Now</span></a></li>
                                        {{-- <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li> --}}
                                    @else
                                        <li><a href="{{ route('training-user.enroll', @$training->id) }}"><i
                                                    class="icon-handbag"></i><span>Enrolled</span></a></li>
                                    @endif

                                </ul>
                            @else
                                <ul class="links">
                                    @if (@$training->enroll_end_date < Carbon\Carbon::today()->format('Y-m-d'))
                                        <li><a href="#">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span>Expired
                                                    !</span></a></li>
                                    @else
                                        <li><a href="#">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span>Enroll :
                                                    {{ @$training->enroll_start_date }} to
                                                    {{ @$training->enroll_end_date }}</span></a></li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="txt">
                    <strong class="title"><a
                            href="{{ route('training-user.course-details', @$training->id) }}">{{ $training->name }}</a></strong>

                    @if (@$training->price == 0 || @$training->price == '')
                        <span class="price"><span>Free</span></span>
                    @else
                        <span class="price"><span>₹</span>
                            <span>{{ number_format(@$training->price, 2, '.', ',') }}</span></span>
                    @endif
                </div>
            </div>
        </li>
    @endforeach
@else
    <P class="text-center">No Record Found !</P>
@endif
