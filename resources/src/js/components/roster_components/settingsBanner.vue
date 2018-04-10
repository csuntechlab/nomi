<template>
    <div class="banner__position bg--light-grey">
        <div class="row">
            <router-link class="col-xs-4 col-sm-4 col-md-4 navy-blue" to="/">Back to Class Sections</router-link>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <shuffle-button v-if="!this.list && this.flash"></shuffle-button>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <card-toggle-button v-if="!this.list"></card-toggle-button>
            </div>
            <sort-selector class="col-xs-4 col-sm-4 col-md-4"></sort-selector>
        </div>
    </div>
</template>

<script>
    import shuffleButton from './shuffleButton.vue'
    import cardToggleButton from './cardToggleButton.vue'
    import sortSelector from './sortSelector.vue'
    import { mapGetters } from "vuex"
    export default {
        name: "settings-banner",

        components: {
            shuffleButton,
            cardToggleButton,
            sortSelector
        },

        computed: {
            ...mapGetters([
                'courseTitle',
                'list',
                'flash'
            ])
        }
    }
</script>