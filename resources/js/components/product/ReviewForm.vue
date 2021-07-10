<template>
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
            title="Оставить отзыв"
            class="form review-form"
            centered
            hide-footer>
            <b-form id="review-form" class="form review-form">
                <b-row>
                    <b-form-group class="mb-1">
                        <b-form-input type="text"
                                      class="form-control"
                                      placeholder="Ваше имя"
                                      v-model="review.name"
                                      :state="validateState('name')"
                                      aria-describedby="input-name-live-feedback">
                        </b-form-input>
                        <b-form-invalid-feedback id="input-name-live-feedback">
                            Введите Ваше имя.
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group>
                        <b-form-textarea class="form-control"
                                         name="comment"
                                         rows="6"
                                         placeholder="Ваш отзыв"
                                         v-model="review.comment"
                                         :state="validateState('comment')"
                                         aria-describedby="input-comment-live-feedback">
                        </b-form-textarea>
                        <b-form-invalid-feedback id="input-comment-live-feedback">
                            Комментарий должен содержать не менее 10-и символов.
                        </b-form-invalid-feedback>

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
<!--            <form id="review-form" class="form review-form">-->
<!--                <div class="row">-->
<!--                    <div class="input-group mb-1">-->
<!--                        <input-->
<!--                            type="text"-->
<!--                            class="form-control"-->
<!--                            placeholder="Ваше имя"-->
<!--                            v-model="review.name"-->
<!--                            :state="validateState('name')"-->
<!--                            aria-describedby="input-name-live-feedback">-->
<!--                        <b-form-invalid-feedback id="input-name-live-feedback">-->
<!--                            Введите Ваше имя.-->
<!--                        </b-form-invalid-feedback>-->
<!--                    </div>-->

<!--                    <div class="input-group mb-2">-->
<!--                            <textarea-->
<!--                                class="form-control"-->
<!--                                name="comment"-->
<!--                                rows="6"-->
<!--                                minlength="8"-->
<!--                                maxlength="200"-->
<!--                                placeholder="Ваш отзыв"-->
<!--                                v-model="review.comment"-->
<!--                                :state="validateState('comment')"-->
<!--                                aria-describedby="input-comment-live-feedback">-->
<!--                            </textarea>-->
<!--                        <b-form-invalid-feedback id="input-comment-live-feedback">-->
<!--                            Комментарий должен содержать не менее 10-и символов.-->
<!--                        </b-form-invalid-feedback>-->
<!--                    </div>-->
<!--                    <div class="row justify-content-center">-->
<!--                        <button-->
<!--                            type="submit"-->
<!--                            class="w-50 review-form__button review-button-modal button button&#45;&#45;color_red button&#45;&#45;color-text_white"-->
<!--                            v-on:click.prevent="sendReview">-->
<!--                            <span class="icon-arrow-right2"></span>-->
<!--                            <span>Оставить отзыв</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
        </b-modal>
    </div>
</template>

<script>
import {validationMixin} from "vuelidate";
import {required, minLength} from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    data() {
        return {
            errors: [],
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
    validations: {
        form: {
            name: {
                required
            },
            comment: {
                required,
                minLength: minLength(10)
            },
        }
    },
    methods: {
        validateState(name) {
            const {$dirty, $error} = this.$v.form[name];
            return $dirty ? !$error : null;
        },

        sendReview() {
            this.$v.form.$touch();
            if (this.$v.form.$anyError) {
                return;
            }
            axios.post('/send-review/', this.review)
                .then(({data}) => this.setSuccessResponse(data))
                .catch(({response}) => this.setErrorResponse(response));
        },
        setSuccessResponse() {
            this.review.name = null;
            this.review.comment = null;
        },
        setErrorResponse(response) {
            console.log(response);
        }
    }
}
</script>
