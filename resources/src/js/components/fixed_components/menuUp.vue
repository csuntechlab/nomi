<template>
    <div id="menu-open-close" class="bg--navy-blue">
        <div v-if="this.menushow"></div>
        <div v-else class="menu_container type--center">
            <div class="menu_selections type--center">
                <div class="list">
                    <img id="faculty-img" :src=faculty_profile_image class="img--circle faculty_image" name="photo">
                    <a class="faculty-name" href="#" title="User Name">{{faculty_full_name}}</a>
                    <a class="faculty-links" href="#" title="Game">Game</a>
                    <router-link class="faculty-links" to="/">Courses</router-link>
                    <a class="faculty-links" href= "/logout" title="Logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "menu-up",

        computed: {
            ...mapGetters([
                'courses',
                'faculty_profile',
                'faculty_email',
                'faculty_first_name',
                'faculty_last_name',
                'faculty_full_name',
                'menushow',
                'faculty_profile_image'
            ]),
        },
        watch: {
            'faculty_email': function(email){
                this.$store.dispatch('getFacultyProfile', {email: email} );
            }
        }
    }
</script>

