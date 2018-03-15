<template>
    <button v-if="this.flash" role="button" class="btn btn-default" @click="$store.commit('toggleFlash')">Flash Card Mode</button>
    <button v-else role="button" class="btn btn-default" @click="$store.commit('toggleFlash')">Gallery Mode</button>
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
