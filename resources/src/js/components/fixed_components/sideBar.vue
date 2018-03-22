<template>
        <div id="sideNav" class="sidebar navy-blue">
            <div class="sidebar_container type--center">  
                <div class="menu type--center">
                        <shuffle-button></shuffle-button> 
                        <div class="list">
                            <router-link class="faculty-links"  to="#" title="Game">Game</router-link> 
                            <a class="faculty-links" href="https://www.csun.edu/faculty/scholarship">Scholarship</a>       
                            <router-link class="faculty-links"  to="#" title="Logout">Logout</router-link>     
                        </div>              
                </div> 
                <div class="close">
                    <i class="fa fa-angle-down fa-3x type--white" title="Close" @click.prevent="closeNav()"></i>
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