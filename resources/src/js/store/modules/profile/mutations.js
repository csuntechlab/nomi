export default {
    GET_STUDENT_PROFILE: function (state, payload) {
        let email = payload.uri+'@my.csun.edu';
        let data = new FormData;

        data.append('faculty_id', payload.faculty_id);
        data.append('email', email);

        state.studentProfile.emailURI = payload.uri;

        window.axios.get('student/'+email)
            .then(response => {
                state.studentProfile.bio = response['data']['people'].biography;

                if(state.studentProfile.bio === null)
                    state.studentProfile.bio = "Pending biography from student.";
            })
            .catch(e => {
                state.profileErrors = e.response.data.message;
            });

        window.axios.get('student_profile/'+email)
            .then(response => {
                state.studentProfile.displayName = response['data'].display_name;
                state.studentProfile.images = response['data'].images;
                state.studentProfile.imagePriority = response['data'].image_priority;
                state.studentProfile.notes = response['data'].notes;
                state.studentProfile.id = response['data'].student_id;
            })
            .catch(e => {
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

    UPDATE_IMAGE_PRIORITY: function (state, payload) {
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
            notes: null
        };

        state.profileErrors = null;
    },

    CLEAR_PROFILE_ERRORS: function (state) {
        state.profileErrors = null;
    }
}
