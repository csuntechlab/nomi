<template>
        <div id="sideNav" class="sidenav bg--black">
            <div class="pileContainer centered-position">
                <div class="pile"><i class="fa fa-user fa-2x type--white" title="Profile" href="#"></i>Profile</div>
                <div class="pile"><i class="fa fa-gamepad fa-2x type--white" title="Game" href="#"></i>Game</div>
                <div class="pile"><i class="fa fa-cog fa-2x type--white" title="Settings" href="#"></i>Settings</div>
                <div class="pile"><i class="fa fa-power-off fa-2x type--white" title="Logout" href="/logout"></i>Logout</div>
                <div class="pile"><i class="fa fa-times fa-2x type--white" title="Close" @click.prevent="closeNav()"></i></div>
            </div>
        </div>
</template>

<script>
    export default {
        name: "side-bar",
        methods: {
            closeNav: function(event) {
                document.getElementById("sideNav").style.height = "0%";
            }
        }
    }
</script>