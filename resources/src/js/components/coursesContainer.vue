<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <course-grid :coursesjson="coursesjson"></course-grid>
        <course-list :coursesjson="coursesjson"></course-list>
    </div>
</template>

<script>
    export default {
        name: "roster-container",

        props: [ 'coursesjson' ]
    }
</script>
