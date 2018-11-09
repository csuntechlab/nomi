<template>
    <div v-if="this.uploadFeedback" class="upload-bar">
        <strong>Uploaded!</strong> Photo changes will be reflected soon.
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';

export default {
  name: 'upload-bar',

  computed: {
    ...mapGetters([
      'uploadFeedback'
    ]),
  },
};
</script>
