@component('mail::message')

    <p><b>Имя:</b> {{$name}}</p>
    <p><b>Телефон:</b> <a href="tel:+{{$phone}}">{{$phone}}</a></p>
    <p><b>Размер:</b> {{$size}}</p>
    <p><b>ID товара:</b> {{$product}}</p>
    <p><b>Название товара:</b> {{$product_name}}</p>
    <p><b>URL:</b> {{$url}}</p>

@endcomponent
