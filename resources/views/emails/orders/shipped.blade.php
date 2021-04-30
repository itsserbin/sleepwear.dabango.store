@component('mail::message')

    <table style="vertical-align: middle" cellspacing="10">
        <tr>
            <td><b>Имя:</b></td>
            <td>{{$name}}</td>
        </tr>

        <tr>
            <td><b>Телефон:</b></td>
            <td><a href="tel:+{{$phone}}">{{$phone}}</a></td>
        </tr>


        <tr>
            <td><b>ID товара:</b></td>
            <td>{{$product}}</td>
        </tr>

        <tr>
            <td><b>Название товара:</b></td>
            <td>{{$product_name}}</td>
        </tr>

        <tr>
            <td><b>URL:</b></td>
            <td>{{$url}}</td>
        </tr>

        <tr>
            <td><b>Размеры:</b></td>
            <td>
                @if($sizes)
                    @foreach($sizes as $size)
                        {{$size}}
                    @endforeach
                @elseРазмеры не указаны @endif
            </td>
        </tr>

        <tr>
            <td><b>Цвета:</b></td>
            <td>
                @if($colors)
                    @foreach($colors as $item)
                        {{$item}}
                    @endforeach
                @elseЦвета не указаны @endif
            </td>
        </tr>
    </table>

    @component('mail::button', ['url' => route('admin.clients.index')])
        Перейти в админ.панель
    @endcomponent
