<template>
    <div v-if="cards">
        <input @click="emitToggleView()" type="image" src="/images/list.png">
    </div>
    <div v-else>
        <input @click="emitToggleView()" type="image" src="/images/grid.png">
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
