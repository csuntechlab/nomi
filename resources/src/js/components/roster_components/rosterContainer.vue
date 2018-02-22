<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <student-matrix :roster="roster"></student-matrix>
        <student-list :roster="roster"></student-list>
    </div>
</template>

<script>
    import studentMatrix from "./studentMatrix"
    import studentList from "./studentList"
    export default {
        name: "roster-container",

        props: [ 'roster' ],

        components: {
            studentMatrix,
            studentList
        }
    }
</script>
