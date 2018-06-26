<template>
    <div class="container">
        <term-selector></term-selector>
        <courses-container></courses-container>
    </div>
</template>

<script>
    export default {
        name: "home",

        created () {
            this.$store.dispatch('clearErrors');
            this.$store.dispatch('hideBackButton');
        },

        beforeRouteLeave (to, from, next) {
            this.$store.dispatch('showBackButton');
            next();
        },
    }
</script>
