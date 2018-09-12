<template>
    <div>
        <a href="#" class="menu__links" @click="showModal=true">
            Theme
        </a>
        <modal v-if="showModal" @close="showModal = false">
            <div slot="header"></div>
            <div slot="body" class="theme">
                <button id="Matador" @click="updateTheme('theme-OnceAMatadorAlwaysAMatador')" class="theme__item" name="OnceAMatadorAlwaysAMatador"> Matador Theme</button>
                <button id="Navy" @click="updateTheme('theme-main')" class="theme__item" name="navy"> Navy Theme</button>
                <button id="Blues" @click="updateTheme('theme-bluesTheme')" class="theme__item" name="bluesTheme"> Blue Theme</button>
                <button id="Cloudy" @click="updateTheme('theme-Cloudy')" class="theme__item" name="Cloudy"> Cloudy Theme</button>
            </div>
        </modal>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import modal from "../fixed_components/modal.vue";
    
    export default {
        name: "theme-selector",

        data: function () {
            return {
                showModal: false
            }
        },

        created: function () {
            this.url = document.querySelector('meta[name=app-url]').content;
        },

        methods: {
            updateTheme: function(theme) {
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

