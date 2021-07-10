@component('mail::message')

    <p><b>Имя:</b> {{$name}}</p>

    <p><b>Телефон:</b> <a href="tel:{{$phone}}">{{$phone}}</a></p>

    @component('mail::button', ['url' => route('admin.clients.index')])
        Перейти в админ.панель
    @endcomponent
