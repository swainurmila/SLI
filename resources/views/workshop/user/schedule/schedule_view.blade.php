@extends('workshop.user.layouts.main')
@section('profile-content')
<div class="col-xl-9 col-lg-9 col-md-12">
    <div class="dashboard__content__wraper" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="dashboard__section__title">
            <h4>Schedule</h4>

        </div>
        <div class="row table-responsive">

            @if ($schedule)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">S.l No</th>
                        <th scope="col">Schedule Title</th>
                        <th scope="col">Schedule Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Schedule Description</th>
                        {{-- <th scope="col">Action</th> --}}

                    </tr>
                </thead>
                {{-- {{dd($schedule)}} --}}
                <tbody>
                    @foreach ($schedule as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->schedule_title }}</td>
                        <td>{{ $item->schedule_date }}</td>
                        <td>{{ $item->start_time }}</td>
                        <td>{{ $item->end_time }}</td>
                        <td>{{ $item->sch_description }}</td>
                    </tr>

                @endforeach




                </tbody>
            </table>
            @else
            <p>No schedule found.</p>
           @endif

        </div>
    </div>

</div>
@endsection
