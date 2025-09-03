@extends('training.traininguser.profile.layouts.main')
@section('profile-content')

    @php
        $countFreeTraining = App\Models\Training\TrTraining::where('payment_type', '0')->count();
        $countPaidTraining = App\Models\Training\TrTraining::where('payment_type', '1')->count();

        $countCertificateTraining = App\Models\Training\TrTraining::where('training_type', '0')->count();
        $countWithoutCertificateTraining = App\Models\Training\TrTraining::where('training_type', '1')->count();

    @endphp
    <style>
        .default__button {
            padding: 6px 25px;
            background-color: #3f82d1db;
            border: 1px solid #607fff;
            float: right;
        }
    </style>

    <div class="container">
        <div class="row">
            <!-- sidebar of the Page start here -->
            <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
            </aside><!-- sidebar of the Page end here -->
            <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">

                {{-- <a href="#" class="btn btn-md btn-dark float-right">
                    Back
                </a> --}}
                <div class="dashboard__form__button">
                    <a href="{{ route('training-user.profile.enrolled-courses') }}"
                        class="default__button btn-dark float-right">Back</a>
                </div>

                <!-- mt productlisthold start here -->
                <div class="product-detail-tab course-tab">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="mt-tabs text-center text-uppercase">
                                <li><a href="#tab1" class="active">E-Books</a></li>
                                <li><a href="#tab2">Video / Audio</a></li>
                                <li><a href="#tab3">Assignments</a></li>
                            </ul>
                            <div class="tab-content">


                                <div id="tab1">
                                    <ul class="mt-productlisthold list-inline">

                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab" tabindex="0">
                                            <div class="mt-4">

                                                @if (!$training_class_ebook->isEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-centered table-nowrap mb-0">
                                                            <thead class="table-secondary">
                                                                <tr>
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
                                                                    <tr>
                                                                        <td>{{ ++$i }}</td>
                                                                        <td>{{ $traing_ebbok->ebook_name }}</td>
                                                                        <?php
                                                                        
                                                                        $image_parth = 'public/upload/ebook_material/' . @$traing_ebbok->ebook_material;
                                                                        ?>

                                                                        <td><a href="{{ asset(@$image_parth) }}"
                                                                                target="_blank"
                                                                                class="btn btn-warning btn-sm"
                                                                                title="Edit">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a></td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p class="text-center">No Ebooks Found !</p>
                                                @endif
                                            </div>

                                        </div>



                                    </ul>
                                </div>
                                <div id="tab2">
                                    <ul class="mt-productlisthold list-inline">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab" tabindex="0">
                                            <div class="mt-4">

                                                @if (!$training_class_mediaes->isEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-centered table-nowrap mb-0">
                                                            <thead class="table-secondary">
                                                                <tr class="">
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
                                                                    <tr class="">
                                                                        <td>{{ ++$i }}</td>
                                                                        <td>{{ $traing_class->media_title }}</td>
                                                                        <td>{{ $traing_class->media_type }}</td>
                                                                        <?php
                                                                        
                                                                        $image_parth = 'public/upload/media_file/' . @$traing_class->media_file;
                                                                        ?>

                                                                        <td><a href="{{ asset(@$image_parth) }}"
                                                                                target="_blank"
                                                                                class="btn btn-warning btn-sm"
                                                                                title="Edit">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a></td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p class="text-center">No Video / Audio Found !</p>
                                                @endif
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
                                                @if (!$training_class_Assignment->isEmpty())
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
                                                                    <th>Score</th>
                                                                    <th>Result</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 0;
                                                                ?>
                                                                @foreach ($training_class_Assignment as $training_assignment)
                                                                    <tr class="">
                                                                        <td>{{ ++$i }}</td>
                                                                        <td>{{ @$training_assignment->assignment_title }}
                                                                        </td>
                                                                        <td>{{ ucfirst(@$training_assignment->question_type) }}
                                                                        </td>
                                                                        <td>{{ ucfirst(@$training_assignment->question_level) }}
                                                                        </td>
                                                                        <td>{{ @$training_assignment->start_date }}</td>
                                                                        <td>{{ @$training_assignment->last_submission_date }}
                                                                        </td>
                                                                        <td>{{ @$training_assignment->assignmentAnswer->result }}
                                                                        </td>
                                                                        <td>

                                                                            @if (@$training_assignment->assignmentAnswer && @$training_assignment->assignmentAnswer->result)
                                                                                @if (@$training_assignment->assignmentAnswer->result > @$training_assignment->pass_score)
                                                                                    <span class="dashboard__td">Pass</span>
                                                                                @else
                                                                                    <span
                                                                                        class="dashboard__td dashboard__td--cancel">Fail</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <?php
                                                                        
                                                                        $image_parth = 'uploads/question_file/' . @$training_assignment->question_file;
                                                                        ?>

                                                                        <td><a href="{{ asset(@$image_parth) }}"
                                                                                target="_blank"
                                                                                class="btn btn-warning btn-sm"
                                                                                title="Edit">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                            {{-- <button title="Submit Assignment" class="btn ms-auto btn-sm btn-warning mt-5 submit-assignment" type="button" data-toggle="modal" id="{{@$training_assignment->id}}" data-target="#updateAssignment-{{@$training_assignment->id}}">

                                                                                Submit Assignment
                                                                            </button> --}}

                                                                            @if (@$training_assignment->assignmentAnswer)
                                                                                {{ $training_assignment->assignmentAnswer->result == null ? 'Already Submitted' : 'Result Published' }}
                                                                            @elseif (@$training_assignment->last_submission_date > Carbon\Carbon::today()->format('Y-m-d'))
                                                                                <button
                                                                                    class="submit-assignment btn btn-success btn-sm"
                                                                                    id="{{ @$training_assignment->id }}"
                                                                                    data-target="updateAssignment-{{ @$training_assignment->id }}">Submit
                                                                                    Assignment</button>
                                                                            @endif





                                                                            <div class="modal"
                                                                                id="updateAssignment-{{ @$training_assignment->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-hidden="true" style="display: none;">
                                                                                <div class="modal-dialog modal-dialog-centered text-start"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <form
                                                                                            id="user_assignment_btn{{ @$training_assignment->id }}"
                                                                                            action="{{ route('training.user.submit.assignment', @$training_assignment->class_id) }}"
                                                                                            method="POST"
                                                                                            enctype="multipart/form-data">
                                                                                            @method('PATCH')
                                                                                            @csrf
                                                                                            <div class="modal-body">
                                                                                                <div class="mb-3 row">
                                                                                                    <input type="hidden"
                                                                                                        value="{{ @$training_assignment->id }}"
                                                                                                        name="assignment_id">
                                                                                                    <input type="hidden"
                                                                                                        value="{{ @$training_assignment->class_id }}"
                                                                                                        name="class_id">
                                                                                                    <input type="hidden"
                                                                                                        value="{{ @$training_assignment->training_details_id }}"
                                                                                                        name="training_details_id">
                                                                                                    <input type="hidden"
                                                                                                        value="{{ @$training_assignment->batch_id }}"
                                                                                                        name="batch_id">
                                                                                                    <div
                                                                                                        class="col-sm-12 col-lg-12">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="col-form-label">Assignment</label>
                                                                                                        <input
                                                                                                            class="form-control form-valid"
                                                                                                            type="file"
                                                                                                            value=""
                                                                                                            id="assignment"
                                                                                                            name="file"
                                                                                                            accept=".pdf">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer" style="margin-top: 20px">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary close-modal"
                                                                                                    data-target="#updateAssignment-{{ @$training_assignment->id }}">Close</button>
                                                                                                <button type="submit"
                                                                                                    class="btn custom-btn">Submit</button>
                                                                                            </div>


                                                                                            <div style="margin-top: 20px">
                                                                                                <span>Note<sup class="text-danger">&ast;</sup> : File size must be less than 5 MB.</span>
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
                                                @else
                                                    <p class="text-center">No Assignments Found !</p>
                                                @endif

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


            $.validator.addMethod("filesize_max", function(value, element, param) {
                if (element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            }, "File size must be less than {0} bytes.");



            $('form[id^="user_assignment_btn"]').each(function() {
                $(this).validate({
                    rules: {
                        file: {
                            required: true,
                            accept: "application/pdf",
                            filesize_max: 5242880,
                        },

                    },
                    messages: {
                        file: {
                            required: "Please choose assignment file",
                            filesize_max: "File size must be less than 5 MB.",
                            accept: "Please select a PDF file"
                        },
                    },
                });
            });


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
