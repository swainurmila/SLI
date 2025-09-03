@extends('course.layouts.admin.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>Online Answers</b> </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Course Name</th>
                                            <th>Exam Name</th>
                                            <th>User Name</th>
                                            <th>Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($questionAnswers as $key => $answer)
                                            <tr class="">
                                                <td class="text-center">{{ ++$key }}</td>
                                                </td>
                                                <td class="text-center">{{ @$answer->notification->course->course_name }}
                                                </td>
                                                <td class="text-center">{{ @$answer->notification->Exam->exam_title }}</td>
                                                <td class="text-center">{{ @$answer->user->user_name }}</td>
                                                <td class="text-center">
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light student_answers"
                                                        title="Edit"
                                                        data-notification="{{ @$answer->exam_notification_id }}"
                                                        data-user="{{ @$answer->user->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#answerModal">Show
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>





                    <div class="modal fade" id="answerModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Answer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" id="student_answer">
                                        
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
            $('.student_answers').on('click', function(e) {
                e.preventDefault();

                var notification_id = $(this).attr('data-notification');
                var student_id = $(this).attr('data-user');

                

                console.log(student_id)
                $.ajax({
                    url: '{{ route('course-notification-student-answer') }}',
                    method: 'POST',
                    data: {
                        notification_id: notification_id,
                        student_id: student_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var answers = response.answers;

                        console.log(answers)
                        $('#student_answer').empty();
                        var htmlString = '';
                        answers.forEach(function(report, index) {
                            htmlString += '<div class="form-group mb-4">'
                                     + '<h4>' + '<span>'+ (++index) +"."+'</span>'  + report.question.question + '</h4>' 
                                     
                                     + '<p>' + '<span>Answer : </span>' + report.answer +'</p>'+ 
                                
                                
                            '</div>';
                        });
                        $('#student_answer').append(htmlString);
                    },
                    error: function(xhr, status, error) {
                        $('#student_answer').empty();
                        console.error('Error fetching investigation reports:', error);
                    }
                });
            });
        </script>
    @endsection
