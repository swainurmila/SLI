@extends('training.admin.layouts.page-layouts.main')

@section('styles')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            /* color: var(--bs-nav-pills-link-active-color); */
            background-color: #179229;
            transform: scale(1.2);
            text-align: start;
        }

        .nav-pills .nav-link {
            text-align: start;
            color: black;

        }

        .nav-pills {
            width: 100%;
        }

        .card-header {
            box-shadow: rgb(33 35 38 / 18%) 0px 10px 10px -10px;
        }

        .tab-pane .fade .show .active {
            box-shadow: rgb(33 35 38 / 18%) 0px 10px 10px -10px;
        }

        .btn-danger-rgba {
            background-color: #cf656d;
            border: none;
            color: #ffffff;
        }

        .btn-primary-rgba {
            background-color: #3b8fb9;
            border: none;
            color: #ffffff;
        }
    </style>
@endsection


@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Class - {{ @$training_class->class_name }}</h4>

                        <div class="page-title-right">
                            <a href="{{ route('training.admin.class.list', @$training_class->training_details_id) }}"
                                class="btn btn-md btn-dark">
                                Back</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <div class="page-title-left d-flex">
                                            <h4><span class="badge bg-success">{{ @$training_class->training->name }}</span>
                                            </h4>
                                            <h4><span
                                                    class="badge bg-warning mx-3">{{ @$training_class->class_name }}</span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#ebooks-tab" role="tab">
                                        <span class="d-none d-sm-block">E-Books</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#video-audio-tab" role="tab">
                                        <span class="d-none d-sm-block">Video / Audio</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#assignments-tab" role="tab">
                                        <span class="d-none d-sm-block">Assignments</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="ebooks-tab" role="tabpanel">
                                    <div class="text-end mt-2">
                                        <button class="btn btn-sm custom-btn" type="button" data-bs-toggle="modal"
                                            data-bs-target="#addModal">Add E-Books</button>
                                    </div>

                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table id="e-bookTable"
                                                class="table table-centered table-bordered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-center">
                                                        <th>Sl. No</th>
                                                        <th>E-Book Title</th>
                                                        <th>Learning Material</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @foreach ($training_class_ebook as $traing_ebbok)
                                                        <tr class="text-center">
                                                            <td>{{ ++$i }}</td>
                                                            <td>{{ $traing_ebbok->ebook_name }}</td>
                                                            <?php
                                                            
                                                            $image_parth = 'public/upload/ebook_material/' . @$traing_ebbok->ebook_material;
                                                            ?>

                                                            <td><a href="{{ asset(@$image_parth) }}" target="_blank"
                                                                    class="btn btn-warning btn-sm" title="View">
                                                                    <i class="fa fa-eye"></i>
                                                                </a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="addModal" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add E-Book</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>

                                                <form action="{{ route('training.admin.class.eBookStore') }}" method="POST"
                                                    id="eBooks_save" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">E-Book Title:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="text" id="exampleInputEBook"
                                                                        class="form-control form-valid-ebook"
                                                                        name="ebook_name" placeholder="E-Book Title"
                                                                        required="required" autofocus="off">
                                                                    <input type="hidden" id="class_id"
                                                                        class="form-control" value="{{ $id }}"
                                                                        name="class_id" required="required">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Learning
                                                                        Material:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="file" id="ebook_material"
                                                                        class="form-control form-valid-ebook"
                                                                        name="ebook_material" autofocus="off" placeholder="E-Book Title"
                                                                        required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary">Reset</button>

                                                        <button type="button" onclick="saveEbook()"
                                                            class="btn custom-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="video-audio-tab" role="tabpanel">
                                    <div class="text-end mt-2">
                                        <button class="btn btn-sm custom-btn" type="button" data-bs-toggle="modal"
                                            data-bs-target="#addMedia">Add Media</button>
                                    </div>

                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table id="e-mediaTable" class="table table-centered table-bordered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-center">
                                                        <th>Sl. No</th>
                                                        <th>Media Title</th>
                                                        <th>Media Type</th>
                                                        <th>Media File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @foreach ($training_class_mediaes as $traing_class)
                                                        <tr class="text-center">
                                                            <td>{{ ++$i }}</td>
                                                            <td>{{ $traing_class->media_title }}</td>
                                                            <td>{{ $traing_class->media_type }}</td>
                                                            <?php
                                                            
                                                            $image_parth = 'public/upload/media_file/' . @$traing_class->media_file;
                                                            ?>

                                                            <td><a href="{{ asset(@$image_parth) }}" target="_blank"
                                                                    class="btn btn-warning btn-sm" title="Edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="addMedia" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add Media</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>

                                                <form action="{{ route('training.admin.class.mediaStore') }}"
                                                    method="POST" id="media_save" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Media Title:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="text" autofocus="off" id="exampleInputEBook"
                                                                        class="form-control form-valid" maxlength="15"
                                                                        name="media_title" placeholder="Media Title"
                                                                        required="required">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Media Type:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <Select class="form-control form-valid"
                                                                        id="media_type" name="media_type">
                                                                        <option value="">Select Media Type
                                                                        </option>
                                                                        <option value="audio">Audio</option>
                                                                        <option value="video">Video</option>
                                                                    </Select>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Media ( File size must be
                                                                        less than 2 MB ) :<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="file" id="media_file"
                                                                        class="form-control form-valid" name="media_file"
                                                                        accept=".mp3, .mp4" required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="class_id" class="form-control"
                                                            value="{{ $id }}" name="class_id"
                                                            required="required">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                        <button type="submit" class="btn custom-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="assignments-tab" role="tabpanel">

                                    <div class="text-end mt-2">
                                        <button class="btn btn-sm custom-btn" type="button" data-bs-toggle="modal"
                                            data-bs-target="#addAssignments">Add
                                            Assignments</button>
                                    </div>

                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table id="e-questionTable" class="table table-centered table-bordered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-center">
                                                        <th>Sl. No</th>
                                                        <th>Assignment Title</th>
                                                        <th>Question Type</th>
                                                        <th>Question Level</th>
                                                        <th>Start Date</th>
                                                        <th>Submission Date</th>
                                                        <th>Question File</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @foreach ($training_class_Assignment as $training_assignment)
                                                        <tr class="text-center">
                                                            <td>{{ ++$i }}</td>
                                                            <td>{{ @$training_assignment->assignment_title }}</td>
                                                            <td>{{ @$training_assignment->question_type }}</td>
                                                            <td>{{ @$training_assignment->question_level }}</td>
                                                            <td>{{ @$training_assignment->start_date }}</td>
                                                            <td>{{ @$training_assignment->last_submission_date }}</td>
                                                            <?php
                                                            
                                                            $image_parth = 'uploads/question_file/' . @$training_assignment->question_file;
                                                            ?>

                                                            <td><a href="{{ asset(@$image_parth) }}" target="_blank"
                                                                    class="btn btn-warning btn-sm" title="Question File">
                                                                    <i class="fa fa-eye"></i>
                                                                </a></td>
                                                            <td>
                                                                <a href="{{ route('training.admin.class.assignment', ['id' => $id, 'assignment_id' => @$training_assignment->id]) }}"
                                                                    class="btn custom-btn btn-sm"
                                                                    title="Submitted Assignment">Submitted
                                                                    Assignment</a>
                                                                {{-- <button class="btn ms-auto btn-md custom-btn" type="button"></button> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="addAssignments" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add Assignment
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>

                                                <form action="{{ route('training.admin.class.assignmentStore') }}"
                                                    method="POST" id="assignment_save" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Assignment
                                                                        Title:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="text" autofocus="off" id="assignment_title"
                                                                        class="form-control form-valid"
                                                                        name="assignment_title" maxlength="15"
                                                                        placeholder="Assignment Title">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Question Type:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <Select class="form-control form-valid"
                                                                        name="question_type">
                                                                        <option value="">Select Question Type
                                                                        </option>
                                                                        <option value="subjective">Subjective</option>
                                                                        <option value="objective">Objective</option>
                                                                    </Select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Question Level:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <Select class="form-control form-valid"
                                                                        name="question_level">
                                                                        <option value="">Select Question Level
                                                                        </option>
                                                                        <option value="easy">Easy</option>
                                                                        <option value="medium">Medium</option>
                                                                        <option value="hard">Hard</option>
                                                                    </Select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Start Date:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="date" id="start_date"
                                                                        class="form-control form-valid" name="start_date"
                                                                        min="<?php echo $training_class->trainingDetail->start_date; ?>"
                                                                        max="<?php echo $training_class->trainingDetail->end_date; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Last Submission
                                                                        Date:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="date" id="last_submission_date"
                                                                        class="form-control form-valid"
                                                                        min="<?php echo $training_class->trainingDetail->start_date; ?>"
                                                                        max="<?php echo $training_class->trainingDetail->end_date; ?>"
                                                                        name="last_submission_date">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Pass Score :<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="text" id="pass_score"
                                                                        class="form-control form-valid" maxlength="3"
                                                                        name="pass_score">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">File ( .jpg, .png, .pdf,
                                                                        .jpeg ):<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="file" id="question_file"
                                                                        class="form-control form-valid"
                                                                        name="question_file"
                                                                        accept=".jpg, .png, .pdf, .jpeg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="class_id" class="form-control"
                                                            value="{{ $id }}" name="class_id"
                                                            required="required">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                        <button type="submit" class="btn custom-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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


            $(document).ready(function() {
                $('#e-bookTable').DataTable();
                $('#e-questionTable').DataTable();
                $('#e-mediaTable').DataTable();
            });

            updateAcceptAttribute();

            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDateValue = $("#start_date").val();
                return Date.parse(value) > Date.parse(startDateValue);
            }, "Last submission date must be greater than start date");

            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, 'File size must be less than 2 MB');

            $.validator.addMethod('noLeadingSpace', function(value, element) {
                return this.optional(element) || /^[^\s].*$/.test(value);
            }, 'No leading spaces allowed.');


            function updateAcceptAttribute() {
                var mediaType = $('#media_type').val();
                if (mediaType === 'audio') {
                    $('#media_file').attr('accept', '.mp3');
                } else if (mediaType === 'video') {
                    $('#media_file').attr('accept', '.mp4');
                } else {
                    $('#media_file').attr('accept', '.mp3, .mp4');
                }
            }



            $('#media_type').change(function() {
                updateAcceptAttribute();
            });

            $("#assignment_save").validate({

                rules: {
                    assignment_title: {
                        required: true,
                        noLeadingSpace: true,
                        maxlength: 15
                    },
                    start_date: {
                        required: true,
                    },
                    last_submission_date: {
                        required: true,
                        greaterThanStartDate: true
                    },
                    pass_score: {
                        required: true,
                        number: true
                    },
                    question_type: {
                        required: true
                    },
                    question_level: {
                        required: true
                    },
                    question_file: {
                        required: true,
                        filesize_max: 2048 * 1024, // Max file size 1 MB
                    },

                },
                messages: {
                    start_date: {
                        required: "This field is required",
                    },
                    last_submission_date: {
                        required: "This field is required",
                        greaterThanStartDate: "Last submission date must be greater than start date"
                    },
                    pass_score: {
                        required: "This field is required",
                        number: "Pass Score should be in number"
                    },

                },
            })


            $("#media_save").validate({

                rules: {
                    media_title: {
                        required: true,
                        noLeadingSpace: true,
                        maxlength: 15
                    },
                    media_type: {
                        required: true,
                    },
                    media_file: {
                        required: true,
                        extension: function() {
                            var mediaType = $('#media_type').val();
                            if (mediaType === 'audio') {
                                return 'mp3';
                            } else if (mediaType === 'video') {
                                return 'mp4';
                            }
                            return 'mp3|mp4';
                        },
                        filesize_max: 2048 * 1024, // Max file size 1 MB
                    },

                },
                messages: {
                    media_title: {
                        required: "Please enter a media title.",
                        noLeadingSpace: "No leading spaces allowed.",
                        maxlength: "Media title must be less than or equal to 15 characters."
                    },
                    media_type: "Please select a media type.",
                    media_file: {
                        required: "Please select a MP3 or MP4 file.",
                        extension: "Please upload a valid MP3 or MP4 file.",
                        filesize_max: "Media size must be less than 2 MB"
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form if validation passes
                }
            })


            $("#eBooks_save").validate({

                rules: {
                    ebook_material: {
                        required: true,
                        filesize_max: 1048576,
                    },

                },
                messages: {
                    ebook_material: {
                        required: "Please add a material",
                        filesize_max: "Learnning Material size must be less than 1 MB"
                    }
                }
            })
        });


        // function saveForm() {

        //     $("#media_save").validate({

        //         rules: {
        //             media_title: {
        //                 required: true,
        //             },
        //             media_type: {
        //                 required: true,
        //             },
        //             media_file: {
        //                 required: true,
        //             },

        //         }
        //     })

        //     // var errcount = 0;
        //     // $(".error-span").remove();

        //     // $("span").remove();
        //     // $('.form-valid').each(function() {
        //     //     if ($(this).val() == '') {
        //     //         errcount++;
        //     //         $(this).addClass('error-text');
        //     //         $(this).removeClass('success-text');
        //     //         $(this).after('<span style="color:red">This field is required</span>');
        //     //     } else {
        //     //         $(this).removeClass('error-text');
        //     //         $(this).addClass('success-text');
        //     //     }
        //     // });
        //     // // alert(errcount);
        //     // if (errcount == 0) {

        //     //     $('#class_save').submit();
        //     // } else {
        //     //     return false;
        //     // }
        // }

        function saveEbook() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();
            $('.form-valid-ebook').each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text');
                    $(this).removeClass('success-text');
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#eBooks_save').submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }



        function saveAssignment() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();
            $('.form-valid').each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text');
                    $(this).removeClass('success-text');
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#assignment_save').submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }
    </script>
@endsection
