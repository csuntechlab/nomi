<template>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div class="flash__panel"  @click="updateRecognized" data-interactable>
          <div class="flash__positioner"></div>
            <div class="flash__element" data-interactable>
                <div v-show="!known" class="card-face">
                    <profile-picture :name="this.student.display_name" :image="this.student.images[this.student.image_priority]" :type="'roster'"></profile-picture>
                </div>
                <div v-show="known">
                    <div class="type--center text-overflow back-of-card back-of-card-mobile">
                        {{this.student.display_name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import profilePicture from '../profile_components/profilePicture.vue';

export default {
  name: 'flash-card',

  data() {
    return {
      known: false,
      messages: true,
      errors: [],
    };
  },

  components: {
    profilePicture,
  },
  
  props: ['student'],

  methods: {
    updateRecognized() {
      this.known = !this.known;
      this.$emit('markRecognized', {
        student_id: this.student.student_id,
        known: this.known,
      });
    },
  },
};
</script>

