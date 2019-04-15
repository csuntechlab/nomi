<template>
    <div class="row bottom-nav">
        <router-link v-bind:class="{[selected]: this.currentLocation == 'home'}" id="courses" class="col-xs-3 type--center bottom-nav__button" to="/" @click.native="setActive('home')" data-interactable>
            <i class="fas fa-2x fa-chalkboard-teacher"></i>
            <div class="bottom-nav__text">Courses</div>
        </router-link>
        <div v-if="this.currentCourse == null || this.loadingClasses == true" v-bind:class="{[selected]: this.currentLocation == 'class'}" id="students" class="col-xs-3 type--center bottom-nav__button--disabled" data-interactable>
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </div>
        <div v-else id="students" v-bind:class="{[selected]: this.currentLocation == 'class'}" class="col-xs-3 type--center bottom-nav__button" @click="setActive('class'), classOrStudent()" data-interactable>
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </div>
        <router-link v-bind:class="{[selected]: this.currentLocation == 'settings'}" id="settings" class="col-xs-3 type--center bottom-nav__button" to="/settings" @click.native="setActive('settings')" data-interactable>
            <i class="fas fa-2x fa-cog"></i>
            <div class="bottom-nav__text">Settings</div>
        </router-link>
        <div id="profile" class="col-xs-3 type--center bottom-nav__button" @click="showMenu()" data-interactable>
            <i v-if="facultyMember.image == null" class="fas fa-2x fa-user-circle"></i>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class="bottom-nav__profile-pic img--circle faculty_image" name="photo" alt="image of faculty profile">
                </div>
            </div>
            <div class="bottom-nav__text">Profile</div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'bottom-nav',

  data() {
    return {
      selected: ['bottom-nav__button--active'],
      disable: true,
    };
  },

  computed: {
    ...mapGetters([
      'courses',
      'facultyMember',
      'currentCourse',
      'currentStudent',
      'currentLocation',
      'displaySideMenu',
      'loadingClasses',
    ]),
  },

  methods: {
    showMenu() {
      this.$store.dispatch('toggleMenu');
    },
    setActive(activeLocation) {
      if (activeLocation != null) { this.$store.dispatch('storeLocation', activeLocation); }
      if (this.displaySideMenu) { this.showMenu(); }
    },
    resetNav() {
      const buttons = document.querySelectorAll('.bottom-nav__button');
      let i;
      for (i = 0; i < buttons.length; i += 1) {
        buttons[i].style.color = 'rgba(255,255,255,0.6)';
      }
    },
    classOrStudent() {
      if (this.currentStudent) {
        this.$router.push({ name: 'profile', params: { courseID: this.currentCourse, emailURI: this.currentStudent } });
      } else { this.$router.push({ name: 'class', params: { id: this.currentCourse } }); }
    },
    checkdisable() {
      if (this.loadingClasses == true) {
        if (this.currentCourse == null) {
          disable == true;
        }
      }
    },
  },
};
</script>