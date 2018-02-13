<template>
    <div> <button @click="emitToggleView()">Toggle View</button> </div>
</template>

<script>
    export default {
        name: "toggle-view-button",
        methods: {
            emitToggleView: function () {
                this.$eventBus.$emit('toggleView');
            }
        }
    }
</script>
