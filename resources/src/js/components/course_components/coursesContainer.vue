<template>
    <div>
        <toggle-view-button></toggle-view-button>
        <course-matrix :courses="courses"></course-matrix>
        <course-list :courses="courses"></course-list>
    </div>
</template>

<script>
    import courseList from './courseList'
    import courseMatrix from './courseMatrix'
    export default {
        name: "courses-container",
        props: [ 'courses' ],
        components: {
            courseList,
            courseMatrix
        }
    }
</script>
