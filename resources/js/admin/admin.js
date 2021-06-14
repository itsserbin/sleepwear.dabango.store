// import Vue from "vue";

require('../bootstrap')

import Vue from "vue";
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import VueSwal from 'vue-swal'
import Paginate from 'vuejs-paginate'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueSwal)
Vue.use(require('vue-moment'));
Vue.component('paginate', Paginate)

var numeral = require("numeral");

Vue.filter("formatMoney", function (value) {
    return numeral(value).format('0,0[.]00');
});


require('bootstrap/dist/js/bootstrap.min')
require('bootstrap/dist/css/bootstrap.css')
require('popper.js')

Vue.component('clients-list', require('./pages/clients/ClientsList.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
