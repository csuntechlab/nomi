<template>
    <div id="menu-open-close" class="bg--navy-blue">
        <div v-if="this.menushow" class="menu_container type--center">
            <div class="menu_selections type--center">
                <div class="list">
                    <div v-if="this.loading" class="type--center">
                        <br>
                        <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
                        <br>
                        <br>
                    </div>
                    <div v-else>
                        <img id="faculty-img" :src=faculty_profile_image class="img--circle faculty_image" name="photo">
                        <a class="faculty-name" href=faculty_profile title="User Name">{{faculty_full_name}}</a>
                    </div>
                    <a class="faculty-links" href="#" title="Game">Game</a>
                    <a class="faculty-links" href="https://www.csun.edu/faculty/scholarship">Scholarship</a>
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

        data: function() {
            return{
                loading: true,
            }
        },

        created () {
            this.$store.subscribe(mutation => {
                if (mutation.type === 'GET_FACULTY_PROFILE') {
                    this.loading = !this.loading; 
                }
            })
        },


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
                this.$store.dispatch('getFacultyProfile', {faculty_email: email} );
            }
        }
    }
</script>
<style scoped>
</style>
