<template>
    <div>
        <router-link to="/home">Back to Class Sections</router-link>
        <roster-container :courseid="parseInt(this.$route.params.id)" :title="this.$route.params.title"></roster-container>
    </div>
</template>

<script>
    export default {
        name: "class",
    }
</script>
