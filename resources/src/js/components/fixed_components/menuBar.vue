<template>
  <nav class="menu-bar bg--black">
    <div class="row">
      <div class="col-xs-11 col-sm-11 col-md-11">
        <toggle-view-button class="col-xs-3 col-sm-3 col-md-3"></toggle-view-button>
        <card-toggle-button class="col-xs-3 col-sm-3 col-md-3"></card-toggle-button>
        <shuffle-button class="col-xs-3 col-sm-3 col-md-3"></shuffle-button>
      </div>
      <div class="col-xs-1 col-sm-1 col-md-1">
          <side-bar-button></side-bar-button>
      </div>
    </div>
  </nav>
</template> 


<script>
import shuffleButton from '../roster_components/shuffleButton.vue'
import cardToggleButton from '../roster_components/cardToggleButton.vue'
import toggleViewButton from './toggleViewButton'
import sideBarButton from './sideBarButton'

export default {
	components: {
        shuffleButton,
        cardToggleButton,
        toggleViewButton,
        sideBarButton,
    },
}
</script>
