@extends('layouts.app')

@section('title','Статистика продаж')
@section('header','Статистика продаж')

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
                <div class="row mb-5">
                    <div class="row">
                        <h2>Статистика по дням</h2>
                        <a href="{{route('admin.bookkeeping.daily-statistics.create')}}">
                            <button class="btn btn-light">
                                Посчитать день
                            </button>
                        </a>
                    </div>

                    <div class="row">
                        <a href="{{route('admin.bookkeeping.daily-statistics.ShowStatisticsForTheWeek')}}">
                            <button class="btn">
                                Итог за 7 дней
                            </button>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-center align-center">
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($days_orders as $item)
                                <tr style="vertical-align:middle;">
                                    <td scope="row">{{$item->date->format('d.m.y')}}</td>
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
                                    <td scope="row">{{round($item->received_parcel_ratio, 2). '%'}}</td>
                                    <td scope="row">{{round($item->сlient_cost, 2) . ' грн.'}}</td>
                                    <td scope="row">{{round($item->profit, 2) . ' грн.'}}</td>
                                    <td scope="row">{{round($item->marginality, 2). '%'}}</td>
                                    <td scope="row">{{round($item->investor_profit,2). ' грн.'}}</td>
                                    <td>
                                        <form
                                            onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                            action="{{route('admin.bookkeeping.daily-statistics.destroy', $item)}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <button type="submit" class="btn">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                     class="bi bi-trash-fill"
                                                     fill="currentColor"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $days_orders->links() }}
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
