<template>
<div>
    <div class="type--center tab__link tab__link--kerning">
        Select Theme
    </div>
<div class="panel">
    <div class="theme">
        <button id="Matador" @click="updateTheme('theme-matadorTheme')" class="theme__item" name="matadorTheme">Matador</button>
        <button id="Navy" @click="updateTheme('theme-navyTheme')" class="theme__item" name="navyTheme"> Navy</button>
        <button id="Blue" @click="updateTheme('theme-blueTheme')" class="theme__item" name="blueTheme"> Blue</button>
        <button id="Dark" @click="updateTheme('theme-darkTheme')" class="theme__item" name="darkTheme"> Dark</button>
    </div>
</div>
</div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'theme-setting',
  
  data() {
    return {
      showModal: false,
    };
  },

  created() {
    this.url = document.querySelector('meta[name=app-url]').content;
  },

  methods: {
    updateTheme(theme) {
      const data = new FormData();
      data.append('theme', theme);

      axios.post(`${this.url}/update_theme`, data, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        }).then(() => {
          this.$store.dispatch('getOnlySettings');
          document.getElementById('app').className = theme;
          document.getElementById('mainBody').className = theme;
        }).catch((e) => {
          console.log(e);
        });
    },
  },

};
</script>