@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-11">
                    <div class="">
                        <h4 class="mb-0"><b>Add New Class</b> </h4>
                    </div>
                </div>
                <div class="col-1">
                    <a href="{{ route('training.admin.class.list',@$id) }}" class="btn ms-auto btn-md custom-btn">
                        Back</a>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('training.admin.class.store') }}" method="POST" id="class_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="mb-3 row">
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Class Trainer</label>
                                        <select class="form-select form-valid"  id="trainer_user_id" name="trainer_user_id">
                                            <option value="">Select Trainer</option>
                                            @foreach($user_detail_approve as $traner_user)

                                            <option value="{{$traner_user->id}}">{{$traner_user->first_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Class Mode</label>
                                        <select class="form-select form-valid class_mode" id="class_mode" name="class_mode">
                                            <option value="">Select</option>
                                            <option value="online">Online</option>
                                            <option value="Offline">Offline</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-lg-4 online-mode">
                                        <label class="col-form-label">Select Online Mode</label>
                                        <select class="form-select form-valid select-online-mode" id="online_mode"
                                            name="online_mode">
                                            <option value="">Select</option>
                                            <option value="zoom">Zoom</option>
                                            <option value="google-meet">Google Meet</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Class Name</label>
                                        <input class="form-control form-valid" type="text" maxlength="20" value="" id="batch_class_name"
                                            name="class_name">
                                    </div>
                                    <input class="form-control" type="hidden" value="{{ $id }}"
                                        id="batch_details_id" name="batch_details_id">
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Class Date</label>
                                        <input class="form-control form-valid" type="Date" value=""
                                            min="<?php echo $tr_details_data->start_date; ?>" max="<?php echo $tr_details_data->end_date; ?>" id="class_date"
                                            name="class_date">
                                    </div>
                                    <span>

                                        <div class="row link">
                                            <div class="col-sm-12 col-lg-4">
                                                <label for="" class="col-form-label">Meeting Topic</label>
                                                <input class="form-control" type="text" value="" id="meeting_topic"
                                                    name="meeting_topic">
                                            </div>
        
                                            <div class="col-sm-12 col-lg-4">
                                                <label for="" class="col-form-label">Meeting Agenda</label>
                                                <input class="form-control" type="text" value="" id="meeting_agenda"
                                                    name="meeting_agenda">
                                            </div>
        
                                            <div class="col-sm-12 col-lg-4">
                                                <label for="" class="col-form-label">Meeting Start Time</label>
                                                <input class="form-control" type="time" value="" id="start_time"
                                                    name="meeting_start_time">
                                            </div>
        
                                            <div class="col-sm-12 col-lg-4 zoom-meeting">
                                                <label for="" class="col-form-label">Meeting Duration ( Minutes )</label>
                                                <input class="form-control" type="number" value="" id="meeting_duration"
                                                    name="meeting_duration">
                                            </div>

                                            <div class="col-sm-12 col-lg-4 google-meeting">
                                                <label for="" class="col-form-label">Meeting End Time</label>
                                                <input class="form-control" type="time" value="" id="meeting_end_time"
                                                    name="meeting_end_time">
                                            </div>
        
                                            <div class="col-sm-12 col-lg-4 zoom-meeting">
                                                <label for="" class="col-form-label">Your Video</label>
                                                <select name="host_video" class="form-control" id="host_video">
                                                    <option value="">Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
        
                                            <div class="col-sm-12 col-lg-4 zoom-meeting">
                                                <label for="" class="col-form-label">Participant Video</label>
                                                <select name="participant_video" class="form-control" id="participant_video">
                                                    <option value="">Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn custom-btn">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            $(".link").hide();
            $('.online-mode').hide();


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


            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "This field is required.");


           



            $.validator.addMethod('noLeadingZeros', function(value, element) {
                return /^[1-9][0-9]*$/.test(value);
            }, 'Price cannot have leading zeros');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#class_save").validate({
                rules: {
                    trainer_user_id:{
                        required:true
                    },
                    class_mode: {
                        required: true,
                    },
                    class_name: {
                        required: true,
                        noSpace:true,
                        maxlength: 20,
                    },
                    class_date: {
                        required: true
                    },
                    online_mode: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_topic: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_agenda: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_start_time: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_end_time: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online' && $('#online_mode').val() == 'google-meet';
                            }
                        },
                        greaterThanStartTime: true
                    },
                    meeting_duration: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online' && $('#online_mode').val() == 'zoom';
                            }
                        },
                        number: true
                    },
                    host_video: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online' && $('#online_mode').val() == 'zoom';
                            }
                        }
                    },
                    participant_video: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online' && $('#online_mode').val() == 'zoom';
                            }
                        }
                    },
                    
                },
                messages: {
                    trainer_user_id: "Please choose a class trainer",
                    class_name:{
                        required:"Class Name is required",
                        noSpace:"Class Name can not have leading space",
                    },
                    class_mode: "Please choose class mode",
                    class_date: "Please enter class date",
                    online_mode: "Please choose a online mode",
                    meeting_topic: "Please enter meeting topic",
                    meeting_agenda: "Please enter meeting agenda",
                    meeting_start_time: "Please enter meeting start time",
                    meeting_duration: "Please enter meeting duration",
                    host_video: "Please enter host video",
                    participant_video: "Please enter participant video",
                    meeting_end_time: {
                        greaterThanStartTime: "End time must be greater than start time"
                    }


                },
                submitHandler: function(form) {
                    form.submit();
                },
            });


        });


        $('.class_mode').change(function() {
            let selectedItem = $(this).val();

            if (selectedItem === 'online') {
                // $(".link").show();
                $('.online-mode').show();
            } else {
                $(".link").hide();
                $('.online-mode').hide();
            }
        })

        
        $('.select-online-mode').change(function() {
            let selectedItem = $(this).val();
            $(".link").show();
            if (selectedItem === 'zoom') {
                $('.zoom-meeting').show();
                $(".google-meeting").hide();
            } else {
                $('.zoom-meeting').hide()
                $(".google-meeting").show();

            }
        })
    </script>
@endsection
