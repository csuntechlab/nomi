<template>
<div>
    <div class="container type--center margin_between_containers">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <textarea type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes"></textarea>
                    <div v-if="noteSaved">Notes Saved!</div>
                    <div v-if="unsavedChanges">There are unsaved changes.</div>
                    <div class="clearPadding">
                        <button class="btn btn-default" @click.prevent="commitNotes">Save Notes</button>
                    </div>
                    <br>
                    <div class="type--center btn_padding">
                        <button class="btn btn-default" @click="showEmail = true">Show Email</button>
                        <br>
                    </div>
                    <br>
                    <h4>Bio: {{this.student.bio}}</h4>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <email-modal :showEmail="this.showEmail" :email="this.student.emailURI" @closeEmail="showEmail = false"></email-modal>
</div>
</template>
<script>
    import emailModal from "../profile_components/emailModal.vue";
    export default {
        name: "profile-info",
        props: [
            'student'
        ],
        data: function () {
            return {
                unsavedChanges: false,
                noteSaved: false,
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
        methods: {
            updateNotes(e) {
                this.$store.dispatch('updateNotes', e.target.value)
                    .then(() => {
                        this.noteSaved = false;
                        this.unsavedChanges = true;
                    });
            },
            commitNotes() {
                this.$store.dispatch('commitNotes')
                    .then(() => {
                        this.noteSaved = true;
                        this.unsavedChanges = false;
                    });
            },
        }
    }
</script>