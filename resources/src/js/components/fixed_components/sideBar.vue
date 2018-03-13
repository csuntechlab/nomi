<template>
    <div>
        <div id="sideNav" class="sidenav">
            <i class="fa fa-times fa-3x type--white" title="Close" @click.prevent="closeNav()"></i>
            <i class="fa fa-user fa-3x type--white" title="Profile" href="#">Profile</i>
            <i class="fa fa-gamepad fa-3x type--white" title="Game" href="#">Game</i>
            <i class="fa fa-cog fa-3x type--white" title="Settings" href="#">Settings</i>
            <i class="fa fa-power-off fa-3x type--white" title="Logout" href="/logout">Logout</i>
        </div>
    </div>
</template>

<script>
    export default {
        name: "side-bar",
        methods: {
            openNav: function(event) {
                document.getElementById("sideNav").style.width = "100vw";
            },
            closeNav: function(event) {
                document.getElementById("sideNav").style.width = "0";
            }
        }
    }
</script>