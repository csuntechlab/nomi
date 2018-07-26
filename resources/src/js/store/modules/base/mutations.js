export default {
    GET_SETTINGS (state) {
        window.axios.get('get_settings')
            .then(response =>{
                state.themeName = response.data;
                document.getElementById("mainBody").className = state.themeName.theme;
            }).catch(e => {
                state.errors = e.response.data.message;
            });
    },

    GET_DATA (state) {
        function capitalize(name) {
            return name.charAt(0).toUpperCase() + name.substr(1);
        }

        if(state.termYear != null){
            let selectedTerm = state.termYear + state.semester;
            selectedTerm = selectedTerm.slice(0,1) + selectedTerm.slice(2);
            state.term = selectedTerm;
    
            function capitalize(name) {
                return name.charAt(0).toUpperCase() + name.substr(1);
            }
    
            window.axios.get(`data/${state.term}`)
                .then(response => {
                    state.term = response.data["term"];
                    state.courses = response.data["courses"];
                    state.loadingClasses = false;
                    state.flashroster = response.data["students"];
                    state.facultyMember.email = response.data["email"];
                    state.facultyMember.emailURI = state.facultyMember.email.replace("nr_", "").split('@')[0];
                    state.facultyMember.profile = "http://www.csun.edu/faculty/profiles/" + state.facultyMember.name;
                    state.facultyMember.firstName = capitalize(state.facultyMember.emailURI.split('.')[0]);
                    state.facultyMember.lastName = capitalize(state.facultyMember.emailURI.split('.')[1]);
                    for(let course in state.courses) {
                        if (state.courses.hasOwnProperty(course)){
                            let realCourse = state.courses[course];
                            for(let student in realCourse.roster) {
                                if(realCourse.roster.hasOwnProperty(student)){
                                    let realStudent = realCourse.roster[student];
                                    let studentId = realStudent.student_id;
                                    let url = realStudent.images.likeness;
    
                                    state.studentImages[studentId] = url;
                                }
                            }
                        }
                        
                    }
                    window.axios.get(`faculty_profile/${state.facultyMember.email}`)
                    .then(response => {
                        state.facultyMember.image = response.data.image;
                        state.facultyMember.id = response.data.id;
                    })
                    .catch(e => {
                        state.errors = e.response.data.message;
                    });
                })
                .catch(e => {
                    state.errors = e.response.data.message;
                });
            }
        else{
        window.axios.get(`data`)
            .then(response => {
                state.term = response.data["term"];
                state.courses = response.data["courses"];
                state.flashroster = response.data["students"];
                state.facultyMember.email = response.data["email"];
                state.facultyMember.emailURI = state.facultyMember.email.replace("nr_", "").split('@')[0];
                state.facultyMember.profile = "http://www.csun.edu/faculty/profiles/" + state.facultyMember.name;
                state.facultyMember.firstName = capitalize(state.facultyMember.emailURI.split('.')[0]);
                state.facultyMember.lastName = capitalize(state.facultyMember.emailURI.split('.')[1]);
                for(let course in state.courses) {
                    if (state.courses.hasOwnProperty(course)){
                        let realCourse = state.courses[course];
                        for(let student in realCourse.roster) {
                            if(realCourse.roster.hasOwnProperty(student)){
                                let realStudent = realCourse.roster[student];
                                let studentId = realStudent.student_id;
                                let url = realStudent.images.likeness;

                                state.studentImages[studentId] = url;
                            }
                        }
                    }
                    
                }
                window.axios.get(`faculty_profile/${state.facultyMember.email}`)
                    .then(response => {
                        state.facultyMember.image = response.data.image;
                        state.facultyMember.id = response.data.id;
                    })
                    .catch(e => {
                        state.errors = e.response.data.message;
                    });
            })
            .catch(e => {
                state.errors = e.response.data.message;
            });
        }
    },

    STORE_COURSE (state, payload){
        state.currentCourse = payload;
    },

    STORE_LOCATION (state){
        state.currentLocation = window.location.hash.split('/')[1];
    },

    SET_LIST (state) {
        state.list = true;
        state.flash = false;
    },

    SET_GALLERY (state) {
        state.list = false;
        state.flash = false;
    },

    SET_FLASH (state) {
        state.list = false;
        state.flash = true;
    },

    TOGGLE_MENU (state) {
        state.menuShow = !state.menuShow;
    },

    SHUFFLE_FLASH (state) {
        function shuffle(students) {
            let currentIndex = students.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = students[currentIndex];
                students[currentIndex] = students[randomIndex];
                students[randomIndex] = temporaryValue;
            }
        }

        let len = state.flashroster.length;

        for (let i = 0; i < len; ++i) {
            let unKnownStudents = [];
            let knownStudents = [];

            state.flashroster[i].forEach((student) => {
                if (student.recognized === true) {
                    knownStudents.push(student)
                } else {
                    unKnownStudents.push(student)
                }
            });

            shuffle(unKnownStudents);
            shuffle(knownStudents);

            state.flashroster[i] = unKnownStudents.concat(knownStudents);
        }

        state.flash = false;
        state.flash = true;
    },

    SORT_ROSTER: function (state) {
        let len = state.courses.length;
        for(let i = 0; i < len; ++i) {
            function sortedRoster (self) {
                if (state.sortLastName === true) {
                    if(state.sortAscending === true) {
                        return self.sort((a, b) => {
                            return a.last_name.localeCompare(b.last_name);
                        });
                    } else {
                        return self.sort((a, b) => {
                            return a.last_name.localeCompare(b.last_name);
                        }).reverse();
                    }
                } else {
                    if(state.sortAscending === true) {
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

            state.courses[i].roster = sortedRoster(state.courses[i].roster);
        }
    },

    SORT_FIRST_NAME: function (state) {
        state.sortLastName = false;
    },

    SORT_LAST_NAME: function (state) {
        state.sortLastName = true;
    },

    SORT_ASC: function (state) {
        state.sortAscending = true;
    },

    SORT_DSC: function (state) {
        state.sortAscending = false;
    },

    CLEAR_ERRORS: function (state) {
        state.errors = null;
    },

    HIDE_BACK_BUTTON: function (state) {
        state.hideBack = true;
    },

    SHOW_BACK_BUTTON: function (state) {
        state.hideBack = false;
    },

    DISABLE_BACK_BUTTON: function (state) {
        state.disableBack = true;
    },

    ENABLE_BACK_BUTTON: function (state) {
        state.disableBack = false;
    },

    UPDATE_IMAGE: function (state, payload) {
        let id = payload.studentId;
        let url = payload.imgUrl;
        state.studentImages[id] = url;
    },

    SET_SPRING: function (state) {
        state.semester = 3;
    },

    SET_SUMMER: function (state) {
        state.semester = 5;
    },

    SET_FALL: function (state) {
        state.semester = 7;
    },

    SET_WINTER: function (state) {
        state.semester = 9;
    },

    SET_TERM_YEAR: function (state, payload){
        state.termYear = payload;
    },

    SET_CLASS_IS_LOADING(state){
        state.loadingClasses = true;
    },

    SET_CLASS_DONE_LOADING(state){
        state.loadingClasses = false;
    },

    HANDLE_PERMISSION_RESPONSE(state, payload){
        state.imagePermission = payload;
    },

    NULLIFY_PERMISSION_RESPONSE(state){
        state.imagePermission = null;
    }
}
