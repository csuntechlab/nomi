export default {
    getStudentProfile (context, payload) {
        let response = payload;
        let email = payload.email;
        let emailSplit = email.split('@');
        if (emailSplit[1] === "NOTREALEMAIL.net") {
            window.axios.get('/student_profile/'+ payload.first_name +'/'+ payload.last_name, {
                student_id: payload.id,
                first_name: payload.first_name,
                last_name: payload.last_name
            })
                .then(payload => {
                    var getters = context.getters
                    context.commit('GET_STUDENT_PROFILE', {payload, getters, response})
                    context.commit('GET_STUDENT_BIO', payload)
                })
                .catch(error => {
                    context.commit('API_STUDENT_FAILURE', error)
                });
        } else {
            window.axios.get('student_profile/'+email)
                .then(payload => {
                    var getters = context.getters
                    context.commit('GET_STUDENT_PROFILE', {payload, getters, response})
                    context.commit('GET_STUDENT_BIO', payload)
                })
                .catch(error => {
                    context.commit('API_STUDENT_FAILURE', error)
                });
        }
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

    updateImagePriority (context) {
        window.axios.post('api/priority', data)
            .then(response => {
                context.commit('UPDATE_IMAGE_PRIORITY', response)
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
    getStudent (context, payload) {
        context.commit("GET_STUDENT", payload)
    },

    storeStudent (context, payload) {
        context.commit('STORE_STUDENT', payload)
    },

    clearStudent (context) {
        context.commit('CLEAR_STUDENT')
    },

    //cropping functionality
    toggleCropping (context, payload) {
        context.commit('TOGGLE_CROPPING', payload)
    }
}
