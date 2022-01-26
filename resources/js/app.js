require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');

Vue.component('index-component', require('./components/IndexComponent.vue').default);

import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

let app = new Vue({
    el:'#app',
});

