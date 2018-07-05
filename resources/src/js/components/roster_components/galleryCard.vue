<template>
<div>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div class="editButton">
            <i class="fa fa-edit fa-2x" @click="showModal = true"></i>
        </div>
        <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri">
        <div class="panel">
            <div class="panel__content">
                <profile-picture :image="image"></profile-picture>
            </div>
            <div class="cardText clearPadding">
                <div class="gallery_name type--center">{{display_name}}</div>
            </div>
        </div>
        </router-link>
    </div>
    <div>
        <modal v-if="showModal" @close="showModal = false">
            <div slot="header"></div>
            <div slot="body">
                <croppa-profile :emailURI="email_uri" :studentImage="image"></croppa-profile>
            </div>
        </modal>
    </div>
</div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import croppaProfile from "../../components/profile_components/croppaProfile.vue";
import modal from "../../components/fixed_components/modal.vue";

export default {
  name: "gallery-card",

  data: function() {
    return {
      messages: true,
      errors: [],
      myCroppa: null,
      showModal: false,
      showMe: true
    };
  },
  components: {
    modal,
    croppaProfile
  },

  props: ["student"],

  computed: {

    ...mapGetters([
      'studentImages'  
    ]),

    display_name: function() {
      return this.student.first_name + " " + this.student.last_name[0] + ".";
    },

    email_uri: function() {
      return this.student.email.split("@")[0].replace("nr_", "");
    },

    image: function() {
      return this.studentImages[this.student.student_id];
    }
  },

  methods: {
    setImgUrl(url) {
      this.showModal = false;
      this.imgUrl = url;
    }
  }
};
</script>
