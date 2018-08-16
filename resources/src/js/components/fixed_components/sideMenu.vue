<template>
    <div class="type--center">
        <div v-if="displaySideMenu" id="outsideLayer" class="transparent_non-menu_layer" @click="toggleMenu"></div>
        <div id="sideMenu" class="side-menu" v-bind:class="[displaySideMenu ? 'side-menu--display' : 'side-menu--hide']">
            <div v-if="facultyMember.image === null" class="type--center">
                <i class="fas fa-user-circle fa-3x icon_theme"></i>
            </div>
            <div v-else>
                <div>
                    <img :src="facultyMember.image" class="img--circle side-menu__img" name="photo">
                </div>
                <div class="side-menu__greeting" :href="facultyMember.profile" title="User Name">Hi, {{facultyFirstName}}</div>
            </div>
            <div class="side-menu__options">
                <a class="side-menu__link" :href="'https://academics.csun.edu/faculty/' + facultyURI">
                    <i class="fas fa-user"/> Faculty Profile
                </a>
                <a class="side-menu__link" :href="this.url + '/logout'" title="Logout">
                    <i class="fas fa-sign-out-alt"/> Logout
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
	name: "side-menu",
	data() {
		return {
			url: ""
		};
	},
	computed: {
		...mapGetters([
			"courses",
			"facultyMember",
            "facultyFirstName",
            "facultyURI",
            "displaySideMenu",
		])
	},
	created: function() {
		this.url = document.querySelector("meta[name=app-url]").content;
	},
	methods: {
		toggleMenu() {
			this.$store.dispatch("toggleMenu");
		}
	},
	watch: {
		sideMenuOpen() {
			if (this.displaySideMenu)
                document.documentElement.style.overflow = 'hidden';
            else
                document.documentElement.style.overflow = 'auto';
		}
	}
};
</script>