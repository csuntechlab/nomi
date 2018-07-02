<template>
    <div class="type--center">
        <div v-if="show == true" id="outsideLayer" class="transparent_non-menu_layer"></div>
        <div id="myMenu" class="menu" v-click-outside="closeMenu">
            <div v-if="show == true">
                <i class="fa fa-angle-down fa-3x type--center" @click="closeMenu"></i>
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
                <div class="height_fix">
                    <img :src="facultyMember.image" class=" height_fix img--circle faculty_image" name="photo">
                    <div class="faculty_links height_fix" :href="facultyMember.profile" title="User Name">{{facultyFullName}}</div>
                </div>
            </div>
                <div class="height_fix">
                    <span @click="closeMenu()">
                        <router-link class="menu_links" to="/">Courses</router-link>
                    </span>
                    <theme-selector></theme-selector>
                    <span @click="closeMenu()">
                        <router-link class="menu_links" to="/about">About</router-link>
                    </span>
                    <a class="menu_links" :href= "this.url + '/logout'" title="Logout" @click="$store.dispatch('hideBackButton')">Logout</a>
                </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import themeSelector from "../fixed_components/themeSelector.vue";
import { clickOutside } from "../../directives/index.js";
export default {
  name: "menu-up",

   data: function () {
            return {
                url: '',
                show: false
            }
    },

  computed: {
    ...mapGetters(["courses", "facultyMember", "facultyFullName", "menuShow"])
  },
  created: function () {
    this.url = document.querySelector('meta[name=app-url]').content;
  },
  methods: {
      openMenu: function () {
          document.getElementById("myMenu").style.height = "66%";
          this.show = true;
      },

      closeMenu: function () {
          document.getElementById("myMenu").style.height = "7%";
          this.show = false;
      }
  }
};
</script>

