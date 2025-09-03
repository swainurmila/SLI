@component('mail::message')
Hi {{ $mailData['username'] }},
<br>
{{$mailData['msg']}} .
<br>
Thanks,<br>
State Labour Institute
@endcomponent