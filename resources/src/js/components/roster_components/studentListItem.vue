<template>
    <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri">
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

    image() {
      if (this.student.image_priority === 'likeness') {
        return this.student.images.likeness.likeness_image;
      } if (this.student.image_priority === 'avatar') {
        return this.student.images.avatar.avatar_image;
      }
    },
  },
};
</script>
