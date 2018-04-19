export default {
    getData (context) {
        context.commit('GET_DATA');
    },

    toggleList (context) {
        context.commit('TOGGLE_LIST');
    },

    toggleFlash (context) {
        context.commit('TOGGLE_FLASH');
    },

    toggleMenu (context) {
        context.commit('TOGGLE_MENU');
    },

    shuffleFlash (context, payload) {
        context.commit('SHUFFLE_FLASH', payload);
    },

    sortFirstName (context) {
        context.commit('SORT_FIRST_NAME');
        context.commit('SORT_ROSTER');
    },

    sortLastName (context) {
        context.commit('SORT_LAST_NAME');
        context.commit('SORT_ROSTER');
    },

    sortDescending (context) {
        context.commit('SORT_DESC');
        context.commit('SORT_ROSTER');
    },

    sortAscending (context) {
        context.commit('SORT_ASC');
        context.commit('SORT_ROSTER');
    },

    getCourseId (context, payload) {
        context.commit('GET_COURSE_ID', payload);
    },
}