<template>
    <div>
        <div class="nav-bars">
            <div class="tab-container">
                <ul class="tabs cf type--center">
                    <li class="tab__list">
                        <a class="tab__link tab__link--active" @click="selectAbout">About</a>
                    </li>
                    <li class="tab__list">
                        <a class="tab__link" @click="selectVersion">Version History</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel center">
            <div v-if="showAbout">
                <about-page></about-page>
            </div>
            <div v-else>
                <version-history></version-history>
            </div>
        </div>
    </div>
</template>

<script>
    import AboutPage from "./aboutPage"
    import VersionHistory from "./versionHistoryPage";

    export default {
        components: {
            VersionHistory,
            AboutPage},
        name: "about-banner",
        data: function(){
            return {
                showAbout: true
            }
        },


        methods: {
            selectAbout: function (){
                this.showAbout = true
            },
            selectVersion: function(){
                this.showAbout = false
            }
        }

    }
</script>