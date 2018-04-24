<template>
    <div>
        <home-settings-banner></home-settings-banner>
        <div class="container">
            <courses-container></courses-container>
        </div>
    </div>
</template>

<script>
    export default {
        name: "home",
        created () {
            this.$store.dispatch('getData');
        },
    }
</script>
