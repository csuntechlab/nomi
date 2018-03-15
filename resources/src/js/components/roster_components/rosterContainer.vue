<template>
    <div>
        <h1>{{this.title}}</h1>
        <toggle-view-button></toggle-view-button>
        <student-list v-if="this.list" :courseid="this.courseid"></student-list>
        <student-matrix v-else :courseid="this.courseid"></student-matrix>
    </div>
</template>

<script>
    import studentMatrix from "./studentMatrix"
    import studentList from "./studentList"
    import { mapGetters } from "vuex"
    export default {
        name: "roster-container",

        props: [ 'title', 'courseid'],

        components: {
            studentMatrix,
            studentList
        },

        computed: {
            ...mapGetters([
                'list'
            ])
        }
    }
</script>
