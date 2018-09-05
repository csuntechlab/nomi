export default {
    API_FAILURE (state, payload) {
        state.profileErrors = payload.response.data.message;
    },

    API_STUDENT_FAILURE (state, payload)  {
        state.profileLoadError = true;
        state.profileErrors = payload.response.data.message;
    },

    GET_STUDENT_PROFILE: function (state, {payload, getters, response}) {
        let email = response.uri+'@my.csun.edu';
        let data = new FormData;

        data.append('faculty_id', response.faculty_id);
        data.append('email', email);

        state.studentProfile.emailURI = payload['data'].uri;
        state.studentProfile.displayName = payload['data'].display_name;
        state.studentProfile.imagePriority = payload['data'].image_priority;
        state.studentProfile.notes = payload['data'].notes;
        state.studentProfile.id = payload['data'].student_id;
        state.studentProfile.firstName = payload['data'].first_name;
        for(var student in getters.students) {
            if(getters.students.hasOwnProperty(student)) {
                if(getters.students[student].email == email) {
                    state.studentProfile.student = getters.students[student];
                    state.studentProfile.images = getters.students[student].images;
                    break;
                }
            }
        }
    },

    GET_STUDENT_BIO (state, payload) {
        state.studentProfile.bio = payload['data']['people'].biography;
    },

    UPDATE_NOTES: function (state, notes) {
        state.studentProfile.notes = notes;
    },

    COMMIT_NOTES: function (state) {
        let data = new FormData;
        data.append('student_id', state.studentProfile.id);
        data.append('notepad', state.studentProfile.notes);
    },

    UPDATE_IMAGE_PRIORITY: function (state, payload, rootState) {
        let data = new FormData;
        data.append('student_id', state.studentProfile.id);
        data.append('image_priority', payload.image_priority);
        data.append('faculty_id', payload.faculty_id); 
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
