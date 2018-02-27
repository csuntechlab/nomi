<template>
    <div> 
    	<input type="image" src="/images/card-exchange.png" @click="emitShuffleCards()">Shuffle</input>
    </div>
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
