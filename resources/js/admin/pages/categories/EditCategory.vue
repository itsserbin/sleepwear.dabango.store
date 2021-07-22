<template>
    <div>
        <b-container>
            <loader v-if="isLoading"></loader>
            <b-form v-if="!isLoading" @submit.stop.prevent="updateCategory(category.id)">
                <b-row>
                    <b-col md="4">
                        <b-form-group label="Название категории">
                            <b-form-input
                                type="text"
                                placeholder="Введите название категории"
                                v-model="category.title">
                            </b-form-input>
                            <span v-if="errors.title" class="has-error text-danger">Это обязательное поле</span>
                        </b-form-group>
                    </b-col>

                    <b-col md="4">
                        <b-form-group label="ЧПУ категории">
                            <b-form-input
                                type="text"
                                placeholder="Введите ЧПУ категории"
                                v-model="category.slug">
                            </b-form-input>
                            <span v-if="errors.slug" class="has-error text-danger">Это обязательное поле</span>
                        </b-form-group>
                    </b-col>

                    <b-col md="4">
                        <div class="d-flex justify-content-center align-items-center flex-column h-100 text-center"
                             v-if="category.preview !== null">
                            <label class="w-100">Главное изображение:</label>
                            <img :src="category.preview" class="img-fluid w-25" alt="...">
                            <div>
                                <button class="btn" v-on:click="deletePreview">
                                    <b-icon icon="x-circle" variant="danger"></b-icon>
                                </button>
                                <a class="btn" v-bind:href="category.preview" target="_blank">
                                    <b-icon icon="arrow-up-right-circle" variant="success"></b-icon>
                                </a>
                            </div>
                        </div>
                        <div v-if="category.preview === null">
                            <b-form-group label="Главное изображение:" label-for="preview">
                                <b-form-file
                                    @click="$refs.preview.click()"
                                    v-on:change="uploadPreview"
                                    ref="preview"
                                    name="preview"
                                    id="preview"
                                ></b-form-file>
                            </b-form-group>
                        </div>
                    </b-col>
                </b-row>

                <b-row class="mt-3">
                    <b-col md="8">
                        <b-form-group label="Родительская категория">
                            <select class="form-select" v-model="category.parent_id">
                                <option :value="null" selected>Выберите родительскую категорию</option>
                                <option v-for="item in categories" :value="item.id">{{ item.title }}</option>
                            </select>
                            <span v-if="errors.parent_id" class="has-error text-danger">Это обязательное поле</span>
                        </b-form-group>
                    </b-col>

                    <b-col md="4">
                        <b-form-group label="Статус публикации">
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       v-model="category.published"
                                       type="checkbox"
                                       id="flexSwitchCheckDefault">
                                <label class="form-check-label"
                                       for="flexSwitchCheckDefault">
                                    {{ publishedStatus(category.published) }}</label>
                            </div>
                        </b-form-group>
                    </b-col>
                </b-row>

                <b-row class="mt-3">
                    <b-col cols="12">
                        <b-form-group label="META Title">
                            <b-form-input
                                type="text"
                                placeholder="Введите META Title"
                                v-model="category.meta_title">
                            </b-form-input>
                            <span v-if="errors.meta_title" class="has-error text-danger">Это обязательное поле</span>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" class="mt-3">
                        <b-form-group label="META Description">
                            <b-form-textarea
                                placeholder="Введите META Description"
                                v-model="category.meta_description">
                            </b-form-textarea>
                            <span v-if="errors.meta_description"
                                  class="has-error text-danger">Это обязательное поле</span>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" class="mt-3">
                        <b-form-group label="META Keywords">
                            <b-form-textarea
                                placeholder="Введите META Keywords"
                                v-model="category.meta_keyword">
                            </b-form-textarea>
                            <span v-if="errors.meta_keyword" class="has-error text-danger">Это обязательное поле</span>
                        </b-form-group>
                    </b-col>
                </b-row>

                <b-row class="mt-3">
                    <b-col cols="12" md="4">
                        <b-form-group label="Создано пользователем:">
                            <b-form-input
                                v-model="category.created_by"
                                disabled>
                            </b-form-input>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="4">
                        <b-form-group label="Обновлено пользователем:">
                            <b-form-input
                                v-model="category.modified_by"
                                disabled>
                            </b-form-input>
                        </b-form-group>
                    </b-col>
                </b-row>

                <b-button class="mt-3" type="submit">
                    Сохранить
                </b-button>
            </b-form>
        </b-container>
    </div>
</template>

<script>
export default {
    data() {
        return {
            category: [],
            categories: [],
            errors: [],
            isLoading: false,
        }
    },
    props: {
        userName: String,
    },
    mounted() {
        let str = window.location.pathname;
        let n = str.lastIndexOf('/');
        let id = str.substring(n + 1);

        this.isLoading = true;
        axios.get('/api/categories/edit/' + id)
            .then(({data}) => this.getCategorySuccessResponse(data))
            .catch((response) => this.getCategoryErrorResponse(response));

        axios.get('/api/categories/all')
            .then(({data}) => this.getAllCategoriesSuccessResponse(data))
            .catch((response) => this.getAllCategoriesErrorResponse(response));
    },
    methods: {
        getCategorySuccessResponse(data) {
            this.category = data.result;
            this.isLoading = false;
        },
        getCategoryErrorResponse(response) {
            console.log(response);
            this.isLoading = false;
        },
        getAllCategoriesSuccessResponse(data) {
            this.categories = data.result;
        },
        getAllCategoriesErrorResponse(response) {
            console.log(response);
        },
        publishedStatus(status) {
            switch (status) {
                case 0:
                    return 'Не опубликован';
                case 1:
                    return 'Опубликован';
                case false:
                    return 'Не опубликован';
                case true:
                    return 'Опубликован';
            }
        },
        updateCategory(id) {
            this.isLoading = true;
            axios.put('/api/categories/update/' + id, [this.category, {userName: this.userName}])
                .then(({data}) => this.getCategoryUpdateSuccessResponse(data))
                .catch((response) => this.getCategoryUpdateErrorResponse(response));
        },
        getCategoryUpdateSuccessResponse() {
            this.isLoading = false;
            swal({
                title: 'Обновлено!',
                text: 'Данные были успешно обновлены',
                icon: 'success',
            });
        },
        getCategoryUpdateErrorResponse(response) {
            this.isLoading = false;
            console.log(response);
            swal({
                title: 'Произошла ошибка :(',
                text: 'Проверьте корректность заполненных данных, или же обратитесь к администратору',
                icon: 'error',
            });
        },
        uploadPreview(event){
            let formData = new FormData();
            formData.append('preview', event.target.files[0]);
            formData.append('type', 'categories');
            axios.post('/api/images/preview-update/categories', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(({data}) => this.uploadCategoryPreviewSuccessResponse(data))
                .catch((response) => this.uploadCategoryPreviewErrorResponse(response));
        },
        uploadCategoryPreviewSuccessResponse(data) {
            if (data.success) {
                this.category.preview = data.url;
            }
        },
        uploadCategoryPreviewErrorResponse(response) {
            console.log(response);
        },
        deletePreview() {
            this.category.preview = null;
        },
    }
}
</script>

<style scoped>

</style>
