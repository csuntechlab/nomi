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
        flashroster: [],
        list: true,
        flash: false
    },

    getters: {
        courses: state => state.courses,
        roster: state => state.roster,
        flashroster: state => state.flashroster,
        list: state => state.list,
        flash: state => state.flash
    },

    mutations: {
        getData (state) {
            axios.get(`/metalab/test/nameface/data`)
                .then(response => {
                    state.courses = response.data[0];
                    state.roster = response.data[1];
                    state.flashroster = response.data[1];
                })
                .catch(e => {
                    this.errors.push(e);
                })
        },

        toggleList (state) {
            state.list = !state.list;
        },

        toggleFlash (state) {
            state.flash = !state.flash;
        },

        shuffleFlash (state, courseid) {
            let unKnownStudents = [];
            let knownStudents = [];

            state.flashroster[courseid].forEach((student) => {
                if(student.recognized === true) {
                    knownStudents.push(student)
                } else {
                    unKnownStudents.push(student)
                }
            });

            let currentIndex = unKnownStudents.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = unKnownStudents[currentIndex];
                unKnownStudents[currentIndex] = unKnownStudents[randomIndex];
                unKnownStudents[randomIndex] = temporaryValue;
            }

            let currentIndexTwo = knownStudents.length, temporaryValueTwo, randomIndexTwo;

            // While there remain elements to shuffle...
            while (0 !== currentIndexTwo) {

                // Pick a remaining element...
                randomIndexTwo = Math.floor(Math.random() * currentIndexTwo);
                currentIndexTwo -= 1;

                // And swap it with the current element.
                temporaryValueTwo = knownStudents[currentIndexTwo];
                knownStudents[currentIndexTwo] = knownStudents[randomIndexTwo];
                knownStudents[randomIndexTwo] = temporaryValueTwo;
            }

            state.flashroster = unKnownStudents.concat(knownStudents);
        }
    }
});

Vue.config.devtools = true;

const app = new Vue({
    el: '#app',
    router,

    beforeCreate () {
        this.$store.commit('getData');
    }
});
