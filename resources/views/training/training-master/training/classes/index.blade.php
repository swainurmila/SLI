@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Class</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Training</a></li>
                                <li class="breadcrumb-item"><a href="{{URL::previous()}}">{{@$tr_details_data->training->name}}</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0);">Classes</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left d-flex">
                            <h4><span class="badge bg-success">Training Name : {{@$tr_details_data->training->name}}</span></h4>
                            {{-- <h4><span class="badge bg-warning mx-3">{{@$tr_details_data->training->name}} :</span></h4> --}}
                            <h4><span class="badge bg-danger mx-3">Batch Name : {{@$tr_details_data->batch->batch_name}}</span></h4>
                        </div>

                        <div class="page-title-right">
                            <a href="{{ route('training.admin.class.create', ['id' => $id]) }}" class="btn ms-auto btn-md custom-btn">
                                Add Class</a>
                            <a href="{{ route('training.admin.about',@$tr_details_data->training->id) }}" class="btn ms-2 btn-md btn-dark">
                                Back</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Class Trainer</th>
                                            <th>Class Mode</th>
                                            <th>Class Name</th>
                                            <th>Class Date</th>
                                            <th>Start Link</th>
                                            <th>Joining Link</th>
                                            <th>Action</th>
                                            <th>Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $class)
                                            <tr class="text-center">
                                                <?php 

                                                $traner_name = App\Models\User::where('id', $class->trainer_user_id)->first();
                                                ?>
                                                <td>{{ ++$i }}</td>
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
                                                       ---
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
                                                        ---
                                                    @endif

                                                <td>
                                                    
                                                    <a href="{{ route('training.admin.class.view', ['id' => $class->id]) }}"
                                                        class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                                        <i class="fa fa-eye"></i></a>

                                                    {{-- <a href="{{ route('training.admin.class.view', ['id' => $class->id]) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fa fa-eye"></i>
                                                    </a> --}}
                                                    
                                                    <a href="{{ route('attendance.index', ['id' => $class->id]) }}"
                                                        class="btn btn-sm custom-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Attendance">
                                                        <i class="uil-user-check"></i></a>

                                                    @if (@$class->class_mode == 'online')
                                                        @if (@$class->meetingDetails)
                                                            <button class="btn btn-sm btn-info" type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#updateZoomMeeting-{{@$class->meetingDetails->id}}" title="Update Meeting">Update Meeting</button>

                                                        @else
                                                        <button class="btn btn-sm btn-danger" type="button" title="Not Created">Not Created</button>
                                                            
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
                                                            
                                                                            <form action="{{ route('training.admin.zoom.update',@$class->meetingDetails->id) }}" method="POST" id="zoom_update"
                                                                                enctype="multipart/form-data">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3 row">

                                                                                        <input type="hidden" value="{{@$class->meetingDetails->meeting_id}}" name="meeting_id">
                                                                                        <input type="hidden" value="{{@$class->training_id}}" name="training_id">
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
                                                            
                                                                            <form action="{{ route('training.admin.auth.googlemeet.update',@$class->meetingDetails->id
                                                                            ) }}" method="POST" id="google_meet_update"
                                                                                enctype="multipart/form-data">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3 row">

                                                                                        <input type="hidden" value="{{@$class->meetingDetails->meeting_id}}" name="meeting_id">
                                                                                        <input type="hidden" value="{{@$class->training_id}}" name="training_id">
                                                                                        <input type="hidden" value="{{@$class->class_date}}" name="class_date">
                                                                                        <input type="hidden" value="{{@$class->meetingDetails->training_details_id}}" name="training_details_id">



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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
