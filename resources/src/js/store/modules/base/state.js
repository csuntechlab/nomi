export default {
  // General
  courses: [],
  flashroster: [],
  errors: null,
  imagePermission: true,
  displaySideMenu: false,
  currentLocation: 'home',
  students: [],
  uploadFeedback: false,
  isPhotoUpdated: false,

  // Views & Sorting
  list: true,
  flash: false,
  sortLastName: false,
  sortAscending: true,

  // Themes
  themeName: { theme: 'theme-matadorTheme' },

  // Back Button
  hideBack: true,
  disableBack: false,

  // Courses
  semester: null,
  termYear: null,
  term: null,
  selectedTerm: 'current',
  loadingClasses: true,
  currentCourse: null,

  // User Info
  facultyMember: {
    email: null,
    emailURI: null,
    profile: null,
    firstName: null,
    lastName: null,
    image: null,
    id: null,
  },
};
