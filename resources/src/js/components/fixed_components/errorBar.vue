<template>
    <div v-if="this.errors || this.profileLoadError" id="error_bar" class="alert alert--warning">
        <strong>Oops!</strong> Something went wrong
        	<a href="#" class="alert__close" @click="closeError()" >&times;</a>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';

export default {
  name: 'error-bar',

  data() {
    return {
      showError: false,
    };
  },

  computed: {
    ...mapGetters([
      'errors',
      'profileErrors',
      'profileLoadError',
      'currentCourse',
    ]),
  },

  updated() {
    this.enableBackButton();
  },

  methods: {
    ...mapActions([
      'enableBackButton',
      'clearErrors',
    ]),

    logErrors() {
      console.log(`Error found: ${this.errors}`);
    },

    closeError() {
      if (this.profileLoadError == true) {
        this.$store.dispatch('clearStudents');
        this.$router.push({ name: 'class', params: { id: this.currentCourse } });
      }
      this.logErrors();
      this.clearErrors();
    },
  },
};
</script>

