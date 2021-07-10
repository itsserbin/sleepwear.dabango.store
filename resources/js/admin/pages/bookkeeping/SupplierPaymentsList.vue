<template>
    <div>
        <b-container>
            <div>
                <b-button variant="outline-warning" v-on:click="getAll">Все выплаты</b-button>
                <b-button variant="outline-warning" v-on:click="getPaymentsAwaiting">Ожидающие</b-button>
                <b-button variant="outline-warning" v-on:click="getPaymentsReceived">Полученные</b-button>
            </div>
            <b-row>
                <b-col>
                    <b-table-simple
                        responsive
                        striped
                        class="text-center"
                        hover>
                        <b-thead>
                            <b-tr>
                                <b-th>Товар</b-th>
                                <b-th>Поставщик</b-th>
                                <b-th>Выплата</b-th>
                                <b-th>Сумма</b-th>
                                <b-th>Действия</b-th>
                            </b-tr>
                        </b-thead>
                        <b-tbody>
                            <b-tr v-for="item in supplierPayments" :key="item.id">
                                <b-td>{{ item.product_h1 }}</b-td>
                                <b-td>{{ item.provider_name }}</b-td>
                                <b-td>{{ getPaymentStatus(item.pay) }}</b-td>
                                <b-td>{{ item.profit }}</b-td>
                                <b-td>
                                    <b-button
                                        variant="link"
                                        type="submit"
                                        v-on:click.prevent="setStatusTrue(item.id)">
                                        <b-icon icon="check-square" font-scale="1"></b-icon>
                                    </b-button>

                                    <b-button
                                        variant="link"
                                        type="submit"
                                        v-on:click.prevent="setStatusFalse(item.id)">
                                        <b-icon icon="x-circle" font-scale="1"></b-icon>
                                    </b-button>
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            supplierPayments: [],
            pageCount: 1,
            showingFrom: 1,
            showingTo: 1,
            total: 1,
            endpoint: '/api/bookkeeping/supplier-payments?page='
        }
    },
    mounted() {
        this.getAll();
    },
    methods: {
        getAll(){
            axios.get('/api/bookkeeping/supplier-payments/')
                .then(({data}) => this.getSupplierPaymentsSuccessResponse(data))
                .catch((response) => this.getSupplierPaymentsErrorResponse(response));
        },
        getPaymentsAwaiting(){
            axios.get('/api/bookkeeping/supplier-payments/payments-awaiting/')
                .then(({data}) => this.getSupplierPaymentsSuccessResponse(data))
                .catch((response) => this.getSupplierPaymentsErrorResponse(response));
        },
        getPaymentsReceived(){
            axios.get('/api/bookkeeping/supplier-payments/payments-received/')
                .then(({data}) => this.getSupplierPaymentsSuccessResponse(data))
                .catch((response) => this.getSupplierPaymentsErrorResponse(response));
        },
        getSupplierPaymentsSuccessResponse(data) {
            this.supplierPayments = data.result.data;
            this.total = data.result.total;
            this.showingFrom = data.result.from;
            this.showingTo = data.result.to;
            this.pageCount = data.result.last_page;
        },
        getSupplierPaymentsErrorResponse(response) {
            console.log(response);
        },

        fetch(page = 1) {
            axios.get(this.endpoint + page)
                .then(({data}) => {
                    this.supplierPayments = data.result.data;
                    this.total = data.result.total;
                    this.showingFrom = data.result.from;
                    this.showingTo = data.result.to;
                    this.pageCount = data.result.last_page;
                });
        },

        getPaymentStatus(status) {
            switch (status) {
                case 0:
                    return 'Не получена';
                case 1:
                    return 'Получена';
            }
        },

        setStatusTrue(id) {
            axios.put('/api/order-items/update-pay-status/' + id, {pay: true})
                .then(() => this.fetch(1))
                .catch((response) => this.getSupplierPaymentsErrorResponse(response));
        },
        setStatusFalse(id) {
            axios.put('/api/order-items/update-pay-status/' + id, {pay: false})
                .then(() => this.fetch(1))
                .catch((response) => this.getSupplierPaymentsErrorResponse(response));
        }
    }
}
</script>
