@extends('course.admin.course.study-material-layout')

@section('style')
<style>
    table tr td.accord-table-content {
        padding: .0rem .75rem;
        border-top-width: 0.05rem;
    }

    .clickable tr {
        pointer-events: none;
    }
</style>
@endsection
@section('course-about')
<div class="tab-content text-muted  mt-md-0">
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">
        <div class="col-lg-12">
            <div class="">
                <div class="card-header text-end">
                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal" data-bs-target="#addLectureNote">Add Lecture Notes</button>
                </div>
                <div class="table-responsive dashboard__table">
                    <table class="table table-centered table-nowrap mb-0 datatable">                  
                        <thead class="table-secondary">
                            <tr>
                                <th>Serial No.</th>
                                <th scope="col">Note Title</th>
                                <th>View File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->Note as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->material_title }}</td>
                                <td><a href="{{ $item->material_file }}" target="_blank" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-eye"></i>
                                    </a></td>
                                <td><a href="{{ route('course.delete-lecture-notes', $item->id) }}" class="btn btn-danger btn-sm edit waves-effect waves-light" title="Delete Record">
                                        <i class="fa fa-trash"></i>
                                    </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="addLectureNote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Study Material</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>

                            <form action="{{ route('course.admin.store-lecture-notes') }}" method="POST" id="add_study_material" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="form-label">Title:<sup><span style="color: red;">*</span></sup></label>
                                                <input type="hidden" name="cr_id" value="{{ @$data->course_id }}">
                                                <input type="hidden" name="syl_id" value="{{ @$data->id }}">
                                                <input type="text" id="material_title" class="form-control form-valid" name="material_title" placeholder="Title" value="" maxlength="25">
                                                @if ($errors->has('exam_title'))
                                                <span class="text-danger">{{ $errors->first('exam_title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="form-label">Learning Material:<sup><span style="color: red;">*</span></sup></label>
                                                <input type="file" id="learning_material" class="form-control form-valid" name="learning_material" placeholder="Examination Title" accept="application/pdf,image/*" value="">
                                                <div id="info"></div>
                                                @if ($errors->has('learning_material'))
                                                <span class="text-danger">{{ $errors->first('learning_material') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" onclick="saveForm()" class="btn custom-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
        <div class="col-lg-12">
            <div>
                <div class="card-header text-end">
                    <!-- <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#addPresentation">Add Presentation</button> -->
                    <button type="button" class="btn ms-auto btn-md custom-btn" data-bs-toggle="modal" data-bs-target="#presentationModalCenter">
                        Add Presentation
                    </button>
                </div>
                <div class="table-responsive dashboard__table">
                    <table id="datatable" class="table table-centered table-nowrap mb-0 datatable">
                        <thead class="table-secondary">
                            <tr class="">
                                <th>Sl. No</th>
                                <th>Media Title</th>
                                <th>Media Type</th>
                                <th>Media File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->Presentation as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-capitalize">{{ $item->media_title }}</td>
                                <td class="text-capitalize">{{ $item->media_type }}</td>
                                <td><a href="{{ $item->media_file }}" target="_blank" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-eye"></i>
                                    </a></td>
                                <td><a href="{{ route('course.delete-course-presentation', $item->id) }}" class="btn btn-danger btn-sm edit waves-effect waves-light" title="Delete Record">
                                        <i class="fa fa-trash"></i>
                                    </a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="presentationModalCenter" tabindex="-1" role="dialog" aria-labelledby="presentationModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Presentation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <form action="{{ route('course.admin.store-course-presentation') }}" method="POST" id="presentation_save" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input type="hidden" name="cr_id" value="{{ @$data->course_id }}">
                                            <input type="hidden" name="syl_id" value="{{ @$data->id }}">
                                            <label class="form-label">Media Title:<sup><span style="color: red;">*</span></sup></label>
                                            <input type="text" id="exampleInputEBook" class="form-control form-valid-pres" name="media_title" placeholder="Media Title" required="required" pattern="[a-zA-Z\s]+" title="Media must contain only letters and spaces." onkeypress="return validateKeyPress(event)" maxlength="30">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Media Type:<sup><span style="color: red;">*</span></sup></label>
                                            <Select class="form-control form-valid-pres" name="media_type">
                                                <option value="">Select Media Type</option>
                                                <option value="audio">Audio</option>
                                                <option value="video">Video</option>
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Media:<sup><span style="color: red;">*</span></sup></label>
                                            <input type="file" id="media_file" class="form-control form-valid-pres" name="media_file" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn custom-btn">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- <div class="modal fade" id="addPresentation" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Presentation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>

                        <form action="{{ route('course.admin.store-course-presentation') }}" method="POST"
                            id="presentation_save" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input type="hidden" name="cr_id" value="{{ @$data->course_id }}">
                                            <input type="hidden" name="syl_id" value="{{ @$data->id }}">
                                            <label class="form-label">Media Title:<sup><span
                                                        style="color: red;">*</span></sup></label>
                                            <input type="text" id="exampleInputEBook"
                                                class="form-control form-valid-pres" name="media_title"
                                                placeholder="Media Title" required="required" pattern="[a-zA-Z\s]+"
                                                title="Media must contain only letters and spaces."
                                                onkeypress="return validateKeyPress(event)" maxlength="30">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Media Type:<sup><span
                                                        style="color: red;">*</span></sup></label>
                                            <Select class="form-control form-valid-pres" name="media_type">
                                                <option value="">Select Media Type</option>
                                                <option value="audio">Audio</option>
                                                <option value="video">Video</option>
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Media:<sup><span
                                                        style="color: red;">*</span></sup></label>
                                            <input type="file" id="media_file" class="form-control form-valid-pres"
                                                name="media_file" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn custom-btn" onclick="savePresentation()">Save</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
        <div class="col-lg-12">
            <div class="">
                <div class="card-header text-end">
                    <button class="btn ms-auto btn-md custom-btn " type="button" data-bs-toggle="modal" data-bs-target="#addAssignments">Add Assignments</button>
                </div>
                <div class="table-responsive dashboard__table">
                    <table id="datatable" class="table table-centered table-nowrap mb-0 datatable">
                        <thead class="table-secondary">
                            <tr class="">
                                <th>Sl. No</th>
                                <th>Assignment Title</th>
                                <th>Assignment Type</th>
                                <th>Assignment Level</th>
                                <th>Start Date</th>
                                <th>Submission Date</th>
                                <th>Pass Score</th>
                                <th>Question</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->Assignment as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->assignment_title }}</td>
                                <td class="text-capitalize">{{ $item->question_type }}</td>
                                <td class="text-capitalize">{{ $item->question_level }}</td>
                                <td>{{ $item->start_submission_date }}</td>
                                <td>{{ $item->end_submission_date }}</td>
                                <td>{{ $item->pass_score }}</td>
                                <td><a href="{{ $item->question_file }}" target="_blank" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-eye"></i>
                                    </a></td>
                                <td>

                                    <a href="{{ route('course.admin.view-submitted-assignment', $item->id) }}" class="btn custom-btn btn-sm" title="Submitted Assignment">Submitted
                                        Assignment</a>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal fade" id="addAssignments" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Assignment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>

                        <form action="{{ route('course.admin.store-course-assignment') }}" method="POST" id="assignment_save" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Assignment Title:<sup><span style="color: red;">*</span></sup></label>
                                            <input type="hidden" name="cr_id" value="{{ @$data->course_id }}">
                                            <input type="hidden" name="syl_id" value="{{ @$data->id }}">
                                            <input type="text" id="exampleInputEBook" class="form-control form-valid-assign" name="assignment_title" placeholder="Assignment Title" required="required" maxlength="20">

                                            <div class="invalid-feedback">Please provide a valid Assignment Title.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Question Type:<sup><span style="color: red;">*</span></sup></label>
                                            <Select class="form-control form-valid-assign" name="question_type" required>
                                                <option value="">Select Question Type</option>
                                                <option value="subjective">Subjective</option>
                                                <option value="objective">Objective</option>
                                            </Select>
                                            <div class="invalid-feedback">Please select a Question Type.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Question Level:<sup><span style="color: red;">*</span></sup></label>
                                            <Select class="form-control form-valid-assign" name="question_level" required>
                                                <option value="">Select Question Level</option>
                                                <option value="easy">Easy</option>
                                                <option value="medium">Medium</option>
                                                <option value="hard">Hard</option>
                                            </Select>
                                            <div class="invalid-feedback">Please select a Question Level.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Start Date:<sup><span style="color: red;">*</span></sup></label>
                                            {{-- <input type="date" id="start_date" class="form-control form-valid-assign"
                                                    name="start_date"> --}}
                                            <input class="form-control " type="Date" value="" min="{{ $data->Course->course_start_date }}" max="{{ $data->Course->course_end_date }}" id="start_date" name="start_date" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Last Submission Date:<sup><span style="color: red;">*</span></sup></label>
                                            <input type="date" id="last_submission_date" min="{{ $data->Course->course_start_date }}" max="{{ $data->Course->course_end_date }}" name="last_submission_date" class="form-control form-valid-assign" required>

                                            <div class="invalid-feedback">Please provide a valid last submission date.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Pass Score :<sup><span style="color: red;">*</span></sup></label>
                                            <input type="number" id="pass_score" class="form-control form-valid-assign" pattern="[0-9]+" name="pass_score" maxlength="2" required>

                                            <div class="invalid-feedback">Please provide a valid pass score.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">File:<sup><span style="color: red;">*</span></sup></label>
                                            <input type="file" id="question_file" class="form-control form-valid-assign" accept="application/pdf,image/*" name="question_file" required="required">

                                            <div class="invalid-feedback">Please upload a valid file. Allowed file
                                                types: .pdf, .doc, .docx.</div>
                                        </div>
                                    </div>
                                </div>
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

@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Add event listener for Media Title input
        $('#exampleInputEBook').on('input', function() {
            removeValidationMessage();
        });

        // Add event listener for Media Type select
        $('select[name="media_type"]').on('change', function() {
            removeValidationMessage();
        });
    });

    function removeValidationMessage() {
        $('#exampleInputEBook').removeClass('error-text');
        $('select[name="media_type"]').removeClass('error-text');
        $('.error-span').remove();
    }


    $(document).ready(function() {
        // Function to clear form fields
        function clearFormFields() {
            $("#assignment_save")[0].reset(); // Reset the form
            $("#assignment_save").validate().resetForm(); // Reset the validation state
        }


        $.validator.addMethod("noLeadingSpace", function(value, element) {
            return this.optional(element) || /^\S.*$/.test(value);
        }, "Assignment title cannot start with a space");

        $.validator.addMethod("greaterThanStartDate", function(value, element) {
            var startDate = $('#start_date').val();
            var endDate = value;

            if (!startDate || !endDate) {
                // If either field is empty, no comparison needed
                return true;
            }

            // Parse dates to compare
            var startDateParts = startDate.split('-');
            var endDateParts = endDate.split('-');

            var startDateTime = new Date(startDateParts[0], startDateParts[1] - 1, startDateParts[
                2]); // Month in JavaScript Date object is zero-based
            var endDateTime = new Date(endDateParts[0], endDateParts[1] - 1, endDateParts[2]);

            // Compare dates
            return endDateTime > startDateTime;
        }, "Course end date must be greater than Course start date");

        $.validator.addMethod('filesize_max', function(value, element, param) {
            if (element.files.length > 0) {
                var fileSize = element.files[0].size;
                var maxSize = parseInt(param);
                return fileSize <= maxSize;
            }
            return true;
        }, 'File size must be less than 20 MB');

        $.validator.addMethod("onlyLetters", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Please enter only alphabetic characters and spaces");

        // Validation for form fields
        $("#assignment_save").validate({
            rules: {
                assignment_title: {
                    required: true,
                    noLeadingSpace: true,
                    onlyLetters: true,
                },
                question_type: {
                    required: true
                },
                question_level: {
                    required: true,
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
                },
                question_file: {
                    required: true,
                    filesize_max: 20971520,


                },
            },
            messages: {
                assignment_title: {
                    required: "Please enter Assignment Title",
                    lettersOnly: "Please enter only alphabetic characters",
                    noLeadingSpace: "Assignment title cannot start with a space",
                },
                question_type: {
                    required: "Please enter Question Type",
                },
                question_level: {
                    required: "Please enter Question Level",
                },
                start_date: {
                    required: "Please enter Start Date",
                },
                last_submission_date: {
                    required: "Please enter Last Submission Date",
                },
                pass_score: {
                    required: "Please enter Pass Score",
                },
                question_file: {
                    required: "Please enter File",
                    filesize_max: "File size must be less than 20 MB",

                },
            },

            submitHandler: function(form) {
                if ($("#assignment_save").valid()) {
                    form.submit();
                }
            }
        });



        $("#presentation_save").validate({
            rules: {
                media_title: {
                    required: true,
                    noLeadingSpace: true,
                    onlyLetters: true,
                },
                media_type: {
                    required: true
                },
                media_file: {
                    required: true,
                    filesize_max: 20971520
                },
            },
            messages: {
                media_title: {
                    required: "Please Enter Media Title",
                    lettersOnly: "Please enter only alphabetic characters",
                    noLeadingSpace: "Media title cannot start with a space",
                },
                media_type: {
                    required: "Please Enter Media Type",
                },
                media_file: {
                    required: "Please Choose Media File",
                    filesize_max: "File size must be less than 20 MB",
                },
            },

            submitHandler: function(form) {
                if ($("#presentation_save").valid()) {
                    form.submit();
                }
            }
        });


        $('select[name="media_type"]').on('change', function() {
            var mediaType = $(this).val();
            var mediaFileInput = $('input[name="media_file"]');

            if (mediaType === 'audio') {
                mediaFileInput.attr('accept', 'audio/*');
            } else if (mediaType === 'video') {
                mediaFileInput.attr('accept', 'video/*');
            } else {
                mediaFileInput.removeAttr('accept');
            }
        });

        // Clear form fields when modal is closed
        $('#addAssignments').on('hidden.bs.modal', function(e) {
            clearFormFields();
        });

    });




    // function saveCoursePresentation() {
    //     event.preventDefault();
    //     var errpre = 0;
    //     $(".error-span").remove();
    //     $("span").remove();

    //     // Regular expression to match allowed file extensions
    //     var allowedAudioExtensions = /(\.mp3)$/i;
    //     var allowedVideoExtensions = /(\.mp4)$/i;

    //     // Loop through each input field
    //     $('.form-valid-pres').each(function() {
    //         if ($(this).val() == '') {
    //             errpre++;
    //             $(this).addClass('error-text');
    //             $(this).removeClass('success-text');
    //             $(this).after(
    //                 '<span class="error-span" style="color:red">This field is required</span>'
    //             );
    //         } else {
    //             $(this).removeClass('error-text');
    //             $(this).addClass('success-text');

    //             // Check file format if it's the media_file input
    //             if ($(this).attr('id') == 'media_file') {
    //                 var fileInput = $(this)[0];
    //                 var fileName = fileInput.value;

    //                 // Get selected media type
    //                 var mediaType = $('select[name="media_type"]').val();

    //                 // Validate file format based on media type
    //                 if (mediaType === 'audio' && !allowedAudioExtensions.test(fileName)) {
    //                     errpre++;
    //                     $(this).addClass('error-text');
    //                     $(this).after(
    //                         '<span class="error-span" style="color:red">Only MP3 files are allowed for Audio type</span>'
    //                     );
    //                 } else if (mediaType === 'video' && !allowedVideoExtensions.test(fileName)) {
    //                     errpre++;
    //                     $(this).addClass('error-text');
    //                     $(this).after(
    //                         '<span class="error-span" style="color:red">Only MP4 files are allowed for Video type</span>'
    //                     );
    //                 }
    //             }
    //         }
    //     });

    //     // Validate Media Title
    //     var mediaTitle = $('#exampleInputEBook').val().trim();
    //     var mediaTitleWithoutSpaces = mediaTitle.replace(/\s/g, ''); // Remove spaces
    //     if (mediaTitleWithoutSpaces === '') {
    //         errpre++;
    //         $('#exampleInputEBook').addClass('error-text');
    //         $('#exampleInputEBook').after(
    //             '<span class="error-span" style="color:red"</span>'
    //         );
    //     } else if (mediaTitleWithoutSpaces.length > 15) {
    //         errpre++;
    //         $('#exampleInputEBook').addClass('error-text');
    //         $('#exampleInputEBook').after(
    //             '<span class="error-span" style="color:red">Media Title should be maximum 15 characters</span>'
    //         );
    //     } else {
    //         $('#exampleInputEBook').removeClass('error-text');
    //         $('#exampleInputEBook').addClass('success-text');
    //     }

    //     // Validate Media Type
    //     var mediaType = $('select[name="media_type"]').val();
    //     if (mediaType === '') {
    //         errpre++;
    //         $('select[name="media_type"]').addClass('error-text');
    //         $('select[name="media_type"]').after(
    //             '<span class="error-span" style="color:red"></span>'
    //         );
    //     } else {
    //         $('select[name="media_type"]').removeClass('error-text');
    //         $('select[name="media_type"]').addClass('success-text');
    //     }

    //     if (errpre == 0) {
    //         $('#presentation_save').submit();
    //     } else {
    //         return false;
    //     }
    // }

    $('#addPresentation').on('hidden.bs.modal', function(e) {
        $('#presentation_save').trigger('reset');
        $(".error-span").remove();
        $("span").remove();
        $('.form-valid-pres').removeClass('error-text success-text');
    });
</script>

{{-- <script>
        $(document).ready(function() {
            

        });
    </script> --}}
<script>
    var documentReadyExecuted = false;
    $(document).ready(function() {
        if (!documentReadyExecuted) {
            documentReadyExecuted = true;

            function clearFormFields() {
                $("#add_study_material")[0].reset(); // Reset the form
                $("#add_study_material").validate().resetForm(); // Reset the validation state
            }


            $('#learning_material').on('change', function() {

                const size =
                    (this.files[0].size / 1024 / 1024).toFixed(2);

                if (size > 20) {
                    alert("File must be between the size of 20 MB");
                    $(this).val('');
                } else {
                    $("#output").html('<b>' +
                        'This file size is: ' + size + " MB" + '</b>');
                }
            });


            $.validator.addMethod("maxsize", function(value, element, param) {
                if (element.files.length > 0) {
                    var fileSize = element.files[0].size / 1024 / 1024; // in MB
                    return fileSize <= param;
                }
                return true;
            }, "File size must be less than {0} MB.");

            $("#add_study_material").validate({

                rules: {
                    material_title: {
                        required: true,
                        noSpace: true,
                        lettersOnly: true,
                    },
                    learning_material: {
                        required: true,
                        maxsize: 20,
                        accept: "application/pdf,*/*",

                    },

                },
                messages: {
                    material_title: {
                        required: "Title Is Required",
                        lettersOnly: "Please enter only alphabetic characters",
                        noSpace: "First name cannot contain only spaces",
                    },
                    learning_material: {
                        required: "Learning Material Is Required ",
                        accept: "Please select a valid file",
                        maxsize: "File size must be less than 20 MB"
                    },
                },
                submitHandler: function(form) {
                    if ($("#add_study_material").valid()) {
                        form.submit();
                    }
                }
            });

            $('#addLectureNote').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });
        }
    });
</script>
<script>
    function validateKeyPress(event) {
        // Prevent spaces at the beginning of the input
        if (event.key === ' ' && event.target.value.length === 0) {
            return false;
        }

        // Allow only letters and spaces
        const regex = /^[a-zA-Z\s]*$/;
        return regex.test(event.key);
    }
</script>
@endsection