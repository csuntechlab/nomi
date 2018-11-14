<template>
<div>
    <div class="type--center tab__link tab__link--kerning">
        Select Theme
    </div>
<div class="panel">
    <div class="theme">
        <button id="Matador" @click="updateTheme('theme-matadorTheme')" class="theme__item" name="matadorTheme"> Matador</button>
        <button id="Raspberry" @click="updateTheme('theme-raspberryTheme')" class="theme__item" name="raspberryTheme"> Raspberry</button>
        <button id="Olive" @click="updateTheme('theme-oliveTheme')" class="theme__item" name="oliveTheme"> Olive</button>
        <button id="Neptune" @click="updateTheme('theme-neptuneTheme')" class="theme__item" name="neptuneTheme"> Neptune</button>
        <button id="Ocean" @click="updateTheme('theme-oceanTheme')" class="theme__item" name="oceanTheme"> Ocean</button>
        <button id="Cloudy" v-if="this.$store.state.base.funTheme" @click="updateTheme('theme-cloudyTheme')" class="theme__item" name="cloudyTheme"> Cloudy</button>
        <button id="Noire" @click="updateTheme('theme-noireTheme')" class="theme__item" name="noireTheme"> Noire</button>
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