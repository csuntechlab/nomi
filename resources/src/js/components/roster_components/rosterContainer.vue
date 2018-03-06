<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <sort-toggle-button></sort-toggle-button>
        <h1>{{this.title}}</h1>
        <student-matrix :roster="roster" :students="roster"></student-matrix>
        <student-list :roster="roster"></student-list>
    </div>
</template>

<script>
    import studentMatrix from "./studentMatrix"
    import studentList from "./studentList"
    import SortToggleButton from "./sortToggleButton";
    export default {
        name: "roster-container",

        props: [ 'roster', 'title' ],

        components: {
            studentMatrix,
            studentList
        }
    }
</script>
