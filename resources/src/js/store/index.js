import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        courses: [],
        roster: [],
        flashroster: [],
        list: true,
        flash: true,
        lastname: true,
        descending: true,
        courseid: 0,
        courseTitle: "Course",
        faculty_email: "undefined",
        faculty_name: "undefined",
        faculty_profile: "underfined"
    },

    getters: {
        courses: state => state.courses,
        roster: state => state.roster,
        flashroster: state => state.flashroster,
        list: state => state.list,
        flash: state => state.flash,
        courseid: state => state.courseid,
        courseTitle: state => state.courseTitle,
        faculty_email: state => state.faculty_email,
        faculty_name: state => state.faculty_name, 
        faculty_profile: state => state.faculty_profile
    },

    actions: {
        getData (context) {
            context.commit('GET_DATA');
        },

        toggleList (context) {
            context.commit('TOGGLE_LIST');
        },

        toggleFlash (context) {
            context.commit('TOGGLE_FLASH');
        },

        shuffleFlash (context, payload) {
            context.commit('SHUFFLE_FLASH', payload);
        },

        nameSort (context) {
            context.commit('TOGGLE_NAME');
            context.commit('SORT_ROSTER');
        },

        descSort (context) {
            context.commit('TOGGLE_DESC');
            context.commit('SORT_ROSTER');
        },

        getCourseId (context, payload) {
            context.commit('GET_COURSE_ID', payload);
        },
    },

    mutations: {
        GET_DATA (state) {
            axios.get(`data`)
                .then(response => {
                    state.courses = response.data[0];
                    state.roster = response.data[1];
                    state.flashroster = response.data[1].slice();
                    state.faculty_email = response.data[0][0].instructors[0].instructor;
                    state.faculty_name = state.faculty_email.replace("nr_", "");
                    state.faculty_name = state.faculty_name.substring(0, state.faculty_name.indexOf('@'));
                    state.faculty_profile = "http://www.csun.edu/faculty/profiles/" + state.faculty_name;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        },

        TOGGLE_LIST (state) {
            state.list = !state.list;
        },

        TOGGLE_FLASH (state) {
            state.flash = !state.flash;
        },

        SHUFFLE_FLASH (state, { courseid }) {
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

        SORT_ROSTER: function (state) {
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

        TOGGLE_NAME: function (state) {
            state.lastname = !state.lastname;
        },

        TOGGLE_DESC: function (state) {
            state.descending = !state.descending;
        },

        GET_COURSE_ID: function (state, payload) {
            state.courseid = payload.courseid;
            state.courseTitle = state.courses[state.courseid].title;
        }
    }
});

