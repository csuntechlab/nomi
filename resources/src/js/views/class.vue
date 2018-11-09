<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <upload-bar></upload-bar>
        <course-banner></course-banner>
        <settings-banner></settings-banner>
        <div class="container-full">
            <roster-container :courseid="this.$route.params.id"></roster-container>
        </div>
    </div>
    <div v-else>
        <div class="post-login type--center">
            <div class="post-login-container">
                <i class="fa fa-spinner fa-spin fa-3x post-login__loading-icon"></i>
            </div>
        </div>
    </div>
</template>

<script>
import settingsBanner from '../components/roster_components/settingsBanner.vue';
import courseBanner from '../components/roster_components/courseBanner.vue';
import navBar from '../components/fixed_components/navBar.vue';
import rosterContainer from '../components/roster_components/rosterContainer.vue';
import uploadBar from '../components/fixed_components/uploadBar.vue';

export default {
    name: 'class',
    components: {
        settingsBanner,
        courseBanner,
        rosterContainer,
        navBar,
        uploadBar
    },

    created() {
        this.$store.dispatch('clearErrors');
    },

    beforeRouteLeave (to, from, next) {
        this.$store.dispatch('stopUploadFeedback');
        next();
    }
};
</script>
