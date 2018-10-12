<template>
<div >
    <div>
      <i class="fa fa-times-circle fa-2x pull-right modal--exit" @click="showModal()"></i>
    </div>
    <div>
        <strong class="type--center">{{student.first_name + " " + student.last_name}}</strong>
        
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
    ...mapGetters(["studentProfile", "modalVisible","toggleCroppa", "facultyMember"])
  },

  methods: {
    checkPermission() {
      this.showCroppaModal = true;
      if (this.permission == false)
        this.$store.dispatch("nullifyPermissionResponse");
    },

    handleSlideClick() {
      this.$root.$emit('newSlide');
    },

    showModal() {

             this.$store.dispatch("toggleModal", false);
             this.$store.dispatch("toggleCropping", false);
           },
  },
  computed: {
    ...mapGetters(["permission"]),
  }
};
</script>