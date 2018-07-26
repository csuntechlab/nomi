<template>
    <div>
            <div>
                <ul v-if="showAbout" class="tabs cf type--center">
                    <li class="tab__list">
                        <a class="tab__link--active" @click="selectAbout">About</a>
                    </li>
                    <li class="tab__list">
                        <a class="tab__link" @click="selectVersion">Version History</a>
                    </li>
                </ul>
                <ul v-if="showAbout === false" class="tabs cf type--center">
                    <li class="tab__list">
                        <a class="tab__link" @click="selectAbout">About</a>
                    </li>
                    <li class="tab__list">
                        <a class="tab__link--active" @click="selectVersion">Version History</a>
                    </li>
                </ul>
            </div>
        <div class="panel about_padding">
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