<template>
    <div class="type--center">
        <div id="myMenu" class="menu">
            <div v-if="show == true">
                <i class="fa fa-angle-down fa-3x type--center" @click="closeMenu"></i>
            </div>
            <div v-else>
                <i class="fa fa-angle-up fa-3x type--center" @click="openMenu"></i>
            </div>
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
        <a class="faculty-links" href="#" title="Game">Nomi Game (coming soon)</a>
        <router-link class="faculty-links" to="/">Courses</router-link>
        <theme-selector></theme-selector>
        <router-link class="faculty-links" to="/about">About</router-link>
        <a class="faculty-links" href= "/logout" title="Logout">Logout</a>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import themeSelector from "../../components/fixed_components/themeSelector.vue";
export default {
  name: "menu-up",

   data: function () {
            return {
                show: false
            }
    },

  computed: {
    ...mapGetters(["courses", "facultyMember", "facultyFullName", "menuShow"])
  },

  methods: {
      openMenu: function () {
          document.getElementById("myMenu").style.height = "66%";
          this.show = true;
      },

      closeMenu: function () {
          document.getElementById("myMenu").style.height = "0";
          this.show = false;
      }
  }
};
</script>

