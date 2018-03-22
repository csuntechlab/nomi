<template>
    <body class="off-white">
        <div class="container">
            <courses-container></courses-container>
        </div>
        <menu-bar></menu-bar>
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
