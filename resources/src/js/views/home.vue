<template>
    <div>
        <list-grid-tabs></list-grid-tabs>
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
