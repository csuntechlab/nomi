<template>
    <button @click="emitToggleName">First/Last Name</button>
</template>

<script>
    export default {
        name: "name-toggle-button",

        methods: {
            emitToggleName: function () {
                this.$eventBus.$emit('toggleName');
            }
        }
    }
</script>
