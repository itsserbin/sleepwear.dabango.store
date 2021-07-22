<template>
    <div>
        <loader v-if="isLoading"></loader>
        <div class="row" v-if="categories != 0 && !isLoading">
            <div class="col-12 col-xs-6 col-md-3" v-for="item in categories" :key="item.id">
                <a v-bind:href="'/category/' + item.slug" class="card__product text-decoration-none my-3">
                    <div class="card__image">
                        <img :src="item.preview" alt="">
                    </div>

                    <div class="card__body h-75">
                        <div class="card__label d-flex align-items-center m-0">{{ item.title }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            isLoading: false,
        }
    },
    mounted() {
        this.isLoading = true;
        axios.get('/api/category/all-on-prod')
            .then(({data}) => this.getCategoriesProdSuccessResponse(data))
            .catch((response) => this.getCategoriesProdErrorResponse(response));
    },
    methods: {
        getCategoriesProdSuccessResponse(data) {
            this.categories = data.result;
            console.log(this.categories);
            this.isLoading = false;
        },
        getCategoriesProdErrorResponse(response) {
            this.isLoading = false;
            console.log(response);
        }
    }
}
</script>
