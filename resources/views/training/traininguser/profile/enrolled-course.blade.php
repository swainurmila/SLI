@extends('training.traininguser.profile.layouts.main')


@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper"
            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="dashboard__section__title">
                <h4>My Trainings</h4>
            </div>
            <div class="row table-responsive">

                @if (count(@$user->trainingOrders) > 0)
                    <table id="datatable_2" class="table enrolled">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Batch</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Price</th>
                                <th scope="col">Reviews</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($user->trainingOrders as $key => $order)
                                {{-- {{dd($order->batch->training->TrainingReviews)}} --}}
                                @php
                                    $completedClassPercentage = 0;
                                    if (count($order->trainingClasses) > 0) {
                                        // if (count($order->batch->trainingDetailsByBatch) > 0) {
                                        // $trainingDetailsByBatch = $order->batch->trainingDetailsByBatch[0];
                                        // if (count($trainingDetailsByBatch->trainingClasses) > 0) {
                                        foreach ($order->trainingClasses as $key => $classes) {
                                            if (
                                                $classes->trainingAttendance &&
                                                $classes->trainingAttendance->attendance_type == 1
                                            ) {
                                                $completedClassPercentage++;
                                            }
                                        }
                                        $completedClassPercentage =
                                            ($completedClassPercentage / count($order->trainingClasses)) * 100;

                                        // }
                                        // }
                                    } else {
                                        $completedClassPercentage = 0;
                                    }
                                    $avg_ratings = App\Models\Training\TrStudentReview::with('userDetails')
                                        ->where('training_id', $order->training_id)
                                        ->avg('rate');
                                    $roundedAverageRating = round($avg_ratings, 2);
                                @endphp
                                <tr>
                                    <td><a
                                            href="{{ route('training-user.course-details', @$order->batch->training->id) }}">{{ ucwords(@$order->batch->training->name) }}</a>
                                    </td>
                                    <td>{{ @$order->batch->batch_name }}</td>

                                    <td>{{ @$order->batch->training->training_duration . ' ' . @$order->batch->training->training_duration_type }}
                                    </td>
                                    <td>
                                        @if (@$order->batch->training->price == 0 || @$order->batch->training->price == '')
                                            <div class="gridarea__price green__color">
                                                <span> Free</span>
                                            </div>
                                        @else
                                            <div class="gridarea__price">
                                                ₹{{ number_format(@$order->batch->training->price, 2, '.', ',') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>( {{ count(@$order->batch->training->TrainingReviews) }} )</td>
                                    {{-- <td>
                                @if ($roundedAverageRating != 0)
                                    @for ($i = 1; $i <= $roundedAverageRating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" height="10" width="15.75" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                    @endfor

                                    @else
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" height="10" width="13.5" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                    @endfor

                                @endif
                            </td> --}}
                                    <td>
                                        @if (count(@$order->trainingClasses) > 0)
                                            {{-- <div class="progress text-center">
                                        <div class="progress-bar training-progress-bar" role="progressbar" aria-valuenow="{{@$completedClassPercentage}}" aria-valuemin="0" aria-valuemax="100" style="color:white;width: 100%;
        background: linear-gradient(to right, #5F2DED {{@$completedClassPercentage}}%, #e9ecef 0%);">
        {{@$completedClassPercentage}}% Complete
        </div>
        </div> --}}

                                            <div class="progress ">
                                                <div class="progress-bar bg-success training-progress-bar"
                                                    role="progressbar"
                                                    aria-valuenow="{{ round(@$completedClassPercentage, 2) }}"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                    {{ round(@$completedClassPercentage, 2) }}%
                                                </div>
                                            </div>

                                            {{-- <div class="progress">
                                        <div class="progress-bar progress-bar-success bg-success" role="progressbar" aria-valuenow="{{@$completedClassPercentage}}" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
        <span class="sr-only">{{@$completedClassPercentage}}% Complete</span>
        </div>
        </div> --}}
                                        @endif
                                    </td>
                                    <td>{{ @$order->userTrainingDetails->start_date }}</td>
                                    <td>{{ @$order->userTrainingDetails->end_date }}</td>
                                    <td>
                                        @if (count(@$order->trainingClasses) > 0)
                                            @if (@$order->training_details_id != null)
                                                <a class="btn btn-sm btn-success" style="margin-bottom: 10px"
                                                    href="{{ route('training-user.class.list', ['id' => @$order->training_details_id]) }}">View
                                                    Class</a>
                                            @else
                                                <span>At hold</span>
                                                {{-- <a class="btn btn-sm btn-success" style="margin-bottom: 10px" href="#">At Hold</a> --}}
                                            @endif
                                            @if (
                                                $completedClassPercentage == 100 &&
                                                $order->trainingClasses->where('trainingAttendance.attendance_type', 1)->count() > 0 &&
                                                $order->batch->training->TrainingReviews->isNotEmpty()
                                            )
                                                <a class="btn btn-sm btn-success" href="{{ route('training-user.class.Certificate', ['id' => $order->id]) }}">Download Certificate</a>
                                            @endif
                                        @else
                                            No Class Yet
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Course Found !</p>
                @endif
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable_2').DataTable();
        });
    </script>
@endsection
