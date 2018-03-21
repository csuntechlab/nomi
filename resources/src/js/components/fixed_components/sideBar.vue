<template>
        <div id="sideNav" class="sidebar navy-blue">
            <div class="sidebar_container type--center">  
                <div class="menu type--center">
                        <shuffle-button></shuffle-button> 
                        <div class="list">
                            <router-link class="sidebar_text"  to="#" title="Game">Game</router-link> 
                            <a class="sidebar_text" href="https://www.csun.edu/faculty/scholarship">Scholarship</a>       
                            <router-link class="sidebar_text"  to="#" title="Logout">Logout</router-link>     
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