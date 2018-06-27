<template>
    <div>
        <modal v-if="showModal" @close="setImgUrl">
            <div slot="header"></div>
            <div slot="body">
                <croppa-profile :studentImage="studentProfile.images['likeness']"></croppa-profile>
            </div>
        </modal>
    </div>
</template>
<script>
    export default {
        name: "profile-info",

        props: [
            'showModal',
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