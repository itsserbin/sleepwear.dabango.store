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
            <div class="table-responsive">
                <table class="table text-center align-center w-100">
                    <thead>
                    <tr style="vertical-align: middle;">
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Дата по которой посчитана статистика">
                                <b>Дата</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Сумма затрат по таргету/Кол-во заявок">
                                <b>Цена заявки</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Сумма всех затрат по таргету за день">
                                <b>Затраты на рекламу</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество всех заявок за день">
                                <b>Количество заявок</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество заявок переданных поставщику за день">
                                <b>Переданы поставщику</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество заявок в процессе за день">
                                <b>В процессе</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество заявок на почте за день">
                                <b>На почте</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество выполненных заявок за день">
                                <b>Выполненные</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество возвращенных заказов за день">
                                <b>Возвраты</b>
                            </button>
                        </th>
                        <th>
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество отмененных заказов за день">
                                <b>Отмененные</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Количество не обработаных заявок за день">
                                <b>Не обработаны</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Canceled Orders Rate = Коэфициент отмененных заказов. Форумула: (Отмененные заказы/Все заказы) * 100">
                                <b>COR</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Returned Orders Ratio = Коэфициент возвращенных заказов. Форумула: (Возвращенные заказы/Все заказы) * 100">
                                <b>ROR</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Received Parcel Ratio = Коэффициент полученных посылок. Форумула: (Выполненные заказы/Все заказы) * 100">
                                <b>RPR</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Средняя реальная стоимость клиента. Форумула: Расходы на таргет/Выполненные заказы">
                                <b>Стоимость клиента</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Фактическая прибыль. Форумула: ((Маржа за день * Количество выполненных заказов)-(100 * Кол-во отмененных заказов)) - Расходы на таргет">
                                <b>Прибыль</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Маржинальность. Форумула: (Чистая прибыль за день) / Расходы на таргет">
                                <b>Маржинальность</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Прибыль инвестора. Форумула: ((Маржинальность за день * Количество выполненных заказов) - (100 * Количество отмененных заказов) * 0,35) - Расходы на таргет">
                                <b>Прибыль инвестора</b>
                            </button>
                        </th>
                        <th scope="col">
                            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Зарплата менеджера. Форумула: Кол-во выполненных заказов * 15">
                                <b>Зарплата менеджера</b>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($days_orders as $item)
                        <tr style="vertical-align:middle;">
                            <td scope="row">{{$item->date->format('d.m.y') ?? '-'}}</td>
                            <td scope="row">{{number_format((float)$item->application_price, 2, ',', '')}}</td>
                            <td scope="row">{{$item->advertising}}</td>
                            <td scope="row">{{$item->applications}}</td>
                            <td scope="row">{{$item->transferred_to_supplier}}</td>
                            <td scope="row">{{$item->in_process}}</td>
                            <td scope="row">{{$item->at_the_post_office}}</td>
                            <td scope="row">{{$item->completed_applications}}</td>
                            <td scope="row">{{$item->refunds}}</td>
                            <td scope="row">{{$item->cancel}}</td>
                            <td scope="row">{{$item->unprocessed}}</td>
                            <td scope="row">{{round($item->canceled_orders_rate, 2). '%'}}</td>
                            <td scope="row">{{round($item->returned_orders_ratio, 2). '%'}}</td>
                            <td scope="row">{{round($item->received_parcel_ratio, 2). '%'}}</td>
                            <td scope="row">{{round($item->сlient_cost, 2) . ' грн.'}}</td>
                            <td scope="row">{{round($item->profit, 2) . ' грн.'}}</td>
                            <td scope="row">{{round($item->marginality, 2). '%'}}</td>
                            <td scope="row">{{round($item->investor_profit,2). ' грн.'}}</td>
                            <td scope="row">{{round($item->manager_salary,2). ' грн.'}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
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
