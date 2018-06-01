<template>
    <nav class="" style="height: 55px">
        <list-grid-selector class="col-xs-6 col-sm-6 col-md-6"></list-grid-selector>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <shuffle-button v-if="!this.list && this.flash"></shuffle-button>
            <sort-selector v-else></sort-selector>
        </div>
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