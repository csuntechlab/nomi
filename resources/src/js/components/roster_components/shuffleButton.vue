<template>
    <div> 
        <i class="fa fa-random fa-3x type--white" @click="emitShuffleCards()"></i>
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
