<template>
    <div>
        <textarea type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes" @keyup.enter="updateNotes"></textarea>
        <div class="type--right">
            <span v-if="noteSaved" class="notes_status">Notes Saved!</span>
            <span v-if="unsavedChanges" class="notes_status">Unsaved changes.</span>
            <span class="clearPadding">
                <button class="btn btn-sm btn-default" @click.prevent="commitNotes">Save Notes</button>
            </span>
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