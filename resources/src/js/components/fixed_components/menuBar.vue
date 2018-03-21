<template>
    <nav class="menu-bar bg--black">
        <div class="row">
            <div class="col-xs-5 col-sm-5 col-md-5">
                <toggle-view-button class="col-xs-4 col-sm-4 col-md-4"></toggle-view-button>
                <div class="col-xs-8 col-sm-8 col-md-8">
                    <div v-if="this.courseid >= 0">
                        <name-toggle-button class="col-xs-4 col-sm-5 col-md-5"></name-toggle-button>
                        <div class="col-xs-2 col-sm-2 col-md-2"></div>
                        <descending-toggle-button class="col-xs-4 col-sm-5 col-md-5"></descending-toggle-button>
                    </div>
                </div>
            </div>

            <div class="col-xs-2 col-sm-2 col-md-2">
                <i class="fa fa-ellipsis-v fa-3x type--white" title="Menu" @click.prevent="openNav"></i>
            </div>

            <div class="col-xs-5 col-sm-5 col-md-5">
                <div v-if="!this.list && this.courseid >= 0">
                    <card-toggle-button class="col-xs-6 col-sm-6 col-md-6"></card-toggle-button>
                    <shuffle-button class="col-xs-6 col-sm-6 col-md-6"></shuffle-button>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import shuffleButton from '../roster_components/shuffleButton'
import cardToggleButton from '../roster_components/cardToggleButton'
import toggleViewButton from './toggleViewButton'
import nameToggleButton from '../roster_components/nameToggleButton'
import descendingToggleButton from '../roster_components/descendingToggleButton'
import { mapGetters } from 'vuex'
export default {
	components: {
        shuffleButton,
        cardToggleButton,
        toggleViewButton,
        nameToggleButton,
        descendingToggleButton
    },

    methods: {
        openNav: function() {
            document.getElementById("mySidenav").style.width = "100vw";
        }
    },

    computed: {
        ...mapGetters([
            'flash',
            'list',
            'courseid'
        ])
    }
}
</script>
