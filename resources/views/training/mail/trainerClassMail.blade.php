@component('mail::message')
Hello Learner,

You have a Live Class of {{ $mailData['traing_name'] }}  on {{ $mailData['class_date'] }} . Please use this link  {{ $mailData['class_link'] }} to join the session.

@endcomponent

