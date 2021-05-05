import $ from 'jquery'
window.jQuery = window.$ = $;
import 'slick-carousel'

window.axios = require('axios');
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require('./components/menu')
require('slick-carousel/slick/slick.min')
require('./components/jquery.maskedinput')
require('./components/mask-input')
require('./components/slider')
require('./components/modal')
require('./components/alert')
require('./components/radio-checked')
require('./components/scroll-box-shadow')


