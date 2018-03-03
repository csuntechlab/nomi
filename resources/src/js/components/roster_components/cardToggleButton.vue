<template>
    <div v-if="flash">
        <input type="image" src="/images/gallery.png" @click="emitToggleCards()"></input>
    </div>
    <div v-else>
        <input type="image" src="/images/flashcards.png" @click="emitToggleCards()"></input>
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
