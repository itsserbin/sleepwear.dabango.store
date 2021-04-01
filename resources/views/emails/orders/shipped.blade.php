@component('mail::message')

    <p><b>Имя:</b> {{$name}}</p>
    <p><b>Телефон:</b> <a href="tel:+{{$phone}}">{{$phone}}</a></p>
    <p><b>Размер:</b> {{$size}}</p>

@endcomponent
