<template>
    <div class="col-xs-6 col-md-4 col-lg-3 card">
        <div class="panel flashCard"  @click="updateRecognized">
            <div class="grid-item panel__content">
                <div v-if="known">
                    <div class="type--center textOverflow back-of-card">
                        {{display_name}}
                    </div>
                </div>
                <div v-else>
                    <label :for="display_name">
                        <profile-picture :name="display_name" :image="image"></profile-picture>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "flash-card",

  data: function() {
    return {
      known: false,
      messages: true,
      errors: []
    };
  },

  props: ["student"],

  computed: {
    display_name: function() {
      return this.student.first_name + " " + this.student.last_name;
    },
    image: function() {
      return this.student.images[this.student.image_priority];
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

<style scoped>
.grid-item {
  padding: 0 !important;
}
.back-of-card {
  font-size: 5vmin;
  position: absolute;;
  float: left;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.panel-heading {
  display: flex;
  justify-content: center;
  align-items: center;
  flex: 0 0 25%;
}
</style>
