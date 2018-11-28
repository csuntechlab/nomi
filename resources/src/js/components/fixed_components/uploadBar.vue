<template>
    <div v-if="this.uploadFeedback" :class="this.sticky ? 'upload-bar upload-bar--sticky' : 'upload-bar upload-bar--relative'">
      <div class="upload-bar-container">
        <span>
          <strong>Uploaded!</strong> Photo changes will be reflected soon.
        </span>
        <span href="#" class="upload-bar__close" @click="closeUpload()" >&times;</span>
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
