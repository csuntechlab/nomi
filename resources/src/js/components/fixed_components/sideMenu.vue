<template>
<div class="type--center">
        <div v-if="show == true" id="outsideLayer" class="transparent_non-menu_layer"></div>
        <div id="myMenu" class="side-menu" v-click-outside="closeMenu">
            <div v-if="show == true">
                <i class="fa fa-angle-down fa-3x type--center" @click="closeMenu"></i>
            </div>
            <div v-else>
                <i class="fa fa-angle-up fa-3x type--center extra_padding" @click="openMenu"></i>
            </div>
            <div v-if="facultyMember.image === null" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
            <br>
            <br>
            </div>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class=" height_fix img--circle faculty_image" name="photo">
                    <div class="faculty_links height_fix" :href="facultyMember.profile" title="User Name">{{facultyFullName}}</div>
                </div>
            </div>
                <div class="height_fix">
                    <span @click="closeMenu()">
                        <router-link class="menu_links" to="/">Courses</router-link>
                    </span>
                    <span @click="closeMenu()">
                        <router-link class="menu_links" to="/settings">Settings</router-link>
                    </span>
                    <a class="menu_links" :href= "this.url + '/logout'" title="Logout" @click="$store.dispatch('hideBackButton')">Logout</a>
                </div>
        </div>
    </div>
</template>
<script>
export default {
	name: "side-menu",

	data: function() {
		return {
			show: false
		};
	},
	computed: {
		...mapGetters(["courses", "facultyMember", "facultyFirstName"])
	},
	methods: {
		openMenu: function() {
			document.getElementById("myMenu").style.left = "40%";
			this.show = true;
		},

		closeMenu: function() {
			document.getElementById("myMenu").style.left = "100%";
			this.show = false;
		}
	}
};
</script>
