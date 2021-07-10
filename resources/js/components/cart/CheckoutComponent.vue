<template>
    <div>
        <b-row>
            <b-col cols="12" md="6" class="mb-3">
                <div class="order-card border rounded m-2 " v-for="item in cart.list" :key="item.id">
                    <div class="d-flex">
                        <div class="order-img w-25 d-flex">
                            <img class="w-100" v-bind:alt="item.name"
                                 :src="item.image.length > 1 ? item.image : '/images/no-image.png'"
                                 style="object-fit: cover;">
                        </div>
                        <div class="order-content d-flex flex-column p-3 w-100">
                            <div class="h5">
                                <a v-bind:href="item.alias" class="text-dark text-decoration-none"
                                   target="_blank">{{ item.name }}</a>
                            </div>
                            <div>Цвет: <span v-for="color in item.color">{{ color }}</span></div>
                            <div>Размер: <span v-for="size in item.size">{{ size }}</span></div>
                            <div>Цена: ₴ {{ item.price }}</div>
                            <div>Кол-во: {{ item.count }}</div>
                            <div>Итого: ₴ {{ item.price * item.count }}</div>
                        </div>
                        <div class="d-flex">
                            <b-button type="button" variant="link" size="sm"
                                      @click.prevent="removeFromCart(item.id)"
                                      title="Удалить товар">
                                <b-icon icon="trash" aria-hidden="true" font-scale="1"></b-icon>
                            </b-button>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th colspan="2">Итого</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Товаров</td>
                        <td>{{ cart.totalCount }}</td>
                    </tr>
                    <tr>
                        <td><b>К оплате</b></td>
                        <td><b>₴ {{ cart.totalPrice }}</b></td>
                    </tr>
                    </tbody>
                </table>
            </b-col>
            <b-col cols="12" md="6" class="mb-3">
                <b-form @submit.stop.prevent="sendOrder">
                    <div class="h3">Контактные данные</div>
                    <b-form-group class="mb-3">
                        <label>ФИО</label>
                        <b-form-input
                            v-model="order.name"
                            placeholder="Введите свое ФИО"
                            aria-describedby="input-name-live-feedback"
                        >
                        </b-form-input>

                        <span v-if="errors.name" class="has-error text-danger">Введите Ваше ФИО</span>
                    </b-form-group>

                    <b-form-group class="mb-3">
                        <label>Телефон</label>
                        <b-form-input
                            v-model="order.phone"
                            class="input-phone"
                            placeholder="Введите свой телефон"
                            aria-describedby="input-phone-live-feedback"
                        ></b-form-input>

                        <span v-if="errors.phone" class="has-error text-danger">Введите Ваш телефон</span>
                    </b-form-group>

                    <b-form-group class="mb-3">
                        <label>Город</label>
                        <b-form-input
                            v-model="order.city"
                            placeholder="Введите город доставки"
                            aria-describedby="input-city-live-feedback"
                        ></b-form-input>

                        <span v-if="errors.city" class="has-error text-danger">Укажите город доставки</span>

                    </b-form-group>

                    <b-form-group class="mb-3">
                        <label>Отделение НоваПошта</label>
                        <b-form-input
                            v-model="order.postal_office"
                            placeholder="Введите номер отделение НоваПошта"
                            aria-describedby="input-postal_office-live-feedback"
                        ></b-form-input>

                        <span v-if="errors.postal_office"
                              class="has-error text-danger">Укажите отделение НоваПошта</span>
                    </b-form-group>
                    <b-row class="justify-content-center justify-content-md-end mb-5 text-center text-md-between">
                        <b-col cols="6">
                            <b-button
                                type="button"
                                v-on:click="goHomePage"
                                variant="outline-primary"
                                size="lg"
                                class="h-100 w-75">
                                Продолжить покупки
                            </b-button>
                        </b-col>

                        <b-col cols="6">
                            <b-button
                                type="submit"
                                variant="outline-success"
                                size="lg"
                                class="h-100 w-75">
                                Оформить заказ
                            </b-button>
                        </b-col>
                    </b-row>
                </b-form>

            </b-col>

        </b-row>
    </div>

</template>

<script>
export default {
    data() {
        return {
            host: window.location.origin + '/',
            cart: this.$store.state,
            errors: [],
            order: {
                name: null,
                phone: null,
                city: null,
                postal_office: null,
            }
        }
    },
    mounted() {
        this.$store.commit('loadCart');
    },
    methods: {

        removeFromCart(id) {
            axios.delete('/api/cart/delete/' + id)
                .then(() => this.deleteCartListSuccessResponse())
                .catch((response) => this.deleteCartListErrorResponse(response));
        },
        deleteCartListSuccessResponse() {
            this.$store.commit('loadCart');
        },
        deleteCartListErrorResponse(response) {
            console.log(response);
        },
        sendOrder() {
            axios.post('/api/order/create', this.order)
                .then(() => this.sendFormSuccessResponse())
                .catch(({response}) => this.sendFormErrorResponse(response));
        },
        sendFormSuccessResponse() {
            swal({
                title: 'Отправлено!',
                text: 'Ваша заявка отправлена :)',
                icon: 'success',
            });
            window.location.href = '/send-form';
        },
        sendFormErrorResponse(response) {
            this.errors = response.data;
            console.log(response)
        },
        goHomePage() {
            window.location.href = window.location.origin;
        }
    }
}
</script>
