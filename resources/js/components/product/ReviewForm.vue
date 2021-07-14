<template>
    <div>
        <div>
            <div class="button-wrapper">
                <b-button
                    v-b-modal="'modal-review'"
                    id="review"
                    class="shop__button review-button button button--color_red button--color-text_white"
                    variant="danger">
                    <span class="icon-file-text2"></span>
                    <span>Оставить отзыв</span>
                </b-button>
            </div>


            <b-modal
                id="modal-review"
                ref="modal-review"
                title="Оставить отзыв"
                class="form review-form"
                centered
                hide-footer>
                <loader v-if="isLoading"></loader>
                <b-form id="review-form" class="form review-form" v-if="!isLoading">
                    <b-row>
                        <b-form-group class="mb-1">
                            <b-form-input type="text"
                                          class="form-control"
                                          placeholder="Ваше имя"
                                          v-model="review.name"
                                          aria-describedby="input-name-live-feedback">
                            </b-form-input>
                            <span
                                v-if="errors.name"
                                class="has-error text-danger">
                                Введите Ваше имя.
                            </span>
                        </b-form-group>

                        <b-form-group>
                            <b-form-textarea class="form-control"
                                             name="comment"
                                             rows="6"
                                             placeholder="Ваш отзыв"
                                             v-model="review.comment"
                                             aria-describedby="input-comment-live-feedback">
                            </b-form-textarea>
                            <span
                                v-if="errors.comment"
                                class="has-error text-danger">
                                Комментарий должен содержать не менее 10-и символов.
                            </span>

                            <b-row class="justify-content-center mt-2">
                                <b-button type="submit"
                                          variant="danger"
                                          class="w-50 review-form__button review-button-modal button button--color_red button--color-text_white"
                                          v-on:click.prevent="sendReview">
                                    <span class="icon-arrow-right2"></span>
                                    <span>Оставить отзыв</span>
                                </b-button>
                            </b-row>
                        </b-form-group>
                    </b-row>
                </b-form>
            </b-modal>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            isLoading: false,
            review: {
                product_id: null,
                name: null,
                comment: null,
            }
        }
    },
    mounted() {
        let str = window.location.pathname;
        let n = str.lastIndexOf('/');
        this.review.product_id = str.substring(n + 1);
    },
    methods: {
        sendReview() {
            this.isLoading = true;
            axios.post('/send-review/', this.review)
                .then(({data}) => this.setSuccessResponse(data))
                .catch(({response}) => this.setErrorResponse(response));
        },
        setSuccessResponse() {
            this.review.name = null;
            this.review.comment = null;
            this.isLoading = false;
            this.$refs['modal-review'].hide();
            swal({
                title: 'Отправлено!',
                text: 'Ваш комментарий отправлен на модерацию :)',
                icon: 'success',
            });
        },
        setErrorResponse(response) {
            this.errors = response.data;
            this.isLoading = false;
            console.log(response);
        }
    }
}
</script>
