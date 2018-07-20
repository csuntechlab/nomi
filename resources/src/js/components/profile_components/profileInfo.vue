<template>
    <div>
        <div class="profile_info_container type--center margin_between_containers">
            <div class="row">
                <div class="col-sm-12">
                    <profile-notes class="profile_notes_padding" :student="student"></profile-notes>
                    <div class="type--left profile_email">
                        <i class="fas fa-envelope" @click="showEmail = true"></i>
                        <a class="profile_email_text" @click="showEmail = true">Show Email</a>
                    </div>
                    <div class="type--left">
                        <strong>Bio:</strong>
                        <span v-if="this.student.bio == null" class="text_italic display_inline"> Pending biography from student.</span>
                        <span v-else> {{this.student.bio}}</span>
                    </div>
                </div>
            </div>
        </div>
        <email-modal :showEmail="this.showEmail" :email="this.student.emailURI" @closeEmail="showEmail = false"></email-modal>
    </div>
</template>
<script>
    import emailModal from "./emailModal.vue";
    import profileNotes from "./profileNotes.vue";
    import profilePicture from "./profilePicture.vue";
    export default {
        name: "profile-info",
        props: [
            'student'
        ],
        data: function () {
            return {
                showEmail: false,
            }
        },
        components: {
            emailModal,
            profileNotes,
            profilePicture
        },
        beforeRouteLeave(to, from, next) {
            if (this.unsavedChanges) {
                const answer = window.confirm('Do you really want to leave? You have unsaved changes.');

                if (answer) {
                    next();
                } else {
                    next(false);
                }
            } else {
                next();
            }
        },
    }
</script>