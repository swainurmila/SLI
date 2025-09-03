<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h4>Dear <b>{{ $mailData['user_name'] }}</b>, </h4>

    <p>Exam Notice for {{ $mailData['course_name'] }} course is now available. To appear in the exam, please apply by logging into your e-Course user portal. Apply before the deadline.</p>
    <h4>Exam Details:</h4>
    <p>Exam Title: {{ $mailData['exam_name'] }}<br>
       Apply Date: {{ $mailData['apply_start'] }} - {{ $mailData['apply_end'] }}<br>
       Exam Date: {{ $mailData['exam_date'] }}<br>
       Exam Center: {{ $mailData['exam_location'] }}
    </p>

    <p>Thank You,<br>
    <b>State Labour Institute</b></p>
</body>
</html>
