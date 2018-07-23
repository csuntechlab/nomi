import Croppa from 'vue-croppa';
import router from './router';
import store from './store'
import VueCarousel from 'vue-carousel';

require('./bootstrap');
window.Vue = require('vue');

Vue.use(VueCarousel);
Vue.use(Croppa);

Vue.component('nav-bar', require('./components/fixed_components/navBar.vue'));
Vue.component('menu-bar', require('./components/fixed_components/menuBar.vue'));
Vue.component('error-bar', require('./components/fixed_components/errorBar.vue'));
Vue.component('permission-modal', require('./components/fixed_components/permissionModal.vue'));

const app = new Vue({
    el: '#app',
    router,
    store,
});