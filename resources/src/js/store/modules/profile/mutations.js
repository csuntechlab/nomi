export default {
  API_FAILURE(state, payload) {
    state.profileErrors = payload.response.data.message;
  },

  API_STUDENT_FAILURE(state, payload) {
    state.profileLoadError = true;
    state.profileErrors = payload.response.data.message;
  },

  GET_STUDENT_PROFILE(state, payload) {
    state.studentProfile.bio = payload.data.bio;
    state.studentProfile.notes = payload.data.notes;
  },

  GET_STUDENT_PROFILE_NO_EMAIL(state, payload) {
    state.studentProfile.bio = payload.data.bio;
    state.studentProfile.notes = payload.data.notes;
  },

  GET_STUDENT_BIO(state, payload) {
    state.studentProfile.bio = payload.data.bio;
  },

  UPDATE_NOTES(state, notes) {
    state.studentProfile.notes = notes;
  },

  UPDATE_IMAGE_PRIORITY(state, payload) {
    state.studentProfile.imagePriority = payload;
  },

  NULLIFY_STUDENT_PROFILE(state) {
    state.studentProfile = {
      id: null,
      email: null,
      emailURI: null,
      displayName: null,
      bio: null,
      image: null,
      imagePriority: null,
      notes: null,
      firstName: null,
      lastName: null,
    };

    state.profileErrors = null;
  },

  CLEAR_PROFILE_ERRORS(state) {
    state.profileErrors = null;
    state.profileLoadError = false;
  },

    //Modal Specific
    TOGGLE_MODAL (state, payload){
        state.modalVisible = payload;
    },

    DATA_FOR_MODAL (state, payload){
        state.modalData = payload;
    },

    //toggle cropping functionality
    TOGGLE_CROPPING (state, payload) {
        state.toggleCroppa = payload;
    },

    SET_STUDENT (state, payload) {
      state.studentProfile.id = payload.student_id;
      state.studentProfile.email = payload.email;
      state.studentProfile.emailURI = payload.email_uri;
      state.studentProfile.images = payload.images;
      state.studentProfile.imagePriority = payload.image_priority;
      state.studentProfile.firstName = payload.first_name;
      state.studentProfile.lastName = payload.last_name;
      state.studentProfile.displayName = payload.display_name;
    },
};
