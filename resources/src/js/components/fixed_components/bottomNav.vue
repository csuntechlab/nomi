<template>
    <!-- <div class="type--center">
            <div v-if="facultyMember.image === null" class="type--center">
                <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
            </div>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class=" height_fix img--circle faculty_image" name="photo">
                    <div class="faculty_links height_fix" :href="facultyMember.profile" title="User Name">{{facultyFullName}}</div>
                </div>
            </div>
                <div class="height_fix">
                    <router-link class="menu_links" to="/">Courses</router-link>
                    <router-link class="menu_links" to="/settings">Settings</router-link>
                    <a class="menu_links" :href= "this.url + '/logout'" title="Logout" @click="$store.dispatch('hideBackButton')">Logout</a>
                </div>
    </div> -->
    <div class="row bottom-nav">
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/">
            <i class="fas fa-2x fa-chalkboard-teacher"></i>
            <div>Courses</div>
        </router-link>
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/class">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div>Students</div>
        </router-link>
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/settings">
            <i class="fas fa-2x fa-cog"></i>
            <div>Settings</div>
        </router-link>
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/">
            <i v-if="facultyMember.image == null" class="fas fa-2x fa-user-circle"></i>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class="bottom-nav__profile-pic img--circle faculty_image" name="photo">
                </div>
            </div>
            <div>Profile</div>
        </router-link>
    </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";
    export default {
        name: "bottom-nav",

        data: function () {
            return {
                url: "",
                show: false
            };
        },

        computed: {
            ...mapGetters([
                "courses",
                "facultyMember",
            ])
        },
        created: function () {
            this.url = document.querySelector("meta[name=app-url]").content;
        },
        methods: {

        }
    };
</script>