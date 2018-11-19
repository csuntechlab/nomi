<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
		<nav-bar></nav-bar>
        <div v-if="(this.studentProfile.images == null) || (this.$route.params.emailURI != this.studentProfile.emailURI)" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"/>
        </div>
        <div v-else>
			<modal></modal>
            <profile-container :student="this.studentProfile.student"/>
			<upload-bar/>
            <profile-info :student="this.studentProfile" @unsavedChanges="setUnsavedChanges" @committedChanges="setChanges"/>
        </div>
    </div>
	<div v-else>
        <loading-screen></loading-screen>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import profileContainer from "../components/profile_components/profileContainer.vue";
import modal from "../components/fixed_components/modal.vue";
import loadingScreen from '../components/fixed_components/loadingScreen.vue';
import profileInfo from "../components/profile_components/profileInfo.vue";
import navBar from '../components/fixed_components/navBar.vue';
import uploadBar from '../components/fixed_components/uploadBar.vue';

export default {
	name: 'profile',

	data() {
		return {
			unsavedChanges: false,
		};
	},

	components: {
		profileContainer,
		modal,
		loadingScreen,
		profileInfo,
		navBar,
		uploadBar
	},

	created() {
		this.$store.dispatch('disableBackButton');
		this.$store.dispatch('showBackButton');
	},

	mounted() {
		let emailSplit = this.$store.state.profile.studentProfile.email.split('@');
		if (emailSplit[1] === "NOTREALEMAIL.net") {
			this.$store.dispatch('getStudentProfileNoEmail', {
				id: this.$store.state.profile.studentProfile.studentID,
				uri: this.$route.params.emailURI,
				faculty_id: this.facultyMember.id,
				email: this.$store.state.profile.studentProfile.email,
				first_name: this.$store.state.profile.studentProfile.firstName,
				last_name: this.$store.state.profile.studentProfile.lastName,
			});
		} else {
			this.$store.dispatch('getStudentProfile', {
				id: this.$store.state.profile.studentProfile.studentID,
				uri: this.$route.params.emailURI,
				faculty_id: this.facultyMember.id,
				email: this.$store.state.profile.studentProfile.email,
				first_name: this.$store.state.profile.studentProfile.firstName,
				last_name: this.$store.state.profile.studentProfile.lastName,
			});
		}
		this.$store.dispatch('storeStudent', this.$route.params.emailURI);
	},

	updated() {
		this.$store.dispatch('enableBackButton');
	},

	beforeRouteLeave(to, from, next) {
		if (this.profileLoadError) {
		this.clearProfileErrors();
		}
		if (this.unsavedChanges) {
		const answer = window.confirm(
			'Do you really want to leave? You have unsaved changes.',
		);

		if (answer) {
			this.$store.dispatch('hideBackButton');
			this.$store.dispatch('stopUploadFeedback');
			next();
		} else {
			next(false);
		}
		} else {
		this.$store.dispatch('hideBackButton');
		this.$store.dispatch('stopUploadFeedback');
		next();
		}
	},

	computed: {

		...mapGetters(['studentProfile', 'facultyMember', 'profileErrors', 'profileLoadError']),
	},

	methods: {
		...mapActions([
		'clearProfileErrors',
		]),
		setUnsavedChanges() {
		this.unsavedChanges = true;
		},
		setChanges() {
		this.unsavedChanges = false;
		},
	},
};
</script>
