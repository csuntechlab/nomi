<template>
    <div>
        <div class="profile_info_container type--center margin_between_containers">
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile_email">
                        <i class="fas fa-envelope" @click="showEmail = true"></i>
                        <a class="profile_email_text" @click="showEmail = true">Show Email</a>
                    </div>
                    <div>
                        <strong>Bio:</strong>
                        <span v-if="this.student.bio == null" class="text_italic display_inline"> Pending biography from student.</span>
                        <span v-else> {{this.student.bio}}</span>
                    </div>
                    <profile-notes class="profile_notes_padding" :student="student" @unsavedChanges="sendUnsavedChanges" @committedChanges="sendChanges"></profile-notes>
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
        methods: {
            sendUnsavedChanges(){
                this.$emit('unsavedChanges');
            },
            sendChanges(){
                this.$emit('committedChanges');
            }
        }
    }
</script>