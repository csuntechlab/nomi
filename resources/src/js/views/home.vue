<template>
    <div>
        <router-link to="/class">Class Test Route</router-link>
        <courses-container :courses="this.courses"></courses-container>
    </div>
</template>

<script>
    export default {
        name: "home",

        data: () => {
            return {
                courses: {}
            }
        },

        props: ['json'],

        mounted () {
            this.courses = JSON.parse(this.json)[0];
        }
    }
</script>

<style scoped>

</style>