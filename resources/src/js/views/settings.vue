<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <div class="container">
            <theme-setting></theme-setting>
            <about-banner></about-banner>
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
import navBar from '../components/fixed_components/navBar.vue';
import themeSetting from '../components/fixed_components/themeSetting.vue';
import aboutBanner from '../components/about_components/aboutBanner';

export default {
    name: 'Settings',
    components: {
        aboutBanner,
        themeSetting,
        navBar,
    },
};
</script>