<template>
        <div id="sideNav" class="sidebar navy-blue">
            <div class="sidebar_container type--center">  
                <div class="menu type--center">
                        <shuffle-button></shuffle-button> 
                        <div class="list">
                            <a class="faculty-links" :href=faculty_profile title="Profile">Profile</a>      
                            <router-link class="faculty-links"  to="#" title="Game">Game</router-link> 
                            <a class="faculty-links" href="https://www.csun.edu/faculty/scholarship">Scholarship</a>       
                            <a class="faculty-links"  href= "/logout" title="Logout">Logout</a>     
                        </div>              
                </div> 
                <div class="close">
                    <i class="fa fa-angle-down fa-3x type--white" title="Close" @click.prevent="closeNav()"></i>
                </div> 
            </div>
        </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "side-bar",

        methods: {
            closeNav: function(event) {
                document.getElementById("sideNav").style.height = "0%";
            }
        }, 

        computed: {
            ...mapGetters([
            'courses',
            'faculty_profile'
            ]),
        },

    }
</script>