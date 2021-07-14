<template>
    <div>
        <div class="row">
            <div class="col-12">
                <b-button
                    v-b-modal="'modal-order'"
                    class="shop__button order-button button button--color_red button--color-text_white"
                    variant="danger">
                    <span class="icon-cart"></span>
                    <span>Купить</span>
                </b-button>

                <b-modal id="modal-order"
                         title="Добавление товара к заказу"
                         centered
                         hide-footer>
                    <b-form class="p-3 text-center">
                        <div class="row">
                            <div class="available-sizes">
                                <label class="w-100 mb-2">Выберите размер:</label>
                                <div class="d-flex justify-content-center w-100">
                                    <div v-if="product.xs !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="xs" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">XS</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>
                                    </div>

                                    <div v-if="product.s !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="s" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">S</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>
                                    </div>

                                    <div v-if="product.m !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="m" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">M</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>
                                    </div>

                                    <div v-if="product.l !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="l" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">L</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>
                                    </div>

                                    <div v-if="product.xl !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="xl" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">XL</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>
                                    </div>

                                    <div v-if="product.xxl !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="xxl" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">XXL</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>

                                    </div>

                                    <div v-if="product.xxxl !== null" class="size__element me-1 mb-2">
                                        <label class="mycheckbox">
                                            <input name="sizes[]" value="xxxl" class="mycheckbox__default"
                                                   type="checkbox" v-model="item.size">
                                            <span class="mycheckbox__new">XXXL</span>
                                            <span class="mycheckbox__descr"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="available-colors">
                                <div class="available-colors__label w-100 mb-2">Доступные цвета:</div>
                                <div class="d-flex justify-content-center w-100">
                                    <div v-for="color in productColors" :key="color.id">
                                        <label class="mycheckbox" :style="'background-color:' + color.colors.hex ">
                                            <input
                                                class="mycheckbox__default"
                                                type="checkbox"
                                                :value="color.colors.name"
                                                v-model="item.color">
                                            <span class="mycheckbox__new"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-4">
                            <div class="col-4">
                                <b-button
                                    v-on:click.prevent="buyNow"
                                    variant="outline-success">
                                    Заказать сейчас
                                </b-button>
                            </div>
                            <div class="col-4">
                                <b-button
                                    v-on:click.prevent="addToCart"
                                    variant="outline-warning">
                                    Хочу еще выбрать
                                </b-button>
                            </div>
                        </div>
                    </b-form>
                </b-modal>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            item: {
                count: 1,
                size: [],
                color: [],
                item_id: null,
            },
            product: [],
            productColors: [],
            order: {
                sizes: [],
                colors: [],
                name: '',
                phone: '',
                city: '',
                postal_office: '',
                product_id: '',
                sale_price: '',
            },
            cart: this.$store.state,
        };
    },
    mounted() {
        let str = window.location.pathname;
        let n = str.lastIndexOf('/');
        let id = str.substring(n + 1);

        this.item.item_id = id;
        this.order.product_id = id;
        this.order.sale_price = this.product.discount_price;

        axios.get('/api/product/show/' + id)
            .then(({data}) => {
                    this.product = data.result;
                    this.order.sale_price = data.result.discount_price ? data.result.discount_price : data.result.price;
                }
            )
            .catch(({response}) => console.log(response));

        axios.get('/api/product/colors/' + id)
            .then(({data}) => this.productColors = data.result)
            .catch(({response}) => console.log(response));
    },
    methods: {
        onIncrement() {
            this.item.count++;
        },
        onDecrement() {
            if (this.item.count > 1) {
                this.item.count--;
            }
        },
        buyNow() {
            axios.post('/api/cart/add', this.item)
                .then(({data}) => window.location.href = '/checkout')
                .catch(({response}) => this.setErrorResponse(response));
        },
        addToCart() {
            axios.post('/api/cart/add', this.item)
                .then(() => this.setSuccessResponse())
                .catch(() => this.setErrorResponse());
        },
        setSuccessResponse() {
            this.$store.commit('loadCart')
            swal({
                title: 'Добавлено!',
                text: 'Товар в корзине :)',
                icon: 'success',
            });
        },
        setErrorResponse() {
            swal({
                title: 'Ошибка!',
                text: 'Что то сломалось :(',
                icon: 'error',
            });
        }
    }
}
</script>
