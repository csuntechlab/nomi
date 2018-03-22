import axios from 'axios';
import VueAxios from 'vue-axios';
import Croppa from 'vue-croppa';
import router from './router';
import store from './store'

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(VueAxios, axios);
Vue.use(Croppa);

Vue.component('menu-bar', require('./components/fixed_components/menuBar.vue'));
Vue.component('nav-bar', require('./components/fixed_components/navBar.vue'));
Vue.component('side-bar', require('./components/fixed_components/sideBar.vue'));

Vue.component('side-bar-button', require('./components/fixed_components/sideBarButton.vue'));
Vue.component('toggle-view-button', require('./components/fixed_components/toggleViewButton.vue'));

Vue.component('toggle-view-button', require('./components/fixed_components/toggleViewButton.vue'));
Vue.component('shuffle-button', require('./components/roster_components/shuffleButton.vue'));
Vue.component('card-toggle-button', require('./components/roster_components/cardToggleButton.vue'));

Vue.component('roster-container', require('./components/roster_components/rosterContainer.vue'));
Vue.component('courses-container', require('./components/course_components/coursesContainer.vue'));
Vue.component('loading-button', require('./components/fixed_components/loadingButton.vue'));

const app = new Vue({
    el: '#app',
    router,
    store,

    mounted () {
        this.$store.dispatch('getData');
    }
});