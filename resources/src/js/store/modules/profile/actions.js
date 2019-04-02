export default {
    getStudentProfile (context, payload) {
        window.axios.get('student-profile/'+ payload.email)
            .then(payload => {
                context.commit('GET_STUDENT_PROFILE', payload)
            })
            .catch(error => {
                context.commit('API_STUDENT_FAILURE', error)
            });
    },

    getStudentProfileNoEmail (context, payload) {
        window.axios.post('/student-profile-alternative', {
            student_id: payload.id,
            first_name: payload.first_name,
            last_name: payload.last_name
        })
            .then(payload => {
                context.commit('GET_STUDENT_PROFILE_NO_EMAIL', payload)
            })
            .catch(error => {
                context.commit('API_STUDENT_FAILURE', error)
            });
    },

    updateNotes (context, notes) {
        context.commit('UPDATE_NOTES', notes)
    },

    commitNotes (context) {
        let data = new FormData;
        data.append('student_id', context.state.studentProfile.id);
        data.append('notepad', context.state.studentProfile.notes);

        window.axios.post('update_note', data)
            .catch(error => {
                context.commit("API_FAILURE", error)
            });
    },

    updateImagePriority (context, payload) {
        const data = new FormData();
        data.append('student_id', payload.student_id);
        data.append('image_priority', payload.image_priority);
        data.append('term', payload.term);
        data.append('faculty_id', payload.faculty_id);
        window.axios.post('api/priority', data)
            .then(response => {
                context.commit('UPDATE_IMAGE_PRIORITY', payload.image_priority)
            })
            .catch(error => {
                context.commit('API_FAILURE', error)
            });
    },

    nullifyStudentProfile (context) {
        context.commit('NULLIFY_STUDENT_PROFILE')
    },

    clearProfileErrors (context) {
        context.commit('CLEAR_PROFILE_ERRORS')
    },

    //modal specific
    toggleModal (context, payload) {
        context.commit("TOGGLE_MODAL", payload)
    },

    dataForModal (context, payload){
        context.commit("DATA_FOR_MODAL", payload)
    },

    //back button
    setStudent (context, payload) {
        context.commit("SET_STUDENT", payload)
    },

    //cropping functionality
    toggleCropping (context, payload) {
        context.commit('TOGGLE_CROPPING', payload)
    }
}
