<template>
    <div class="gallery-card col-xs-6 col-md-4 col-lg-3">
        <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri">
		</router-link>
        	<div class="panel gallery-card__content">
				<div class="panel__wrapper">
					<div class="panel__content">
						<profile-picture :student="student" :editable="true" :image="image" :type="'roster'" />
					</div>
				</div>
				<div class="cardText clearPadding">
					<div class="gallery__name type--center">{{display_name}}</div>
				</div>
        	</div>
    </div>
        
</template>

<script>
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import croppaProfile from "../profile_components/croppaProfile.vue";
import imageHandler from "../profile_components/imageHandler.vue";
import profilePicture from "../profile_components/profilePicture.vue";
export default {
	name: "gallery-card",
	props: ["student"],

	data: function() {
		return {
			messages: true,
			errors: [],
			showCroppaModal: false,
		};
	},

	components: {
		croppaProfile,
		imageHandler,
		profilePicture
	},

	created() {
		this.$store.dispatch("getStudentProfile", {
			uri: this.student.email_uri,
			faculty_id: this.facultyMember.id
		});
		console.log(this.student)
		
		
	},

	computed: {

		...mapGetters([
			'permission',
			'studentProfile',
			'facultyMember',
			'modalVisible',
			'modalData'
		]),

		displayModal(){
			return(this.showCroppaModal && this.permission);
		},

		display_name: function() {
			return this.student.first_name + " " + this.student.last_name[0] + ".";
		},

		email_uri: function() {
			return this.student.email.split("@")[0];
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
		},

		
	}
};
</script>
