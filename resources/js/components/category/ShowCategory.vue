<template>
    <div>
        <section class="product-list card">
            <div class="product-list__title">{{ category.title }}</div>
            <loader v-if="isLoading"></loader>
            <div class="row justify-content-center" v-if="!isLoading">
                <div v-for="product in products"
                     v-if="product.published === 1"
                     class="card__product text-decoration-none my-3"
                >
                    <a v-bind:href="host + '/product/' + product.id">

                        <div class="card__image">
                            <img :src="host + '/' + product.preview" :alt="product.h1" style="object-fit: cover;">
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
            <div class="row">
                <div class="col">
                    <paginate
                        :page-count="pageCount"
                        :page-range="3"
                        :margin-pages="2"
                        :click-handler="fetch"
                        :prev-text="'<'"
                        :next-text="'>'"
                        :container-class="'pagination justify-content-center'"
                        :page-link-class="'page-link'"
                        :prev-link-class="'page-link'"
                        :next-link-class="'page-link'"
                        :page-class="'page-item'">
                    </paginate>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            category: '',
            products: [],
            isLoading: false,
            host: window.location.origin,
            pageCount: 1,
            showingFrom: 1,
            showingTo: 1,
            total: 1,
            endpoint: `/api/category/products/?page=`
        }
    },
    mounted() {
        let str = window.location.pathname;
        let n = str.lastIndexOf('/');
        let slug = str.substring(n + 1);

        this.isLoading = true;
        this.endpoint = `/api/category/products/${slug}?page=`;

        axios.get('/api/category/' + slug)
            .then(({data}) => this.getCategorySuccessResponse(data))
            .catch((response) => this.getCategoryErrorResponse(response));

        axios.get('/api/category/products/' + slug)
            .then(({data}) => this.getCategoryProductSuccessResponse(data))
            .catch((response) => this.getCategoryProductErrorResponse(response));
    },
    methods: {
        getCategorySuccessResponse(data) {
            this.category = data.result;
            this.isLoading = false;
        },
        getCategoryErrorResponse(response) {
            this.isLoading = false;
            console.log(response);
        },
        getCategoryProductSuccessResponse(data) {
            this.isLoading = false;
            this.products = data.result.data;
            this.total = data.result.total;
            this.showingFrom = data.result.from;
            this.showingTo = data.result.to;
            this.pageCount = data.result.last_page;
        },
        getCategoryProductErrorResponse(response) {
            this.isLoading = false;
            console.log(response);
        },
        fetch(page = 1) {
            this.isLoading = true;
            axios.get(this.endpoint + page)
                .then(({data}) => {
                    this.isLoading = false;
                    this.products = data.result.data;
                    this.total = data.result.total;
                    this.showingFrom = data.result.from;
                    this.showingTo = data.result.to;
                    this.pageCount = data.result.last_page;
                });
        },
    }
}
</script>
