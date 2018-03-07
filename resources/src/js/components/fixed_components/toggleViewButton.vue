<template>
    <div v-if="cards">
        <button class="btn btn-default" @click="emitToggleView()">
            <i class="fa fa-th-large" title="Grid"></i>
        </button>
    </div>
    <div v-else>
        <button class="btn btn-default" @click="emitToggleView()"> 
            <i class="fa fa-list-ul" title="List"></i>
        </button>
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
