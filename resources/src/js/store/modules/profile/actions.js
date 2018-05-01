export default {
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
    },

    nullifyStudentProfile (context) {
        context.commit('NULLIFY_STUDENT_PROFILE');
    }
}