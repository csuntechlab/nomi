<template>
    <div>
        <div class="container">
            <courses-container></courses-container>
        </div>
    </div>
</template>

<script>
    export default {
        name: "home",
        created () {
            this.$store.dispatch('clearErrors');
            this.$store.dispatch('getData');
        },
    }
</script>
