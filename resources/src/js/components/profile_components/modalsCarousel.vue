<template>
<div>
  <div class="modal-body__carousel">
    <carousel v-if="okayToUpdate" :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'" @pageChange="handleSlideClick">
        <slide class="slide-wrap">
          <div>
            <profile-picture v-show="!switchItUp" :image="likenessImage" :editable="false" :type="'profile-picture'"></profile-picture>
              <croppa-profile v-show="switchItUp"></croppa-profile>
              <div class="type--center">
                <i>Faculty Uploaded</i>
                <image-handler :image_type="'likeness'" class="profile-carousel__default-btn"></image-handler>
              </div>
          </div>
        </slide>
        <slide class="slide-wrap">
          <div>
              <profile-picture :image="avatarImage" :editable="false" :type="'profile-picture'"></profile-picture>
              <div class="type--center">
                <i>Student Uploaded</i>
                <image-handler :image_type="'avatar'" class="profile-carousel__default-btn"></image-handler>
              </div>
          </div>
        </slide>
    </carousel>
    <carousel v-else :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'" @pageChange="handleSlideClick">
        <slide class="slide-wrap">
          <div>
              <profile-picture :image="avatarImage" :editable="false" :type="'profile-picture'"></profile-picture>
              <div class="type--center">
                <i>Student Uploaded</i>
                <image-handler :image_type="'avatar'" class="profile-carousel__default-btn"></image-handler>
              </div>
          </div>
        </slide>
        <slide class="slide-wrap">
          <div>
            <profile-picture v-show="!switchItUp" :image="likenessImage" :editable="false" :type="'profile-picture'"></profile-picture>
              <croppa-profile v-show="switchItUp"></croppa-profile>
              <div class="type--center">
                <i>Faculty Uploaded</i>
                <image-handler :image_type="'likeness'" class="profile-carousel__default-btn"></image-handler>
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
  data: function() {
      return{
        okayToUpdate: null,
        switchItUp: false,
        imageUrl: document.querySelector('meta[name=img-url]').content,
        secret: document.querySelector('meta[name=secret]').content + '&source=true',
      }
  },

  mounted(){
    this.$root.$on('letsSwitchItUp', () => {
        this.switchItUp = !this.switchItUp;
    });
  },

  components: {
    imageHandler,
    profilePicture,
    croppaProfile
  },
  computed: {
    
    ...mapGetters(["studentProfile", "modalVisible"]),
    likenessImage() {
      if(this.studentProfile){
        // return this.imageUrl + `${this.studentProfile.emailURI}`+ '/' +`likeness` +'?secret='+ this.secret + `${this.student.timestamp}`;
        return this.imageUrl + `${this.studentProfile.emailURI}`+ '/' +`likeness` +'?secret='+ this.secret;

      }
    },
    
    avatarImage() {
    if(this.studentProfile){
      return this.imageUrl + `${this.studentProfile.emailURI}`+ '/' +`avatar` +'?secret='+ this.secret;
      }
    }
  },

  methods: {

    handleSlideClick() {
      this.$root.$emit('newSlide');
    },
  },

  created() {
    if(this.studentProfile.imagePriority === 'likeness'){
      this.okayToUpdate = true;
    } else {
      this.okayToUpdate = false;
    }
    this.$root.$emit('okayToUpdate', this.okayToUpdate);
  }
}
</script>
