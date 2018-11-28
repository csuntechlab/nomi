<template>
    <div v-if="this.uploadFeedback" :class="this.sticky ? 'upload-bar upload-bar--sticky' : 'upload-bar upload-bar--relative'">
        <strong>Uploaded!</strong> Photo changes will be reflected soon.
        <div class="upload-bar-container">
          <a href="#" class="upload-bar__close" @click="closeUpload()" >&times;</a>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';

export default {
  name: 'upload-bar',

  props: ['sticky'],

  computed: {
    ...mapGetters([
      'uploadFeedback'
    ]),
  },

  methods: {
    closeUpload() {
      this.$store.dispatch('stopUploadFeedback');
    }
  }
};
</script>
