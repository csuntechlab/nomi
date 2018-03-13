<template>
    <i class="fa fa-ellipsis-v fa-3x type--white" title="Menu" @click.prevent="openNav()"></i>
</template>

<script>
    export default {
        name: "side-bar-button",
        methods: {
             openNav: function() {
                document.getElementById("sideNav").style.width = "100vw";
            }
        }
    }
</script>
