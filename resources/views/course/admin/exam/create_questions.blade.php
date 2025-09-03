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
                            </div>
                            <form action="{{route("course.admin.exam-store-questions")}}" method="POST" id="add_questions" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <x-question-form :questiondata="$data" />
                                {{-- <div class="row">
                                    <input type="hidden" name="course_id" id="course_id" value="{{$data->course_id}}">
                                    <input type="hidden" name="exam_id" id="exam_id" value="{{$data->id}}">
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 1)
                                            <div class="form-group mb-4">
                                                <h4 class="card-title mb-4">Multiple Type
                                                    Questions({{ $question->no_of_questions }})</h4>
                                                @for ($i = 1; $i <= $question->no_of_questions; $i++)
                                                    <div class="form-group mb-2">
                                                        <label for="multiple_question_{{ $i }}">Question
                                                            {{ $i }}</label>
                                                        <input type="hidden" name="no_of_multiple_question" value="{{$question->no_of_questions}}">
                                                        <textarea id="multiple_question_{{ $i }}" name="multiple_question_{{ $i }}" class="form-control form-valid"
                                                            placeholder="Enter question"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        @for ($j = 1; $j <= 4; $j++)
                                                            <input type="text"
                                                                id="option_{{ $i }}_{{ $j }}"
                                                                name="option_{{ $i }}_{{ $j }}"
                                                                class="form-control form-valid"
                                                                placeholder="Option {{ $j }}"
                                                                style="display: inline-block; width: calc(25% - 10px); margin-right: 5px;">
                                                        @endfor
                                                    </div>
                                                    <br> <!-- Add a line break after each question -->
                                                @endfor
                                            </div>
                                        @elseif ($question->question_type == 2)
                                        <div class="form-group mb-4">
                                            <h4 class="card-title mb-4">Long Questions({{ $question->no_of_questions }})
                                            </h4>
                                            @for ($i = 1; $i <= $question->no_of_questions; $i++)
                                                <label for="long_question_{{ $i }}">Question
                                                    {{ $i }}</label>
                                                <input type="hidden" name="no_of_long_question" value="{{$question->no_of_questions}}">
                                                <textarea id="long_question_{{ $question->id }}_{{ $i }}"
                                                    name="long_question_{{ $i }}" class="form-control form-valid" placeholder="Enter question"></textarea>
                                               
                                            @endfor
                                        </div>
                                        @elseif ($question->question_type == 3)
                                        <div class="form-group mb-4">
                                            <h4 class="card-title mb-4">Short Questions({{ $question->no_of_questions }})
                                            </h4>
                                            @for ($i = 1; $i <= $question->no_of_questions; $i++)
                                                <label for="short_question_{{ $question->id }}_{{ $i }}">Question
                                                    {{ $i }}</label>
                                                 <input type="hidden" name="no_of_short_question" value="{{$question->no_of_questions}}">
                                                <textarea id="short_question_{{ $i }}"
                                                    name="short_question_{{ $i }}" class="form-control form-valid" placeholder="Enter question"></textarea>
                                            @endfor
                                        </div>
                                        @endif
                                        
                                    @endforeach


                                </div> --}}
                                <div class="text-end mt-4">
                                    <button type="button" onclick="saveForm()"
                                        class="btn custom-btn">Submit</button>
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
