<template>
    <div>
        <div class="profile-info-container type--center margin-between-containers">
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile_email">
                        <div v-if="this.showEmail">
                            <i class="fas fa-envelope" @click="showEmail = true"></i>
                            {{this.student.student.email}}
                        </div>
                    </div>
                    <div>
                        <span v-if="this.student.bio != null" class="text_italic display-inline">
                            <strong>About {{this.student.firstName}}:</strong>
                            {{this.student.bio}}
                        </span>
                        <span v-else></span>
                    </div>
                    <profile-notes class="profile-notes-padding" :student="student" @unsavedChanges="sendUnsavedChanges" @committedChanges="sendChanges"></profile-notes>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import profileNotes from './profileNotes.vue';
import profilePicture from './profilePicture.vue';

export default {
    name: 'profile-info',
    props: [
        'student',
    ],

    data() {
        return {
            showEmail: false,
        };
    },

    mounted() {
        let emailSplit = this.student.student.email.split("@")[1];
        if (emailSplit === "NOTREALEMAIL.net") {
            this.showEmail = false;
        }
    },

    components: {
        profileNotes,
        profilePicture,
    },
    methods: {
        sendUnsavedChanges() {
        this.$emit('unsavedChanges');
        },
        sendChanges() {
        this.$emit('committedChanges');
        },
    },
};
</script>