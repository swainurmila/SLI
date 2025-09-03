@extends('course.layouts.admin.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">EDIT QUESTIONS</h4>
                                <a href="{{ URL::previous() }}" class="btn ms-auto btn-sm btn-dark"><i
                                        class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                            </div>
                            <form action="{{ route('course.admin.exam-update-questions',$data->id ) }}" method="POST"
                                id="add_questions" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{-- <x-question-form :questiondata="$data" /> --}}
                                <div class="row">
                                    <input type="hidden" name="course_id" id="course_id" value="{{ $data->course_id }}">
                                    <input type="hidden" name="exam_id" id="exam_id" value="{{ $data->id }}">
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 1)
                                            <div class="form-group mb-4">
                                                

                                                @php
                                                    $options = \App\Models\Course\CrQuestionOptions::where(
                                                        'question_id',
                                                        $question->id,
                                                    )->get();
                                                @endphp

                                                @php
                                                    $exam = @$question->ExamQuestion->where('exam_id', $question->exam_id);
                                                @endphp

                                                
                                                @for ($i = 0; $i < count($exam); $i++)
                                                    <div class="form-group mb-2">
                                                            Q-{{ $i+1 }}.
                                                        <input type="hidden" name="no_of_multiple_question"
                                                            value="{{ $question->no_of_questions }}">

                                                        <input type="hidden" name="multiple_question_id[]"
                                                        value="{{ $exam[$i]->id }}"> 
                                                        <textarea id="multiple_question_{{ $i }}" name="multiple_question[]"
                                                            class="form-control form-valid" placeholder="Enter question">{{ $exam[$i]->question }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        @php
                                                            $options = @$exam[$i]->Options;
                                                        @endphp
                                                        @for ($j = 0; $j < count($options); $j++)
                                                            <input type="text"
                                                                id="option_{{ $i }}_{{ $j }}"
                                                                name="option[]"
                                                                class="form-control form-valid"
                                                                placeholder="Option {{ $j }}"
                                                                value="{{ @$options[$j]->option_title }}"
                                                                style="display: inline-block; width: calc(25% - 10px); margin-right: 5px;">
                                                        @endfor
                                                    </div>
                                                    <br>
                                                @endfor

                                            </div>
                                        
                                        @endif
                                    @endforeach


                                </div>
                                <div class="text-end mt-4">
                                    <button type="button" onclick="saveForm()" class="btn custom-btn">Update</button>
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
