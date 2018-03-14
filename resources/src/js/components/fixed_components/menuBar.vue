<template>
    <nav class="menu-bar bg--black">
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10"></div>
            <div class="col-xs-2 col-sm-2 col-md-2">
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