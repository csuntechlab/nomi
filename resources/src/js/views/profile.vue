<template>
    <div>
        <div v-if="(this.studentProfile.images == null) || (this.$route.params.emailURI != this.studentProfile.emailURI)" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
        </div>
        <div v-else>
            <profile-carousel :student="this.studentProfile"></profile-carousel>
            <profile-info :student="this.studentProfile" @unsavedChanges="setUnsavedChanges" @committedChanges="setChanges"></profile-info>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import profileCarousel from "../components/profile_components/profileCarousel.vue";
import profileInfo from "../components/profile_components/profileInfo.vue";
export default {
	name: "profile",

	data: function() {
		return {
			unsavedChanges: false
		};
	},

	components: {
		profileCarousel,
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

	mounted() {
		this.$store.dispatch("storeStudent", this.$route.params.emailURI);
	},

	updated() {
		this.$store.dispatch("enableBackButton");
	},

	beforeRouteLeave(to, from, next) {
		if(this.profileLoadError){
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
	}

};
</script>
