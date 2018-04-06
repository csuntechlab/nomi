<template>
    <i class="fa fa-angle-up fa-3x" id="caret" title="Menu" @click.prevent="openNav()"></i>
</template>

<script>
    export default {
        name: "side-bar-button",
        methods: {
             openNav: function() {
                document.getElementById("sideNav").style.height = "75%";
            }
        }
    }
</script>