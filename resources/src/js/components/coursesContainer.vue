<template>
    <div>
        <course-matrix :coursesjson="coursesjson"></course-matrix>
        <course-list :coursesjson="coursesjson"></course-list>
    </div>
</template>

<script>
    export default {
        name: "roster-container",

        props: [ 'coursesjson' ]
    }
</script>
