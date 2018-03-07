<template>
  <nav class="menu-bar bg--black">
    <div class="row">
      <div class="col-xs-10 col-sm-10 col-md-10">
        <toggle-view-button class="col-xs-3 col-sm-3 col-md-3"></toggle-view-button>
        <card-toggle-button class="col-xs-3 col-sm-3 col-md-3"></card-toggle-button>
        <shuffle-button class="col-xs-3 col-sm-3 col-md-3"></shuffle-button>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2">
        <button class="btn btn-default" @click.prevent="openNav()">
          <i class="fa fa-ellipsis-v" title="Menu"></i>
        </button>
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
            openNav: function(event) {
                document.getElementById("mySidenav").style.width = "100vw";
            }

           
        }
}
</script>