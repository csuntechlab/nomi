export default {
    getFacultyProfile (context, payload) {
        context.commit('GET_FACULTY_PROFILE', payload);
    },
}