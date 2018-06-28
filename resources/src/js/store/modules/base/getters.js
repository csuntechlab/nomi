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

    // User
    facultyMember: state => state.facultyMember,
    facultyFullName: state => state.facultyMember.firstName + " " + state.facultyMember.lastName,
}