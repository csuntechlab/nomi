<template>
    <nav>
        <div v-if="!this.list && this.flash">
            <div class="row sort-filters">
            <list-grid-selector></list-grid-selector>
            </div>
            <shuffle-button v-if="!this.list && this.flash" class="btn shuffle-button"></shuffle-button>
        </div>
        <div v-else class="row sort-filters"> 
            <list-grid-selector></list-grid-selector>
            <sort-selector></sort-selector>
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