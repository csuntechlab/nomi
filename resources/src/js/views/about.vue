<template>
    <div>
        <about-banner></about-banner>
        <div>
            <about-container></about-container>
        </div>
    </div>
</template>

<script>
    import AboutBanner from "../components/about_components/aboutBanner";
    import AboutContainer from "../components/about_components/aboutContainer";

    export default {
        components: {
            AboutContainer,
            AboutBanner},
        name: "About"
    }
</script>