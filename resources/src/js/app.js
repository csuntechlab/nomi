import VueRouter from 'vue-router'
import axios from 'axios';
import VueAxios from 'vue-axios';
import Croppa from 'vue-croppa';
import router from './routes';
import Vuex from 'vuex';

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(VueAxios, axios);
Vue.use(VueRouter);
Vue.use(Croppa);
Vue.use(Vuex);

Vue.component('menu-bar', require('./components/fixed_components/menuBar.vue'));
Vue.component('nav-bar', require('./components/fixed_components/navBar.vue'));
Vue.component('side-bar', require('./components/fixed_components/sideBar.vue'));
Vue.component('toggle-view-button', require('./components/fixed_components/toggleViewButton.vue'));

Vue.component('roster-container', require('./components/roster_components/rosterContainer.vue'));
Vue.component('shuffle-button', require('./components/roster_components/shuffleButton.vue'));
Vue.component('card-toggle-button', require('./components/roster_components/cardToggleButton.vue'));

Vue.component('courses-container', require('./components/course_components/coursesContainer.vue'));

Vue.prototype.$eventBus = new Vue(); // Global event bus
Vue.prototype.$store = new Vuex.Store({
    state: {
        courses: [],
        roster: [],
        list: true
    },

    getters: {
        courses: state => state.courses,
        roster: state => state.roster,
        list: state => state.list
    },

    mutations: {
        getData (state) {
            axios.get(`data`)
                .then(response => {
                    state.courses = response.data[0];
                    state.roster = response.data[1];
                })
                .catch(e => {
                    this.errors.push(e);
                })
        },

        toggleList (state) {
            state.list = !state.list;
        }
    }
});

const app = new Vue({
    el: '#app',
    router,

    created () {
        this.$store.commit('getData');
    }
});