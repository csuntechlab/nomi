<template>
    <div>
        <name-toggle-button></name-toggle-button>
        <descending-toggle-button></descending-toggle-button>
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
    import nameToggleButton from "./nameToggleButton"
    import descendingToggleButton from "./descendingToggleButton"
    import courseBrand from "./courseBrand"
    export default {
        name: "roster-container",

        components: {
            studentMatrix,
            studentList,
            nameToggleButton,
            descendingToggleButton,
            courseBrand
        },

        computed: {
            ...mapGetters([
                'list',
                'courseid',
                'courseTitle'
            ])
        }
    }
</script>
