<template>
    <div class="type--center">
        <div v-if="displaySideMenu" id="outsideLayer" class="menu--transparent" @click="toggleMenu"></div>
        <div id="sideMenu" class="side-menu" v-bind:class="[displaySideMenu ? 'side-menu--display' : 'side-menu--hide']">
            <div v-if="facultyMember.image === null" class="type--center">
                <i class="fas fa-user-circle fa-3x icon__theme"></i>
            </div>
            <div v-else>
                <div class="pb-4">
                    <img :src="facultyMember.image" class="img--circle side-menu__img" name="photo" alt="image of faculty profile">
                </div>
                <div class="side-menu__greeting" :href="facultyMember.profile" title="User Name">Hi, {{facultyMember.firstName}}</div>
            </div>
            <div class="side-menu__options">
                <a class="side-menu__link" :href="'https://academics.csun.edu/faculty/' + facultyMember.emailURI">
                    <i class="fas fa-user"/> Faculty Profile
                </a>
                <a class="side-menu__link" :href="this.url + '/logout'" @click="toggleMenu()" title="Logout">
                    <i class="fas fa-sign-out-alt"/> Logout
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
  name: 'side-menu',
  computed: {
    ...mapGetters(['courses', 'facultyMember', 'displaySideMenu']),
    showMenu() {
      return this.displaySideMenu;
    },
  },

  data() {
    return {
      url: '',
    };
  },

  created() {
    this.url = document.querySelector('meta[name=app-url]').content;
  },

  watch: {
    showMenu(open) {
      if (open) document.documentElement.style.overflow = 'hidden';
      else document.documentElement.style.overflow = 'auto';
    },
  },

  methods: {
    toggleMenu() {
      this.$store.dispatch('toggleMenu');
    }
  },
};
</script>