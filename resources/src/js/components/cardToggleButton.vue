<template>
    <div v-if="flash">
        <input type="image" src="/images/gallery.png" @click="emitToggleCards()">Gallery Mode</input>
    </div>
    <div v-else>
        <input type="image" src="/images/flashcards.png" @click="emitToggleCards()">Flash Card Mode</input>
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
