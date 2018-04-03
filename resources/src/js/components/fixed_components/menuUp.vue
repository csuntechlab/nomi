<template>
        <div id="menuFunc" class="sidebar navy-blue">
            <div class="sidebar_container type--center">  
                <div class="side_bar_menu type--center">
                        <div class="list">
                            <img :id="faculty_full_name +'-img'" :src=profile_image class="img--circle faculty_image" name="photo">
                            <a class="faculty-name" :href=faculty_profile title="User Name">{{faculty_full_name}}</a> 
                        </div>
                        <div class="list">
                            <a class="faculty-links" :href=faculty_profile title="Profile">Profile</a>      
                            <a class="faculty-links"  href="#" title="Game">Game</a> 
                            <a class="faculty-links" href="https://www.csun.edu/faculty/scholarship">Scholarship</a>       
                            <a class="faculty-links"  href= "/logout" title="Logout">Logout</a>     
                        </div>              
                </div> 
            </div>
        </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "menu-up",

        methods: {
            closeMenu: function(event) {
                document.getElementById("menuFunc").style.height = "0%";
            }
        }, 

        computed: {
            ...mapGetters([
            'courses',
            'faculty_profile', 
            'faculty_email',
            'faculty_first_name', 
            'faculty_last_name', 
            'faculty_full_name',
            'profile_image'
            ]),
        },
        watch: {
            'faculty_email': function(email){
                this.$store.dispatch('getFacultyProfile', {email: email} );
            }
        }

    }
</script>