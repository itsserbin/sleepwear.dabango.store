<template>

    <b-table-simple
        responsive
        class="text-center"
    >
        <b-thead>
            <b-tr>
                <b-th>Фото</b-th>
                <b-th>Название</b-th>
                <b-th>Цена</b-th>
                <b-th>Кол-во</b-th>
                <b-th>Итого</b-th>
                <b-th>Действие</b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <b-tr v-for="item in cart.list" :key="item.id" style="vertical-align: middle;">
                <b-td class="w-25">
                    <img class="w-25" :alt="item.name" :src="item.image.length > 1 ? item.image : '/images/no-image.png'">
                </b-td>
                <b-td><a v-bind:href="item.alias">{{ item.name }}</a></b-td>
                <b-td>₴ {{ item.price }}</b-td>
                <b-td>
                    <div class="d-flex">
                        <b-button type="button" variant="link" size="sm" v-on:click="onDecrement(item.count, item.id)"
                                  class="reduced items">
                            <b-icon icon="file-minus" aria-hidden="true" font-scale="1"></b-icon>
                        </b-button>

                        <input
                            type="text"
                            v-model="item.count"
                            class="input-text qty"
                            style="width: 10px;"
                            disabled>

                        <b-button type="button" variant="link" size="sm" v-on:click="onIncrement(item.count, item.id)"
                                  class="increase items">
                            <b-icon icon="file-plus" aria-hidden="true" font-scale="1"></b-icon>
                        </b-button>

                    </div>
                </b-td>
                <b-td>₴ {{ item.price * item.count }}</b-td>
                <b-td>
                    <b-button type="button" variant="link" size="sm" @click.prevent="removeFromCart(item.id)"
                              title="Удалить товар">
                        <b-icon icon="trash" aria-hidden="true" font-scale="1"></b-icon>
                    </b-button>
                </b-td>
            </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
export default {
    data() {
        return {
            cart: this.$store.state,
            item: {
                count: 1,
                item_id: null,
            }
        }
    },
    mounted() {
        this.$store.commit('loadCart');
    },
    methods: {
        cartListSuccessResponse(data) {
            this.$store.commit('loadCart')
        },
        cartListErrorResponse(response) {
            console.log(response);
        },
        onIncrement(item_count, item_id) {
            this.item.count = item_count + 1;
            this.item.item_id = item_id;
            axios.post("/api/cart/update", this.item)
                .then(() => this.cartListSuccessResponse())
                .catch((response) => this.cartListErrorResponse(response));
        },
        onDecrement(item_count, item_id) {
            if (item_count > 1) {
                this.item.count = item_count - 1;
                this.item.item_id = item_id;
                axios.post("/api/cart/update", this.item)
                    .then(() => this.cartListSuccessResponse())
                    .catch((response) => this.cartListErrorResponse(response));
            }
        },
        removeFromCart(id) {
            axios.delete("/api/cart/delete/" + id)
                .then(() => this.cartListSuccessResponse())
                .catch((response) => this.cartListErrorResponse(response));
        },
    }
}
</script>
