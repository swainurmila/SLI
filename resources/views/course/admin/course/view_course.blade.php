@extends('course.admin.course.course-about-layout')

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
    <div class="tab-content text-muted mt-4 mt-md-0">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">

            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <img class="img-fluid" src="{{ @$course->course_image }}" alt="">

                </div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <h5 class="text-danger fw-bold">Course Name : <span class="ms-2">{{ @$course->course_name }}</span>
                    </h5>
                    <div class="">
                        <h5 class="text-danger fw-bold"><span
                                class="badge rounded-pill bg-primary">{{ ucfirst(@$course->Category->name) }}</span>
                        </h5>
                        <span class="badge bg-warning font-size-14 mx-4"><i class="uil-star"></i>
                            {{ @$roundedAverageRating }}</span>
                        {{-- <span class="badge bg-secondary font-size-14"><i class="uil-users-alt me-2"></i>{{count(@$training->TrainingReviews)}} Reviews</span> --}}
                    </div>
                    {{-- <li class="rank-rating mb-0" style="margin-left:40px;">
                        <ul class="list-unstyled rating-list">
                            @for ($i = 1; $i <= $roundedAverageRating; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75"
                                    viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#FFD43B"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                </svg>
                            @endfor
                            <li class="ps-2">Rating ( {{ count(@$totalRatings) }} )</li>
                        </ul>
                    </li> --}}

                    <p>{{ @$course->course_description }}</p>
                    <div class="row">
                        <div class="col-md-6 border-end border-primary">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Start Date</strong>
                                    <span
                                        class="mb-0">{{ Carbon\Carbon::parse(@$course->course_start_date)->toFormattedDateString() }}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Price</strong>

                                    <span class="mb-0">
                                        {{ isset($course->course_price) ? '₹ ' . number_format($course->course_price, 2, '.', ',') : '₹ ' . number_format($course->price, 2, '.', ',') }}

                                    </span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Language</strong>
                                    <span class="mb-0">
                                        <i class="flag-icon flag-icon-us"></i><span class="badge rounded-pill bg-secondary">
                                            {{ @$course->language->name }} </span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>End Date</strong>
                                    <span
                                        class="mb-0">{{ Carbon\Carbon::parse(@$course->course_end_date)->toFormattedDateString() }}</span>
                                </li>

                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Payment Type</strong>
                                    <span class="mb-0">{{ @$course->payment_type == 'free' ? 'Free' : 'Paid' }}</span>
                                </li>


                                {{-- <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Place</strong>

                                    <span class="mb-0">
                                        {{ @$course->Place->name }}

                                    </span>
                                </li> --}}
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Certificate</strong>

                                    <span class="mb-0">
                                        {{ @$course->certificate_type == 'without' ? 'No' : 'Yes' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row m-2 justify-content-end">
                        <div class="col-2">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModalSyllabus">Add Syllabus</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="batches_datatable" class="table table-bordered datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Serial No.</th>
                                    <th scope="col">Syllabus Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->Syllabus as $key => $syl)
                                    <tr data-bs-toggle="" data-bs-target="#accordion{{ $syl->id }}" class="clickable">

                                        <td>{{ ++$key }}</td>
                                        <td>{{ @$syl->syllabus_title }}</td>
                                        <td>
                                            <a class="btn custom-btn btn-sm edit waves-effect waves-light" title="Edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModalSyllabus{{ $syl->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('course.admin.course-view.class', ['id' => @$course->id, 'syllabus_id' => @$syl->id]) }}"
                                                class="btn custom-btn btn-sm" title="Add-Class">View Class</a>

                                            <a href="{{ route('course.admin.view-study-material', $syl->id) }}"
                                                class="btn custom-btn btn-sm edit waves-effect waves-light" title="Edit">
                                                Study Material
                                            </a>
                                        </td>


                                    </tr>

                                    <div class="modal fade" id="editModalSyllabus{{ $syl->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Syllabus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>

                                                <form action="{{ route('course.admin.edit-syllabus') }}" method="POST"
                                                    id="course_place_save" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="cr_id" value="{{ @$course->id }}">
                                                    <input type="hidden" name="syl_id" value="{{ @$syl->id }}">
                                                    <x-modal-master :modaldata="$course" :sysid="$syl->id" />
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn custom-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row m-2 justify-content-end">
                        <div class="col-2">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add Exam</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="batches_datatable" class="table table-bordered datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Serial No.</th>
                                    <th scope="col">Examination Title</th>
                                    <th>Exam Mode</th>
                                    <th>Total Mark</th>
                                    <th>Passing Mark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($course->Exam as $key => $val)
                                    <tr data-bs-toggle="" data-bs-target="#accordion{{ $val->id }}"
                                        class="clickable">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ @$val->exam_title }}</td>
                                        <td>{{ @$val->exam_mode }}</td>
                                        <td>{{ @$val->exam_mark }}</td>
                                        <td>{{ @$val->passing_mark }}</td>
                                        <td>
                                            @php
                                                $hasExamQuestions = false;
                                            @endphp
                                            @foreach ($course->Question as $questions)
                                                @if ($questions->exam_id == $val->id)
                                                    @php
                                                        $hasExamQuestions = true;
                                                        break;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($val->exam_mode == 'online')
                                                @if ($hasExamQuestions)
                                                    <a href="{{ route('course.admin.exam-view-questions', $val->id) }}"
                                                        class="btn ms-auto btn-md custom-btn">
                                                        View Questions
                                                    </a>
                                                @else
                                                    <a href="{{ route('course.admin.exam-add-questions', $val->id) }}"
                                                        class="btn ms-auto btn-md custom-btn">
                                                        Add Questions
                                                    </a>
                                                @endif
                                            @else
                                                ---
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="4-tab">

            <div class="col-lg-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="course_rating_datatable" class="table table-bordered">
                            <thead class="table-light">
                                <tr class="">
                                    <th>Sl. No</th>
                                    <th>Student Name</th>
                                    <th>Ratings</th>
                                    <th>Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->Ratings as $key => $item)
                                    <tr class="">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ @$item->userDetails->first_name }}</td>
                                        <td>
                                            @for ($i = 1; $i <= $item->rating; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75"
                                                    viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="#FFD43B"
                                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                                </svg>
                                            @endfor

                                        </td>
                                        <td>{{ @$item->feedback }}</td>
                                        <td>
                                            <a href="{{ route('user.course.review.destroy', [@$item->id]) }}"
                                                onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                title="Delete Record">
                                                <i class="fa fa-trash"></i>
                                             </a>
                                             
                                             <!-- Add a form to handle the actual delete action -->
                                             <form id="delete-form-{{ $item->id }}"
                                                   action="{{ route('user.course.review.destroy', [@$item->id]) }}"
                                                   method="POST" style="display: none;">
                                                 @method('GET')
                                                 @csrf
                                             </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('course.admin.exam-total-questions') }}" method="POST" id="add_exam_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Examination Mode:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <select class="form-select form-valid" name="exam_mode" id="exam_mode">
                                        <option value="">Select</option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                    @if ($errors->has('exam_mode'))
                                        <span class="text-danger">{{ $errors->first('exam_mode') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Examination Title:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="hidden" name="cr_id" value="{{ @$course->id }}">
                                    <input type="text" id="exampleInputUsername" class="form-control"
                                        name="exam_title" placeholder="Examination Title" value=""
                                        required="required" maxlength="15">
                                    @if ($errors->has('exam_title'))
                                        <span class="text-danger">{{ $errors->first('exam_title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Total Mark:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="number" id="total_mark" class="form-control" name="total_mark"
                                        placeholder="Total Mark" value="" required="required" maxlength="3">
                                    @if ($errors->has('total_mark'))
                                        <span class="text-danger">{{ $errors->first('total_mark') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Passing Mark:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="number" id="passing_mark" class="form-control" name="passing_mark"
                                        placeholder="Passing Mark" value="" maxlength="2" required="required">
                                    @if ($errors->has('passing_mark'))
                                        <span class="text-danger">{{ $errors->first('passing_mark') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 div-strength" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">Multiple Type Questions:</label>
                                    <select class="form-select form-valid" name="multiple_qs" id="multiple_qs">
                                        <option value="">Select Option</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 div-strength" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">Long Questions:</label>
                                    <select class="form-select" name="long_qs" id="long_qs">
                                        <option value="">Select Option</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 div-strength" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">Short Questions:</label>
                                    <select class="form-select" name="short_qs" id="short_qs">
                                        <option value="">Select Option</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
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
    <div class="modal fade" id="addModalSyllabus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Syllabus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('course.admin.store-syllabus') }}" method="POST" id="syllabus_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="cr_id" value="{{ @$course->id }}">

                    <x-modal-master :modaldata="[]" :sysid="[]" />
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


            function clearFormFields() {
                $("#syllabus_save")[0].reset(); // Reset the form
                $("#syllabus_save").validate().resetForm(); // Reset the validation state
            }

            $.validator.addMethod("noLeadingSpace", function(value, element) {
                // Ensure value is not null/undefined, and check for leading spaces
                return value && value.trimStart() === value;
            }, "Place name cannot contain only spaces");

            $.validator.addMethod("lettersOnlyWithSpace", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "Please enter only alphabetic characters and spaces.");

            $("#syllabus_save").validate({
                rules: {
                    syllabus_title: {
                        required: true,
                        noLeadingSpace: true,
                        lettersOnlyWithSpace: true,
                    },
                },
                messages: {
                    syllabus_title: {
                        required: "Syllabus Title  Is required",
                        lettersOnlyWithSpace: "Please enter only alphabetic characters",
                        noLeadingSpace: "Place name cannot contain only spaces",
                    },
                },
                submitHandler: function(form) {
                    if ($("#syllabus_save").valid()) {
                        form.submit();
                    }
                }
            });
            $('#addModalSyllabus').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });

            $('#course_rating_datatable').DataTable();


            $('#addModal').on('hidden.bs.modal', function() {
                // Reset the form fields
                $('#add_exam_form')[0].reset();
                // Additionally, you may want to remove any validation messages
                $('#add_exam_form').validate().resetForm();
            });


            $('#exam_mode').change(function() {

                if ($(this).val() === 'online') {
                    $('#multiple_qs').addClass('form-valid');
                    $('#long_qs').addClass('form-valid');
                    $('#short_qs').addClass('form-valid');
                    $('.div-strength').css('display', 'block');
                } else {
                    $('#multiple_qs').removeClass('form-valid');
                    $('#long_qs').removeClass('form-valid');
                    $('#short_qs').removeClass('form-valid');
                    $('.div-strength').css('display', 'none');
                }
            });
            $("#add_exam_form").validate({
                rules: {
                    exam_mode: {
                        required: true,
                    },
                    exam_title: {
                        required: true,
                    },
                    total_mark: {
                        required: true,
                    },
                    passing_mark: {
                        required: true,
                    },
                },
                messages: {
                    exam_mode: {
                        required: "Exam Mode field is required",
                    },
                    exam_title: {
                        required: "Exam Title field is required",
                    },
                    total_mark: {
                        required: "Total mark field is required",
                    },
                    passing_mark: {
                        required: "Passing mark field is required",
                    },
                },
            });
        });
    </script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
@endsection
