@extends('course.examination.layouts.main')
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="CountDown">
            <div class="CDcard">
                <div class="exam_to_start">
                    <h3 class="exam-head">Your Exam will Starts in: </h3>
                    <span id="countdown"></span>
                    <p class="text-center">Please be Patience.</p>
                </div>
                <div id="exam-over" style="display: none;">
                    <h1>Exam Over</h1>
                </div>
            </div>
        </div>
        <div class="dashboard__content__wraper" id="exam-screen">
            <div class="row">
                <div class="col-lg-8">
                    <div class="dashboard__section__title">
                        <h2 style="text-align: center;">Online Examination</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="panel" style="border-radius: 8px;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 id="exam-timer" style="float: right; margin: 6px;">Time : 00:00:00</h4>
                                    <button type="button" onclick="submitAnswers()" class="btn btn-primary pull-right"
                                        style="margin: 6px; color: white; padding: 10px;display: inline-block;border-radius: 20px;">Submit</button>
                                </div>
                            </div>

                            <form
                                style="height: calc(100vh - 243px); overflow-y: scroll; width: calc(100% - 10px); padding: 0 20px;overflow-x: hidden;"
                                action="{{ route('user.course.examination.submit', $id) }}" method="POST"
                                id="online_answer" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="course_id" id="course_id" value="{{ $data->course_id }}">
                                    <input type="hidden" name="exam_id" id="exam_id" value="{{ $data->id }}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="exam_notification_id" id="exam_notification_id" value="{{ $data->Notification->id }}">

                                    <h4 class="panel-title mb-4">Multiple Type Questions : </h4>
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 1)
                                            <div class="form-group mb-4">

                                                <label for="">{{ ++$key }}. {{ $question->question }}</label>
                                                @php
                                                    $options = \App\Models\Course\CrQuestionOptions::where(
                                                        'question_id',
                                                        $question->id,
                                                    )->get();
                                                @endphp

                                                <input type="hidden" name="{{$question->id}}" id="mcq-{{@$question->id}}">
                                                @if (!$options->isEmpty())
                                                    <div class="form-group">
                                                        <ul class="question">
                                                            @foreach ($options as $key1 => $option)
                                                                <li class="sub-question">
                                                                    <input class="mcq-radio" id="{{ @$question->id }}" name="{{ $question->id }}" type="radio"
                                                                    value="{{ @$option->option_title }}">{{ @$option->option_title }}
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
                                    <h4 class="card-title mb-4">Short Questions : </h4>
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 2)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label for="">{{ ++$key }}.
                                                            {{ $question->question }}</label>
                                                        <textarea class="mt-4 form-control" name="{{ @$question->id }}" id="" rows="5"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <h4 class="card-title mb-4">Long Questions : </h4>
                                    @foreach ($data->Questions as $key => $question)
                                        @if ($question->question_type == 3)
                                            <div class="form-group mb-4">

                                                <label for="">{{ ++$key }}.
                                                    {{ $question->question }}</label>
                                                <textarea class="mt-4 form-control" name="{{ @$question->id }}" id="" rows="5"></textarea>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 examImg">
                    <img style="height: 67vh; width: auto; margin: auto;"
                        src="{{ asset('sli_assets/images/examQstn.png') }}" alt="Exam Image">
                </div>
            </div>

        </div>


    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {



            const examInfoUrl = "{{ route('user.course.examination.info', @$id) }}";

            $.get(examInfoUrl, function(data) {

                const examDuration = data.examDuration * 60 * 60 * 1000;
                const examStartTime = new Date(data.examStartTime).getTime();
                const now = new Date().getTime();
                const examEndTime = examStartTime + examDuration;


                $('#exam-over').hide();

                if (now > examEndTime) {
                    $('#countdown').hide();
                    $('.exam_to_start').hide();
                    $('#exam-over').show();
                } else if (now < examStartTime) {
                    const nowTime = new Date().getTime();
                    const examTime = examStartTime - nowTime;

                    if (examTime > 0) {
                        $('#countdown').show();
                        $('.exam_to_start').show();
                        $('#exam-over').hide();
                        $('#exam-screen').hide();

                        const countdownInterval = setInterval(function() {
                            const currentTime = new Date().getTime();
                            const distance = examStartTime - currentTime;
                            if (distance <= 0) {
                                clearInterval(countdownInterval);
                                $('#countdown').hide();
                                $('.exam_to_start').hide();
                                $('#exam-screen').show();
                                location.reload();
                                startExamTimer(examDuration / 1000);
                            } else {
                                // const duration = dayjs.duration(distance);
                                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (
                                    1000 *
                                    60 *
                                    60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 *
                                    60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                $('#countdown').text(`${days}d ${hours}h ${minutes}m ${seconds}s`);
                            }
                        }, 1000);
                    } else {
                        const countdownInterval = setInterval(function() {
                            const currentTime = new Date().getTime();
                            const distance = examEndTime - currentTime;
                            if (distance <= 0) {
                                clearInterval(countdownInterval);
                                $('#countdown').hide();
                                $('.exam_to_start').hide();
                                $('#exam-screen').show();
                                startExamTimer(examDuration / 1000);
                            } else {
                                // const duration = dayjs.duration(distance);
                                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (
                                    1000 *
                                    60 *
                                    60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 *
                                    60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                $('#countdown').text(`${days}d ${hours}h ${minutes}m ${seconds}s`);
                            }
                        }, 1000);
                    }

                } else {
                    $('.CountDown').hide();
                    $('.exam_to_start').hide();
                    $('#countdown').hide();
                    $('#exam-over').hide();
                    const remainingTime = (examEndTime - now) / 1000; // Remaining time in seconds
                    $('#exam-screen').show();
                    startExamTimer(remainingTime);
                }



                function startExamTimer(duration) {
                    let timer = duration;
                    const examInterval = setInterval(function() {
                        const hours = Math.floor(timer / 3600);
                        const minutes = Math.floor((timer % 3600) / 60);
                        const seconds = Math.floor(timer % 60);

                        $('#exam-timer').text(`Time : ${hours}h ${minutes}m ${seconds}s`);

                        if (--timer < 0) {
                            clearInterval(examInterval);
                            submitAnswers();
                            $('#exam-over').show();
                        }
                    }, 1000);
                }



                const submitAnswers = function() {
                    $('#online_answer').submit();
                };


                window.addEventListener('unload', function() {
                    submitAnswers();
                });

                $(window).on('beforeunload', function() {
                    clearInterval(countdownInterval);
                    clearInterval(examInterval);
                    submitAnswers();
                    const message =
                        'Your answers will be saved and you will be logged out if you leave this page.';
                    event.returnValue = message;
                    return message;
                });

                document.addEventListener('keydown', function(e) {
                    if (e.ctrlKey && (e.key === 'u' || e.key === 'i' || e.key === 'j' || e.key ===
                            'c' || e.key === 'v') || (e.key === 'F5') || (e.ctrlKey && e.key ===
                            'r')) {
                        e.preventDefault();
                    }
                });

                document.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                });


            });


            
        });


        $('.mcq-radio').change(function(e){
            $('#mcq-'+$(this).attr('id')).val(e.target.value);
        })
        function submitAnswers() {
                $('#online_answer').submit();
            };

        $(document).ready(function() {
            const container = $('.panel-body');
            container.scrollLeft(30);
        });
    </script>
@endsection
