<template>
<div>
    <div slot="header">
        <strong class="type--center">{{student.displayName}}</strong>
    </div>
      <div slot="body">
        <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'"  @pageChange="handleSlideClick">
            <slide class="slide-wrap">
              <div>
                  <croppa-profile :student="student"></croppa-profile>
                  <i>Student Uploaded</i>
                  <image-handler image_type="likeness" class="profile-carousel__default-btn"></image-handler>
              </div>
            </slide>
            <slide class="slide-wrap">
              <div>
                  <profile-picture :image="student.images.avatar" :editable="false" :type="'profile'"></profile-picture>
                  <i>Faculty Uploaded</i>
                  <image-handler image_type="avatar" class="profile-carousel__default-btn"></image-handler>
              </div>
            </slide>
        </carousel>
      </div>
</div>
</template>

<script>
import croppaProfile from "../profile_components/croppaProfile.vue";
import profilePicture from "../profile_components/profilePicture.vue";
import { mapGetters, mapMutations, mapActions } from 'vuex';
import imageHandler from "../profile_components/imageHandler.vue";
export default {
  name: "carouselModal",

  props: ["student"],
  // beforeRouteLeave(to, from, next) {
  //   if (this.unsavedChanges) {
  //     const answer = window.confirm(
  //       "Do you really want to leave? You have unsaved changes."
  //     );

  //     if (answer) {
  //       next();
  //     } else {
  //       next(false);
  //     }
  //   } else {
  //     next();
  //   }
  // },
  components: {
    imageHandler,
    profilePicture,
    croppaProfile
  },
  methods: {
    checkPermission() {
      this.showCroppaModal = true;
      if (this.permission == false)
        this.$store.dispatch("nullifyPermissionResponse");
    },

    handleSlideClick() {
      this.$root.$emit('newSlide');
    }
  },
  computed: {
    ...mapGetters(["permission"]),
  }
};
</script>