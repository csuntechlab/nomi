<template>
    <div>
        <div class="container type--center margin_between_containers">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <profile-notes :student="student"></profile-notes>
                        <br>
                        <div class="type--left profile_email" @click="showEmail = true">
                            <i class="fas fa-envelope"></i>
                            <a class="profile_email_text">Show Email</a>
                        </div>
                        <div class="type--left">
                            <strong>Bio:</strong>
                            <p v-if="this.student.bio == null" class="text_italic display_inline"> Pending biography from student.</p>
                            <p v-else class="display_inline"> {{this.student.bio}}</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <email-modal :showEmail="this.showEmail" :email="this.student.emailURI" @closeEmail="showEmail = false"></email-modal>
    </div>
</template>
<script>
    import emailModal from "../profile_components/emailModal.vue";
    import profileNotes from "../profile_components/profileNotes.vue";
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
            emailModal
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