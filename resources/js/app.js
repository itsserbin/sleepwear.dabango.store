import $ from 'jquery'
window.jQuery = window.$ = $;
import 'slick-carousel'

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

require('./components/menu')
require('slick-carousel/slick/slick.min')
require('./components/jquery.maskedinput')
require('./components/mask-input')
require('./components/slider')
require('./components/modal')
require('./components/alert')
require('./components/radio-checked')
require('./components/scroll-box-shadow')


