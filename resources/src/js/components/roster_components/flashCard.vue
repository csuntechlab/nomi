<template>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div class="flash_panel"  @click="updateRecognized">
          <div class="flash_positioner"></div>
            <div class="flash_element">
                <div v-if="!known" class="card_face">
                    <profile-picture :name="display_name" :image="image"></profile-picture>
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
      'studentImages'  
    ]),

    display_name: function() {
      return this.student.first_name + " " + this.student.last_name;
    },

    image: function() {
      return this.studentImages[this.student.student_id];
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

