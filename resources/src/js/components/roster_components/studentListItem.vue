<template>
    <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri" @click.native="getStudent()">
        <div class="roster-list__item">
        <div class="row">
            <div class="col-xs-3 col-md-2">
                <profile-picture class="pull-left" :name="display_name" :image="image" :type="'roster'"></profile-picture>
            </div>
            <div class="col-xs-9 col-md-10">
                <span>
                    <div class="student_list_first_name student_list_first_name_mobile">{{this.student.first_name}}</div>
                    <div class="student_list_last_name student_list_last_name_mobile">{{this.student.last_name}}</div>
                </span>
            </div>
        </div>
        </div>
    </router-link>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapState } from 'vuex';
import modal from '../fixed_components/modal.vue';
import profilePicture from '../profile_components/profilePicture.vue';

export default {
  name: 'student-list-item',

  props: ['student'],

  components: {
    modal,
    profilePicture,
  },

  computed: {

    ...mapGetters([
    ]),

    display_name() {
      return `${this.student.first_name} ${this.student.last_name}`;
    },

    email_uri() {
      return this.student.email.split('@')[0];
    },

    // image() {
      // if (this.student.image_priority === 'likeness') {
      //   return this.student.images.likeness;
      // } if (this.student.image_priority === 'avatar') {
      //   return this.student.images.avatar;
      // }
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
    getStudent() {
      this.$store.dispatch('getStudent', {studentID: this.student.student_id, email: this.student.email, first_name: this.student.first_name, last_name: this.student.last_name})
    },
    
	},
};
</script>
