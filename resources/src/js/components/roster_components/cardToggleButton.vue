<template>
    <div>
        <i v-if="this.flash" class="fa fa-arrow-left fa-3x" title="Gallery Card" @click="$store.dispatch('toggleFlash')"></i>
        <div v-else-if="this.list"></div>
        <i v-else class="fa fa-id-card fa-3x" title="Flashcard" @click="$store.dispatch('toggleFlash')"></i>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
      name: 'card-toggle-button',
      computed: {
        ...mapGetters([
          'flash',
          'list',
        ]),
      },
    };
</script>
