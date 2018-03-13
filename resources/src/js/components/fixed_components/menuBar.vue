<template>
    <nav class="menu-bar bg--black">
        <div class="row">
            <div class="col-xs-11 col-sm-11 col-md-11"></div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <side-bar-button></side-bar-button>
            </div>
        </div>
    </nav>
</template>

<script>
import sideBarButton from './sideBarButton.vue'
export default {
    components:{
        sideBarButton
    }

}
</script>