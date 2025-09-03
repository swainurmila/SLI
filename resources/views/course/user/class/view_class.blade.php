@extends('course.user.layouts.main')
@section('profile-content')
<div class="col-xl-9 col-lg-9 col-md-12">
    <div class="dashboard__content__wraper">
        <div class="dashboard__section__title">
            <h4>View Classes</h4>
        </div>
        <div class="row">
                        
                        

            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0">
                    <thead class="table-secondary">
                        <tr class="">
                            <th>Sl. No</th>
                             
                            <th>Class Mode</th>
                            <th>Class Name</th>
                            <th>Class Date</th>
                            <th>Joining Link</th>
                            
                            {{-- <th>Attendance</th> --}}
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes->Class as $key=>$class)
                       
                        <tr class="">
                            <td>{{++$key}}</td>
                            <td class="text-capitalize">{{$class->class_mode}}</td>
                            <td>{{$class->class_name}}</td>
                            <td>{{$class->class_date}}</td>
                            <td>
                                @if(Carbon\Carbon::today()->format('Y-m-d') <= $class->class_date && $class->class_mode == "online")
                                    @if (@$class->meetingDetails->join_url != null)
                                        <a href="{{ @$class->meetingDetails->join_url }}">Join</a>
                                    @else
                                        Not Available
                                    @endif  
                                @elseif ($class->class_mode == "offline")
                                    Offline Class
                                @else
                                    Link Expired
                                @endif  
                            </td>
                            {{-- <td>
                                <a href="{{ route('training.user.class.view', ['id' => $class->id]) }}" class="btn btn-warning btn-sm"
                                title="Edit">
                                <i class="fa fa-eye"></i>
                            </a>
                            </td> --}}
                        </tr>
                        @endforeach
                          </tbody>
                </table>
            </div>

        </div>
        
    </div>

</div>
@endsection
