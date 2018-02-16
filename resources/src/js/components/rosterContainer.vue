<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <student-grid :studentsjson="studentsjson"></student-grid>
        <student-list :studentsjson="studentsjson"></student-list>
    </div>
</template>

<script>
    export default {
        name: "roster-container",

        props: [ 'studentsjson' ]
    }
</script>
