<template>
  <nav class="menu-bar navy-blue">
    <div class="row">
      <div class="col-xs-11 col-sm-11 col-md-11">
        <toggle-view-button class="col-xs-3 col-sm-3 col-md-3"></toggle-view-button>
        <card-toggle-button class="col-xs-3 col-sm-3 col-md-3"></card-toggle-button>
        <shuffle-button class="col-xs-3 col-sm-3 col-md-3"></shuffle-button>
      </div>
      <div class="col-xs-1 col-sm-1 col-md-1">
          <i class="fa fa-ellipsis-v fa-3x type--white" title="Menu" @click.prevent="openNav()"></i>
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
