<template>
<div>
   <div class="container">
      <div >
         <div>
            <h1 class="type--center">{{this.student.displayName}}</h1>
         </div>
         <div style="padding: 15%;">
         <profile-picture class="padding" :image="image" :editable="true" :type="'profile'" @showModal="checkPermission()"></profile-picture>
         </div>
            
         <div class="type--center">
            
            <modal v-if="displayModal">
              <div slot="header">
                 <strong class="type--center">{{this.student.displayName}}</strong>
              </div>
               <div slot="body">
                  <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'"  @pageChange="handleSlideClick">
                     <slide class="slide-wrap">
                        <div>
                           <croppa-profile :student="this.student.student"></croppa-profile>
                           <i>Faculty Uploaded</i>
                           <image-handler image_type="likeness" class="profile-carousel__default-btn"></image-handler>
                        </div>
                        
                     </slide>
                     <slide class="slide-wrap">
                        <div>
                           <profile-picture :image="avatar" :type="'profile'"></profile-picture>
                           <i>Faculty Uploaded</i>
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
    croppaProfile,
    croppaFunctionality,
    modal
  },
  methods: {
    checkPermission() {
      this.showCroppaModal = true;
      this.$root.$emit('showModal');
      if (this.permission == false)
        this.$store.dispatch("nullifyPermissionResponse");
    },

    handleSlideClick() {
      this.$root.$emit('newSlide');
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