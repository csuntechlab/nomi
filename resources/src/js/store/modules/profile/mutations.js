export default {
    GET_STUDENT_PROFILE: function (state, payload) {
        state.studentProfile.emailURI = payload.uri;
        axios.get('student/'+state.studentProfile.emailURI+'@my.csun.edu')
            .then(response => {
                state.studentProfile.bio = response['data']['people'].biography;

                if(state.studentProfile.bio === null)
                    state.studentProfile.bio = "Pending biography from student.";
            })
            .catch(e => {
                console.log(e);
            });

        axios.get('student_profile/'+state.studentProfile.emailURI+'@my.csun.edu')
            .then(response => {
                state.studentProfile.display_name = response['data'].display_name;
                state.studentProfile.images = response['data'].images;
                state.studentProfile.image_priority = response['data'].image_priority;
                state.studentProfile.notes = response['data'].notes;
                state.studentProfile.student_id = response['data'].student_id;
            })
            .catch(e => {
                console.log(e);
            });
    },

    UPDATE_NOTES: function (state, notes) {
        state.sp_notes = notes;
    },

    COMMIT_NOTES: function (state) {
        let data = new FormData;
        data.append('student_id', state.sp_student_id);
        data.append('notepad', state.sp_notes);

        axios.post('update_note', data)
            .catch(e => {
                console.log(e)
            });
    },

    UPDATE_IMAGE_PRIORITY: function (state, payload) {
        let data = new FormData;
        data.append('student_id', state.sp_student_id.replace("members:", ""));
        data.append('image_priority', payload.image_priority);

        axios.post('api/priority', data)
            .then(response => {
                state.sp_image_priority = payload.image_priority;
            })
            .catch(e => {
                console.log(e)
            });
    }
}
