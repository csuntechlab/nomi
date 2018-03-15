<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <name-toggle-button></name-toggle-button>
        <descending-toggle-button></descending-toggle-button>
        <h1>{{this.title}}</h1>
        <student-matrix :roster="roster" :students="roster"></student-matrix>
        <student-list :roster="roster"></student-list>
    </div>
</template>

<script>
    import studentMatrix from "./studentMatrix"
    import studentList from "./studentList"
    import nameToggleButton from "./nameToggleButton"
    import descendingToggleButton from "./descendingToggleButton"
    export default {
        name: "roster-container",

        props: [ 'roster', 'title' ],

        components: {
            studentMatrix,
            studentList,
            nameToggleButton,
            descendingToggleButton
        }
    }
</script>
