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
                        title="Средняя реальная стоимость клиента. Форумула: Чистая прибыль / Выполненные">
                    <b>Стоимость клиента</b>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Фактическая прибыль. Форумула: Сумма маржинальности всех проданных товаров">
                    <b>Прибыль</b>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Все расходы за день. Форумула: ЗП менеджера + Затраты на рекламу + (100 * Кол-во возвратов)">
                    <b>Расходы</b>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Форумула: Прибыль - расходы">
                    <b>Чистая прибыль</b>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Маржинальность. Форумула: (Прибыль / Расходы) * 100">
                    <b>Маржинальность</b>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Прибыль инвестора. Форумула: Чистая  прибыль * 0.35">
                    <b>Прибыль инвестора</b>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Зарплата менеджера. Форумула: (Кол-во выполненных заказов + Кол-во отмененных заказов) * 15">
                    <b>Зарплата менеджера</b>
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
                <td scope="row">{{round($item->returned_orders_ratio, 2). '%'}}</td>
                <td scope="row">{{round($item->received_parcel_ratio, 2). '%'}}</td>
                <td scope="row">{{round($item->client_cost, 2) . ' грн.'}}</td>
                <td scope="row">{{round($item->profit, 2) . ' грн.'}}</td>
                <td scope="row">{{round($item->costs, 2) . ' грн.'}}</td>
                <td scope="row">{{round($item->net_profit, 2) . ' грн.'}}</td>
                <td scope="row">{{round($item->marginality, 2). '%'}}</td>
                <td scope="row">{{round($item->investor_profit, 2). ' грн.'}}</td>
                <td scope="row">{{round($item->manager_salary, 2). ' грн.'}}</td>
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
