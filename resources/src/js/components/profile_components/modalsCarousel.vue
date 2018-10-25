<template>
<div >
      
      <div class="modal-body__carousel">
        <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'"  @pageChange="handleSlideClick">
            <slide class="slide-wrap">
              <div>
                  <croppa-profile :student="student"></croppa-profile>
                  <div class="type--center">
                    <i>Faculty Uploaded</i>
                    <image-handler image_type="likeness" class="profile-carousel__default-btn"></image-handler>
                  </div>
              </div>
            </slide>
            <slide class="slide-wrap">
              <div>
                  <profile-picture :image="student.images.avatar" :editable="false" :type="'profile'"></profile-picture>
                  <div class="type--center">
                    <i>Student Uploaded</i>
                    <image-handler image_type="avatar" class="profile-carousel__default-btn"></image-handler>
                  </div>
              </div>
            </slide>
        </carousel>
      </div>
</div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
import croppaProfile from "../profile_components/croppaProfile.vue";
import profilePicture from "../profile_components/profilePicture.vue";
import imageHandler from "../profile_components/imageHandler.vue";

export default {
  name: "modals-carousel",

  props: ["student"],

  components: {
    imageHandler,
    profilePicture,
    croppaProfile
  },
  computed: {
    ...mapGetters(["studentProfile", "modalVisible","toggleCroppa"])
  },

  methods: {

    handleSlideClick() {
      this.$root.$emit('newSlide');
    },
  },


  computed: {
    ...mapGetters(["permission"]),
  }
}
</script>