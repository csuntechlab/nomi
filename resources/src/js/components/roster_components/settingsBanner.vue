<template>
    <nav style="height: 55px">
        <div v-if="!this.list && this.flash">
            <div class="row sort_filters">
            <list-grid-selector class="col-xs-6 col-sm-6 col-md-6"></list-grid-selector>
            </div>
            <shuffle-button v-if="!this.list && this.flash" class="btn shuffle_button"></shuffle-button>
        </div>
        <div v-else class="row sort_filters"> 
            <list-grid-selector class="col-xs-6 col-sm-6 col-md-6"></list-grid-selector>
            <sort-selector class="col-xs-6 col-sm-6 col-md-6"></sort-selector>
        </div>
    </nav>
</template>

<script>
    import shuffleButton from './shuffleButton.vue';
    import cardToggleButton from './cardToggleButton.vue';
    import sortSelector from './sortSelector.vue';
    import listGridSelector from "../fixed_components/listGridSelector.vue";
    import { mapGetters } from "vuex";
    export default {
        name: "settings-banner",

        components: {
            shuffleButton,
            cardToggleButton,
            sortSelector,
            listGridSelector
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