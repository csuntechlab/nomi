<template>
        <div id="sideNav" class="sidenav bg--black">
            <div class="centered-position sideHeight">
                <div class="img bg--red"></div>
                <div>
                    <div class="pile">
                        <i class="fa fa-user fa-2x type--white" title="Profile"></i>
                        <div class="text">Profile</div> 
                    </div>
                    <div class="pile">
                            <i class="fa fa-gamepad fa-2x type--white" title="Game"></i>                       
                            <div class="text">Game</div>
                    </div>
                    <div class="pile">
                            <i class="fa fa-cog fa-2x type--white" title="Settings"></i>       
                            <div class="text">Settings</div>
                    </div>
                    <div class="pile">
                            <i class="fa fa-power-off fa-2x type--white" title="Logout" href="/logout"></i>           
                            <div class="text">Logout</div>
                    </div>
                    <div class="pile">
                            <i class="fa fa-times fa-2x type--white" title="Close" @click.prevent="closeNav()"></i>
                    </div>
                </div>
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