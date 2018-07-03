<template>
    <div>
        <textarea type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes" @keyup.enter="updateNotes"></textarea>
        <div class="row">
                <br v-if="textStatus">
                <span v-if="noteSaved" class="type--right">Notes Saved!</span>
                <span v-if="unsavedChanges" class="type--right">Unsaved changes.</span>
                <div class="clearPadding type--right">
                    <button class="btn btn-sm btn-default" @click.prevent="commitNotes">Save Notes</button>
                </div>
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
                textStatus: true,
            }
        },

        methods: {
            updateNotes(e) {
                this.$store.dispatch('updateNotes', e.target.value)
                    .then(() => {
                        this.noteSaved = false;
                        this.unsavedChanges = true;
                        this.textStatus = false;
                    });
            },
            commitNotes() {
                this.$store.dispatch('commitNotes')
                    .then(() => {
                        this.noteSaved = true;
                        this.unsavedChanges = false;
                        this.textStatus = false;
                    });
            },
        }
    }
</script>