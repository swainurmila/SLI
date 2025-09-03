<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        /* Count Down  */
        .CountDown {
            position: fixed;
            left: 0;
            top: 0;
            /* background: #031132b8; */
            background-image: url({{ asset('sli_assets/images/examWillStart.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            width: 100vw;
            z-index: 9999;
            display: flex;
            /* display: none; */
            justify-content: center;
            align-items: center;
        }

        .CountDown .CDcard {
            height: 250px;
            width: 500px;
            background: #fff;
            color: rgb(0, 15, 44);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
            border-radius: 10px;
            border: 1px solid #f00;
            margin-left: -650px;
            margin-top: 200px;
        }

        .CountDown .CDcard h3 {
            font-weight: bold;
        }

        .CountDown .CDcard #countdown {
            font-size: 45px;
            color: #f00;
            font-weight: bold;
        }

        /* Count Down Ends */


        /* Exam Timer */
        #exam-timer {
            color: white;
            padding: 10px;
            display: inline-block;
            background: #61cd5e;
            border-radius: 20px;
        }

        /* === */


        .checkout-order {
            border: 2px solid #e1e1e1;
            padding: 40px;
        }

        .checkout-title .title {
            font-size: 24px;
            color: #131313;
            position: relative;
        }

        .checkout-title .title::after {
            content: "";
            width: 50px;
            display: block;
            margin-top: 10px;
            border-bottom-width: 2px;
            border-bottom-style: solid;
            border-color: inherit;
        }

        .checkout-order .table {
            margin-bottom: 0;
        }

        .checkout-order .table thead tr th {
            padding: 10px 0;
            border-top: 0;
            border-bottom: 1px solid #e1e1e1;
            border-bottom-color: rgb(225, 225, 225);
            font-weight: 400;
            font-size: 14px;
            color: #000;
            vertical-align: middle;
        }

        .checkout-order .table tbody tr:first-child td {
            padding-top: 20px;
        }

        .checkout-order .table tbody tr td {
            padding: 5px 0;
            padding-top: 5px;
            border-top: 0;
            vertical-align: middle;
        }

        .checkout-order .table tbody tr td p {
            font-weight: 400;
            font-size: 14px;
            color: #000;
        }

        .checkout-payment {
            margin-top: 30px;
        }

        .checkout-order ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .single-form .btn {
            height: 40px;
            line-height: 40px;
            padding: 0 35px;
            font-size: 15px;
            font-weight: 500;
        }

        .btn-custom {
            background-color: #2b932b;
            border-color: #2b932b;
            color: #ffffff !important;
        }

        .btn-secondary {
            background-color: #6e6f6e;
            border-color: #6e6f6e;
            color: #ffffff !important;
            margin-left: 10px;
        }

        .modal-success {
            display: none;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #565656b5;
            z-index: 99;
            overflow: hidden;
        }

        .modal-dialog {
            width: 80%;
            margin: auto;
            display: flex;
            align-content: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .modal-content {
            width: 52%;
            background: #fff;
            padding: 7rem;
            border-radius: 15px;
            margin: auto;
        }

        @media screen and (max-width: 767px) {
            .modal-content {
                width: 100%;
                padding: 3rem;
            }
        }



        .success-alert {
            background: #2b932b;
        }

        .error-alert {
            background: red;
        }

        #snackbar {
            min-width: 250px;
            margin-left: -125px;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 92%;
            /* bottom: 30px; */
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .hide {
            display: none
        }

        .pagination {
            margin: 20px 0;
            padding: 0;
            list-style: none;
            text-align: center;
        }

        .pagination li {
            display: inline-block;
            margin-right: 5px;
        }

        .pagination li a,
        .pagination li span {
            color: #333;
            padding: 6px 12px;
            text-decoration: none;
            border: 1px solid #ccc;
        }

        .pagination li.active span {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination li.disabled span {
            color: #999;
        }

        .pagination li a:hover {
            background-color: #f5f5f5;
        }

        .pagination .disabled span {
            pointer-events: none;
            cursor: default;
        }



        .panel-tab {
            float: left;
            width: 50%;
            padding: 15px 15px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #fff;
            background: rgb(63, 114, 251);
            background: #0B4D8B;
        }

        .panel-tab-full {
            width: 100%;
        }

        .panel {
            border-radius: 45px;
            margin-left: 20px;
            box-shadow: 10px 10px 5px #888888;
            border: 2px solid #0155ad !important;
            border-bottom: 3px solid #0B365E !important;
            width: -webkit-fill-available;
            /* padding-bottom: 200px; */
            /* border-radius: 30px; */
            /* background-color: #f9f9f9; */
            /* box-shadow: 0px 0px 5px rgb(0 0 0 / 30%); */
            /* padding: 0px 0px;
            margin-top: 35px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 10px 10px 5px #888888;
            border: 2px solid #0155ad !important;
            border-bottom: 4px solid #0B365E !important;
            width: -webkit-fill-available;
            height: 200px;
            position: relative;
            background: #faf9f8;
            border-radius: 0px 0px 30px 30px; */
        }


        .hot-news {
            display: flex;
            width: 100%;
            align-items: center;
            /* flex-flow: row wrap; */
            margin: 0px 0px;
            box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
            justify-content: space-between;
            border: 0px solid #55cb94;
            /* border-left: none; */
            /* border-right: none; */
            background-color: #000;
        }

        .left_head {
            width: 20%;
            background: #5ba903;
            padding: 10px 10px;
            text-align: center;
            color: #fff;
            text-transform: capitalize;
        }

        .right_marq {
            width: 87%;
            line-height: inherit;
        }

        .apply-now {
            /* -webkit-animation: pulse 400ms infinite alternate; */
            animation: pulse 400ms infinite alternate;
            cursor: pointer;
            padding: 2px 8px;
            width: 50px;
            border-radius: 12px;
            font-size: 12px;
            margin-left: 14px;
            /* font-weight: 600; */
            color: #fff;
            text-align: center;
            height: 19px;
            line-height: 14px;
            background-color: #a50000;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        ul li {
            list-style: none;
        }

        .question {
            display: flex;
            align-items: center;
            gap: 35px;
        }

        .sub-question {
            display: flex;
            align-items: center;
        }

        textarea {
            display: block;
        }
    </style>
</head>

<body>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="CountDown">
            <div class="CDcard exam_to_start">
                <h3 class="exam-head">Your Exam will Starts in: </h3>
                <span id="countdown"></span>
                <p class="exam-desc">Please be Patience.</p>
            </div>
            <div class="CDcard" id="link-expired" style="display: none;">
                <h1>Exam Link Expired !</h1>
            </div>
        </div>
        {{-- <div class="dashboard__content__wraper" id="exam-screen">
            <div class="row">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-5">
                    <div class="dashboard__section__title">
                        <h2>Online Examination</h2>
                    </div>
                </div>
                <div class="col-md-2">&nbsp;</div>
    
    
    
            </div>
    
            <div class="row">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-5">&nbsp;</div>
    
                <div class="col-md-2">
                    <div class="dashboard__section__title">
                        <h4 id="exam-timer">Time : 00:00:00</h4>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.course.examination.submit', $id) }}" method="POST" id="online_answer"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" name="course_id" id="course_id" value="{{ $data->course_id }}">
                                <input type="hidden" name="exam_id" id="exam_id" value="{{ $data->id }}">
                                <h4 class="card-title mb-4">Multiple Type Questions : </h4>
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
    
                                            @if (!$options->isEmpty())
                                                <div class="form-group">
                                                    <ul class="question">
                                                        @foreach ($options as $key1 => $option)
                                                            <li class="sub-question">
                                                                <input name="mcq-{{ @$question->id }}[]" type="radio"
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
                                                    <textarea class="mt-4" name="short_answer-{{ @$question->id }}" id="" cols="200" rows="5"></textarea>
    
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <h4 class="card-title mb-4">Long Questions : </h4>
                                @foreach ($data->Questions as $key => $question)
                                    @if ($question->question_type == 3)
                                        <div class="form-group mb-4">
    
                                            <label for="">{{ ++$key }}. {{ $question->question }}</label>
                                            <textarea class="mt-4" name="long_answer-{{ @$question->id }}" id="" cols="200" rows="5"></textarea>
    
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn custom-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    
        </div> --}}
        
        
    </div>


    <script src="{{ asset('user-assets/js/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            const examInfoUrl = "{{ route('user.course.examination.info', @$id) }}";

            $.get(examInfoUrl, function(data) {

                const now = new Date().getTime();
                let examDuration = data.examDuration * 60 * 60 * 1000;
                const examStartTime = new Date(data.examStartTime).getTime();

                const examEndTime = new Date(data.examStartTime).getTime() + data.examDuration * 60 * 60 * 1000;
                console.log('Exam Start Time:', examStartTime);
                console.log('Current Time:', now);
                console.log('Exam Duration :', data.examDuration);
                // Countdown to exam start

                if (now > examEndTime) {
                    $('.exam_to_start').hide();
                    $('#link-expired').show();
                    $('#countdown').hide();
                } else {
                    $('#countdown').show();
                    $('#link-expired').hide();
                    $('#exam-over').hide();

                    const countdownInterval = setInterval(function() {
                        const currentTime = new Date().getTime();
                        const distance = examStartTime - currentTime;

                        if (distance <= 0) {
                            clearInterval(countdownInterval);
                            $('#countdown').hide();
                            $('.exam-head').text('Exam Begin');
                            $('.exam-desc').text('BEST OF LUCK !')
                            window.location.href = "{{ route('user.course.examination.start', @$id) }}";
                        } else {
                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 *
                                60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            $('#countdown').text(`${days}d ${hours}h ${minutes}m ${seconds}s`);
                        }
                    }, 1000);


                }
            });
        });
    </script>
</body>

</html>
