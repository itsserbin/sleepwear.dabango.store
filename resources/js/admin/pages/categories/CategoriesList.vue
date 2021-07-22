<template>
    <div>
        <loader v-if="isLoading"></loader>
        <b-container v-if="!isLoading">
            <b-row>
                <b-col>
                    <b-button
                        v-if="categories != 0"
                        @click="createCategory">
                        Создать категорию
                    </b-button>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-table-simple
                        responsive
                        striped
                        class="text-center"
                        hover
                        v-if="categories">
                        <b-thead>
                            <b-tr>
                                <b-th>ID</b-th>
                                <b-th>Название</b-th>
                                <b-th>Статус публикации</b-th>
                                <b-th>Родительская категория</b-th>
                                <b-th>Дата создания</b-th>
                                <b-th>Дата обновления</b-th>
                                <b-th>Действия</b-th>
                            </b-tr>
                        </b-thead>
                        <b-tbody>
                            <b-tr v-if="categories < 1">
                                <b-td colspan="7">
                                    <div class="row justify-content-center">
                                        <div class="h2">Данные отсутствуют</div>
                                        <div class="h5">Категории еще не созданы</div>
                                        <b-button
                                            @click="createCategory"
                                            variant="primary"
                                            class="w-25">Создать
                                        </b-button>
                                    </div>
                                </b-td>
                            </b-tr>
                            <b-tr v-for="item in categories" :key="item.id">
                                <b-th>{{ item.id }}</b-th>
                                <b-th>{{ item.title }}</b-th>
                                <b-td>{{ publishedStatus(item.published) }}</b-td>
                                <b-td>{{ item.parent_id ? item.parent_id : '-' }}</b-td>
                                <b-td>{{ item.created_at | moment("DD.MM.YYYY") }}</b-td>
                                <b-td>{{ item.updated_at | moment("DD.MM.YYYY") }}</b-td>
                                <b-td>
                                    <a v-bind:href="'/admin/categories/edit/' + item.id">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                             class="bi bi-pen"
                                             fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                                            <path fill-rule="evenodd"
                                                  d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                                            <path
                                                d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                                        </svg>
                                    </a>
                                    <a href="javascript:;" v-on:click="onDelete(item.id)">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                             class="bi bi-trash-fill"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                        </svg>
                                    </a>
                                </b-td>
                            </b-tr>
                        </b-tbody>
                        <b-tfoot>
                            <b-tr>
                                <b-th colspan="10">
                                    <paginate
                                        :page-count="pageCount"
                                        :page-range="3"
                                        :margin-pages="2"
                                        :click-handler="fetch"
                                        :prev-text="'<'"
                                        :next-text="'>'"
                                        :container-class="'pagination justify-content-start'"
                                        :page-link-class="'page-link'"
                                        :prev-link-class="'page-link'"
                                        :next-link-class="'page-link'"
                                        :page-class="'page-item'">
                                    </paginate>
                                </b-th>
                            </b-tr>
                        </b-tfoot>
                    </b-table-simple>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            pageCount: 1,
            showingFrom: 1,
            showingTo: 1,
            total: 1,
            endpoint: '/api/categories?page=',
            isLoading: false,
        }
    },
    mounted() {

        this.isLoading = true;
        axios.get('/api/categories/')
            .then(({data}) => this.getCategoriesListSuccessResponse(data))
            .catch((response) => this.getCategoriesListErrorResponse(response));
    },
    methods: {
        getCategoriesListSuccessResponse(data) {
            this.categories = data.result.data ? data.result.data : null;
            this.total = data.result.total;
            this.showingFrom = data.result.from;
            this.showingTo = data.result.to;
            this.pageCount = data.result.last_page;
            this.isLoading = false;
        },
        getCategoriesListErrorResponse(response) {
            console.log(response);
            this.isLoading = false;
        },
        fetch(page = 1) {
            this.isLoading = true;
            axios.get(this.endpoint + page)
                .then(({data}) => {
                    this.categories = data.result.data;
                    this.total = data.result.total;
                    this.showingFrom = data.result.from;
                    this.showingTo = data.result.to;
                    this.pageCount = data.result.last_page;
                    this.isLoading = false;
                });
        },
        onDelete(id) {
            if (confirm('Вы точно хотите удалить категорию?')) {
                axios.delete('/api/categories/destroy/' + id)
                    .then(() => this.fetch(1))
            }
        },
        createCategory() {
            window.location.href = '/admin/categories/create';
        },
        publishedStatus(status) {
            switch (status) {
                case 0:
                    return 'Не опубликован';
                case 1:
                    return 'Опубликован';
            }
        },
    },
}
</script>
