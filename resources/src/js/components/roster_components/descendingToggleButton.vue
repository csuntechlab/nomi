<template>
    <button @click="this.$store.commit('toggleDesc')">Descending/Ascending</button>
</template>

<script>
    export default {
        name: "descending-toggle-button",
    }
</script>
