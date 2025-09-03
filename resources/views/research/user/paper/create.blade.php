@extends('research.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Papers</li>
                                <li class="breadcrumb-item active text-custom-primary">Create New Paper</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">Add New Paper</h4>
                                <a href="{{ route('research.admin.paper.index') }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>

                            <form action="{{ route('research.admin.paper.store') }}" method="POST" id="paper_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Paper Title</label>
                                            <input type="text" class="form-control form-valid" name="paper_title"
                                                id="paper_title" placeholder="Paper Title" pattern="[a-zA-Z\s]+"
                                                title="The field subject  must contain only letters and spaces."
                                                onkeypress="return validateKeyPress(event)" maxlength="50">
                                            @if ($errors->has('paper_title'))
                                                <span class="text-danger">{{ $errors->first('paper_title') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Subject Category</label>
                                            <select class="form-select form-valid" name="subject_category_id"
                                                id="subject_category_id">
                                                <option value="">Select</option>
                                                @foreach ($subjectCategory as $category)
                                                    <option value="{{ @$category->category_name }}">
                                                        {{ @$category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subject_category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Upload Papers</label>
                                            <input class="form-control form-valid" type="file" name="papers[]" id="research_paper"
                                                value="" multiple accept="application/pdf">
                                            @if ($errors->has('papers'))
                                                <span class="text-danger">{{ $errors->first('papers') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Are you a</label>
                                            <select class="form-select form-valid" name="are_you_a" id="are_you_a">
                                                <option value="">Select</option>
                                                <option value="student">Student</option>
                                                <option value="guide">Guide</option>
                                            </select>

                                            @if ($errors->has('are_you_a'))
                                                <span class="text-danger">{{ $errors->first('are_you_a') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Description</label>
                                            <textarea class="form-control form-valid" name="description" id="description" maxlength="500"
                                                cols="5" rows="5"></textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn custom-btn">Submit</button>
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

            // $.validator.addMethod("pdfOnly", function(value, element) {
            //     if (this.optional(element) || !element.files || !element.files.length) {
            //         return true; // If no file is selected, pass the validation
            //     }

            //     var isValid = true;
            //     var maxSize = 5 * 1024 * 1024; // 5 MB in bytes

            //     $.each(element.files, function(index, file) {
            //         var fileType = file.type;
            //         var fileSize = file.size;

            //         // Check if the file is a PDF and does not exceed the max size
            //         if (fileType !== "application/pdf" || fileSize > maxSize) {
            //             isValid = false;
            //             return false; // Break the loop if any file is invalid
            //         }
            //     });

            //     return isValid;
            // }, "Only PDF files under 5MB are allowed.");
            $.validator.addMethod("maxsize", function(value, element, param) {
                if (element.files.length > 0) {
                    var fileSize = element.files[0].size / 1024 / 1024; // in MB
                    return fileSize <= param;
                }
                return true;
            }, "File size must be less than {0} MB.");

            // Custom method for file type validation
            $.validator.addMethod("filetype", function(value, element, param) {
                if (element.files.length > 0) {
                    // Loop through each selected file
                    for (var i = 0; i < element.files.length; i++) {
                        var fileType = element.files[i].type;
                        // Check if the file type is not PDF
                        if (fileType !== 'application/pdf') {
                            return false;
                        }
                    }
                }
                return true;
            }, "Please upload only PDF files.");
            $("#paper_save").validate({
                rules: {
                    paper_title: {
                        required: true,
                    },
                    subject_category_id: {
                        required: true,
                    },
                    are_you_a: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    "papers[]": {
                        required: true,
                        maxsize: 5, // Size in MB
                        filetype: true // Apply filetype rule
                    }
                },
                messages: {
                    paper_title: {
                        required: "Paper title is required",
                    },
                    subject_category_id: {
                        required: "Subject category is required",
                    },
                    are_you_a: {
                        required: "Are you a field is required",
                    },
                    description: {
                        required: "Description is required",
                    },
                    "papers[]": {
                        required: "Papers are required",
                        maxsize: "File size must be less than 5 MB.",
                        filetype: "Please upload only PDF files."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('#research_paper').on('change', function() {
                $(this).siblings('.error').hide();
            });
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
