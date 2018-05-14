<template>
    <nav class="" style="height: 55px">
        <back-button class="col-xs-2 col-sm-2 col-md-2" v-if="this.list || !this.flash" destination="/"></back-button>
        <card-toggle-button class="col-xs-2 col-sm-2 col-md-2" v-if="!this.list"></card-toggle-button>
        <shuffle-button class="col-xs-2 col-sm-2 col-md-2" v-if="!this.list && this.flash"></shuffle-button>
        <list-grid-selector class="col-xs-4 col-sm-4 col-md-4"></list-grid-selector>
        <sort-selector class="col-xs-4 col-sm-4 col-md-4"></sort-selector>
    </nav>
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
            sortSelector,
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