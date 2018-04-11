import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        courses: [],
        roster: [],
        flashroster: [],
        menushow: true,
        list: true,
        flash: true,
        lastname: true,
        descending: true,
        courseid: 0,
        courseTitle: "Course", 

        faculty_email: null,
        faculty_name: null,
        faculty_profile: null,
        faculty_first_name: null, 
        faculty_last_name: null,
        faculty_full_name: null,
        faculty_profile_image: null,

        sp_student_id: null,
        sp_emailURI: null,
        sp_display_name: null,
        sp_major: "None",
        sp_bio: null,
        sp_images: null,
        sp_image_priority: null,
        sp_notes: null,
    },

    getters: {
        courses: state => state.courses,
        roster: state => state.roster,
        flashroster: state => state.flashroster,
        list: state => state.list,
        flash: state => state.flash,
        menushow: state => state.menushow,
        courseid: state => state.courseid,
        courseTitle: state => state.courseTitle,

        faculty_email: state => state.faculty_email,
        faculty_name: state => state.faculty_name, 
        faculty_profile: state => state.faculty_profile,
        faculty_first_name: state => state.faculty_first_name,
        faculty_last_name: state => state.faculty_last_name,
        faculty_full_name: state => state.faculty_full_name,
        faculty_profile_image: state => state.faculty_profile_image,

        sp_student_id : state => state.sp_student_id,
        sp_emailURI : state => state.sp_emailURI,
        sp_display_name: state => state.sp_display_name,
        sp_major: state => state.sp_major,
        sp_bio: state => state.sp_bio,
        sp_images: state => state.sp_images,
        sp_image_priority: state => state.sp_image_priority,
        sp_notes: state => state.sp_notes,
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

        toggleMenu (context) {
            context.commit('TOGGLE_MENU');
        },

        shuffleFlash (context, payload) {
            context.commit('SHUFFLE_FLASH', payload);
        },

        sortFirstName (context) {
            context.commit('SORT_FIRST_NAME');
            context.commit('SORT_ROSTER');
        },

        sortLastName (context) {
            context.commit('SORT_LAST_NAME');
            context.commit('SORT_ROSTER');
        },

        sortDescending (context) {
            context.commit('SORT_DESC');
            context.commit('SORT_ROSTER');
        },

        sortAscending (context) {
            context.commit('SORT_ASC');
            context.commit('SORT_ROSTER');
        },

        getCourseId (context, payload) {
            context.commit('GET_COURSE_ID', payload);
        },

        getFacultyProfile (context, payload) {
            context.commit('GET_FACULTY_PROFILE', payload);
        },

        getStudentProfile (context, payload) {
            context.commit('GET_STUDENT_PROFILE', payload);
        },

        updateNotes (context, notes) {
            context.commit('UPDATE_NOTES', notes);
        },

        commitNotes (context, payload) {
            context.commit('COMMIT_NOTES', payload);
        },

        updateImagePriority (context, payload) {
            context.commit('UPDATE_IMAGE_PRIORITY', payload);
        }
    },

    mutations: {
        GET_DATA (state) {
            axios.get(`data`)
                .then(response => {
                    state.courses = response.data["courses"];
                    state.roster = response.data["students"];
                    state.flashroster = response.data["students"].slice();
                    state.faculty_email = response.data["courses"][0].instructors[0].instructor;
                    state.faculty_name = state.faculty_email.replace("nr_", "");
                    state.faculty_name = state.faculty_name.split('@')[0];
                    state.faculty_profile = "http://www.csun.edu/faculty/profiles/" + state.faculty_name;
                    state.faculty_first_name = state.faculty_name.charAt(0).toUpperCase() + state.faculty_name.substring(1, state.faculty_name.indexOf('.'));
                    state.faculty_last_name = state.faculty_name.substring((state.faculty_name.indexOf('.') + 2), state.faculty_name.length);
                    state.faculty_last_name = state.faculty_name.charAt((state.faculty_name.indexOf('.') + 1)).toUpperCase() + state.faculty_last_name;
                    state.faculty_full_name = state.faculty_first_name + " " + state.faculty_last_name ;

                    state.sp_emailURI = state.sp_emailURI.replace("nr_", "");
                    state.sp_emailURI = state.sp_emailURI + "@my.csun.edu";
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

        TOGGLE_MENU (state) {
            state.menushow = !state.menushow;
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

        SORT_FIRST_NAME: function (state) {
            state.lastname = false;
        },

        SORT_LAST_NAME: function (state) {
            state.lastname = true;
        },

        SORT_DESC: function (state) {
            state.descending = true;
        },

        SORT_ASC: function (state) {
            state.descending = false;
        },

        GET_COURSE_ID: function (state, payload) {
            state.courseid = payload.courseid;
            state.courseTitle = state.courses[state.courseid].title;
        },

        GET_FACULTY_PROFILE: function (state, payload) {
            axios.get(`faculty_profile/${state.faculty_email}`)
            .then(response => {
                state.faculty_profile_image = response.data;
            })
            .catch(e => {
                this.errors.push(e);
            });
        },

        GET_STUDENT_PROFILE: function (state, payload) {
            state.sp_emailURI = payload.uri;
            axios.get('student/'+state.sp_emailURI+'@my.csun.edu')
                .then(response => {
                    state.sp_bio = response['data']['people'].biography;

                    if(state.sp_bio === null)
                        state.sp_bio = "Pending biography from student.";
                })
                .catch(e => {
                    this.errors.push(e);
                });

            axios.get('student_profile/'+state.sp_emailURI+'@my.csun.edu')
                .then(response => {
                    state.sp_display_name = response['data'].display_name;
                    state.sp_images = response['data'].images;
                    state.sp_image_priority = response['data'].image_priority;
                    state.sp_notes = response['data'].notes;
                    state.sp_student_id = response['data'].student_id;
                })
                .catch(e => {
                    this.errors.push(e);
                });
        },

        UPDATE_NOTES: function (state, notes) {
            state.sp_notes = notes;
        },

        COMMIT_NOTES: function (state) {
            let data = new FormData;
            data.append('student_id', state.sp_student_id);
            data.append('notepad', state.sp_notes);

            axios.post('update_note', data)
                .catch(e => {
                    this.errors.push(e)
                });
        },

        UPDATE_IMAGE_PRIORITY: function (state, payload) {
            let data = new FormData;
            data.append('student_id', state.sp_student_id.replace("members:", ""));
            data.append('image_priority', payload.image_priority);

            axios.post('api/priority', data)
                .then(response => {
                    state.sp_image_priority = payload.image_priority.split(",");
                })
                .catch(e => {
                    this.errors.push(e)
                });
        }
    }
});

