<template>
  <nav class="metalab-footer menu-bar container">
    <div class="row">
      <div class="col-sx-8 col-sm-10">
        <toggle-view-button class="col-sx-2 col-sm-2"></toggle-view-button>
        <card-toggle-button class="col-sx-2 col-sm-2"></card-toggle-button>
        <shuffle-button class="col-sx-2 col-sm-2"></shuffle-button>
      </div>
      <div class="col-sx-4 col-sm-2">
        <input type="image" src="/images/menu.png" @click.prevent="openNav()">SideBar</input>
      </div>
    </div>
  </nav>

</template> 

<script>
import shuffleButton from './shuffleButton.vue';
import cardToggleButton from './cardToggleButton.vue';
import toggleViewButton from './toggleViewButton.vue';

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