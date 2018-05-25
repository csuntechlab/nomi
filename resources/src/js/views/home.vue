<template>
    <div class="container">
        <courses-container></courses-container>
    </div>
</template>

<script>
    export default {
        name: "home",

        created () {
            this.$store.dispatch('clearErrors');
            this.$store.dispatch('getData');
            this.$store.dispatch('hideBackButton');
        },

        beforeRouteLeave (to, from, next) {
            this.$store.dispatch('showBackButton');
            next();
        },
    }
</script>
