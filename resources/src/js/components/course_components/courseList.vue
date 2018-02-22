<template>
    <div v-if="show">
        <h1>Course List</h1>
        <ul class="list">
            <li class="list__item" v-for="course in this.courses"><a href="#">{{ course.title }}</a></li>
        </ul>
    </div>
</template>

<script>
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

        props: ['courses'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>
