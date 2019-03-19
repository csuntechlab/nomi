<template>
    <nav class="navbar">
        <back-button></back-button>
        <div v-if="!checkIfLogin">
            <div v-if="displayCurrentTerm" class="navbar__header">
            {{displayCurrentTerm}}
            </div>
            <a data-interactable :href="this.url + '/support'" class="feedback-button pull-right">Feedback</a>
        </div>
    </nav>
</template>

<script>
import { mapGetters } from 'vuex';
import backButton from './backButton.vue';

export default {
  data() {
    return {
      url: '',
    };
  },
  components: {
    backButton,
  },
  created() {
    this.url = document.querySelector('meta[name=app-url]').content;
  },
  computed: {
    ...mapGetters(['term']),

    displayCurrentTerm() {
      if (!(this.term.display_term == null || this.term.display_term == undefined)) {
        return this.term.display_term;
      }
    },
    checkIfLogin() {
      if (document.getElementById('loginContainer')) { return true; }
      return false;
    },
  },
};
</script>
