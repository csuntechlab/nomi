<template>
    <div class="gallery-card col-xs-6 col-md-4 col-lg-3">
		<div data-interactable class="panel gallery-card__content">
			<div class="panel__wrapper">
				<div class="panel__content">
					<gallery-profile :student="student" :email="student.email_uri" :course_id="this.$route.params.id" :editable="emailExists" :image="image" :type="'profile'" />
				</div>
			</div>
			<router-link :to="'/profile/'+this.$route.params.id+'/'+student.email_uri" @click.native="setStudent()">
			<div class="cardText clearPadding">
				<div class="gallery__name type--center">{{student.display_name}}</div>
			</div>
			</router-link>
		</div>
    </div>
        
</template>

<script>
import { mapGetters, mapState } from "vuex";
import galleryProfile from "../roster_components/galleryProfile.vue";
import { getImage } from './../../mixins/getImage.js';
import { setStudent } from '../../mixins/setStudent.js'
import { refetchImage } from './../../mixins/refetchImage.js'
import { displayName } from './../../mixins/displayName.js';

export default {
	name: 'gallery-card',
	props: ['student'],
	mixins: [setStudent, getImage, refetchImage, displayName],

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
		]),

		emailExists() {
			return this.student.email.split('@')[1] != 'NOTREALEMAIL.net';
		},
	},
};
</script>
