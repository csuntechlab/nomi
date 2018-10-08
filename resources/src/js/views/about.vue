<template>
    <div>
        <nav-bar></nav-bar>
        <about-banner></about-banner>
    </div>
</template>

<script>
import navBar from '../components/fixed_components/navBar.vue';
import AboutBanner from '../components/about_components/aboutBanner';

export default {
    components: {
    AboutBanner,
    navBar,
},
    name: 'About',
};
</script>