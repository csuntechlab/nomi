<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <course-matrix :courses="courses"></course-matrix>
        <course-list :courses="courses"></course-list>
    </div>
</template>

<script>
    export default {
        name: "courses-container",
        props: [ 'courses' ]
    }
</script>
