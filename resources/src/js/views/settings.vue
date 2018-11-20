<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <div class="container">
            <theme-setting></theme-setting>
            <about-banner></about-banner>
        </div>
    </div>
    <div v-else>
        <loading-screen></loading-screen>
    </div>
</template>

<script>
import navBar from '../components/fixed_components/navBar.vue';
import themeSetting from '../components/fixed_components/themeSetting.vue';
import loadingScreen from '../components/fixed_components/loadingScreen.vue';
import aboutBanner from '../components/about_components/aboutBanner';

export default {
    name: 'Settings',
    components: {
        aboutBanner,
        themeSetting,
        loadingScreen,
        navBar,
    },
};
</script>