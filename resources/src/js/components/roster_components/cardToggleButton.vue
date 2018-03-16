<template>
<!-- <<<<<<< HEAD
    <div v-if="flash">
            <i class="fa fa-address-book fa-3x type--white" title="Gallery Card" @click="emitToggleCards()"></i>
    </div>
    <div v-else>
            <i  class="fa fa-id-card fa-3x type--white" title="Flashcard" @click="emitToggleCards()"></i>
    </div>
======= -->
    <i v-if="this.flash" class="fa fa-address-book fa-3x type--white" title="Gallery Card" @click="$store.commit('toggleFlash')"></i>
    
    <div v-else-if="this.list"></div>

    <i v-else class="fa fa-id-card fa-3x type--white" title="Flashcard" @click="$store.commit('toggleFlash')"></i>

</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "card-toggle-button",
        computed: {
            ...mapGetters([
                'flash',
                'list'
            ])
        }
    }
</script>
