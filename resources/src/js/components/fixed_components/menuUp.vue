<template>
    <div id="menu-open-close">
        <div v-if="this.menuShow" class="menu_container makeBlue type--center">
            <div class="menu_selections type--center">
                <div class="list">
                    <div v-if="faculty_profile_image === null" class="type--center">
                        <br>
                        <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
                        <br>
                        <br>
                    </div>
                    <div v-else>
                        <img id="faculty-img" :src="faculty_profile_image" class="img--circle faculty_image" name="photo">
                        <a class="faculty-name" :href="faculty_profile" title="User Name">{{faculty_full_name}}</a>
                    </div>
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
                'faculty_full_name',
                'faculty_profile_image',
                'menuShow'
            ]),
        }
    }
</script>

