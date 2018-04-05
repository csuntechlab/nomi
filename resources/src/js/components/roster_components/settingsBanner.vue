<template>
    <div class="banner__position light-grey">
        <div class="row">
            <shuffle-button></shuffle-button>
            <name-toggle-button></name-toggle-button>
            <descending-toggle-button></descending-toggle-button>
            <card-toggle-button></card-toggle-button>
        </div>
    </div>
</template>

<script>
    import nameToggleButton from "./nameToggleButton"
    import descendingToggleButton from "./descendingToggleButton"
    import shuffleButton from './shuffleButton.vue'
    import cardToggleButton from './cardToggleButton.vue';
    import { mapGetters } from "vuex"
    export default {
        name: "settings-banner",

        components: {
            shuffleButton,
            nameToggleButton,
            descendingToggleButton,
            cardToggleButton,
        },

        computed: {
            ...mapGetters([
                'courseTitle'
            ])
        }
    }
</script>