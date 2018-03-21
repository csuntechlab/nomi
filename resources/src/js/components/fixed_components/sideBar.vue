<template>
        <div id="sideNav" class="sidenav bg--black">
                <div class="menu type--center">         
                    <!-- <div class="img bgred centered-position"></div>   -->
                    <shuffle-button></shuffle-button>            
                    <h3 class="text" title="Game">Game</h3> 
                    <h3 class="text" href="https://www.csun.edu/faculty/scholarship">Scholarship</h3>       
                    <h3 class="text" title="Logout">Logout</h3>
                    <i class="fa fa-times fa-1x type--white close" title="Close" @click.prevent="closeNav()"></i>
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