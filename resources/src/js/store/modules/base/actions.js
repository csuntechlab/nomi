export default {
    getData (context) {
        context.commit('GET_SETTINGS');
        context.commit('GET_DATA');
    },
    
    setList (context) {
        context.commit('SET_LIST');
    },

    setGallery (context) {
        context.commit('SET_GALLERY');
    },

    setFlash (context) {
        context.commit('SET_FLASH');
    },

    toggleMenu (context) {
        context.commit('TOGGLE_MENU');
    },

    shuffleFlash (context) {
        context.commit('SHUFFLE_FLASH');
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

    clearErrors (context) {
        context.commit('CLEAR_ERRORS');
    },

    hideBackButton (context) {
        context.commit('HIDE_BACK_BUTTON');
    },

    showBackButton (context) {
        context.commit('SHOW_BACK_BUTTON');
    },

    updateImage (context, payload) {
        context.commit('UPDATE_IMAGE', payload);
    },
}