<template>
    <div>
        <button v-if="flash" role="button" class="btn btn-default" @click="emitToggleCards()">Gallery Mode</button>
        <button v-else role="button" class="btn btn-default" @click="emitToggleCards()">Flash Card Mode</button>
    </div>
</template>

<script>
    export default {
        name: "card-toggle-button",

        data: function () {
            return {
                flash: false
            }
        },

        methods: {
            emitToggleCards: function () {
                this.$eventBus.$emit('toggleCards');
                this.flash = !this.flash;
            }
        }
    }
</script>
