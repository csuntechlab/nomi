export default {

    // General
    courses: state => state.courses,
    studentImages: state => state.studentImages,
    menuShow: state => state.menuShow,
    errors: state => state.errors,

    // Back Button
    hideBack: state => state.hideBack,
    disableBack: state => state.disableBack,

    // Themes
    themeName: state => state.themeName,

    // Views & Sorting
    flashroster: state => state.flashroster,
    list: state => state.list,
    flash: state => state.flash,
    sortLastName: state => state.sortLastName,
    sortDescending: state => state.sortDescending,
    semester: state => state.semester,
    termYear: state => state.termYear,
    term: state => state.term,
    loadingClasses: state => state.loadingClasses,
    permission: state => state.imagePermission,

    // User
    facultyMember: state => state.facultyMember,
    facultyFullName: state => state.facultyMember.firstName + " " + state.facultyMember.lastName,
}