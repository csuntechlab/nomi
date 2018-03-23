<template>
  <nav class="menu-bar navy-blue">
    <div class="row">
        <div class="type--center">
            <side-bar-button></side-bar-button>
        </div>
    </div>
  </nav>
</template> 


<script>
import sideBarButton from './sideBarButton'
export default {
	components: {
        sideBarButton
    }
}
</script>
