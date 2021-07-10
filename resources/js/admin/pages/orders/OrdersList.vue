<template>
    <b-container>
        <b-row>
            <b-form v-on:submit.prevent="searchOrders">
                <b-form-group label="Поиск" label-for="search-input" class="my-3">
                    <b-input-group>
                        <b-input-group-append>
                            <b-button v-on:click.prevent="clearSearch">Очистить</b-button>
                        </b-input-group-append>
                        <b-form-input
                            id="search-input"
                            type="search"
                            placeholder="Введите данные для поиска"
                            v-model="searchForm"
                            required
                        ></b-form-input>

                        <b-input-group-append>
                            <b-button type="submit">Поиск</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-form>
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
                    <b-tfoot>
                        <b-tr>
                            <b-th colspan="10">
                                <paginate
                                    :page-count="pageCount"
                                    :page-range="3"
                                    :margin-pages="2"
                                    :click-handler="fetch"
                                    :prev-text="'<'"
                                    :next-text="'>'"
                                    :container-class="'pagination justify-content-start'"
                                    :page-link-class="'page-link'"
                                    :prev-link-class="'page-link'"
                                    :next-link-class="'page-link'"
                                    :page-class="'page-item'">
                                </paginate>
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
            searchForm: '',
            orders: [],
            pageCount: 1,
            showingFrom: 1,
            showingTo: 1,
            total: 1,
            endpoint: '/api/orders?page='
        }
    },
    mounted() {
        axios.get("/api/orders/")
            .then(({data}) => this.getOrdersListSuccessResponse(data))
            .catch((response) => this.getOrdersListErrorResponse(response));
    },
    methods: {
        clearSearch() {
            document.getElementById("search-input").value = "";
            axios.get("/api/orders/")
                .then(({data}) => this.getOrdersListSuccessResponse(data))
                .catch((response) => this.getOrdersListErrorResponse(response));
        },
        getOrdersListSuccessResponse(data) {
            this.orders = data.result.data;
            this.total = data.result.total;
            this.showingFrom = data.result.from;
            this.showingTo = data.result.to;
            this.pageCount = data.result.last_page;
        },
        getOrdersListErrorResponse(response) {
            console.log(response);
        },
        fetch(page = 1) {
            axios.get(this.endpoint + page)
                .then(({data}) => {
                    this.orders = data.result.data;
                    this.total = data.result.total;
                    this.showingFrom = data.result.from;
                    this.showingTo = data.result.to;
                    this.pageCount = data.result.last_page;
                });
        },
        searchOrders() {
            axios.post("/api/orders/search/" + this.searchForm)
                .then(({data}) => this.getSearchResultListSuccessResponse(data))
                .catch((response) => this.getSearchResultListErrorResponse(response));
        },
        getSearchResultListSuccessResponse(data) {
            this.orders = data.result.data;
            this.total = data.result.total;
            this.showingFrom = data.result.from;
            this.showingTo = data.result.to;
            this.pageCount = data.result.last_page;
        },
        getSearchResultListErrorResponse(response) {
            console.log(response);
        },
        onDelete(id) {
            if (confirm('Вы точно хотите удалить заказ?')) {
                axios.delete('/api/orders/destroy/' + id)
                    .then(() => this.fetch(1))
            }
        },
    }
}
</script>
