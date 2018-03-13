<template>
    <div>
        <router-link to="/home">Back to Courses</router-link>
        <roster-container :courseid="this.$route.params.id" :title="this.$route.params.title"></roster-container>
    </div>
</template>

<script>
    export default {
        name: "class",
    }
</script>
