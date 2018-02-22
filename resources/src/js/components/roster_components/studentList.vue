<template>
    <div v-if="show">
        <h1>Student List</h1>
        <ul class="list">
            <student-list-item v-for="student in this.roster" :key="student.display_name" :student="student"></student-list-item>
        </ul>
    </div>
</template>

<script>
    import studentListItem from './studentListItem.vue';
    export default {
        name: "student-list",

        created () {
            /** Creates listener for toggleView event, applying method on event. */
            this.$eventBus.$on('toggleView', function () {
                this.toggleViewHandler();
            }.bind(this));
        },

        data: function () {
            return {
                show: true,
                messages: true,
                errors: [],
            }
        },

        components: {
            studentListItem
        },

        props: ['roster'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>
