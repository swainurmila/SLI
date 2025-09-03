@component('mail::message')
Your Account  <b>User Name-</b> {{ucfirst( $mailData['username']) }} & and <b>Password-</b>{{ $mailData['password'] }}.
<br>
Once Admin approved your account you can login through your credential .
<br>
Thanks,<br>
State Labour Institute
@endcomponent
