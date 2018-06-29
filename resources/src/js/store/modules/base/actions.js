export default {
    getAllUserData (context) {
        context.commit('GET_SETTINGS');
        context.commit('GET_DATA');
    },

    getOnlyData (context) {
        context.commit('GET_DATA');
    },
    
    getOnlySettings (context) {
        context.commit('GET_SETTINGS');
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
        context.commit('SORT_DSC');
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

    setSpring (context) {
        context.commit('SET_SPRING');
    },

    setSummer (context) {
        context.commit('SET_SUMMER');
    },

    setFall (context) {
        context.commit('SET_FALL');
    },

    setWinter (context) {
        context.commit('SET_WINTER');
    },

    setTermYear (context, payload) {
        context.commit('SET_TERM_YEAR', payload);
    },

    loadingClassesTrue(context){
        context.commit('SET_CLASS_IS_LOADING');
    },

    doneLoadingClasses(context){
        context.commit('SET_CLASS_DONE_LOADING');
    },
}