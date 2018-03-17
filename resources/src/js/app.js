import axios from 'axios';
import VueAxios from 'vue-axios';
import Croppa from 'vue-croppa';
import router from './router';
import Vuex from 'vuex';

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(VueAxios, axios);
Vue.use(Croppa);
Vue.use(Vuex);

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

Vue.prototype.$store = new Vuex.Store({
    state: {
        courses: [],
        roster: [],
        flashroster: [],
        list: true,
        flash: true,
        lastname: true,
        descending: true,
        courseid: 0,
    },

    getters: {
        courses: state => state.courses,
        roster: state => state.roster,
        flashroster: state => state.flashroster,
        list: state => state.list,
        flash: state => state.flash,
        courseid: state => state.courseid,
    },

    actions: {
        nameSort (context) {
            context.commit('toggleName');
            context.commit('sortRoster');
        },

        descSort (context) {
            context.commit('toggleDesc');
            context.commit('sortRoster');
        },

        getCourseId (context, payload) {
            context.commit('GET_COURSE_ID', payload);
        },
    },

    mutations: {
        getData (state) {
            axios.get(`data`)
                .then(response => {
                    state.courses = response.data[0];
                    state.roster = response.data[1];
                    state.flashroster = response.data[1].slice();
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

        shuffleFlash (state, { courseid }) {
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

            state.flashroster[courseid] = unKnownStudents.concat(knownStudents);

            state.flash = false;
            state.flash = true;
        },

        sortRoster: function (state) {
            state.roster.forEach((course) => {
                function sortedRoster (self) {
                    if (state.lastname === true) {
                        if(state.descending === true) {
                            return self.sort((a, b) => {
                                return a.last_name.localeCompare(b.last_name);
                            });
                        } else {
                            return self.sort((a, b) => {
                                return a.last_name.localeCompare(b.last_name);
                            }).reverse();
                        }
                    } else {
                        if(state.descending === true) {
                            return self.sort((a, b) => {
                                return a.first_name.localeCompare(b.first_name);
                            });
                        } else {
                            return self.sort((a, b) => {
                                return a.first_name.localeCompare(b.first_name);
                            }).reverse();
                        }
                    }
                }

                course = sortedRoster(course);
            });
        },

        toggleName: function (state) {
            state.lastname = !state.lastname;
        },

        toggleDesc: function (state) {
            state.descending = !state.descending;
        },

        GET_COURSE_ID: function (state, payload) {
            state.courseid = payload.courseid;
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