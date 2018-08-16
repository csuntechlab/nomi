<template>
<div class="type--center">
        <div v-if="menuShow" id="outsideLayer" class="transparent_non-menu_layer"></div>
        <div id="sideMenu" class="side-menu" v-click-outside="toggleMenu" v-bind:class="[menuShow ? 'side-menu--display' : 'side-menu--hide']">
            <div v-if="facultyMember.image === null" class="type--center">
            <i class="fas fa-user-circle fa-3x icon_theme"></i>
            </div>
            <div v-else>
                <div>
                    <img :src="facultyMember.image" class="img--circle" name="photo">
                    <div class="side-menu__link" :href="facultyMember.profile" title="User Name">Hello, {{facultyFirstName}}</div>
                </div>
            </div>
                <div>
                        <router-link class="menu_links" to="/">Faculty Profile</router-link>
                    <a class="menu_links" :href= "this.url + '/logout'" title="Logout">Logout</a>
                </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    name: "side-menu",
    data() {
        return{
            url: '',
        }
    },
	computed: {
		...mapGetters([
			"courses",
			"facultyMember",
			"facultyFirstName",
			"menuShow"
		])
	},
	created: function() {
		this.url = document.querySelector("meta[name=app-url]").content;
    },
    methods: {
        toggleMenu(){
            this.$store.dispatch('toggleMenu');
        }
    }
};
</script>
