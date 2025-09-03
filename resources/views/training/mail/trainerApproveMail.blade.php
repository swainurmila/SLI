@component('mail::message')
Your Account  <b>User Name-</b> {{ $mailData['username'] }} and <b>Password-</b> {{ $mailData['password'] }} has been approved by Admin.
<br>
Now you can Login with your User Name and Password 
<br>
Thanks,<br>
State Labour Institute
@endcomponent