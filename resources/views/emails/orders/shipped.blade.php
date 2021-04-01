@component('mail::message')

Name: {{$name}}
Phone: {{$phone}}
Size: {{$size}}

@component('mail::button', ['url' => 'tel:{{$phone}}'])
Позвонить
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
