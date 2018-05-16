<template>
    <div class="panel center">
        <about-page></about-page>
        <!--<version-history></version-history>-->
    </div>
</template>

<script>
    import AboutPage from "./aboutPage"
    import VersionHistory from "./versionHistoryPage";

    export default {
        components: {
            VersionHistory,
            AboutPage},
        name: "about-container",
    }
</script>