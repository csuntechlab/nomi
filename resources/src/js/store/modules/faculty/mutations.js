export default {
    GET_FACULTY_PROFILE: function (state, payload) {
        axios.get(`faculty_profile/${state.faculty_email}`)
            .then(response => {
                state.faculty_profile_image = response.data;
            })
            .catch(e => {
                console.log(e);
            });
    },
}
