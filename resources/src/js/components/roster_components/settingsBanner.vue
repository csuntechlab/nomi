<template>
    <nav class="" style="height: 55px">
        <list-grid-selector class="col-xs-4 col-sm-4 col-md-4"></list-grid-selector>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <shuffle-button v-if="!this.list && this.flash"></shuffle-button>
        </div>
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