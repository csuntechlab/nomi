<template>
    <button @click="$store.dispatch('descSort')">Descending/Ascending</button>
</template>

<script>
    export default {
        name: "descending-toggle-button",
    }
</script>
