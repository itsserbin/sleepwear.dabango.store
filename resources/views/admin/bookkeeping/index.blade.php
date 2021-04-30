@extends('layouts.app')

@section('title','Бухгалтерия')
@section('header','Бухгалтерия')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <div class="row mb-4">
                    <h3>Последние траты</h3>
                    <div class="table-responsive rounded-3">
                        <table class="table text-center align-center table-light">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Кол-во</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Итого</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($costs as $cost)
                                <tr style="vertical-align:middle;">
                                    <th scope="row">{{$cost->id}}</th>
                                    <td>{{$cost->name}}</td>
                                    <td scope="row">{{$cost->quantity}}</td>
                                    <td scope="row">{{$cost->sum}}</td>
                                    <td scope="row">{{$cost->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="row" colspan="3" class="text-end">За 7 дней:</th>
                                <th colspan="2" class="text-center">@convert($CostsInJustAWeek) ₴</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row mb-4">

                <h3>Последние проданные товары</h3>
                    <div class="table-responsive rounded-3">
                        <table class="table text-center align-center table-light">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Закупочная цена</th>
                                <th scope="col">Цена продажи</th>
                                <th scope="col">Маржа</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr style="vertical-align:middle;">
                                        <th scope="row">{{$order->Product->id}}</th>
                                        <td>{{$order->Product->h1}}</td>
                                        <td>@convert($order->Product->trade_price) ₴</td>
                                        <td>@convert($order->sale_price) ₴</td>
                                    <td>@convert($order->sale_price - $order->Product->trade_price) ₴</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="row" colspan="3" class="text-end">За 7 дней:</th>
                                <th colspan="2" class="text-center">@convert($OrdersProfitInJustAWeek) ₴</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row">
                <h3>Прибыль с вычетом расходов</h3>
                    <div class="table-responsive rounded-3">
                        <table class="table text-center align-center table-light">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Дата</th>
                                <th scope="col">Расходы</th>
                                <th scope="col">Прибыль</th>
                                <th scope="col">Маржа</th>
                                <th scope="col">Оборот</th>
                                <th scope="col">Обновлено</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profits as $profit)
                                <tr style="vertical-align:middle;">
                                    <th scope="row">{{$profit->id}}</th>
                                    <td>{{$profit->created_at->format('d.m.y')}}</td>
                                    <td>@convert($profit->cost) ₴</td>
                                    <td>@convert($profit->profit) ₴</td>
                                    <td>@convert($profit->marginality) ₴</td>
                                    <td>@convert($profit->turnover) ₴</td>
                                    <td>{{$profit->updated_at->format('d.m.y h:m')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tr>
                                <th scope="row" colspan="5" class="text-end">За 7 дней:</th>
                                <td colspan="2" class="text-center">@convert($ProfitInJustAWeek) ₴</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
