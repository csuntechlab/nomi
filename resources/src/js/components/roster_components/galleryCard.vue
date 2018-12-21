<template>
    <div class="gallery-card col-xs-6 col-md-4 col-lg-3">
        
		
        	<div class="panel gallery-card__content">
				<div class="panel__wrapper">
					<div class="panel__content">
						<gallery-profile :student="student" :email="student.email_uri" :course_id="this.$route.params.id" :editable="emailExists" :image="image" :type="'profile'" />
					</div>
				</div>
				<router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri" @click.native="getStudent()">
				<div class="cardText clearPadding">
					<div class="gallery__name type--center">{{display_name}}</div>
				</div>
				</router-link>
        	</div>
					
    </div>
        
</template>

<script>
import { mapGetters, mapState } from "vuex";
import galleryProfile from "../roster_components/galleryProfile.vue";
import { getImage } from './../../mixins/getImage.js';
import { getStudent } from './../../mixins/getStudent.js'

export default {
  name: 'gallery-card',
	props: ['student'],
	mixins: [getStudent, getImage],

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
      return this.student.email.split('@')[1] != 'NOTREALEMAIL.net';
    },
	},
};
</script>
