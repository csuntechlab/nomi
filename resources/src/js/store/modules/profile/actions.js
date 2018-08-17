export default {
    getStudentProfile (context, payload) {
        var getters = context.getters
        context.commit('GET_STUDENT_PROFILE', {payload, getters});
    },

    updateNotes (context, notes) {
        context.commit('UPDATE_NOTES', notes);
    },

    commitNotes (context) {
        context.commit('COMMIT_NOTES');
    },

    updateImagePriority (context, payload) {
        context.commit('UPDATE_IMAGE_PRIORITY', payload);
    },

    nullifyStudentProfile (context) {
        context.commit('NULLIFY_STUDENT_PROFILE');
    },

    clearProfileErrors (context) {
        context.commit('CLEAR_PROFILE_ERRORS');
    }
}