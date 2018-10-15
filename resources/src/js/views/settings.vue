<template>
    <div>
        <nav-bar></nav-bar>
        <div class="container">
            <theme-setting></theme-setting>
            <about-banner></about-banner>
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