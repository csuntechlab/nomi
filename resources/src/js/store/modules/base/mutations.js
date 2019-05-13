import lodash from 'lodash';
export default {
  API_FAILURE(state, payload) {
    state.errors = payload.response.data.message;
  },

  GET_SETTINGS(state, payload) {
    state.themeName = payload.data;
    document.getElementById('app').className = state.themeName.theme;
    document.getElementById('mainBody').className = state.themeName.theme;
  },

  GET_TERMS(state, terms) {
    state.term = terms;
  },

  GET_COURSES(state, payload) {
    state.courses = payload.data.courses;
    state.loadingClasses = false;
  },

  GET_ROSTER(state, payload) {
    state.students = payload.data.allStudents;
    state.flashroster = payload.data.students;
    state.loadingClasses = false;
  },

  GET_FACULTY_PROFILE(state, profile) {
    state.facultyMember.id = profile.user_id;
    state.facultyMember.email = profile.email;
    state.facultyMember.image = profile.image;
    state.facultyMember.emailURI = profile.email_uri;
    state.facultyMember.firstName = profile.first_name;
    state.facultyMember.lastName = profile.last_name;
  },

  UPDATE_STUDENT_PRIORITY(state, payload) {
    state.students[state.currentCourse] = lodash.forEach(state.students[state.currentCourse], (student) => {
      if (student.student_id === payload.student_id) {
        student.image_priority = payload.image_priority;
      }
    });

    state.flashroster[state.currentCourse] = lodash.forEach(state.flashroster[state.currentCourse], (student) => {
      if (student.student_id === payload.student_id) {
        student.image_priority = payload.image_priority;
      }
    });
  },

  STORE_COURSE(state, payload) {
    state.currentCourse = payload;
  },

  STORE_LOCATION(state, payload) {
    state.currentLocation = payload;
  },

  SET_LIST(state) {
    state.list = true;
    state.flash = false;
  },

  SET_GALLERY(state) {
    state.list = false;
    state.flash = false;
  },

  SET_FLASH(state) {
    state.list = false;
    state.flash = true;
  },

  TOGGLE_MENU(state) {
    state.displaySideMenu = !state.displaySideMenu;
  },

  SHUFFLE_FLASH(state) {
    function shuffle(students) {
      let currentIndex = students.length; let temporaryValue; let
        randomIndex;

      // While there remain elements to shuffle...
      while (currentIndex !== 0) {
        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = students[currentIndex];
        students[currentIndex] = students[randomIndex];
        students[randomIndex] = temporaryValue;
      }
    }
    const len = state.flashroster[state.currentCourse].length;

    for (let i = 0; i < len; ++i) {
      const unKnownStudents = [];
      const knownStudents = [];

      Object.entries(state.flashroster[state.currentCourse]).forEach(([key, value]) => {
        if (value.recognized === true) {
          knownStudents.push(value);
        } else {
          unKnownStudents.push(value);
        }
      });

      shuffle(unKnownStudents);
      shuffle(knownStudents);

      state.flashroster[state.currentCourse] = unKnownStudents.concat(knownStudents);
    }
    state.flash = true;
  },

  SORT_ROSTER(state) {
    if (state.sortAscending === true) {
        if (state.sortLastName === true) {
          state.students[state.currentCourse] = lodash.orderBy(state.students[state.currentCourse], ['last_name'], ['asc']);
        } else {
          state.students[state.currentCourse] = lodash.orderBy(state.students[state.currentCourse], ['first_name'], ['asc']);
        }
    } else {
        if (state.sortLastName === false) {
          state.students[state.currentCourse] = lodash.orderBy(state.students[state.currentCourse], ['first_name'], ['desc']);
        } else {
          state.students[state.currentCourse] = lodash.orderBy(state.students[state.currentCourse], ['last_name'], ['desc']);
        }
    }
  },

  SORT_FIRST_NAME(state) {
    state.sortLastName = false;
  },

  SORT_LAST_NAME(state) {
    state.sortLastName = true;
  },

  SORT_ASC(state) {
    state.sortAscending = true;
  },

  SORT_DSC(state) {
    state.sortAscending = false;
  },

  CLEAR_ERRORS(state) {
    state.errors = null;
  },

  HIDE_BACK_BUTTON(state) {
    state.hideBack = true;
  },

  SHOW_BACK_BUTTON(state) {
    state.hideBack = false;
  },

  DISABLE_BACK_BUTTON(state) {
    state.disableBack = true;
  },

  ENABLE_BACK_BUTTON(state) {
    state.disableBack = false;
  },

  SELECTED_TERM(state, term) {
    state.selectedTerm = term;
  },

  SET_TERM_YEAR(state, payload) {
    state.termYear = payload;
  },

  SET_CLASS_IS_LOADING(state) {
    state.loadingClasses = true;
  },

  SET_CLASS_DONE_LOADING(state) {
    state.loadingClasses = false;
  },

  HANDLE_PERMISSION_RESPONSE(state, payload) {
    state.imagePermission = payload;
  },

  NULLIFY_PERMISSION_RESPONSE(state) {
    state.imagePermission = null;
  },

  GET_UPLOAD_PERMISSION(state, payload) {
    state.imagePermission = payload;
    if (payload == false) {
      state.imagePermission = null;
    }
  },

  STORE_PERMISSION(state, payload) {
    state.imagePermission = true;
  },

  NULLIFY_COURSE(state) {
    state.currentCourse = null;
  },

  SET_TERM(state, term) {
    state.selectedTerm = term;
  },

  START_UPLOAD_FEEDBACK(state) {
    state.uploadFeedback = true;
  },

  STOP_UPLOAD_FEEDBACK(state) {
    state.uploadFeedback = false;
  },

  CLEAR_COURSES(state) {
    state.courses = null;
  },

  CLEAR_ROSTER(state) {
    state.students = null;
    state.flashroster = null;
  },

  UPDATED_IMAGE (state, payload)  {
    state.students[state.currentCourse] = lodash.forEach(state.students[state.currentCourse], function (student) {
      if (student.student_id === payload.student_id) {
        student.images.likeness = payload.image;
      }
    });

    state.flashroster[state.currentCourse] = lodash.forEach(state.flashroster[state.currentCourse], function (student) {
      if (student.student_id === payload.student_id) {
        student.images.likeness = payload.image;
      }
    });
  }
};
