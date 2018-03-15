<template>
    <button @click="emitToggleDesc">Descending/Ascending</button>
</template>

<script>
    export default {
        name: "descending-toggle-button",

        methods: {
            emitToggleDesc: function () {
                this.$eventBus.$emit('toggleDesc');
            }
        }
    }
</script>
