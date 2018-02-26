<template>
    <div v-if="flash">
        <button role="button" class="btn btn-default" @click="emitToggleCards()">Gallery Mode</button>
    </div>
    <div v-else>
        <button role="button" class="btn btn-default" @click="emitToggleCards()">Flash Card Mode</button>
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
