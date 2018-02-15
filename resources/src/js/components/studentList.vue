<template>
    <div v-if="show">
        <h1>Student List</h1>
        <ul class="list">
        <!--for loop through array objects-->
            <li class="list__item" v-for="student in this.students"><a href="#">{{ student.display_name }}</a></li>
        </ul>
    </div>
</template>

<script>
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

        props: ['studentsjson'],

        methods: {
            toggleViewHandler: function () {
                this.show = !this.show;
            }
        }
    }
</script>
