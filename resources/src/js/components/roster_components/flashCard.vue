<template>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div class="flash_panel"  @click="updateRecognized">
          <div class="flash_positioner"></div>
            <div class="flash_element">
                <div v-if="!known" class="card_face">
                    <profile-picture class="roster__img" :name="display_name" :image="image" :type="'roster'"></profile-picture>
                </div>
                <div v-else>
                    <div class="type--center textOverflow back_of_card back_of_card_mobile">
                        {{display_name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import profilePicture from "../profile_components/profilePicture.vue";
export default {
  name: "flash-card",

  data: function() {
    return {
      known: false,
      messages: true,
      errors: []
    };
  },

  components: {
    profilePicture,
  },

  props: ["student"],

  computed: {

    ...mapGetters([
    ]),

    display_name: function() {
      return this.student.first_name + " " + this.student.last_name;
    },

    image: function() {
      if (this.student.image_priority === 'likeness') {
        return this.student.images.likeness;
      } else if (this.student.image_priority === 'avatar') {
        return this.student.images.avatar;
      }
    }
  },

  methods: {
    updateRecognized: function() {
      this.known = !this.known;
      this.$emit("markRecognized", {
        student_id: this.student.student_id,
        known: this.known
      });
    }
  }
};
</script>

