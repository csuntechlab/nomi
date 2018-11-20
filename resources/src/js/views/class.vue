<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <upload-bar :sticky="true"></upload-bar>
        <course-banner></course-banner>
        <settings-banner></settings-banner>
        <div class="container-full">
            <roster-container :courseid="this.$route.params.id"></roster-container>
        </div>
    </div>
    <div v-else>
        <loading-screen></loading-screen>
    </div>
</template>

<script>
import settingsBanner from '../components/roster_components/settingsBanner.vue';
import courseBanner from '../components/roster_components/courseBanner.vue';
import navBar from '../components/fixed_components/navBar.vue';
import loadingScreen from '../components/fixed_components/loadingScreen.vue';
import rosterContainer from '../components/roster_components/rosterContainer.vue';
import uploadBar from '../components/fixed_components/uploadBar.vue';

export default {
    name: 'class',
    components: {
        settingsBanner,
        courseBanner,
        rosterContainer,
        loadingScreen,
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
