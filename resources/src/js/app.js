import axios from 'axios';
import Croppa from 'vue-croppa';
import router from './router';
import store from './store'
import { mapGetters } from 'vuex';
import VueCarousel from 'vue-carousel';

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(VueCarousel);
Vue.use(Croppa);

Vue.component('nav-bar', require('./components/fixed_components/navBar.vue'));
Vue.component('menu-up', require('./components/fixed_components/menuUp.vue'));
Vue.component('menu-button', require('./components/fixed_components/menuButton.vue'));
Vue.component('croppa-profile', require('./components/fixed_components/croppaProfile.vue'));
Vue.component('list-grid-tabs', require('./components/fixed_components/listGridTabs.vue'));
Vue.component('profile-picture', require('./components/fixed_components/profilePicture.vue'));
Vue.component('shuffle-button', require('./components/roster_components/shuffleButton.vue'));
Vue.component('card-toggle-button', require('./components/roster_components/cardToggleButton.vue'));
Vue.component('roster-container', require('./components/roster_components/rosterContainer.vue'));
Vue.component('courses-container', require('./components/course_components/coursesContainer.vue'));
Vue.component('loading-button', require('./components/fixed_components/loadingButton.vue'));

const app = new Vue({
    el: '#app',
    router,
    store,
    created () {
        this.$store.dispatch('getData');
    }
});