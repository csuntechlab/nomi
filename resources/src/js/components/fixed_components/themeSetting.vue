<template>
<div>
    <div class="type--center tab__link tab__link--kerning">
        Select Theme
    </div>
<div class="panel">
    <div class="theme">
        <button id="Matador" @click="updateTheme('theme-OnceAMatadorAlwaysAMatador')" class="theme__item" name="OnceAMatadorAlwaysAMatador">
        Matador</button>
        <button id="Navy" @click="updateTheme('theme-main')" class="theme__item" name="navy"> Navy</button>
        <button id="Blues" @click="updateTheme('theme-bluesTheme')" class="theme__item" name="bluesTheme"> Blue</button>
        <button id="Dark" @click="updateTheme('theme-Dark')" class="theme__item" name="Dark"> Dark</button>
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
            document.getElementById('mainBody').className = theme;
          }).catch((e) => {
            console.log(e);
          });
    },
      },


    };
</script>