<template>
    <div class="container">
        <term-selector></term-selector>
        <courses-container></courses-container>
    </div>
</template>

<script>
import termSelector from "../components/course_components/termSelector.vue";
import coursesContainer from "../components/course_components/coursesContainer.vue";
export default {
    name: "home",
    
    components: {
        termSelector,
        coursesContainer
    },

	created() {
		this.$store.dispatch("clearErrors");
		this.$store.dispatch("hideBackButton");
	},

	beforeRouteLeave(to, from, next) {
		this.$store.dispatch("showBackButton");
		next();
	},
	beforeCreate() {
		this.$store.dispatch("getOnlyData");
	}
};
</script>
