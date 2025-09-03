@component('mail::message')
Your Account having <b>User Name-</b> {{ $mailData['first'] }} {{ $mailData['last'] }} has been created by Admin. You can login now.
<p>Your login credentials are given below:<br>
    <b>Id: {{ $mailData['id'] }}</b>
    <b>Password: {{ $mailData['password'] }}</b>
</p>
Thanks,<br>
State Labour Institute
@endcomponent
