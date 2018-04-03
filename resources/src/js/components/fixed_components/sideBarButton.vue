<template>
<nav class="side_bar_button navy-blue">
    <div class="row">
        <div class="type--center">
            <i class="fa fa-angle-up fa-3x type--white" title="Menu" @click.prevent="openNav()"></i>
        </div>
    </div>
  </nav>
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
