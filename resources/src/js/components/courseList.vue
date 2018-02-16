<template>
    <div v-if="show">
        <h1>Course List</h1>
        <ul class="list">
        <!--for loop through array objects-->
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

        mounted () {
            /** Transform prop into attribute */
            this.courses = JSON.parse(this.coursesjson);
        },

        data: function () {
            return {
                courses: [],
                show: false,
                messages: true,
                errors: [],
            }
        },

        props: ['coursesjson'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>
