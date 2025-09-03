@extends('course.layouts.admin.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">

                        @if (auth()->user()->hasRole('Course Admin'))
                            <h4 class="mb-0 text-capitalize">Assign classes</h4>
                        @else
                            <h4 class="mb-0 text-capitalize">Assign Classes for {{@$traner_user_data->first_name}}</h4>
                        @endif

                        <div class="page-title-right">
                            <a href="{{ URL::previous() }}" class="btn btn-md btn-dark">
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
                                <table id="datatable_1" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr class="">
                                            <th>Sl. No</th>
                                            <th>Course Name</th>
                                            
                                            <th>Course Start Date</th>
                                            
                                            <th>Course End Date</th>

                                            <th>Class Mode</th>
                                            <th>Class Name</th>
                                            <th>Class Date</th>
                                            <th>Class Link</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 0;
                                        ?>
                                        @foreach ($classes as $class)
                                            <tr class="text-center">
                                                <td>{{ ++$i }}</td>
                                                
                                                <td>{{@$class->courseDetails->course_name}}</td>

                                                
                                                
                                                <td>{{ date('d-m-Y',strtotime(@$class->courseDetails->course_start_date)) }} </td>
                                                <td> {{ date('d-m-Y',strtotime(@$class->courseDetails->course_end_date)) }}       </td>
                                                <td>{{ @$class->class_mode }}</td>

                                                <td>{{ @$class->class_name }}</td>

                                                <td>{{ @$class->class_date }}</td>

                                                @if (@$class->class_mode == 'online')
                                                    <td><a href="{{ @$class->meetingDetails->join_url }}">Join</a></td>
                                                @else
                                                    <td>Not Required</td>
                                                @endif


                                                <td>
                                                   
                                                    <a href="{{ route('course.admin.course-view', ['id' => @$class->course_id]) }}" class="btn custom-btn btn-sm edit waves-effect waves-light">About
                                                        Course</a>

                                                        <a href="{{ route('course.course-class-attendance', ['id' => @$class->id]) }}" class="btn btn-danger btn-sm edit waves-effect waves-light">
                                                            Attendance</a>
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





    <div class="modal fade mode_vid" id="addMeeting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form action="{{ route('training.admin.class.store') }}" method="POST" id="class_save"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="col-sm-12 col-lg-4">
                            <label class="col-form-label">Class Mode</label>
                            <select class="form-select form-valid class_mode" id="class_mode" name="class_mode">
                                <option value="">Select</option>
                                <option value="online">Online</option>
                                <option value="Offline">Offline</option>

                            </select>
                        </div>
                        


                        <div class="col-sm-12 col-lg-4 link">
                            <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal"></button>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn custom-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



@section('script')
<script>
    $(document).ready(function() {

        $('#datatable_1').DataTable();
    });
</script>
    <script>
        $(document).ready(function() {
            $(".link").hide();
            $('.online-mode').hide();



            $("#class_save").validate({
                rules: {
                    class_mode: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    class_date: {
                        required: true
                    },
                    class_link: {
                        required: {
                            depends: function(element) {
                                return $('#class_mode').val() == 'online';
                            }
                        }
                    }
                },
                messages: {
                    class_mode: "Please enter class mode",
                    name: "Please enter class name",
                    class_date: "Please enter class date",
                    class_link: "Please enter class link"

                },
                submitHandler: function(form) {
                    form.submit();
                },
            });


        });


        $('.class_mode').change(function() {
            let selectedItem = $(this).val();

            if (selectedItem === 'online') {
                $(".link").show();
                $('.online-mode').show();
            } else {
                $(".link").hide();
                $('.online-mode').hide();
            }
        })
    </script>
   
@endsection
