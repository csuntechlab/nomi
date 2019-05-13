export default {
  // General
  getOnlyTerms(context, response) {
    context.commit('GET_TERMS', response.terms);
  },

  getOnlyCourses(context) {
    window.axios.get(`courses/${context.state.term[context.state.selectedTerm].term}`)
        .then((response) => context.commit('GET_COURSES', response))
        .catch((error) => context.commit('API_FAILURE', error));
  },

  getOnlyRoster(context, response) {
    window.axios.get(`roster/${context.state.term[context.state.selectedTerm].term}/${response.course}`)
        .then((response) => {context.commit('GET_ROSTER', response); context.commit('SORT_ROSTER');})
        .catch((error) => context.commit('API_FAILURE', error));
  },

  getOnlyFacultyProfile(context, response) {
    context.commit('GET_FACULTY_PROFILE', response.profile);
  },

  getOnlySettings(context) {
    window.axios.get('get-settings')
      .then((response) => {
        context.commit('GET_SETTINGS', response);
      }).catch((error) => {
        context.commit('API_FAILURE', error);
      });
  },

  clearCourses(context) {
    context.commit('CLEAR_COURSES');
  },

  clearErrors(context) {
    context.commit('CLEAR_ERRORS');
  },

  clearRoster(context) {
    context.commit('CLEAR_ROSTER');
  },

  toggleMenu(context) {
    context.commit('TOGGLE_MENU');
  },

  handlePermissionResponse(context, payload) {
    context.commit('HANDLE_PERMISSION_RESPONSE', payload);
  },

  nullifyPermissionResponse(context) {
    context.commit('NULLIFY_PERMISSION_RESPONSE');
  },

  getUploadPermission(context, payload) {
    window.axios.get('get-upload-permission')
      .then((response) => {
        context.commit('GET_UPLOAD_PERMISSION', response.data.permission);
      })
      .catch((error) => {
        context.commit('API_FAILURE', error);
      });
  },

  storePermission(context, payload) {
    window.axios.post('store-permission')
      .then((response) => {
        context.commit('STORE_PERMISSION', response);
      })
      .catch((error) => {
        context.commit('API_FAILURE', error);
      });
  },

  nullifyCourse(context) {
    context.commit('NULLIFY_COURSE');
  },

  updateStudentPriority(context, payload) {
    context.commit('UPDATE_STUDENT_PRIORITY', payload);
  },
  // Views & Sorting
  setList(context) {
    context.commit('SET_LIST');
  },

  setGallery(context) {
    context.commit('SET_GALLERY');
  },

  setFlash(context) {
    context.commit('SET_FLASH');
  },

  shuffleFlash(context) {
    context.commit('SHUFFLE_FLASH');
  },

  sortFirstName(context) {
    context.commit('SORT_FIRST_NAME');
    context.commit('SORT_ROSTER');
  },

  sortLastName(context) {
    context.commit('SORT_LAST_NAME');
    context.commit('SORT_ROSTER');
  },

  sortDescending(context) {
    context.commit('SORT_DSC');
    context.commit('SORT_ROSTER');
  },

  sortAscending(context) {
    context.commit('SORT_ASC');
    context.commit('SORT_ROSTER');
  },

  // Back Button
  hideBackButton(context) {
    context.commit('HIDE_BACK_BUTTON');
  },

  showBackButton(context) {
    context.commit('SHOW_BACK_BUTTON');
  },

  disableBackButton(context) {
    context.commit('DISABLE_BACK_BUTTON');
  },

  enableBackButton(context) {
    context.commit('ENABLE_BACK_BUTTON');
  },

  // Courses
  setTerm(context, payload) {
    context.commit('SET_TERM', payload.term);
  },

  loadingClassesTrue(context) {
    context.commit('SET_CLASS_IS_LOADING');
  },

  doneLoadingClasses(context) {
    context.commit('SET_CLASS_DONE_LOADING');
  },

  storeCourse(context, payload) {
    context.commit('STORE_COURSE', payload);
  },

  storeLocation(context, payload) {
    context.commit('STORE_LOCATION', payload);
  },

  setSem(context) {
    context.commit('SET_SEM');
  },

  startUploadFeedback(context) {
    context.commit('START_UPLOAD_FEEDBACK');
  },

  stopUploadFeedback(context) {
    context.commit('STOP_UPLOAD_FEEDBACK');
  },

  updatedImage (context, payload) {
    context.commit('UPDATED_IMAGE', payload);
  }
};
