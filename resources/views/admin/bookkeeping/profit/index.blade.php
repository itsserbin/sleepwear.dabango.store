@extends('layouts.app')

@section('title','Прибыль')
@section('header','Прибыль')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <div class="row">
                    <h2>Прибыль с товара</h2>
                    <div class="table-responsive">
                        <table class="table text-center align-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Имя</th>
                                <th scope="col">ID Товара</th>
                                <th scope="col">Товар</th>
                                <th scope="col">Закупочная цена</th>
                                <th scope="col">Цена продажи</th>
                                <th scope="col">Маржа</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profitOrders as $profit)
                                <tr style="vertical-align:middle;">
                                    <th scope="row">{{$profit->id}}</th>
                                    <td>{{$profit->name}}</td>
                                    <td>{{$profit->product_id}}</td>
                                    {{--                                @foreach($profit->product as $item)--}}
                                    <td>
                                        <a href="{{route('product', $profit->product->id)}}"
                                           target="_blank">
                                            {{$profit->product->h1}}
                                        </a>
                                    </td>
                                    <td>@convert($profit->trade_price) ₴</td>
                                    <td>@convert($profit->sale_price) ₴</td>
                                    {{--                                @endforeach--}}
                                    <td>@convert($profit->profit) ₴</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="row" colspan="5" class="text-end">За 7 дней:</th>
                                {{--                            <td colspan="2" class="text-center">@convert($ProfitClientsInJustAWeek) ₴</td>--}}
                            </tr>
                        </table>
                    </div>
                    {{ $profitOrders->links() }}
                </div>

                <div class="row">
                    <h2>Прибыль с вычетом расходов</h2>
                    <div class="table-responsive">
                        <table class="table text-center align-center">
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
                                {{--                            <td colspan="2" class="text-center">@convert($ProfitInJustAWeek) ₴</td>--}}
                            </tr>
                        </table>
                    </div>
                    {{ $profits->links() }}
                </div>
            </div>

        </div>
@endsection
