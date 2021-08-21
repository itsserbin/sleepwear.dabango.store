<template>
    <b-container>
        <b-row>
            <b-col>
                <a v-bind:href="'/admin/bookkeeping/daily-statistics/create/'">
                    <b-button variant="danger">
                        <b>Добавить день</b>
                    </b-button>
                </a>

            </b-col>
            <b-col>
                <b-form v-on:submit.prevent="searchByRange" class="d-flex">

                    <VueDatePicker
                        v-model="date"
                        format="YYYY-MM-DD"
                        placeholder="Введите дату"
                        range/>

                    <b-input-group-append>
                        <b-button type="submit" variant="danger">Поиск</b-button>
                    </b-input-group-append>
                </b-form>
            </b-col>
        </b-row>

        <b-row class="my-3">
            <b-col>
                <b-button v-on:click.prevent="showAllStatistics" variant="outline-warning">
                    За все время
                </b-button>
            </b-col>

            <b-col>
                <b-button v-on:click.prevent="showStatisticsFor7Days" variant="outline-warning">
                    За 7 дней
                </b-button>
            </b-col>

            <b-col>
                <b-button v-on:click.prevent="showStatisticsFor14Days" variant="outline-warning">
                    За 14 дней
                </b-button>
            </b-col>

            <b-col>
                <b-button v-on:click.prevent="showStatisticsFor30Days" variant="outline-warning">
                    За 30 дней
                </b-button>
            </b-col>
        </b-row>

        <b-row class="align-items-center">
            <hr>
            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Получено заявок:
                </div>
                <div class="h6">
                    {{ SumApplications }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    На почте:
                </div>
                <div class="h6">
                    {{ SumAtThePostOffice }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Средний COR:
                </div>
                <div class="h6">
                    {{ AverageCorRate | formatPercent }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Средний ROR:
                </div>
                <div class="h6">
                    {{ AverageRorRate | formatPercent }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Средний RPR:
                </div>
                <div class="h6">
                    {{ AverageRprRate | formatPercent }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Средняя цена заявки:
                </div>
                <div class="h6">
                    {{ AverageApplicationPrice | formatMoney }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Средняя стоимость клиента:
                </div>
                <div class="h6">
                    {{ AverageClientCostRate | formatMoney }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Общая прибыль:
                </div>
                <div class="h6">
                    {{ SumProfit | formatMoney }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Затраты на рекламу:
                </div>
                <div class="h6">
                    {{ SumTargetCosts | formatMoney }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Средняя маржа:
                </div>
                <div class="h6">
                    {{ AverageMarginality | formatPercent }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Прибыль инвестора:
                </div>
                <div class="h6">
                    {{ SumInvestorProfit | formatMoney }}
                </div>
            </b-col>

            <b-col class="col-6 col-md-3 text-center my-3">
                <div class="h5">
                    Зарплата менеджера:
                </div>
                <div class="h6">
                    {{ SumManagerSalary | formatMoney }}
                </div>
            </b-col>
            <hr>
        </b-row>

        <b-row>
            <b-col>
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
                                          title="Количество заявок ожидающих отправки">
                                    <b>Ожидают отправки</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество заявок ожидающих предоплаты">
                                    <b>Ожидают предоплаты</b>
                                </b-button>
                            </b-th>

                            <b-th>
                                <b-button v-b-tooltip.hover variant="btn"
                                          title="Количество заявок в дороге">
                                    <b>В дороге</b>
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
                            <b-td>{{ item.awaiting_dispatch }}</b-td>
                            <b-td>{{ item.awaiting_prepayment }}</b-td>
                            <b-td>{{ item.on_the_road }}</b-td>
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
                <b-row>
                    <b-col>
                        Показано {{ showingFrom }}-{{ showingTo }} / {{ total }} Записей
                    </b-col>
                    <b-col>
                        <paginate
                            :page-count="pageCount"
                            :page-range="3"
                            :margin-pages="2"
                            :click-handler="fetch"
                            :prev-text="'<'"
                            :next-text="'>'"
                            :container-class="'pagination justify-content-end'"
                            :page-link-class="'page-link'"
                            :prev-link-class="'page-link'"
                            :next-link-class="'page-link'"
                            :page-class="'page-item'">
                        </paginate>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data() {
        return {
            dailyStatistics: [],
            pageCount: 1,
            showingFrom: 1,
            showingTo: 1,
            total: 1,
            endpoint: '/api/bookkeeping/daily-statistics?page=',
            SumApplications: 1,
            SumAtThePostOffice: 1,
            AverageCorRate: 1,
            AverageRorRate: 1,
            AverageRprRate: 1,
            AverageApplicationPrice: 1,
            AverageClientCostRate: 1,
            SumProfit: 1,
            SumTargetCosts: 1,
            AverageMarginality: 1,
            SumInvestorProfit: 1,
            SumManagerSalary: 1,
            date: new Date(),
            currentDate: new Date(),
        }
    },
    mounted() {
        axios.get("/api/bookkeeping/daily-statistics")
            .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
            .catch((response) => this.getDailyStatisticsErrorResponse(response));
    },
    computed: {
        minDate() {
            return new Date(
                this.currentDate.getFullYear() - 1,
                this.currentDate.getMonth(),
                this.currentDate.getDate()
            );
        },
        maxDate() {
            return new Date(
                this.currentDate.getFullYear() + 1,
                this.currentDate.getMonth(),
                this.currentDate.getDate(),
            );
        },
    },
    methods: {
        showAllStatistics() {
            axios.get("/api/bookkeeping/daily-statistics")
                .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
                .catch((response) => this.getDailyStatisticsErrorResponse(response));
        },
        showStatisticsFor7Days() {
            axios.get("/api/bookkeeping/daily-statistics/?days=7")
                .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
                .catch((response) => this.getDailyStatisticsErrorResponse(response));
        },
        showStatisticsFor14Days() {
            axios.get("/api/bookkeeping/daily-statistics/?days=14")
                .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
                .catch((response) => this.getDailyStatisticsErrorResponse(response));
        },
        showStatisticsFor30Days() {
            axios.get("/api/bookkeeping/daily-statistics/?days=30")
                .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
                .catch((response) => this.getDailyStatisticsErrorResponse(response));
        },
        getDailyStatisticsSuccessResponse(data) {
            this.dailyStatistics = data.result.data;
            this.SumApplications = data.SumApplications;
            this.SumAtThePostOffice = data.SumAtThePostOffice;
            this.AverageCorRate = data.AverageCorRate;
            this.AverageRorRate = data.AverageRorRate;
            this.AverageRprRate = data.AverageRprRate;
            this.AverageApplicationPrice = data.AverageApplicationPrice;
            this.AverageClientCostRate = data.AverageClientCostRate;
            this.SumProfit = data.SumProfit;
            this.SumTargetCosts = data.SumTargetCosts;
            this.AverageMarginality = data.AverageMarginality;
            this.SumInvestorProfit = data.SumInvestorProfit;
            this.SumManagerSalary = data.SumManagerSalary;

            this.total = data.result.total;
            this.showingFrom = data.result.from;
            this.showingTo = data.result.to;
            this.pageCount = data.result.last_page;
        },
        getDailyStatisticsErrorResponse(response) {
            console.log(response);
        },
        fetch(page = 1) {
            axios.get(this.endpoint + page)
                .then(({data}) => {
                    this.dailyStatistics = data.result.data;
                    this.total = data.result.total;
                    this.showingFrom = data.result.from;
                    this.showingTo = data.result.to;
                    this.pageCount = data.result.last_page;
                });
        },
        searchByRange() {
            axios.get("/api/bookkeeping/daily-statistics/date-range/", {
                params: {
                    date_start: this.date.start,
                    date_end: this.date.end
                }
            })
                .then(({data}) => this.getDailyStatisticsSuccessResponse(data))
                .catch((response) => this.getDailyStatisticsErrorResponse(response));
        },
    }
}
</script>
