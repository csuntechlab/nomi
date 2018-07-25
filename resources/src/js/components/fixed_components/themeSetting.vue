<template>
<div>
    <div class="type--center tab__link">
        Set Theme
    </div>
<div class="panel">
    <div class="colorThemes">
        <button id="Matador" @click="updateTheme('theme-OnceAMatadorAlwaysAMatador')" class="colorTheme_item " name="OnceAMatadorAlwaysAMatador">
        Matador</button>
        <button id="Navy" @click="updateTheme('theme-main')" class="colorTheme_item " name="navy"> Navy</button>
        <button id="Blues" @click="updateTheme('theme-bluesTheme')" class="colorTheme_item " name="bluesTheme"> Blue</button>
        <button id="Dark" @click="updateTheme('theme-Dark')" class="colorTheme_item " name="Dark"> Dark</button>
    </div>
</div>
</div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "theme-setting",

        data: function () {
            return {
                showModal: false
            }
        },

        created: function () {
            this.url = document.querySelector('meta[name=app-url]').content;
        },

        methods: {
            updateTheme: function (theme) {
                let data = new FormData();
                data.append('theme', theme);

                axios.post(this.url + '/update_theme', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(() => {
                    document.getElementById("mainBody").className = theme;
                }).catch(e => {
                    console.log(e)
                });
            }
        }


    }
</script>