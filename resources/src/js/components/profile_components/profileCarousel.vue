<template>
<div>
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <h1 class="type--center">{{this.student.displayName}}</h1>
         </div>
         <div class="type--center">
            <profile-picture :image="image" :editable="true" :type="'profile'" @showModal="checkPermission()"></profile-picture>
            <image-handler image_type="likeness" class="profile-carousel__default-btn"></image-handler>
            <modal v-if="displayModal" @close="showCroppaModal = false">
               <div slot="header"></div>
               <div slot="body">
                  <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                     <slide class="slide-wrap">
                        <div class="image-wrap">
                           <croppa-profile :student="this.student.student"></croppa-profile>
                        </div>
                     </slide>
                     <slide class="slide-wrap">
                        <div class="image-wrap">
                           <profile-picture :image="avatar" :type="'profile'"></profile-picture>
                           <image-handler image_type="avatar" class="profile-carousel__default-btn"></image-handler>
                        </div>
                     </slide>
                     <!-- <slide class="slide-wrap">
                        <div class="image-wrap">
                            <profile-picture :image="studentProfile.images['official']"></profile-picture>
                            <div class="type--center">
                                <image-handler image_type="official"></image-handler>
                            </div>
                        </div>
                        </slide>
                        -->
                  </carousel>
               </div>
               <croppa-functionality></croppa-functionality>
            </modal>
         </div>
      </div>
   </div>
</div>
</template>

<script>
import croppaProfile from "../profile_components/croppaProfile.vue";
import profilePicture from "../profile_components/profilePicture.vue";
import croppaFunctionality from "../profile_components/croppaFunctionality.vue";
import modal from "../fixed_components/modal.vue";
import imageHandler from "../profile_components/imageHandler.vue";
import croppaModal from "../profile_components/croppaModal.vue";
import { mapGetters } from "vuex";
export default {
  name: "profile-carousel",

  props: ["student"],
  data: function() {
    return {
      showCroppaModal: false
    };
  },
  beforeRouteLeave(to, from, next) {
    if (this.unsavedChanges) {
      const answer = window.confirm(
        "Do you really want to leave? You have unsaved changes."
      );

      if (answer) {
        next();
      } else {
        next(false);
      }
    } else {
      next();
    }
  },
  components: {
    imageHandler,
    profilePicture,
    croppaModal,
    croppaProfile,
    croppaFunctionality,
    modal
  },
  methods: {
    setImgUrl(url) {
      this.showCroppaModal = false;
      this.imgUrl = url;
    },
    checkPermission() {
      this.showCroppaModal = true;
      if (this.permission == false)
        this.$store.dispatch("nullifyPermissionResponse");
    }
  },
  computed: {
    ...mapGetters(["permission"]),
    image: function() {
      return this.student.images.likeness;
    },

    avatar: function() {
      return this.student.images.avatar;
    },

    displayModal() {
      return this.showCroppaModal && this.permission;
    }
  }
};
</script>