<template>
    <div v-if="flash">
        <button @click="emitToggleCards()">
            <i class="fa fa-address-book" title="Gallery Card"></i>
        </button>
    </div>
    <div v-else>
        <button @click="emitToggleCards()">
            <i class="fa fa-id-card" title="Flashcard"></i>
        </button>
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
