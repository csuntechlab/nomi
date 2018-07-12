<template>
    <div>
        <textarea type="text" id="ex0" name="ex0" :value="this.student.notes" @input="updateNotes" @keyup.enter="updateNotes"></textarea>
        <div class="type--right">
            <span v-if="noteSaved" class="notes_status">Notes Saved!</span>
            <span v-if="unsavedChanges" class="notes_status">Unsaved changes.</span>
            <button class="btn btn-sm btn-default" @click.prevent="commitNotes">Save Notes</button>
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
                characterCount: 600,
            }
        },

        methods: {

            updateNotes(e) {
                let current = this.characterCount - this.student.notes.length
                if (current >= 0) {
                    this.$store.dispatch('updateNotes', e.target.value)
                        .then(() => {
                            this.noteSaved = false;
                            this.unsavedChanges = true;
                        });
                } else {
                    
                }
            },
            commitNotes() {
                this.$store.dispatch('commitNotes')
                    .then(() => {
                        this.noteSaved = true;
                        this.unsavedChanges = false;
                    });
            },
        },
        computed: {
            charactersLeft() {
                let current = this.characterCount - this.student.notes.length
                if(current >= 0){
                    return current
                } else {
                    return 0
                }

            }
        }
    }
</script>