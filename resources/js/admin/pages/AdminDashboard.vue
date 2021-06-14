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
                            <b-th>ID товара</b-th>
                            <b-th>Название товара</b-th>
                            <b-th>Цена продажи</b-th>
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
                            <b-td>{{ item.product_id }}</b-td>
                            <b-td>{{ item.product.h1 }}</b-td>
                            <b-td>{{ item.sale_price | formatMoney }}</b-td>
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

        getTimeNow: function () {
            const today = new Date();
            const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            this.timeNow = time;
        }
    }
}
</script>
