<template>
    <div>
		<nav-bar></nav-bar>
        <div v-if="(this.studentProfile.images == null) || (this.$route.params.emailURI != this.studentProfile.emailURI)" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
        </div>
        <div v-else>
			<modal></modal>
            <profile-container :student="this.studentProfile.student"></profile-container>
            <profile-info :student="this.studentProfile" @unsavedChanges="setUnsavedChanges" @committedChanges="setChanges"></profile-info>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import profileContainer from "../components/profile_components/profileContainer.vue";
import modal from "../components/fixed_components/modal.vue";
import profileInfo from "../components/profile_components/profileInfo.vue";
import navBar from '../components/fixed_components/navBar.vue';

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
		profileInfo,
		navBar,
	},

	created() {
		this.$store.dispatch('disableBackButton');
		this.$store.dispatch('showBackButton');
	},

	mounted() {
		this.$store.dispatch('getStudentProfile', {
			id: this.$store.state.profile.studentProfile.studentID,
			uri: this.$route.params.emailURI,
			faculty_id: this.facultyMember.id,
			email: this.$store.state.profile.studentProfile.email,
			first_name: this.$store.state.profile.studentProfile.firstName,
			last_name: this.$store.state.profile.studentProfile.lastName,
		});
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
			next();
		} else {
			next(false);
		}
		} else {
		this.$store.dispatch('hideBackButton');
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
