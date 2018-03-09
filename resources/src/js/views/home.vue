<template>
    <div>
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
            console.log(this.courses);
        }
    }
</script>

<style scoped>

</style>