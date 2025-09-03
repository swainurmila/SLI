@extends('course.layouts.admin.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">ADD QUESTIONS</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                                &nbsp;
                                <a href="{{ route('course.admin.exam-edt-questions', $data->id) }}"
                                    class="btn custom-btn w-xs btn-xs waves-effect waves-light">Edit</a>
                            </div>
                            <form action="{{ route('course.admin.exam-update-questions', $data->id) }}" method="POST"
                                id="add_questions" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="course_id" id="course_id" value="{{ $data->course_id }}">
                                    <input type="hidden" name="exam_id" id="exam_id" value="{{ $data->id }}">
                                    <h4 class="card-title mb-4">Multiple Type
                                        Questions</h4>
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 1)
                                            <div class="form-group mb-4">

                                                <p>{{ ++$key }}. {{ $question->question }}</p>
                                                @php
                                                    $options = \App\Models\Course\CrQuestionOptions::where(
                                                        'question_id',
                                                        $question->id,
                                                    )->get();
                                                @endphp

                                                @if (!$options->isEmpty())
                                                    <div class="form-group">
                                                        <ul>
                                                            @foreach ($options as $option)
                                                                <li>{{ @$option->option_title }}
                                                                    <span class="circle-icon"></span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <br>
                                                @endif

                                            </div>

                                        @endif
                                    @endforeach
                                    <h4 class="card-title mb-4">Long Questions</h4>
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 2)
                                            <div class="form-group mb-4">
                                               

                                                <p>{{ ++$key }}. {{ $question->question }}</p>

                                            </div>
                                        @endif
                                    @endforeach
                                    <h4 class="card-title mb-4">Short Questions</h4>
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 3)
                                            <div class="form-group mb-4">
                                                

                                                <p>{{ ++$key }}. {{ $question->question }}</p>
                                            </div>
                                        @endif
                                    @endforeach
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
        function saveForm() {
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

            if (errcount == 0) {
                // If there are no errors, submit the form
                $('#add_questions').submit();
            } else {

                return false;
            }
        }
    </script>
@endsection
