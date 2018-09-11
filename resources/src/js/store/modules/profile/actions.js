export default {
    getStudentProfile (context, payload) {
        let response = payload
        let email = payload.uri+'@my.csun.edu'
        
        window.axios.get('student_profile/'+email)
            .then(payload => {
                var getters = context.getters
                context.commit('GET_STUDENT_PROFILE', {payload, getters, response})
                context.commit('GET_STUDENT_BIO', response)
            })
            .catch(error => {
                context.commit('API_STUDENT_FAILURE', error)
            });
    },

    updateNotes (context, notes) {
        context.commit('UPDATE_NOTES', notes)
    },

    commitNotes (context) {
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

    storeStudent (context, payload) {
        context.commit('STORE_STUDENT', payload)
    },

    clearStudent (context) {
        context.commit('CLEAR_STUDENT')
    }
}