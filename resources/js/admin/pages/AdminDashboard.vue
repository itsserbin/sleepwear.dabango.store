<template>
    <b-container>
        <b-row>
            <b-col>
                <div class="h3">Текущее время: {{ timeNow }}</div>
                <div class="h3">Заказов сегодня: {{ ordersToday }}</div>
            </b-col>
        </b-row>

        <b-row class="my-3">
            <b-col>
                <h2>Статистика по дням</h2>

                <b-table-simple
                    responsive
                    striped
                    class="text-center"
                    hover>
                    <b-thead>
                        <b-tr>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Дата по которой посчитана статистика">
                                    <b>Дата</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Сумма затрат по таргету/Кол-во заявок">
                                    <b>Цена заявки</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Сумма всех затрат по таргету">
                                    <b>Затраты на рекламу</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество всех заявок">
                                    <b>Количество заявок</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество заявок переданных поставщику">
                                    <b>Переданы поставщику</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество заявок в процессе">
                                    <b>В процессе</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество заявок на почте">
                                    <b>На почте</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество выполненных заявок">
                                    <b>Выполненные</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество возвращенных заказов">
                                    <b>Возвраты</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество отмененных заказов">
                                    <b>Отмененные</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество не обработаных заявок">
                                    <b>Не обработаны</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Canceled Orders Rate = Коэфициент отмененных заказов. Форумула: (Отмененные заказы/Все заказы) * 100">
                                    <b>COR</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Returned Orders Ratio = Коэфициент возвращенных заказов. Форумула: (Возвращенные заказы/Все заказы) * 100">
                                    <b>ROR</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Received Parcel Ratio = Коэффициент полученных посылок. Форумула: (Выполненные заказы/Все заказы) * 100">
                                    <b>RPR</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Средняя реальная стоимость клиента. Форумула: Чистая прибыль / Выполненные">
                                    <b>Стоимость клиента</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Форумула: Сумма маржинальности всех проданных товаров">
                                    <b>Прибыль</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Все расходы за день. Форумула: ЗП менеджера + Затраты на рекламу + (100 * Кол-во возвратов)">
                                    <b>Расходы</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Форумула: Прибыль - расходы">
                                    <b>Чистая прибыль</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Маржинальность. Форумула: (Прибыль / Расходы) * 100">
                                    <b>Маржинальность</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Прибыль инвестора. Форумула: Чистая  прибыль * 0.35">
                                    <b>Прибыль инвестора</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Зарплата менеджера. Форумула: (Кол-во выполненных заказов + Кол-во отмененных заказов) * 15">
                                    <b>Зарплата менеджера</b>
                                </b-button>
                            </b-th>
                        </b-tr>
                    </b-thead>
                    <b-tbody>
                        <b-tr v-for="item in dailyStatistics" :key="item.id">
                            <b-th>{{ item.date | moment("DD.MM.YYYY") }}</b-th>
                            <b-th>{{ item.application_price | formatMoney }}</b-th>
                            <b-td>{{ item.advertising }}</b-td>
                            <b-td>{{ item.applications }}</b-td>
                            <b-td>{{ item.transferred_to_supplier }}</b-td>
                            <b-td>{{ item.in_process }}</b-td>
                            <b-td>{{ item.at_the_post_office }}</b-td>
                            <b-td>{{ item.completed_applications }}</b-td>
                            <b-td>{{ item.refunds }}</b-td>
                            <b-td>{{ item.cancel }}</b-td>
                            <b-td>{{ item.unprocessed }}</b-td>
                            <b-td>{{ item.canceled_orders_rate | formatPercent }}</b-td>
                            <b-td>{{ item.returned_orders_ratio | formatPercent }}</b-td>
                            <b-td>{{ item.received_parcel_ratio | formatPercent }}</b-td>
                            <b-td>{{ item.client_cost | formatMoney }}</b-td>
                            <b-td>{{ item.profit | formatMoney }}</b-td>
                            <b-td>{{ item.costs | formatMoney }}</b-td>
                            <b-td>{{ item.net_profit | formatMoney }}</b-td>
                            <b-td>{{ item.marginality | formatPercent }}</b-td>
                            <b-td>{{ item.investor_profit | formatMoney }}</b-td>
                            <b-td>{{ item.manager_salary | formatMoney }}</b-td>
                            <b-td>
                                <a href="javascript:;" v-on:click="onDelete(item.id)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                         class="bi bi-trash-fill"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                    </svg>
                                </a>
                            </b-td>
                        </b-tr>
                    </b-tbody>
                </b-table-simple>
                <b-row class="text-center">
                    <a v-bind:href="'/admin/bookkeeping/daily-statistics'">
                        <b-button variant="danger">Перейти ко всем клиентам</b-button>
                    </a>
                </b-row>
            </b-col>
        </b-row>

        <b-row class="my-3">
            <b-col>
                <h2>Последние заказы</h2>
                <b-table-simple
                    responsive
                    striped
                    class="text-center"
                    hover>
                    <b-thead>
                        <b-tr>
                            <b-th>ID</b-th>
                            <b-th>Статус заказа</b-th>
                            <b-th>Имя</b-th>
                            <b-th>Номер телефона</b-th>
<!--                            <b-th>ID товара</b-th>-->
<!--                            <b-th>Название товара</b-th>-->
<!--                            <b-th>Цена продажи</b-th>-->
                            <b-th>Создан</b-th>
                            <b-th>Дата обновления</b-th>
                            <b-th>Действия</b-th>
                        </b-tr>
                    </b-thead>
                    <b-tbody>
                        <b-tr v-for="item in orders" :key="item.id">
                            <b-th>{{ item.id }}</b-th>
                            <b-th>{{ item.status }}</b-th>
                            <b-td>{{ item.name }}</b-td>
                            <b-td><a v-bind:href="'tel:' + item.phone">{{ item.phone }}</a></b-td>
<!--                            <b-td>{{ item.product_id }}</b-td>-->
<!--                            <b-td>{{ item.product.h1 }}</b-td>-->
<!--                            <b-td>{{ item.sale_price | formatMoney }}</b-td>-->
                            <b-td>{{ item.created_at | moment("DD.MM.YYYY") }}</b-td>
                            <b-td>{{ item.updated_at | moment("DD.MM.YYYY") }}</b-td>
                            <b-td>
                                <a v-bind:href="'/admin/orders/edit/' + item.id">
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
                            </b-td>
                        </b-tr>
                    </b-tbody>
                    <b-tfoot>
                        <b-tr>
                            <b-th colspan="10">
                                <a v-bind:href="'/admin/orders/'">
                                    <b-button variant="danger">Перейти ко всем заказам</b-button>
                                </a>
                            </b-th>
                        </b-tr>
                    </b-tfoot>
                </b-table-simple>
            </b-col>
        </b-row>

        <b-row class="my-3">
            <b-col>
                <h2>Последние клиенты</h2>
                <b-table-simple
                    responsive
                    striped
                    class="text-center"
                    hover>
                    <b-thead>
                        <b-tr>
                            <b-th>ID</b-th>
                            <b-th>Статус</b-th>
                            <b-th>Имя</b-th>
                            <b-th>Номер телефона</b-th>
                            <b-th>Кол-во покупок</b-th>
                            <b-th>Средний чек</b-th>
                            <b-th>Общий чек</b-th>
                            <b-th>Создан</b-th>
                            <b-th>Дата обновления</b-th>
                            <b-th>Действия</b-th>
                        </b-tr>
                    </b-thead>
                    <b-tbody>
                        <b-tr v-for="item in clients" :key="item.id">
                            <b-th>{{ item.id }}</b-th>
                            <b-th>{{ item.status }}</b-th>
                            <b-td>{{ item.name }}</b-td>
                            <b-td><a v-bind:href="'tel:' + item.phone">{{ item.phone }}</a></b-td>
                            <b-td>{{ item.number_of_purchases }}</b-td>
                            <b-td>{{ item.average_check | formatMoney }}</b-td>
                            <b-td>{{ item.whole_check | formatMoney }}</b-td>
                            <b-td>{{ item.created_at | moment("DD.MM.YYYY") }}</b-td>
                            <b-td>{{ item.updated_at | moment("DD.MM.YYYY") }}</b-td>
                            <b-td>
                                <a v-bind:href="'/admin/clients/edit/' + item.id">
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
                            </b-td>
                        </b-tr>
                    </b-tbody>
                    <b-tfoot>
                        <b-tr>
                            <b-th colspan="10">
                                <a v-bind:href="'/admin/clients/'">
                                    <b-button variant="danger">Перейти ко всем клиентам</b-button>
                                </a>
                            </b-th>
                        </b-tr>
                    </b-tfoot>
                </b-table-simple>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data() {
        return {
            clients: [],
            orders: [],
            dailyStatistics: [],
            timeNow: '',
            ordersToday: '',
        }
    },
    created() {
        setInterval(this.getTimeNow, 1000);
    },
    mounted() {
        axios.get("/api/dashboard/")
            .then(({data}) => this.getDashboardSuccessResponse(data))
            .catch((response) => this.getDashboardErrorResponse(response));

        axios.get("/api/clients/")
            .then(({data}) => this.getClientsListSuccessResponse(data))
            .catch((response) => this.getClientsListErrorResponse(response));

        axios.get("/api/orders/")
            .then(({data}) => this.getOrdersListSuccessResponse(data))
            .catch((response) => this.getOrdersListErrorResponse(response));

        axios.get("/api/bookkeeping/daily-statistics")
            .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
            .catch((response) => this.getDailyStatisticsErrorResponse(response));
    },
    methods: {
        getDashboardSuccessResponse(data) {
            this.ordersToday = data.ordersToday;
        },
        getDashboardErrorResponse(response) {
            console.log(response);
        },

        getClientsListSuccessResponse(data) {
            this.clients = data.result.data;
        },
        getClientsListErrorResponse(response) {
            console.log(response);
        },

        getOrdersListSuccessResponse(data) {
            this.orders = data.result.data;
        },
        getOrdersListErrorResponse(response) {
            console.log(response);
        },

        getDailyStatisticsSuccessResponse(data) {
            this.dailyStatistics = data.result.data;
        },
        getDailyStatisticsErrorResponse(response) {
            console.log(response);
        },

        getTimeNow: function () {
            const today = new Date();
            const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            this.timeNow = time;
        }
    }
}
</script>
