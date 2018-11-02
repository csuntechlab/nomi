<template>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div class="flash__panel"  @click="updateRecognized">
          <div class="flash__positioner"></div>
            <div class="flash__element">
                <div v-show="!known" class="card-face">
                    <profile-picture :name="display_name" :image="image" :type="'roster'"></profile-picture>
                </div>
                <div v-show="known">
                    <div class="type--center text-overflow back-of-card back-of-card-mobile">
                        {{display_name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';
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

  computed: {

    ...mapGetters([
    ]),

    display_name() {
      return `${this.student.first_name} ${this.student.last_name}`;
    },

    image() {
      if (this.student.image_priority === 'likeness') {
        return this.student.images.likeness_image;
      } if (this.student.image_priority === 'avatar') {
        return this.student.images.avatar_image;
      }
    },
  },

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

