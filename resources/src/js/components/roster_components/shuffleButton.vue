<template>
    <div>
        <i v-if="this.flash" class="fa fa-random fa-3x" @click="handleClick()" data-interactable></i>
        <div v-else-if="this.list"></div>
        <i v-else class="fa fa-random fa-3x" disabled></i>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex';

    export default {
      name: 'shuffle-button',

      computed: {
        ...mapGetters([
          'flash',
          'list',
        ]),
      },
      methods: {
          handleClick() {
              this.$store.dispatch('shuffleFlash', { course_id: this.$route.params.id});
          }
      }
    };
</script>
