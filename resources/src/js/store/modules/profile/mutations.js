export default {
    GET_STUDENT_PROFILE: function (state, {payload, getters}) {
        let email = payload.uri+'@my.csun.edu';
        let data = new FormData;

        let tempEmail = 'nr_' + email;

        data.append('faculty_id', payload.faculty_id);
        data.append('email', email);

        state.studentProfile.emailURI = payload.uri;

        window.axios.get('student/'+email)
            .then(response => {
                state.studentProfile.bio = response['data']['people'].biography;
            })
            .catch(e => {
                state.profileLoadError = true;
                state.profileErrors = e.response.data.message;
            });

        window.axios.get('student_profile/'+email)
            .then(response => {
                state.studentProfile.displayName = response['data'].display_name;
                state.studentProfile.imagePriority = response['data'].image_priority;
                state.studentProfile.notes = response['data'].notes;
                state.studentProfile.id = response['data'].student_id;
                state.studentProfile.firstName = response['data'].first_name;
                for(var student in getters.students) {
                    if(getters.students.hasOwnProperty(student)) {
                        if(getters.students[student].email == tempEmail) {
                            state.studentProfile.images = getters.students[student].images;
                            state.studentProfile.name_recording = getters.students[student].name_recording;
                            break;
                        }
                    }
                }
            })
            .catch(e => {
                state.profileLoadError = true;
                state.profileErrors = e.response.data.message;
            });
        


    },

    UPDATE_NOTES: function (state, notes) {
        state.studentProfile.notes = notes;
    },

    COMMIT_NOTES: function (state) {
        let data = new FormData;
        data.append('student_id', state.studentProfile.id);
        data.append('notepad', state.studentProfile.notes);

        window.axios.post('update_note', data)
            .catch(e => {
                state.profileErrors = e.response.data.message;
            });
    },

    UPDATE_IMAGE_PRIORITY: function (state, payload, rootState) {
        let data = new FormData;
        data.append('student_id', state.studentProfile.id);
        data.append('image_priority', payload.image_priority);
        data.append('faculty_id', payload.faculty_id);
        window.axios.post('api/priority', data)
            .then(response => {
                state.studentProfile.imagePriority = payload.image_priority;
            })
            .catch(e => {
                state.profileErrors = e.response.data.message;
            });
    },

    NULLIFY_STUDENT_PROFILE: function (state) {
        state.studentProfile = {
            id: null,
            emailURI: null,
            displayName: null,
            bio: null,
            images: null,
            imagePriority: null,
            notes: null,
            firstName: null,
        };

        state.profileErrors = null;
    },

    CLEAR_PROFILE_ERRORS: function (state) {
        state.profileErrors = null;
        state.profileLoadError = false;
    }
}
