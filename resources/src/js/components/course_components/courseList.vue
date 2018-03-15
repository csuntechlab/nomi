<template>
    <div v-if="show">
        <h1>Course List</h1>
        <ul class="list">
            <course-list-item v-for="course in this.courses" :key="course.title" :course="course"></course-list-item>
        </ul>
    </div>
</template>

<script>
    import courseListItem from './courseListItem.vue'
    export default {
        name: "course-list",

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
            courseListItem
        },

        props: ['courses'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>
