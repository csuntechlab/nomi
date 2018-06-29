<template>
    <div>
        <textarea type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes"></textarea>
        <div v-if="noteSaved">Notes Saved!</div>
        <div v-if="unsavedChanges">There are unsaved changes.</div>
        <div class="clearPadding">
            <button class="btn btn-default" @click.prevent="commitNotes">Save Notes</button>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'profile-notes',

        props: ['student'],

        data: function () {
            return {
                unsavedChanges: false,
                noteSaved: false,
                showEmail: false,
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