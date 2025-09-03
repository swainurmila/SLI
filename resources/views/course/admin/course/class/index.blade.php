@extends('course.layouts.admin.main')
@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Class</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Course</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::previous()}}">{{@$cr_details_data->course_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">classes</a></li>
                    </ol>
                </div>
            </div>

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-lg-9 col-sm-4">
                    &nbsp;
                </div>
                <div class="col-lg-1 col-sm-4">
                   &nbsp;
                </div>

                <div class="col-lg-2 col-sm-4">
                    <a href="{{ route('course.admin.course-view.class.create', ['id' => $cr_details_data->id,'syllabus_id'=>@$syllabus_id]) }}" class="btn ms-auto btn-md custom-btn">
                        Add Class</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if (!$classes->isEmpty())

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Class Trainer</th>
                                            <th>Class Mode</th>
                                            <th>Class Name</th>
                                            <th>Class Date</th>
                                            <th>Start Link</th>
                                            <th>Joining Link</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        
                                            @foreach ($classes as $key => $class)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $class->trainerDetails->user_name }}</td>
                                                    <td>{{ $class->class_mode }}</td>
                                                    <td>{{ $class->class_name }}</td>

                                                    <td>{{ $class->class_date }}</td>

                                                    <td>
                                                        @if (@$class->class_mode == 'online' && @$class->meetingDetails->start_url != null)
                                                            @if (@$class->meetingDetails)
                                                                <a href="{{@$class->meetingDetails->start_url}}">Start Meeting</a>
                                                            @else
                                                                Not Created
                                                            @endif 
                                                        @else
                                                            Not Required
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @if (@$class->class_mode == 'online')
                                                            @if (@$class->meetingDetails)
                                                                <a href="{{@$class->meetingDetails->join_url}}">Join</a>
                                                            @else
                                                                Not Created
                                                            @endif
                                                        @else
                                                            Not Required
                                                        @endif

                                                    <td>
                                                        {{-- {{ route('attendance.index', ['id' => $class->id]) }} --}}
                                                        <a href="{{route("course.course-class-attendance",$class->id )}}"
                                                            class="btn ms-auto btn-md custom-btn">
                                                            Attendance</a>


                                                        @if (@$class->class_mode == 'online')
                                                            @if (@$class->meetingDetails)
                                                                <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                                                        data-bs-target="#updateZoomMeeting-{{@$class->meetingDetails->id}}">Update Meeting</button>

                                                            @else
                                                                Not Created
                                                            @endif
                                                        @endif
                                                        
                                                    </td>


                                                    <td>
                                                        @if (@$class->class_mode == 'online')
                                                            @if (@$class->meetingDetails)
                                                                @if (@$class->meetingDetails->start_url)
                                                                    <div class="modal fade mode_vid" id="updateZoomMeeting-{{@$class->meetingDetails->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                                        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="staticBackdropLabel">Update 
                                                                                        Class</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                
                                                                                <form action="{{ route('course.admin.class.zoom.update',@$class->meetingDetails->id) }}" method="POST" id="zoom_update"
                                                                                    enctype="multipart/form-data">
                                                                                    @method('PATCH')
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-3 row">

                                                                                            <input type="hidden" value="{{@$class->meetingDetails->meeting_id}}" name="meeting_id">
                                                                                            <input type="hidden" value="{{@$class->class_date}}" name="class_date">

                                                                                            <div class="col-sm-12 text-start">
                                                                                                <label for="" class="col-form-label">Meeting Topic</label>
                                                                                                <input class="form-control" type="text" value="{{@$class->meetingDetails->topic}}" id="meeting_topic"
                                                                                                    name="topic">
                                                                                            </div>
                                                                                            <div class="col-sm-12 text-start">
                                                                                                <label for="" class="col-form-label">Meeting Agenda</label>
                                                                                                <input class="form-control" type="text" value="{{@$class->meetingDetails->agenda}}" id="meeting_agenda"
                                                                                                    name="agenda">
                                                                                            </div>
                                                                                            
                                                        
                                                                                            <div class="col-sm-12 text-start">
                                                                                                <label for="" class="col-form-label">Meeting Start Time</label>
                                                                                                <input class="form-control" type="time" value="{{@$class->meetingDetails->start_time}}" id="meeting_start_time"
                                                                                                    name="meeting_start_time">
                                                                                            </div>
                                                        
                                                                                            <div class="col-sm-12 text-start zoom-meeting">
                                                                                                <label for="" class="col-form-label">Meeting Duration</label>
                                                                                                <input class="form-control" type="number" value="{{@$class->meetingDetails->duration}}" id="meeting_duration"
                                                                                                    name="meeting_duration">
                                                                                            </div>
                                                        
                                                                                            <div class="col-sm-12 text-start zoom-meeting">
                                                                                                <label for="" class="col-form-label">Your Video</label>
                                                                                                <select name="host_video" class="form-control" id="host_video">
                                                                                                    <option value="">Select</option>
                                                                                                    <option value="1" {{@$class->meetingDetails->host_video == true ? 'selected' : ''}}>Yes</option>
                                                                                                    <option value="0" {{@$class->meetingDetails->host_video == false ? 'selected' : ''}}>No</option>
                                                                                                </select>
                                                                                            </div>
                                                        
                                                                                            <div class="col-sm-12 text-start zoom-meeting">
                                                                                                <label for="" class="col-form-label">Participant Video</label>
                                                                                                <select name="participant_video" class="form-control" id="participant_video">
                                                                                                    <option value="">Select</option>
                                                                                                    <option value="1"  {{@$class->meetingDetails->participant_video == true ? 'selected' : ''}}>Yes</option>
                                                                                                    <option value="0" {{@$class->meetingDetails->participant_video == false ? 'selected' : ''}}>No</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn custom-btn">Update</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="modal fade mode_vid" id="updateZoomMeeting-{{@$class->meetingDetails->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                                        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Class</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                
                                                                                <form action="{{ route('course.admin.class.auth.googlemeet.update',@$class->meetingDetails->id
                                                                                ) }}" method="POST" id="google_meet_update"
                                                                                    enctype="multipart/form-data">
                                                                                    @method('PATCH')
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-3 row">

                                                                                            <input type="hidden" value="{{@$class->meetingDetails->meeting_id}}" name="meeting_id">
                                                                                            <input type="hidden" value="{{@$class->class_date}}" name="class_date">
                                                                                            <input type="hidden" value="{{@$class->course_id}}" name="course_id">
                                                                                            <input type="hidden" value="{{@$class->syllabus_id}}" name="syllabus_id">



                                                                                            <div class="col-sm-12 text-start">
                                                                                                <label for="" class="col-form-label">Meeting Topic</label>
                                                                                                <input class="form-control" type="text" value="{{@$class->meetingDetails->topic}}" id="meeting_topic"
                                                                                                    name="topic">
                                                                                            </div>
                                                                                            <div class="col-sm-12 text-start">
                                                                                                <label for="" class="col-form-label">Meeting Agenda</label>
                                                                                                <input class="form-control" type="text" value="{{@$class->meetingDetails->agenda}}" id="meeting_agenda"
                                                                                                    name="agenda">
                                                                                            </div>
                                                        
                                                                                            <div class="col-sm-12 text-start">
                                                                                                <label for="" class="col-form-label">Meeting Start Time</label>
                                                                                                <input class="form-control" type="time" value="{{@$class->meetingDetails->start_time}}" id="meeting_start_time"
                                                                                                    name="meeting_start_time">
                                                                                            </div>
                                                        
                                                
                                                                                            <div class="col-sm-12 google-meeting text-start">
                                                                                                <label for="" class="col-form-label">Meeting End Time</label>
                                                                                                <input class="form-control" type="time" value="{{@$class->meetingDetails->end_time}}" id="meeting_end_time"
                                                                                                    name="meeting_end_time">
                                                                                            </div>
                                                        
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn custom-btn">Update</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        
                                    </tbody>
                                </table>
                            </div>

                            @else
                                <p class="text-center">No Class Found !</p>
                            @endif
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {


            $.validator.addMethod("greaterThanStartTime", function(value, element) {
                var startTime = $('#start_time').val();
                var endTime = value;

                if (!startTime || !endTime) {
                    // If either field is empty, no comparison needed
                    return true;
                }

                // Parse times to compare
                var startTimeParts = startTime.split(':');
                var endTimeParts = endTime.split(':');

                var startDateTime = new Date(0, 0, 0, startTimeParts[0], startTimeParts[1]);
                var endDateTime = new Date(0, 0, 0, endTimeParts[0], endTimeParts[1]);

                // Compare times
                return endDateTime > startDateTime;
            }, "End time must be greater than start time");

            $("#zoom_update").validate({
                rules: {
                    topic: {
                        required: true,
                    },
                    agenda: {
                        required: true,
                    },
                    meeting_duration: {
                        required: true,
                        number:true
                    },
                    meeting_start_time:{
                        required:true
                    },
                    meeting_end_time:{
                        required:true,
                        greaterThanStartTime: true
                    }
                },
                messages: {
                    end_time: {
                        greaterThanStartTime: "End time must be greater than start time"
                    }

                },
                submitHandler: function(form) {
                    form.submit();
                },
            });



            $("#google_meet_update").validate({
                rules: {
                    topic: {
                        required: true,
                    },
                    agenda: {
                        required: true,
                    },
                    meeting_start_time:{
                        required:true
                    },
                    meeting_end_time:{
                        required:true,
                        greaterThanStartTime: true
                    }
                },
                messages: {
                    end_time: {
                        greaterThanStartTime: "End time must be greater than start time"
                    }

                },
                submitHandler: function(form) {
                    form.submit();
                },
            });

        });

    </script>
@endsection
