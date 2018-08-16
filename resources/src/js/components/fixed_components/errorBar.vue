<template>
    <div v-if="this.errors || this.profileLoadError" id="error_bar" class="alert alert--warning">
        <strong>Oops!</strong> Something went wrong
         <a href="#" class="alert__close" @click="closeError()" >&times;</a>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";
export default {
	name: "error-bar",

	data: function() {
		return {
			showError: false
		};
	},

	computed: {
		...mapGetters([
			"errors",
			"profileErrors",
			"profileLoadError",
			"currentCourse"
		])
	},

	updated() {
		this.enableBackButton();
	},

	methods: {
		...mapActions([
            "enableBackButton",
            "clearErrors"
		]),

		logErrors() {
			console.log("Error found: " + this.errors);
		},

		closeError() {
			if (this.profileLoadError == true) {
                let course = this.currentCourse;
				this.$router.go(-1);
            }
            this.logErrors();
            this.clearErrors();
		},
	}
};
</script>

