@extends('course.user.layouts.main')
@section('profile-content')
    <div class="container">
        <div class="row">
            <!-- sidebar of the Page start here -->
            <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
            </aside><!-- sidebar of the Page end here -->
            <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">

                <!-- mt productlisthold start here -->
                <div class="product-detail-tab course-tab">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="mt-tabs text-center text-uppercase">
                                <li><a href="#tab1" class="active">Lecture Notes</a></li>
                                <li><a href="#tab2">Presentations</a></li>
                                <li><a href="#tab3">Assignments</a></li>
                            </ul>
                            <div class="tab-content">


                                <div id="tab1">
                                    <ul class="mt-productlisthold list-inline">

                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab" tabindex="0">
                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-centered table-nowrap mb-0">
                                                        <thead class="table-secondary">
                                                            <tr class="">
                                                                <th>Sl. No</th>
                                                                <th>E-Book Title</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->Note as $key => $value)
                                                                <tr class="">
                                                                    <td>{{ ++$key }}</td>
                                                                    <td>{{ $value->material_title }}</td>
                                                                    <td><a href="{{ $value->material_file }}"
                                                                            target="_blank" class="btn btn-info btn-sm"
                                                                            title="Edit">
                                                                            <i class="fa fa-file-text"></i>
                                                                        </a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                                <div id="tab2">
                                    <ul class="mt-productlisthold list-inline">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab" tabindex="0">
                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-centered table-nowrap mb-0">
                                                        <thead class="table-secondary">
                                                            <tr class="">
                                                                <th>Sl. No</th>
                                                                <th>Media Title</th>
                                                                <th>Media Type</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->Presentation as $key => $val)
                                                                <tr class="">
                                                                    <td>{{ ++$key }}</td>
                                                                    <td>{{ $val->media_title }}</td>
                                                                    <td class="text-capitalize">{{ $val->media_type }}</td>

                                                                    <td><a href="{{ $val->media_file }}" target="_blank"
                                                                            class="btn btn-warning btn-sm" title="Edit">
                                                                            <i class="fa fa-play"></i>
                                                                        </a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </ul><!-- mt productlisthold end here -->
                                    <!-- mt pagination start here -->

                                </div>

                                <div id="tab3">
                                    <ul class="mt-productlisthold list-inline">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab" tabindex="0">
                                            <div class="mt-4">
                                                <div class="table-responsive dashboard__table">
                                                    <table class="table table-centered table-nowrap mb-0">
                                                        <thead class="table-secondary">
                                                            <tr class="">
                                                                <th>Sl. No</th>
                                                                <th>Assignment Title</th>
                                                                <th>Assignment Type</th>
                                                                <th>Assignment Level</th>
                                                                <th>Start Date</th>
                                                                <th>Submission Date</th>
                                                                <th>Pass Score</th>
                                                                <th>Result</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                            @foreach ($data->Assignment as $key=>$val)
                                                            {{-- {{dd(@$val->end_submission_date)}} --}}
                                                                <tr class="">
                                                                    <td>{{ ++$key }}</td>
                                                                    <td>{{ @$val->assignment_title }}</td>
                                                                    <td>{{ ucfirst(@$val->question_type) }}</td>
                                                                    <td>{{ ucfirst(@$val->question_level) }}</td>
                                                                    <td>{{ @$val->start_submission_date }}</td>
                                                                    <td>{{ @$val->end_submission_date }}</td>
                                                                    <td>{{@$val->pass_score}}</td>
                                                                    <td>{{@$val->Answer->result}}

                                                                        {{-- @if (@$val->assignmentAnswer && @$val->assignmentAnswer->result)
                                                                        
                                                                        @if (@$val->Answer->result > @$val->pass_score@$val->Answer->result > @$val->pass_score)
                                                                            <span class="dashboard__td">Pass</span>
                                                                        @else
                                                                            <span class="dashboard__td dashboard__td--cancel">Fail</span>
                                                                        @endif
                                                                        @endif --}}
                                                                    </td>
                                                                    
                                                                    <td><a href="{{ @$val->question_file }}" target="_blank" class="btn btn-warning btn-sm"
                                                                        title="Edit">
                                                                        <i class="fa fa-file-image-o"></i>
                                                                    </a>
                                                                        @if (@$val->Answer)
                                                                            {{$val->Answer->result == null ? 'Already Submitted' : 'Result Published'}}
                                                                        @else
                                                                            @if(@$val->end_submission_date > Carbon\Carbon::today()->format('Y-m-d'))
                                                                            <button class="submit-assignment btn custom-btn btn-md" id="{{@$val->id}}" data-target="updateAssignment-{{@$val->id}}">Submit Assignment</button>
                                                                            @else
                                                                                Expired
                                                                                @endif
                                                                        @endif
                                                                    

                                                                        <div class="modal" id="updateAssignment-{{@$val->id}}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                                                            <div class="modal-dialog modal-dialog-centered text-start" role="document">
                                                                                <div class="modal-content">
                                                                                    <form id="assignment-save-btn" action="{{route("user.course.store-assignment-answer", $val->id)}}" method="POST" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="modal-body">
                                                                                            <div class="mb-3 row">
                                                                                                <input type="hidden" value="{{@$val->id}}" name="assignment_id">
                                                                                                <input type="hidden" value="{{@$val->course_id}}" name="course_id">
                                                                                                <input type="hidden" value="{{@$val->syllabus_id}}" name="syllabus_id">
                                                                                               
                                                                                                <div class="col-sm-12 col-lg-12">
                                                                                                    <label for="" class="col-form-label">Assignment</label>
                                                                                                    <input class="form-control form-valid" type="file" value="" id="assignment" name="answer_file">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary close-modal btn-sm" data-target="#updateAssignment-{{@$val->id}}">Close</button>
                                                                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                
                                                                    </td>


                                                                
                                                                    
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </ul><!-- mt productlisthold end here -->
                                    <!-- mt pagination start here -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('.assignment-modal').hide()
            $("#assignment-save-btn").validate({
                rules: {
                    answer_file: {
                        required: true,
                        accept: "application/pdf"
                    },

                },
                messages: {
                    answer_file: {
                        required: "Please choose a file",
                        accept: "Please select a PDF file"
                    },
                },
            })


            $('.submit-assignment').click(function() {

                var targetModalId = $(this).data('target');
                $('#' + targetModalId).show();
                // document.querySelector('#updateAssignment-'+id).style.display='block';
                // $('#updateAssignment-'+id).show()



            })

            $('.close-modal').click(function() {
                var target = $(this).data('target');

                $(target).find('input[type="file"]').val('');
                $(target).hide();
            });

        });
    </script>
@endsection
