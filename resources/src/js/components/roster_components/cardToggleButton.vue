<template>
    <div v-if="flash">
            <i class="fa fa-address-book fa-3x type--white" title="Gallery Card" @click="emitToggleCards()"></i>
    </div>
    <div v-else>
            <i  class="fa fa-id-card fa-3x type--white" title="Flashcard" @click="emitToggleCards()"></i>
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
