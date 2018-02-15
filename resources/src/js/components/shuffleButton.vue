<template>
    <div> <button role="button" class="btn btn-default" @click="emitShuffleCards()">Shuffle</button> </div>
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
