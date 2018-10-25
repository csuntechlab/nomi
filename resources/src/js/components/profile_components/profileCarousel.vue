<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="type--center">{{this.student.displayName}}</h1>
                </div>
                <div class="type--center">
                    <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                        <slide class="slide-wrap">
                            <div class="image-wrap">
                                <profile-picture :image="image" :editable="this.emailExists" :type="'profile'" @showModal="checkPermission()"></profile-picture>
                                <image-handler image_type="likeness" class="profile-carousel__default-btn"></image-handler>
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
                    <modal v-if="displayModal" @close="showCroppaModal = false">
                        <div slot="header"></div>
                        <div slot="body">
                            <croppa-profile :student="this.student.student"></croppa-profile>
                        </div>
                    </modal>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import croppaProfile from './croppaProfile.vue';
import profilePicture from './profilePicture.vue';
import modal from '../fixed_components/modal.vue';
import imageHandler from './imageHandler.vue';
import croppaModal from './croppaModal.vue';

export default {
  name: 'profile-carousel',

  props: ['student'],
  data() {
    return {
      showCroppaModal: false,
    };
  },
  beforeRouteLeave(to, from, next) {
    if (this.unsavedChanges) {
      const answer = window.confirm(
        'Do you really want to leave? You have unsaved changes.',
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
    modal,
  },
  methods: {
    setImgUrl(url) {
      this.showCroppaModal = false;
      this.imgUrl = url;
    },
    checkPermission() {
      this.showCroppaModal = true;
      if (this.permission == false) { this.$store.dispatch('nullifyPermissionResponse'); }
    },
  },
  computed: {
    ...mapGetters(['permission']),
    image() {
      return this.student.images.likeness;
    },

    avatar() {
      return this.student.images.avatar;
    },

    displayModal() {
      return (this.showCroppaModal && this.permission);
    },

    emailExists() {
      return (this.student.emailURI != null);
    }
  },
};
</script>