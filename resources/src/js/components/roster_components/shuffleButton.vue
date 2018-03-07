<template>
    <div> 
    	<button class="btn btn-default" @click="emitShuffleCards()">
            <i class="fa fa-random"></i>
        </button>
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
