<template>
    <div v-if="cards">
            <i class="fa fa-list-ul fa-3x type--white" title="List"  @click="emitToggleView()"></i>
    </div>
    <div v-else>
            <i class="fa fa-th-large fa-3x type--white" title="Grid" @click="emitToggleView()"></i> 
    </div>
</template>

<script>
    export default {
        name: "toggle-view-button",

        data: function () {
            return {
                cards: true
            }
        },
        methods: {
            emitToggleView: function () {
                this.$eventBus.$emit('toggleView');
                this.cards = !this.cards;
            }
        }
    }
</script>
