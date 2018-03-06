<template>
    <button @click="emitSortRoster">Toggle Sorting</button>
</template>

<script>
    export default {
        name: "sort-toggle-button",

        methods: {
            emitSortRoster: function () {
                this.$eventBus.$emit('sortRoster');
            }
        }
    }
</script>
