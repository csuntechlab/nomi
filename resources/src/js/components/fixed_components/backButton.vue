<template>
    <div v-if="!hideBack">
        <div v-if="!disableBack">
            <i class="fa fa-angle-left fa-3x back-button" title="Go Back" @click="goBack"></i>
        </div>
        <div v-else>
            <i class="fa fa-angle-left fa-3x back-button back-button--disabled"></i>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
      name: 'back-button',

      methods: {
        goBack() {
          if (document.getElementById('charCount')) {
            this.$store.dispatch('clearStudent');
            this.$router.push({ name: 'class', params: { id: this.currentCourse } });
          } else this.$router.go(-1);
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