<template>
  <nav class="menu-bar container">
    <div class="row">
      <div class="col-sm-11">
        <toggle-view-button class="col-sm-3"></toggle-view-button>
        <card-toggle-button class="col-sm-3"></card-toggle-button>
        <shuffle-button class="col-sm-3"></shuffle-button>
      </div>
      <div class="col-sm-1">
        <button class="btn btn-default" @click.prevent="openNav()">SideBar</button>
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
<!-- 
<style scoped>
	card-toggle-button, toggle-view-button, shuffle-button {
		position: absolute;
		top: 0;
		left: 0;
	}
</style> -->