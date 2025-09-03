<!DOCTYPE html>
<html lang="en">
<head>
    <title>Training enrollement</title>
</head>
<body>
    Dear <b>{{ ucfirst($mailData['user_name'])}},</b> <br> you have  successful enrollment  for training <b> {{$mailData['name']}}.</b>
        <br>
        Thanks,<br>
        State Labour Institute
</body>
</html>
