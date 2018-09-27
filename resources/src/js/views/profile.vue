<template>
    <div>
        <div v-if="this.studentProfile.images == null" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
        </div>
        <div v-else>
			<modal></modal>
            <profile-container :student="this.studentProfile"></profile-container>
            <profile-info :student="this.studentProfile" @unsavedChanges="setUnsavedChanges" @committedChanges="setChanges"></profile-info>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import profileContainer from "../components/profile_components/profileContainer.vue";
import modal from "../components/fixed_components/modal.vue";
import profileInfo from "../components/profile_components/profileInfo.vue";
export default {
	name: "profile",

	data: function() {
		return {
			unsavedChanges: false
		};
	},

	components: {
		profileContainer,
		modal,
		profileInfo
	},

	created() {
		this.$store.dispatch("disableBackButton");
		this.$store.dispatch("showBackButton");
		this.$store.dispatch("getStudentProfile", {
			uri: this.$route.params.emailURI,
			faculty_id: this.facultyMember.id
		});
	},

	updated() {
		this.$store.dispatch("enableBackButton");
	},

	beforeRouteLeave(to, from, next) {
		if(this.profileLoadError){
			this.logErrors();
			this.clearProfileErrors();
		}
		if (this.unsavedChanges) {
			const answer = window.confirm(
				"Do you really want to leave? You have unsaved changes."
			);

			if (answer) {
				this.$store.dispatch("hideBackButton");
				next();
			} else {
				next(false);
			}
		} else {
			this.$store.dispatch("hideBackButton");
			next();
		}
	},

	computed: {

		...mapGetters(["studentProfile", "facultyMember", 'profileErrors', 'profileLoadError'])
	},

	methods: {
		...mapActions([
			"clearProfileErrors",
		]),
		setUnsavedChanges() {
			this.unsavedChanges = true;
		},
		setChanges() {
			this.unsavedChanges = false;
		},

		logErrors() {
			console.log("Profile Error found: " + this.profileErrors);
		},
	}

};
</script>
