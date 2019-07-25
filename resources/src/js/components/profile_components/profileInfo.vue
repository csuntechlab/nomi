<template>
    <div>
        <div class="profile-info-container type--center">
            <div class="panel profile__info-panel">
                <div class="col-sm-12">
                    <div class="profile_email mt-3">
                        <div v-if="this.showEmail">
                            <i class="fas fa-envelope" @click="showEmail = true"></i>
                            {{this.studentProfile.email}}
                        </div>
                    </div>
                    <div>
                        <span v-if="this.studentProfile.bio != null" class="text_italic display-inline">
                            <strong>About {{this.studentProfile.first_name}}:</strong>
                            {{this.studentProfile.bio}}
                        </span>
                        <span v-else></span>
                    </div>
                    <profile-notes class="profile-notes-padding pb-4" @unsavedChanges="sendUnsavedChanges" @committedChanges="sendChanges"></profile-notes>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import profileNotes from './profileNotes.vue';
import profilePicture from './profilePicture.vue';
import {mapGetters} from 'vuex';
export default {
    name: 'profile-info',
    props: ['student'],

    data() {
        return {
            showEmail: false,
        };
    },

    mounted() {
        let emailSplit = this.studentProfile.email.split("@")[1];
        if (emailSplit === "NOTREALEMAIL.net") {
            this.showEmail = false;
        } else {
            this.showEmail = true;
        }
    },

    computed: {
        ...mapGetters(["studentProfile"])
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