<template>
    <div class="col-xs-6 col-md-4 col-lg-3">
        <div class="flash__panel"  @click="updateRecognized">
          <div class="flash__positioner"></div>
            <div class="flash__element">
                <div v-show="!known" class="card-face">
                    <profile-picture :name="display_name" :image="image" :type="'roster'"></profile-picture>
                </div>
                <div v-show="known">
                    <div class="type--center text-overflow back-of-card back-of-card-mobile">
                        {{display_name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';
import profilePicture from '../profile_components/profilePicture.vue';

export default {
  name: 'flash-card',

  data() {
    return {
      known: false,
      messages: true,
      errors: [],
    };
  },

  components: {
    profilePicture,
  },

  props: ['student'],

  computed: {

    ...mapGetters([
    ]),

    display_name() {
      return `${this.student.first_name} ${this.student.last_name}`;
    },

    // image() {
    //   if (this.student.image_priority === 'likeness') {
    //     return this.student.images.likeness;
    //   } if (this.student.image_priority === 'avatar') {
    //     return this.student.images.avatar;
    //   }
    // },
    image() {
      let testUrl = "https://api.sandbox.csun.edu/metalab/test/media/1.1/student/media/" + `${this.student.email_uri}`+ '/' +`${this.student.image_priority}` + '?secret=IUEdtASs7sdiCZBe7Phb/26ilx8PyWr6N4vk8r59KSE019TgsFiBb19wKAxLnwGlbOENrRikSSi5NgqDOTsftw=='
      // const firstAPI = axios.create({
      //     baseURL: 'https://api.sandbox.csun.edu/metalab/test/media/1.1/student/media/'
      // })
    //  firstAPI.get(`${this.student.email_uri}`+ '/' +`${this.student.image_priority}` + '?secret=IUEdtASs7sdiCZBe7Phb/26ilx8PyWr6N4vk8r59KSE019TgsFiBb19wKAxLnwGlbOENrRikSSi5NgqDOTsftw==', {
    //     // headers: {
    //     //   'X-API-Key': 'IUEdtASs7sdiCZBe7Phb/26ilx8PyWr6N4vk8r59KSE019TgsFiBb19wKAxLnwGlbOENrRikSSi5NgqDOTsftw==',
    //     // },
    //     }).then((response) => {
    //       // console.log(response.data);
    //       return response.data;
    //     }).catch((e) => {
    //       console.log(e);
   
    //     });
        return testUrl;
    },
  },

  methods: {
    updateRecognized() {
      this.known = !this.known;
      this.$emit('markRecognized', {
        student_id: this.student.student_id,
        known: this.known,
      });
    },
  },
};
</script>

