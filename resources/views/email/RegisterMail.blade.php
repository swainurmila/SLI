@component('mail::message')
you have successfully registered your credentials is <b>User Name-</b>{{ $mailData['username'] }} and <b>Password-</b>{{ $mailData['password'] }}
<br>
You can login after the verification of Admin .
<br>
Thanks,<br>
State Labour Institute
@endcomponent
