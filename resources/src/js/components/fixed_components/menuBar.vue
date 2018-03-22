<template>
    <nav class="menu-bar navy-blue">
        <div class="row">
        <div class="col-xs-11 col-sm-11 col-md-11">
            <card-toggle-button class="col-xs-6 col-sm-6 col-md-6"></card-toggle-button>
            <shuffle-button class="col-xs-6 col-sm-6 col-md-6"></shuffle-button>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
            <i class="fa fa-ellipsis-v fa-3x " title="Menu" @click.prevent="openNav"></i>
            </div>
        </div>
    </nav>
</template>
<script>
import shuffleButton from '../roster_components/shuffleButton.vue'
import cardToggleButton from '../roster_components/cardToggleButton.vue'
import toggleViewButton from './toggleViewButton'
export default {
	components: {
        shuffleButton,
        cardToggleButton,
        toggleViewButton
    },

    methods: {
            openNav: function () {
                document.getElementById("mySidenav").style.width = "100vw";
            }
        }
}
</script>
