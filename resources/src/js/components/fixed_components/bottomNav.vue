<template>
    <div class="row bottom-nav">
        <router-link id="courses" class="col-xs-3 type--center bottom-nav__button" to="/" @click.native="setActive('')">
            <i class="fas fa-2x fa-chalkboard-teacher"></i>
            <div class="bottom-nav__text">Courses</div>
        </router-link>

        <div v-if="this.currentCourse == null" id="students" class="col-xs-3 type--center bottom-nav__button--disabled">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </div>
        <router-link v-else id="students" class="col-xs-3 type--center bottom-nav__button" :to="{path:'/class/' + currentCourse}" @click.native="setActive('class')">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </router-link>
        
        <router-link id="settings" class="col-xs-3 type--center bottom-nav__button" to="/settings" @click.native="setActive('settings')">
            <i class="fas fa-2x fa-cog"></i>
            <div class="bottom-nav__text">Settings</div>
        </router-link>
        <router-link id="profile" class="col-xs-3 type--center bottom-nav__button" to="/settings" @click.native="setActive('profile')">
            <i v-if="facultyMember.image == null" class="fas fa-2x fa-user-circle"></i>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class="bottom-nav__profile-pic img--circle faculty_image" name="photo">
                </div>
            </div>
            <div class="bottom-nav__text">Profile</div>
        </router-link>
    </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
	name: "bottom-nav",

	computed: {
		...mapGetters([
			"courses",
			"facultyMember",
			"currentCourse",
			"currentLocation"
		])
	},

	mounted() {
		this.setActive();
	},

	methods: {
		setActive(activeLocation) {
			if (activeLocation != null) {
				this.$store.dispatch("storeLocation", activeLocation);
			}
			this.resetNav();
			if (this.currentLocation == "") {
				document.getElementById("courses").style.color =
					"rgba(255,255,255,1)";
			} else if (this.currentLocation == "settings") {
				document.getElementById("settings").style.color =
					"rgba(255,255,255,1)";
			} else if (this.currentLocation == "profile") {
				document.getElementById("profile").style.color =
					"rgba(255,255,255,1)";
			} else {
				document.getElementById("students").style.color =
					"rgba(255,255,255,1)";
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