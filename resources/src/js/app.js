import axios from 'axios';
import Croppa from 'vue-croppa';
import router from './router';
import store from './store'
import VueCarousel from 'vue-carousel';

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(VueCarousel);
Vue.use(Croppa);

Vue.component('nav-bar', require('./components/fixed_components/navBar.vue'));
Vue.component('menu-bar', require('./components/fixed_components/menuBar.vue'));
Vue.component('error-bar', require('./components/fixed_components/errorBar.vue'));
Vue.component('croppa-profile', require('./components/fixed_components/croppaProfile.vue'));
Vue.component('profile-picture', require('./components/fixed_components/profilePicture.vue'));
Vue.component('loading-button', require('./components/fixed_components/loadingButton.vue'));
Vue.component('list-grid-selector', require('./components/fixed_components/listGridSelector.vue'));
Vue.component('modal', require('./components/fixed_components/modal.vue'));
Vue.component('back-button', require('./components/fixed_components/backButton.vue'));

Vue.component('shuffle-button', require('./components/roster_components/shuffleButton.vue'));
Vue.component('card-toggle-button', require('./components/roster_components/cardToggleButton.vue'));
Vue.component('roster-container', require('./components/roster_components/rosterContainer.vue'));
Vue.component('course-banner', require('./components/roster_components/courseBanner.vue'));
Vue.component('settings-banner', require('./components/roster_components/settingsBanner.vue'));

Vue.component('courses-container', require('./components/course_components/coursesContainer.vue'));

const app = new Vue({
    el: '#app',
    router,
    store,
});