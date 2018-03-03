<template>
  <nav class="menu-bar">
    <div class="row">
      <div class="col-xs-10 col-sm-10">
        <toggle-view-button class="col-xs-2 col-sm-2"></toggle-view-button>
        <card-toggle-button class="col-xs-2 col-sm-2"></card-toggle-button>
        <shuffle-button class="col-xs-2 col-sm-2"></shuffle-button>
      </div>
      <div class="col-xs-2 col-sm-2">
        <input type="image" src="/images/menu.png" @click.prevent="openNav()"></input>
      </div>
    </div>
  </nav>

</template> 

<script>
import shuffleButton from './roster_components/shuffleButton.vue';
import cardToggleButton from './roster_components/cardToggleButton.vue';
import toggleViewButton from './fixed_components/toggleViewButton.vue';

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