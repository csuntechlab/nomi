<template>
  <nav class="menu-bar">
  	<card-toggle-button class="col-sm-3"></card-toggle-button>
  	<toggle-view-button class="col-sm-3"></toggle-view-button>
  	<shuffle-button class="col-sm-3"></shuffle-button>
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