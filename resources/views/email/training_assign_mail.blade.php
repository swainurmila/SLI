<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h4>Dear {{ $mailData['name'] }}, </h4>
    <p>Congratulations!</p>
    <p>You are assigned to train for <b>{{ $mailData['training_name'] }}</b> sponsored by <b>{{ $mailData['sponsor_name'] }}</b>.</p>
    <p>Other Details:</p>
    <p>Training Start Date: {{ $mailData['start_date'] }}<br>
    Training Time: {{ $mailData['start_time'] }} - {{ $mailData['end_time'] }}<br>
    Training Duration: {{ $mailData['training_duration'] }}</p>

    <p>Thank You,<br>
    <b>State Labour Institute</b></p>
</body>
</html>
