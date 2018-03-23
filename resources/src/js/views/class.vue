<template>
    <div>
        <router-link to="/">Back to Class Sections</router-link>
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
