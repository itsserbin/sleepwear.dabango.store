import $ from 'jquery'
window.jQuery = window.$ = $;

import 'slick-carousel'
import Vue from "vue";
import Vuex from 'vuex';
import store from "./store";

import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

window.axios = require('axios');

Vue.use(Vuex)

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require('./components/menu')
// require('slick-carousel/slick/slick.min')
require('./components/jquery.maskedinput')
require('./components/mask-input')
require('./components/slider')
// require('./components/modal')
// require('./components/alert')
// require('./components/radio-checked')
require('./components/scroll-box-shadow')

/**
 * Vue Cart components
 */
Vue.component('cart', require('./components/cart/CartComponent').default);
Vue.component('cart-list', require('./components/cart/CartTableComponent').default);
// Vue.component('cart-total', require('./components/cart/CartTotalComponent').default);
Vue.component('add-to-cart', require('./components/product/AddToCart').default);
Vue.component('checkout', require('./components/cart/CheckoutComponent').default);

/**
 * Vue Product components
 */
Vue.component('product-cards', require('./components/product/ProductCart').default);
Vue.component('sizes-table', require('./components/product/SizesTable').default);
Vue.component('review-form', require('./components/product/ReviewForm').default);
Vue.component('available-size', require('./components/product/AvailableSizes').default);
Vue.component('available-colors', require('./components/product/AvailableColors').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store)
});
