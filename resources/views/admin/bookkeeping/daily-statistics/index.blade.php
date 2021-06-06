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
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('admin.bookkeeping.daily-statistics.index')}}"
                               class="text-decoration-none">
                                <button class="btn btn-outline-warning my-3">
                                    За все время
                                </button>
                            </a>

                            <a href="{{route('admin.bookkeeping.daily-statistics.7Days')}}"
                               class="text-decoration-none">
                                <button class="btn btn-outline-warning my-3">
                                    За 7 дней
                                </button>
                            </a>

                            <a href="{{route('admin.bookkeeping.daily-statistics.week')}}" class="text-decoration-none">
                                <button class="btn btn-outline-warning my-3">
                                    За 14 дней
                                </button>
                            </a>

                            <a href="{{route('admin.bookkeeping.daily-statistics.30Days')}}"
                               class="text-decoration-none">
                                <button class="btn btn-outline-warning my-3">
                                    За 30 дней
                                </button>
                            </a>
                        </div>

                    </div>
                    <hr>
                    @if(!Route::is('admin.bookkeeping.daily-statistics.index'))
                        <div class="row align-items-center">
                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Получено заявок:
                                </div>
                                <div class="h6">
                                    {{round($SumApplications)}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    На почте:
                                </div>
                                <div class="h6">
                                    {{round($SumAtThePostOffice)}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Средний COR:
                                </div>
                                <div class="h6">
                                    {{round($AverageCorRate, 2). '%'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Средний ROR:
                                </div>
                                <div class="h6">
                                    {{round($AverageRorRate, 2). '%'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Средний RPR:
                                </div>
                                <div class="h6">
                                    {{round($AverageRprRate, 2). '%'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Средняя цена заявки:
                                </div>
                                <div class="h6">
                                    {{round($AverageApplicationPrice, 2). ' грн.'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Средняя стоимость клиента:
                                </div>
                                <div class="h6">
                                    {{round($AverageClientCostRate, 2). ' грн.'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Общая прибыль:
                                </div>
                                <div class="h6">
                                    {{round($SumProfit, 2). ' грн.'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Затраты на рекламу:
                                </div>
                                <div class="h6">
                                    {{round($SumTargetCosts, 2). ' грн.'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Средняя маржа:
                                </div>
                                <div class="h6">
                                    {{round($AverageMarginality, 2). '%'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Прибыль инвестора:
                                </div>
                                <div class="h6">
                                    {{round($SumInvestorProfit, 2). ' грн.'}}
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-center my-3">
                                <div class="h5">
                                    Зарплата менеджера:
                                </div>
                                <div class="h6">
                                    {{round($SumManagerSalary, 2). ' грн.'}}
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endif
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
                            @foreach($data as $item)
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
                                    <td scope="row">{{round($item->returned_orders_ratio, 2). '%'}}</td>
                                    <td scope="row">{{round($item->received_parcel_ratio, 2). '%'}}</td>
                                    <td scope="row">{{round($item->client_cost, 2) . ' грн.'}}</td>
                                    <td scope="row">{{round($item->profit, 2) . ' грн.'}}</td>
                                    <td scope="row">{{round($item->marginality, 2). '%'}}</td>
                                    <td scope="row">{{round($item->investor_profit,2). ' грн.'}}</td>
                                    <td scope="row">{{round($item->manager_salary,2). ' грн.'}}</td>
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
                    {{ $data->links() }}
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
