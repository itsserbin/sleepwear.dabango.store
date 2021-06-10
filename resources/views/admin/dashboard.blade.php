@extends('layouts.app')
@section('header')Добро пожаловать, {{auth()->user()->name}} :)@endsection
@section('title','Welcome')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h3>Текущее время: {{\Carbon\Carbon::now()->toTimeString('minute')}}</h3>
                <h3>Заказов сегодня: {{$orders_today}}</h3>
            </div>
        </div>

        @role('administrator')
        <div class="row mb-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2>Статистика по дням</h2>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <a href="{{route('admin.bookkeeping.daily-statistics.create')}}">
                        <button class="btn btn-danger">
                            Посчитать день
                        </button>
                    </a>
                </div>
                <hr>
            </div>
            @include('admin.bookkeeping.daily-statistics.partials.table')
            <a href="{{route('admin.bookkeeping.daily-statistics.index')}}">
                <button type="button" class="btn btn-danger ">Перейти к статистике</button>
            </a>
        </div>
        @endrole

        <div class="row mb-5">
            <div class="col-12">
                <h2>Последние заказы</h2>
                <div class="table-responsive">
                    <table class="table text-center align-center">
                        <thead>
                        <tr>
                            <th scope="col">Статус клиента</th>
                            <th scope="col">Статус заказа</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Сумма продажи</th>
                            <th scope="col">Дата обновления</th>
                            <th scope="col">Дата создания</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($orders)
                            @foreach($orders as $order)
                                <tr style="vertical-align:middle;">
                                    <td scope="row">{{$order->Clients->status}}</td>
                                    <td scope="row">{{$order->status}}</td>
                                    <td>{{$order->name}}</td>
                                    <td><a href="tel:+{{$order->phone}}">{{$order->phone}}</a></td>
                                    <td>{{$order->sale_price}}</td>
                                    <td>{{$order->updated_at->toDateTimeString('minute')}}</td>
                                    <td>{{$order->created_at->toDateTimeString('minute')}}</td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8" class="p-3">
                                <a href="{{route('admin.orders.index')}}">
                                    <button type="button" class="btn btn-light ">Перейти ко всем заказам</button>
                                </a></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <h2>Клиенты</h2>
                <div class="table-responsive">
                    <table class="table text-center align-center">
                        <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Покупок</th>
                            <th scope="col">Весь чек</th>
                            <th scope="col">Средний чек</th>
                            <th scope="col">Последняя покупка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($clients)
                            @foreach($clients as $client)
                                <tr style="vertical-align:middle;">
                                    <td>{{$client->name}}</td>
                                    <td>
                                        {{$client->status}}
                                    </td>
                                    <td><a href="tel:{{$client->phone}}">{{$client->phone}}</a></td>
                                    <td>{{$client->number_of_purchases}}</td>
                                    <td>{{$client->whole_check}}</td>
                                    <td>{{$client->average_check}}</td>
                                    <td>{{$client->created_at->format('d.m.Y h:m')}}</td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7" class="p-3">
                                <a href="{{route('admin.clients.index')}}">
                                    <button type="button" class="btn btn-light ">Перейти ко всем клиентам</button>
                                </a></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("body").tooltip({selector: '[data-bs-toggle=tooltip]'});
        });
    </script>
@endsection
