import initialState from './state.js';

export default {
  API_FAILURE(state, payload) {
    state.errors = payload.response.data.message;
  },

  GET_SETTINGS(state, payload) {
    state.themeName = payload.data;
    document.getElementById('app').className = state.themeName.theme;
    document.getElementById('mainBody').className = state.themeName.theme;
  },

  GET_DATA(state, payload) {
    function capitalize(name) {
      return name.charAt(0).toUpperCase() + name.substr(1);
    }

    state.term = payload.data.term;

    if (state.termYear != null) {
      let chosenTerm = state.termYear + state.semester;
      chosenTerm = chosenTerm.slice(0, 1) + chosenTerm.slice(2);
      state.term = chosenTerm;
    } else {
      state.students = payload.data.allStudents;
    }

    state.term = payload.data.term;
    state.courses = payload.data.courses;
    state.loadingClasses = false;
    state.flashroster = payload.data.students;
    state.facultyMember.email = payload.data.email;
    state.facultyMember.emailURI = state.facultyMember.email.split('@')[0];
    state.facultyMember.profile = `https://api.metalab.csun.edu/media/1.1/faculty/media/${state.facultyMember.name}`;
  },

  GET_FACULTY_PROFILE(state, payload) {
    state.facultyMember.image = 'https://api.sandbox.csun.edu/metalab/media/1.0/' + state.facultyMember.emailURI + '/avatar';
    state.facultyMember.id = payload.data.id;
    state.facultyMember.firstName = payload.data.name_first;
    state.facultyMember.lastName = payload.data.name_last;
  },

  UPDATE_STUDENT_PRIORITY(state, payload) {
    for (let i = 0, len = state.courses.length; i < len; i += 1) {
      for (let j = 0, jLen = state.courses[i].roster.length; j < jLen; j += 1) {
        if (state.courses[i].roster[j].student_id === payload.studentId) {
          state.courses[i].roster[j].image_priority = payload.image_priority;
        }
      }
    }
    for (let i = 0, len = state.flashroster.length; i < len; i += 1) {
      for (let j = 0, jLen = state.flashroster[i].length; j < jLen; j += 1) {
        if (state.flashroster[i][j].student_id === payload.studentId) {
          state.flashroster[i][j].image_priority = payload.image_priority;
        }
      }
    }
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

    const len = state.flashroster.length;

    for (let i = 0; i < len; ++i) {
      const unKnownStudents = [];
      const knownStudents = [];

      state.flashroster[i].forEach((student) => {
        if (student.recognized === true) {
          knownStudents.push(student);
        } else {
          unKnownStudents.push(student);
        }
      });

      shuffle(unKnownStudents);
      shuffle(knownStudents);

      state.flashroster[i] = unKnownStudents.concat(knownStudents);
    }

    state.flash = false;
    state.flash = true;
  },

  SORT_ROSTER(state) {
    const len = state.courses.length;
    for (let i = 0; i < len; ++i) {
      function sortedRoster(self) {
        if (state.sortLastName === true) {
          if (state.sortAscending === true) {
            return self.sort((a, b) => a.last_name.localeCompare(b.last_name));
          }
          return self.sort((a, b) => a.last_name.localeCompare(b.last_name)).reverse();
        }
        if (state.sortAscending === true) {
          return self.sort((a, b) => a.first_name.localeCompare(b.first_name));
        }
        return self.sort((a, b) => a.first_name.localeCompare(b.first_name)).reverse();
      }

      state.courses[i].roster = sortedRoster(state.courses[i].roster);
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

  SET_SPRING(state) {
    state.semester = 3;
  },

  SET_SUMMER(state) {
    state.semester = 5;
  },


  SET_FALL(state) {
    state.semester = 7;
  },

  SET_WINTER(state) {
    state.semester = 9;
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

  SET_PREVIOUS_TERM(state) {
    state.loadingClasses = true;
    state.termYear = state.term.slice(0, 3);
    state.semester = state.term.slice(3);
    if (state.selectedTerm == 'current') {
      state.semester -= 2;
      if (state.semester < 3) {
        state.semester = 9;
        state.termYear -= 1;
      }
    } else if (state.selectedTerm == 'next') {
      state.semester -= 4;
      if (state.semester == 1) {
        state.semester = 9;
        state.termYear -= 1;
      } else if (state.semester == -1) {
        state.semester = 7;
        state.termYear -= 1;
      }
    }
    state.term = `${state.termYear}${state.semester}`;
    state.termYear = `${state.termYear}`;
    state.termYear = state.termYear.slice(0, 1) + 0 + state.termYear.slice(1);
    state.semester = `${state.semester}`;
    state.selectedTerm = 'previous';
  },

  SET_CURRENT_TERM(state) {
    state.loadingClasses = true;
    state.semester = null;
    state.termYear = null;
    state.selectedTerm = 'current';
  },

  SET_NEXT_TERM(state) {
    state.loadingClasses = true;
    state.termYear = parseInt(state.term.slice(0, 3));
    state.semester = parseInt(state.term.slice(3));
    if (state.selectedTerm == 'current') {
      state.semester += 2;
      if (state.semester > 9) {
        state.semester = 3;
        state.termYear += 1;
      }
    } else if (state.selectedTerm == 'previous') {
      state.semester += 4;
      if (state.semester == 11) {
        state.semester = 3;
        state.termYear += 1;
      } else if (state.semester == 13) {
        state.semester = 5;
        state.termYear += 1;
      }
    }
    state.term = `${state.termYear}${state.semester}`;
    state.termYear = `${state.termYear}`;
    state.termYear = state.termYear.slice(0, 1) + 0 + state.termYear.slice(1);
    state.semester = `${state.semester}`;
    state.selectedTerm = 'next';
  },

  SET_SEM(payload) {
    state.selectedTerm = payload;
  },

  START_UPLOAD_FEEDBACK(state) {
    state.uploadFeedback = true;
  },

  STOP_UPLOAD_FEEDBACK(state) {
    state.uploadFeedback = false;
  },
};
