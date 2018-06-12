<template>
    <nav class="" style="height: 55px">
        <div v-if="!this.list && this.flash">
            <list-grid-selector class="col-xs-9 col-sm-9 col-md-9"></list-grid-selector>
            <shuffle-button v-if="!this.list && this.flash" class="col-xs-3 col-sm-3 col-md-3 botPaddingSort"></shuffle-button>
        </div>
        <div v-else>    
            <list-grid-selector class="col-xs-12 col-sm-5 col-md-5"></list-grid-selector>
            <sort-selector class="col-xs-12 col-sm-7 col-md-7 botPaddingSort"></sort-selector>
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