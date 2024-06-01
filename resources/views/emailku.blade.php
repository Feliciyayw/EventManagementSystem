@component('mail::message')
# Notification

@php
 echo $data['title'];   
@endphp

@component('mail::button', ['url' => $data['url']])
    Aplikasi Event Organizer
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
