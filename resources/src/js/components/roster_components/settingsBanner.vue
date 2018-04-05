<template>
    <div class="banner__position light-grey">
        <div class="row">
            <shuffle-button class="col-xs-4 col-sm-4 col-md-4"></shuffle-button>
            <card-toggle-button class="col-xs-4 col-sm-4 col-md-4"></card-toggle-button>
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
                'courseTitle'
            ])
        }
    }
</script>