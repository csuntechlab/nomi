<template>
    <div v-if="show">
        <h1>Student List</h1>
        <ul class="list">
            <student-list-item v-for="student in students" :key="student.display_name" :student="student"></student-list-item>
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

        mounted () {
            /** Transform prop into attribute */
            this.students = JSON.parse(this.studentsjson);
        },

        data: function () {
            return {
                students: [],
                show: false,
                messages: true,
                errors: [],
            }
        },

        components: {
            studentListItem
        },

        props: ['studentsjson'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>
