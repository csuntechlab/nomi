<template>
    <div>
        <course-banner></course-banner>
        <list-grid-tabs></list-grid-tabs>
        <settings-banner></settings-banner>
        <roster-container></roster-container>
    </div>
</template>

<script>
    export default {
        name: "class",

        created () {
            this.$store.dispatch('getCourseId', {courseid: parseInt(this.$route.params.id)})
        }
    }
</script>
