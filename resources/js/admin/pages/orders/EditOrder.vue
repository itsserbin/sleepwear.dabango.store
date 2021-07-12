<template>
    <div>
        <b-container>
            <b-row>
                <div class="col-12 col-md-3">
                    <div class="form-group my-3">
                        <label for="status">Статус клиента:</label>
                        <select class="form-control" id="status" name="status" v-model="order.status">
                            <option value="Новый">Новый</option>
                            <option value="В процессе">В процессе</option>
                            <option value="Передан поставщику">Передан поставщику</option>
                            <option value="На почте">На почте</option>
                            <option value="Отменен">Отменен</option>
                            <option value="Возврат">Возврат</option>
                            <option value="Выполнен">Выполнен</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group my-3">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="name" name="name"
                               v-model="order.name">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group my-3">
                        <label for="phone">Номер телефона</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               v-model="order.phone">
                    </div>
                </div>
            </b-row>

            <hr>

            <b-row>
                <div class="col-12 col-md-6">
                    <div class="form-group my-3">
                        <label for="city">Город</label>
                        <input type="text" class="form-control" id="city" name="city"
                               v-model="order.city">
                    </div>


                    <div class="form-group my-3">
                        <label for="postal_office">Номер почтового отеделения</label>
                        <input type="text" class="form-control" id="postal_office" name="postal_office"
                               v-model="order.postal_office">
                    </div>

                    <div class="form-group my-3">
                        <label for="waybill">Номер накладной</label>
                        <input type="text" class="form-control" id="waybill" name="waybill"
                               v-model="order.waybill">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group my-3">
                        <label for="comment">Комментарий</label>
                        <textarea rows="8"
                                  class="form-control"
                                  id="comment"
                                  name="comment"
                                  v-model="order.comment">
                        </textarea>
                    </div>
                </div>
            </b-row>

            <hr>

            <b-row class="mt-5 py-3 ">
                <div class="col-12 text-center" style="overflow-x: scroll;">
                    <b-row class="flex-nowrap justify-center align-items-center">
                        <b-col>
                            <div class="h6">Название</div>
                        </b-col>
                        <b-col>
                            <div class="h6">Фото</div>
                        </b-col>
                        <b-col>
                            <div class="h6">Количество</div>
                        </b-col>
                        <b-col>
                            <div class="h6">Цена</div>
                        </b-col>
                        <b-col>
                            <div class="h6">Цвет</div>
                        </b-col>
                        <b-col>
                            <div class="h6">Размер</div>
                        </b-col>
                        <b-col>
                            <div class="h6">Действия</div>
                        </b-col>
                    </b-row>
                    <hr>
                    <b-row v-for="item in items" :key="item.id" class=" my-2">
                        <b-card>
                            <b-row class="flex-nowrap justify-center align-items-center">
                                <b-col>
                                    <a v-bind:href="'/product/' + item.product_id"
                                       target="_blank">{{ item.product.h1 }}</a>
                                </b-col>
                                <b-col>
                                    <img :src="host + item.product.preview" :alt="item.product.h1" class="w-75">
                                </b-col>
                                <b-col>{{ item.count }}</b-col>
                                <b-col>{{ item.sale_price }}</b-col>
                                <b-col><span v-for="color in item.color">{{ color }}</span></b-col>
                                <b-col><span v-for="size in item.size">{{ size }}</span></b-col>
                                <b-col>
                                    <div class="d-flex justify-center align-items-center">
                                        <a v-b-toggle v-bind:href="'#example-collapse' + item.id"
                                           class="btn">
                                            <b-icon icon="three-dots" font-scale="1"></b-icon>
                                        </a>

                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                :data-bs-target="'#staticBackdrop' + item.id">
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
                                        </button>

                                        <a class="btn" href="javascript:;" v-on:click="onDelete(item.id)">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                 class="bi bi-trash-fill"
                                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                            </svg>
                                        </a>

                                    </div>
                                </b-col>
                            </b-row>
                        </b-card>

                        <b-row class="flex-nowrap my-2">
                            <b-collapse :id="'example-collapse' + item.id">
                                <b-card>
                                    <b-row>
                                        <b-col>
                                            <div class="h6">Артикул</div>
                                        </b-col>
                                        <b-col>
                                            <div class="h6">Поставщик</div>
                                        </b-col>
                                    </b-row>
                                    <b-row>
                                        <b-col>{{ item.product.vendor_code }}</b-col>
                                        <b-col>{{ item.product.providers.name }}</b-col>
                                    </b-row>
                                </b-card>
                            </b-collapse>
                        </b-row>

                        <b-row>
                            <div class="modal fade" :id="'staticBackdrop' + item.id" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <label for="size" class="form-label">Размер</label>
                                            <input type="text"
                                                   id="size"
                                                   v-model="item.size"
                                                   class="form-control">

                                            <label for="color" class="form-label mt-3">Цвет</label>
                                            <input type="text"
                                                   id="color"
                                                   v-model="item.color"
                                                   class="form-control">

                                            <label for="count" class="form-label mt-3">Количество</label>
                                            <input type="text"
                                                   id="count"
                                                   v-model="item.count"
                                                   class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Закрыть
                                            </button>
                                            <button type="button"
                                                    v-on:click.prevent="updateOrderItems(item.id,item.count,item.size,item.color)"
                                                    class="btn btn-primary">Сохранить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </b-row>
                    </b-row>

                </div>
            </b-row>

            <b-row v-if="order.product_id !== null">
                <b-col>
                    <div class="h5">Данные до обновления:</div>
                    <ul>
                        <li>ID товара:
                            <a v-bind:href="host + 'product/' + order.product_id" target="_blank">{{ order.product_id }}</a>
                        </li>
                        <li v-if="this.colorsOld !== null">Цвет: {{this.colorsOld}}</li>
                        <li v-if="this.sizesOld !== null">Размер: {{this.sizesOld}}</li>
                    </ul>
                </b-col>
            </b-row>

            <b-row>
                <div class="col-12 col-md-3">
                    <div class="form-group my-3">
                        <label>Дата обновления</label>
                        <b-form-datepicker
                            v-model="order.updated_at"
                            id="updated_at"
                            name="updated_at"
                            disabled
                        ></b-form-datepicker>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="form-group my-3">
                        <label>Дата создания</label>
                        <b-form-datepicker
                            v-model="order.created_at"
                            id="created_at"
                            name="created_at"
                            disabled
                        ></b-form-datepicker>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="form-group my-3">
                        <label for="modified_by">Обновлено пользователем</label>
                        <input type="text" class="form-control" id="modified_by"
                               v-model="order.modified_by" disabled>
                    </div>
                </div>
            </b-row>
            <b-button type="submit" v-on:click.prevent="updateOrder" variant="primary">Сохранить</b-button>
        </b-container>
    </div>
</template>

<script>
export default {
    data() {
        return {
            host: window.location.origin + '/',
            order: {
                id: null,
                status: null,
                name: null,
                phone: null,
                city: null,
                postal_office: null,
                waybill: null,
                comment: null,
                updated_at: null,
                modified_by: null,
            },
            items: [],
        }
    },
    props: {
        userName: String,
        colorsOld: String,
        sizesOld: String,
    },
    mounted() {
        let str = window.location.pathname;
        let n = str.lastIndexOf('/');
        let id = str.substring(n + 1);

        axios.get('/api/orders/edit/' + id)
            .then(({data}) => this.getOrderSuccessResponse(data))
            .catch((response) => this.getOrderErrorResponse(response));

        this.getItems(id);
    },
    methods: {
        getItems(id) {
            axios.get('/api/order-items/' + id)
                .then(({data}) => this.getOrderItemsSuccessResponse(data))
                .catch((response) => this.getOrderItemsErrorResponse(response));
        },
        getOrderItemsSuccessResponse(data) {
            this.items = data.result;
        },
        getOrderItemsErrorResponse(response) {
            console.log(response)
        },

        getOrderSuccessResponse(data) {
            this.order = data.result;
        },
        getOrderErrorResponse(response) {
            console.log(response)
        },
        updateOrderItems(id, count, size, color) {
            axios.put('/api/order-items/update/' + id, {count: count, size: size, color: color})
                .then(({data}) => this.getOrderItemsSuccessResponse(data))
                .catch((response) => this.getOrderItemsErrorResponse(response));
        },
        onDelete(id) {
            if (confirm('Вы точно хотите удалить товар из заказа?')) {
                axios.delete('/api/order-items/destroy/' + id)
                    .then(() => this.getItems(this.order.id))
                    .catch((response) => this.getOrderItemsErrorResponse(response));
            }
        },
        updateOrder() {
            axios.put('/api/orders/update/' + this.order.id, [this.order, {userName: this.userName}])
                .then(swal({
                    title: 'Обновлено!',
                    text: 'Данные успешно обновлены',
                    icon: 'success',
                }))
                .catch((response) => console.log(response));
        },
    }
}
</script>
