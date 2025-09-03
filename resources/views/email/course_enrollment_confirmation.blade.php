
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Course enrollement</title>
</head>
<body>
    Dear <b>{{ ucfirst($mailData['user_name'])}} </b>, <br> you have  successful enrollment  for course {{$mailData['course_name']}}.
        <br>
        Thanks,<br>
        State Labour Institute
</body>
</html>

