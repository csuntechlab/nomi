<template>
    <div>
        <course-banner></course-banner>
        <settings-banner></settings-banner>
        <div class="container-full">
            <roster-container :courseid="this.$route.params.id"></roster-container>
        </div>
    </div>
</template>

<script>
import settingsBanner from "../components/roster_components/settingsBanner.vue";
import courseBanner from "../components/roster_components/courseBanner.vue";
import rosterContainer from "../components/roster_components/rosterContainer.vue";
export default {
    name: "class",
    components: {
        settingsBanner,
        courseBanner,
        rosterContainer
    },
	created() {
        this.$store.dispatch("clearErrors");
    }
}
</script>
