<template>
    <div id="menu-open-close">
        <div v-if="this.menuShow" class="menu_container makeBlue type--center">
            <div class="menu_selections type--center">
                <div class="list">
                    <div v-if="facultyMember.image === null" class="type--center">
                        <br>
                        <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
                        <br>
                        <br>
                    </div>
                    <div v-else>
                        <img id="faculty-img" :src="facultyMember.image" class="img--circle faculty_image" name="photo">
                        <a class="faculty-name" :href="facultyMember.profile" title="User Name">{{facultyFullName}}</a>
                    </div>
                    <!--<a class="faculty-links" href="#" title="Game">Nomi Game (coming soon)</a>-->
                    <router-link class="faculty-links" to="/">Courses</router-link>
                    <router-link class="faculty-links" to="/about">About</router-link>
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
                'facultyMember',
                'facultyFullName',
                'menuShow'
            ]),
        }
    }
</script>

