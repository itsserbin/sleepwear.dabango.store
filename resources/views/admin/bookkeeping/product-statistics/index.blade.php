@extends('layouts.app')

@section('content')
    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('active')Бухгалтерия@endslot
            @slot('active_link'){{route('admin.bookkeeping.index')}}@endslot
            @slot('subsidiary')Статистика продаж@endslot
        @endcomponent
        <hr>

        <div class="row ">
            <div class="col-12 col-md-2">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-10">
                <h2>Статистика по товарам</h2>
                <div class="table-responsive">
                    <table class="table text-center align-center">
                        <thead>
                        <tr style="vertical-align: middle;">
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Оптовая стоимость</th>
                            <th scope="col">Сумма продажи</th>
                            <th scope="col">Чистая прибыль</th>
                            <th scope="col">Дата создания заявки</th>
                            <th scope="col">Дата последнего обновления</th>
                            <th scope="col">Выплата от поставщика</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($done_orders as $item)
                            <tr style="vertical-align:middle;">
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->product->h1}}</td>
                                <td scope="row">{{$item->trade_price}}</td>
                                <td scope="row">{{$item->sale_price}}</td>
                                <td scope="row">{{$item->profit}}</td>
                                <td scope="row">{{$item->created_at->format('d.m.y')}}</td>
                                <td scope="row">{{$item->updated_at->format('d.m.y')}}</td>
                                <td scope="row">@if($item->pay)Получена@elseНе получена@endif</td>
                                <td scope="row">
                                    <a class="btn btn-default"
                                       href="{{route('admin.orders.edit', $item->id)}}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                             class="bi bi-pen"
                                             fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                                            <path fill-rule="evenodd"
                                                  d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                                            <path
                                                d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $done_orders->links() }}
            </div>
        </div>
    </div>
@endsection
