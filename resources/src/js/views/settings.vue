<template>
    <div>
        <theme-setting></theme-setting>
        <about-banner></about-banner>
    </div>
</template>

<script>
    import themeSetting from "../components/fixed_components/themeSetting.vue";
    import AboutBanner from "../components/about_components/aboutBanner";

    export default {
        name: "Settings",
        components: {
            AboutBanner
        },
    }
</script>