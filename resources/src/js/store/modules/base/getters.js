export default {
    courses: state => state.courses,
    flashroster: state => state.flashroster,
    list: state => state.list,
    flash: state => state.flash,
    menuShow: state => state.menuShow,

    facultyMember: state => state.facultyMember,
    facultyFullName: state => state.facultyMember.firstName + " " + state.facultyMember.lastName,
}