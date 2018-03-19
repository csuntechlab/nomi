<template>
    <button class="btn btn-default" @click="$store.dispatch('nameSort')">First/Last Name</button>
</template>

<script>
    export default {
        name: "name-toggle-button",
    }
</script>
