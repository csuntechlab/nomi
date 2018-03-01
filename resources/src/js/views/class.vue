<template>
    <div>
        <router-link to="/home">Back to Courses</router-link>
        <roster-container :roster="this.roster" :title="this.$route.params.title"></roster-container>
    </div>
</template>

<script>
    export default {
        name: "class",

        data: () => {
            return {
                roster: {},
            }
        },

        props: ['json', 'number', 'title'],

        mounted () {
            this.roster = JSON.parse(this.json)[1][this.$route.params.id];
        },
    }
</script>

<style scoped>

</style>