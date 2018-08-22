<template>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div v-if="this.student.image_priority === 'likeness'">
            <i class="fas fa-pencil-alt panel__edit-button" @click="checkPermission"/>
        </div>
        <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri">
          <div class="panel">
            <div class="panel__content">
                <profile-picture :image="image" :type="'roster'"/>
            </div>
            <div class="cardText clearPadding">
                <div class="gallery_name type--center">{{display_name}}</div>
            </div>
          </div>
        </router-link>
        <modal v-if="displayModal" @close="showCroppaModal = false">
            <div slot="header"></div>
            <div slot="body">
                <croppa-profile :student="this.student"></croppa-profile>
            </div>
        </modal>
    </div>
        
</template>

<script>
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import croppaProfile from "../profile_components/croppaProfile.vue";
import modal from "../fixed_components/modal.vue";
import profilePicture from "../profile_components/profilePicture.vue";
export default {
  name: "gallery-card",

  data: function() {
    return {
      messages: true,
      errors: [],
      myCroppa: null,
      showCroppaModal: false,
      showMe: true
    };
  },
  components: {
    modal,
    croppaProfile,
    profilePicture
  },

  props: ["student"],

  computed: {

    ...mapGetters([
      'permission'  
    ]),

    displayModal(){
      return(this.showCroppaModal && this.permission);
    },

    display_name: function() {
      return this.student.first_name + " " + this.student.last_name[0] + ".";
    },

    email_uri: function() {
      return this.student.email.split("@")[0].replace("nr_", "");
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
    setImgUrl(url) {
      this.showCroppaModal = false;
      this.imgUrl = url;
    },
    checkPermission() {
      this.showCroppaModal = true;
      if (this.permission == false)
        this.$store.dispatch('nullifyPermissionResponse');
    }
  }
};
</script>
