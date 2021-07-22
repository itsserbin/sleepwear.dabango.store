require('../bootstrap')

import Vue from "vue";
import VueSwal from 'vue-swal'
import Paginate from 'vuejs-paginate'

import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import VueDatePicker from '@mathieustan/vue-datepicker';
import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';

Vue.use(VueDatePicker);

Vue.use(VueSwal)
Vue.use(require('vue-moment'));
Vue.component('paginate', Paginate)


let numeral = require("numeral");

Vue.filter("formatMoney", function (value) {
    return numeral(value).format('0,0[.]00');
});
Vue.filter("formatPercent", function (value) {
    return numeral(value).format('0.000%');
});


// require('bootstrap/dist/js/bootstrap.min')
// require('bootstrap/dist/css/bootstrap.css')
require('popper.js')

Vue.component('loader', require('../components/LoaderComponent').default);
Vue.component('admin-dashboard', require('./pages/AdminDashboard').default);
Vue.component('clients-list', require('./pages/clients/ClientsList.vue').default);
Vue.component('categories-list', require('./pages/categories/CategoriesList').default);
Vue.component('category-create', require('./pages/categories/CategoryCreate').default);
Vue.component('category-edit', require('./pages/categories/EditCategory').default);
Vue.component('orders-list', require('./pages/orders/OrdersList.vue').default);
Vue.component('order-edit', require('./pages/orders/EditOrder').default);
Vue.component('bookkeeping-daily-statistics', require('./pages/bookkeeping/DailyStatistics.vue').default);
Vue.component('supplier-payments', require('./pages/bookkeeping/SupplierPaymentsList').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
