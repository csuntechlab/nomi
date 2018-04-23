<template>
    <div>
        <div v-if="this.list">
            <student-list :courseid="this.courseid"></student-list>
        </div>
        <div v-else>
            <student-matrix :courseid="this.courseid"></student-matrix>
        </div>
    </div>
</template>

<script>
    import studentMatrix from "./studentMatrix"
    import studentList from "./studentList"
    import { mapGetters } from "vuex"
    export default {
        name: "roster-container",

        components: {
            studentMatrix,
            studentList,
        },

        props: [
            'courseid'
        ],

        computed: {
            ...mapGetters([
                'list',
            ])
        }
    }
</script>
