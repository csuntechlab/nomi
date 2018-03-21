<template>
    <body class="bg--gray">
        <div class="container">
            <courses-container></courses-container>
        </div>
    </body>
</template>

<script>
    export default {
        name: "home",

        created () {
            this.$store.dispatch('getCourseId', {courseid: -1});
        }
    }
</script>
