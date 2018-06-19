<template>
    <div>
        <about-banner></about-banner>
    </div>
</template>

<script>
    import AboutBanner from "../components/about_components/aboutBanner";

    export default {
        components: {
            AboutBanner
        },
        name: "About",

        created() {
            this.$store.dispatch('getData');
        }
    }
</script>