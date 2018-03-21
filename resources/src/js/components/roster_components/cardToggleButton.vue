<template>
    <div>
        <i v-if="this.flash" class="fa fa-address-book fa-3x type--white" title="Gallery Card" @click="$store.dispatch('toggleFlash')"></i>
        <i v-else class="fa fa-id-card fa-3x type--white" title="Flashcard" @click="$store.dispatch('toggleFlash')"></i>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "card-toggle-button",

        computed: {
            ...mapGetters([
                'flash'
            ])
        }
    }
</script>
