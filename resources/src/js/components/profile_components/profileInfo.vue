<template>
    <div class="container type--center margin_between_containers">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <textarea type="text" id="ex0" name="ex0" :value="this.studentNotes" @input="updateNotes"></textarea>
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
                    <h4>Bio: {{this.studentBio}}</h4>
                    <br>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "profile-info",

        props: [
            'studentBio',
            'studentNotes'
        ],

        data: function () {
            return {
                unsavedChanges: false,
                noteSaved: false,
            }
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
        computed: {
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