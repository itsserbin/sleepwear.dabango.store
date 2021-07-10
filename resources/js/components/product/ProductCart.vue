<template>
    <div>
        <div class="row justify-content-center">

            <a v-for="product in products"
               v-if="product.published === 1"
               v-bind:href="host + '/product/' + product.id"
               class="card__product text-decoration-none my-3">

                <div class="card__image">
                    <img :src="host + '/' + product.preview" alt="">
                </div>

                <div class="card__body">
                    <h5 class="card__label">{{ product.h1 }}</h5>
                    <div class="card__price">
                        <div v-if="product.discount_price === null"
                             class="card__price-without-discount">{{ product.price }}
                        </div>

                        <div v-if="product.discount_price > null">
                            <div class="card__old-price">{{ product.price }}</div>
                            <div class="card__actual-price">{{ product.discount_price }}</div>
                        </div>


                    </div>
                    <span class="card__button">Подробнее</span>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            host: window.location.origin,
            products: [],
        }
    },
    mounted() {
        axios.get('/api/product/')
            .then(({data}) => this.deleteCartListSuccessResponse(data))
            .catch((response) => this.deleteCartListErrorResponse(response));
    },
    methods: {
        deleteCartListSuccessResponse(data) {
            this.products = data.result.data;
        },
        deleteCartListErrorResponse(response) {
            console.log(response);
        },
    }
}
</script>
