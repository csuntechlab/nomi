export default {
    courses: state => state.courses,
    flashroster: state => state.flashroster,
    list: state => state.list,
    flash: state => state.flash,
    menuShow: state => state.menuShow,

    facultyMember: state => state.facultyMember,
    faculty_email: state => state.facultyMember.email,
    faculty_name: state => state.facultyMember.emailURI,
    faculty_profile: state => state.facultyMember.profile,
    faculty_first_name: state => state.facultyMember.firstName,
    faculty_last_name: state => state.facultyMember.lastName,
    faculty_full_name: state => state.facultyMember.firstName + " " + state.facultyMember.lastName,
    faculty_profile_image: state => state.facultyMember.image,
}