<template>
    <div>
        <router-link to="/home">Home Test Route</router-link>
        <roster-container :roster="this.roster"></roster-container>
    </div>
</template>

<script>
    export default {
        name: "class",

        data: () => {
            return {
                roster: {}
            }
        },

        props: ['json'],

        mounted () {
            this.roster = JSON.parse(this.json)[1];
        },
    }
</script>

<style scoped>

</style>