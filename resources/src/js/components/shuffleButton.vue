<template>
    <div> <button @click="emitShuffleCards()">Shuffle</button> </div>
</template>

<script>
    export default {
        name: "shuffle-button",
        methods: {
            emitShuffleCards: function () {
                this.$eventBus.$emit('shuffleCards');
            }
        }
    }
</script>
