@extends('workshop.layouts.backend.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-11">
                    <div class="">
                        <h4 class="mb-0"><b>Add New Schedule</b> </h4>
                    </div>
                </div>
                <div class="col-1">
                    <a href="{{ URL::previous() }}" class="btn ms-auto btn-md custom-btn">
                        Back</a>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('workshop.create-schedule') }}" method="POST" id="class_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="mb-3 row">
                                    <input type="hidden" name="workshop_id" value="{{ $workshop->id }}">
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Mode of Workshop</label>
                                        <select class="form-select form-valid class_mode" id="workshop_mode"
                                            name="workshop_mode">
                                            <option value="">Select</option>
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>

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
                                        <label for="" class="col-form-label">Schedule Name</label>
                                        <input class="form-control form-valid" type="text" value="" id="class_name"
                                            name="name">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Schedule Date</label>
                                        <input class="form-control form-valid" type="date" value=""
                                            min="{{$workshop->start_date}}" max="{{$workshop->end_date}}" id="workshop_date"
                                            name="workshop_date">
                                    </div>
                                    <div class="col-sm-12 col-lg-4 offline" id="offline_div1" style="display: none">
                                        <label for="" class="col-form-label">Start Time</label>
                                        <input class="form-control" type="time" value="" id="offline_start"
                                            name="offline_start">
                                    </div>

                                    <div class="col-sm-12 col-lg-4 offline" id="offline_div2" style="display: none">
                                        <label for="" class="col-form-label">End Time</label>
                                        <input class="form-control" type="time" value="" id="offline_end"
                                            name="offline_end">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label class="form-label">Description:<sup><span
                                                    style="color: red;">*</span></sup></label>
                                        <textarea name="sch_description" id="sch_description" class="form-control" placeholder="Add some text here...."></textarea>
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
                                                <input class="form-control" type="text" value=""
                                                    id="meeting_agenda" name="meeting_agenda">
                                            </div>

                                            <div class="col-sm-12 col-lg-4">
                                                <label for="" class="col-form-label">Meeting Start Time</label>
                                                <input class="form-control" type="time" value=""
                                                    id="start_time" name="meeting_start_time">
                                            </div>

                                            <div class="col-sm-12 col-lg-4 zoom-meeting">
                                                <label for="" class="col-form-label">Meeting Duration</label>
                                                <input class="form-control" type="number" value=""
                                                    id="meeting_duration" name="meeting_duration">
                                            </div>

                                            <div class="col-sm-12 col-lg-4 google-meeting">
                                                <label for="" class="col-form-label">Meeting End Time</label>
                                                <input class="form-control" type="time" value=""
                                                    id="meeting_end_time" name="meeting_end_time">
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
                                                <select name="participant_video" class="form-control"
                                                    id="participant_video">
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
        var startTimeInput = document.getElementById("offline_start");
        var endTimeInput = document.getElementById("offline_end");

        endTimeInput.addEventListener("change", function() {
            // Get the values of start time and end time
            var startTime = startTimeInput.value;
            var endTime = endTimeInput.value;

            if (!startTime || !endTime) return;

            var startDate = new Date("2000-01-01 " + startTime);
            var endDate = new Date("2000-01-01 " + endTime);

            if (startDate >= endDate) {
                alert("End time must be greater than start time.");
                endTimeInput.value = ""; 
            }
        });
    </script>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#class_save").validate({
                rules: {
                    workshop_mode: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    workshop_date: {
                        required: true
                    },
                    online_mode: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_topic: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_agenda: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_start_time: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online';
                            }
                        }
                    },
                    meeting_end_time: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online' && $('#online_mode')
                                .val() ==
                                    'google-meet';
                            }
                        },
                        greaterThanStartTime: true
                    },
                    meeting_duration: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online' && $('#online_mode')
                                .val() ==
                                    'zoom';
                            }
                        },
                        number: true,
                        max: 40
                    },
                    host_video: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online' && $('#online_mode')
                                .val() ==
                                    'zoom';
                            }
                        }
                    },
                    participant_video: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'online' && $('#online_mode')
                                .val() ==
                                    'zoom';
                            }
                        }
                    },
                    offline_start: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'offline';
                            }
                        }
                    },
                    offline_end: {
                        required: {
                            depends: function(element) {
                                return $('#workshop_mode').val() == 'offline';
                            }
                        }
                    },
                    sch_description: {
                        required: true,
                    },

                },
                messages: {
                    workshop_mode: "Please choose workshop mode",
                    name: "Please enter workshop name",
                    workshop_date: "Please enter workshop date",
                    online_mode: "Please choose a online mode",
                    meeting_topic: "Please enter meeting topic",
                    meeting_agenda: "Please enter meeting agenda",
                    meeting_start_time: "Please enter meeting start time",
                    host_video: "Please enter host video",
                    participant_video: "Please enter participant video",
                    offline_start: "Please enter start date",
                    offline_end: "Please enter end date",
                    sch_description: "Please add description",
                    meeting_end_time: {
                        greaterThanStartTime: "End time must be greater than start time"
                    },
                    meeting_duration: {
                        required: "Please enter meeting duration",
                        number: "Please enter a valid number",
                        max: "Meeting duration cannot be greater than 40"
                    },


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

        $('.class_mode').change(function() {
            let selectedItem = $(this).val();

            if (selectedItem === 'offline') {
                // $(".link").show();
                $('.offline').show();
            } else {
                $(".offline").hide();
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
