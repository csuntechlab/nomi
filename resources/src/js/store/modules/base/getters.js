export default {
    courses: state => state.courses,
    flashroster: state => state.flashroster,
    studentImages: state => state.studentImages,
    list: state => state.list,
    flash: state => state.flash,
    menuShow: state => state.menuShow,
    errors: state => state.errors,
    hideBack: state => state.hideBack,
    themeName: state => state.themeName,

    facultyMember: state => state.facultyMember,
    facultyFullName: state => state.facultyMember.firstName + " " + state.facultyMember.lastName,
}