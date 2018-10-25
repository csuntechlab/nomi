import Croppa from 'vue-croppa';
import VueCarousel from 'vue-carousel';
import router from './router';
import store from './store';

require('./bootstrap');
window.Vue = require('vue');

Vue.use(VueCarousel);
Vue.use(Croppa);

Vue.component('nav-bar', require('./components/fixed_components/navBar.vue'));
Vue.component('menu-bar', require('./components/fixed_components/menuBar.vue'));
Vue.component('error-bar', require('./components/fixed_components/errorBar.vue'));
Vue.component('permission-modal', require('./components/fixed_components/permissionModal.vue'));
Vue.component('side-menu', require('./components/fixed_components/sideMenu.vue'));

const app = new Vue({
  el: '#app',
  router,
  store,
});

export const convertCourseData = {
  created() {
    console.log("test")
  },

  methods: {
    convertTime(OriginalTime) {
      let time = OriginalTime;
      let hour = parseInt(time.substring(0, 2));
      let min = `${time.substring(2, 4)} a.m.`;
      if (hour > 12) {
        hour -= 12;
        min = `${min.substring(0, 2)} p.m.`;
      }
      time = `${hour}:${min}`;
      return time;
    },

    convertDays(originalDays) {
      let days = originalDays;
      let split = days.split('');

      // M T W R F S
      // Mo Tu We Th Fr Sa
      let result = split.map((day) => {
        if (day === 'M') day = 'Mo';
        if (day === 'T') day = 'Tu';
        if (day === 'W') day = 'We';
        if (day === 'R') day = 'Th';
        if (day === 'F') day = 'Fr';
        if (day === 'S') day = 'Sa';
        return day;
      });

      return result.join('');
    },
  }
}