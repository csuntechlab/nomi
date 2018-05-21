<template>
    <div class="type--center">
        <div id="myMenu" class="menu">
            <div v-if="show == true">
                <i class="fa fa-angle-down fa-3x type--center extra_padding" @click="closeMenu"></i>
            </div>
            <div v-else>
                <i class="fa fa-angle-up fa-3x type--center extra_padding" @click="openMenu"></i>
            </div>
            <div v-if="facultyMember.image === null" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
            <br>
            <br>
        </div>
        <div v-else>
            <img :src="facultyMember.image" class="img--circle faculty_image" name="photo">
            <a class="faculty_links" :href="facultyMember.profile" title="User Name">{{facultyFullName}}</a>
        </div>
        <router-link class="menu_links" to="/">Courses</router-link>
        <theme-selector class="menu_links"></theme-selector>
        <router-link class="menu_links" to="/about">About</router-link>
        <a class="menu_links" href= "/logout" title="Logout">Logout</a>
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
          document.getElementById("myMenu").style.height = "8%";
          this.show = false;
      }
  }
};
</script>

