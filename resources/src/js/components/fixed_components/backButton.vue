<template>
    <div v-if="!hideBack">
        <i class="fa fa-angle-left fa-3x back-button" title="Go Back" @click="goBack" data-interactable></i>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
      name: 'back-button',

      methods: {
        goBack() {
          this.$store.dispatch('clearStudent');
          this.$router.replace({ name: 'class', params: { id: this.currentCourse } });
    },
      },

      computed: {
        ...mapGetters([
          'hideBack',
          'disableBack',
          'currentCourse',
        ]),
      },
    };
</script>