<template>
    <div class="row bottom-nav">
        <router-link v-bind:class="{[selected]: this.currentLocation == 'home'}" id="courses" class="col-xs-3 type--center bottom-nav__button" to="/" @click.native="setActive('home')">
            <i class="fas fa-2x fa-chalkboard-teacher"></i>
            <div class="bottom-nav__text">Courses</div>
        </router-link>

        <div v-if="this.currentCourse == null" v-bind:class="{[selected]: this.currentLocation == 'class'}" id="students" class="col-xs-3 type--center bottom-nav__button--disabled">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </div>
        <router-link v-else id="students" v-bind:class="{[selected]: this.currentLocation == 'class'}" class="col-xs-3 type--center bottom-nav__button" :to="{path:'/class/' + currentCourse}" @click.native="setActive('class')">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </router-link>
        
        <router-link v-bind:class="{[selected]: this.currentLocation == 'settings'}" id="settings" class="col-xs-3 type--center bottom-nav__button" to="/settings" @click.native="setActive('settings')">
            <i class="fas fa-2x fa-cog"></i>
            <div class="bottom-nav__text">Settings</div>
        </router-link>
        <div id="profile" class="col-xs-3 type--center bottom-nav__button" @click="showMenu()">
            <i v-if="facultyMember.image == null" class="fas fa-2x fa-user-circle"></i>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class="bottom-nav__profile-pic img--circle faculty_image" name="photo">
                </div>
            </div>
            <div class="bottom-nav__text">Profile</div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
	name: "bottom-nav",

	data(){
		return{
			selected: ['bottom-nav__button--active']
		}
	},

	computed: {
		...mapGetters([
			"courses",
			"facultyMember",
			"currentCourse",
			"currentLocation"
		]),
	},

	methods: {
		showMenu(){
			this.$store.dispatch("toggleMenu");
		},
		setActive(activeLocation) {
			if (activeLocation != null) {
				this.$store.dispatch("storeLocation", activeLocation);
			}
		},
		resetNav() {
			let buttons = document.querySelectorAll(".bottom-nav__button");
			let i;
			for (i = 0; i < buttons.length; i += 1) {
				buttons[i].style.color = "rgba(255,255,255,0.6)";
			}
		}
	}
};
</script>