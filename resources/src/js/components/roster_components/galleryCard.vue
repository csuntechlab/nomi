<template>
    <div class="gallery-card col-xs-6 col-md-4 col-lg-3">
        
		
        	<div class="panel gallery-card__content">
				<div class="panel__wrapper">
					<div class="panel__content">
						<gallery-profile :student="student" :email="student.email_uri" :course_id="this.$route.params.id" :editable="emailExists" :image="image" :type="'profile'" />
					</div>
				</div>
				<router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri" >
				<div class="cardText clearPadding">
					<div class="gallery__name type--center">{{display_name}}</div>
				</div>
				</router-link>
        	</div>
					
    </div>
        
</template>

<script>
import { mapGetters, mapState } from "vuex";
// import profilePicture from "../profile_components/profilePicture.vue";
import galleryProfile from "../roster_components/galleryProfile.vue";
export default {
  name: 'gallery-card',
  props: ['student'],

	data: function() {
		return {
			messages: true,
			errors: [],
			showCroppaModal: false,
		};
	},

	components: {
		galleryProfile
	},

	created() {
		this.$store.dispatch("getStudentProfile", {
			uri: this.student.email_uri,
			faculty_id: this.facultyMember.id
		});
	},

	computed: {

		...mapGetters([
			'permission',
			'facultyMember',
		]),

    display_name() {
      return `${this.student.first_name} ${this.student.last_name[0]}.`;
    },

    email_uri() {
      return this.student.email.split('@')[0];
    },

    emailExists() {
      return (this.student.emailURI != null);
    },

    image() {
      if (this.student.image_priority === 'likeness') {
        return this.student.images.likeness;
      } if (this.student.image_priority === 'avatar') {
        return this.student.images.avatar;
      }
    },
  },
};
</script>
