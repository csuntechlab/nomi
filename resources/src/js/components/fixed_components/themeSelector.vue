<template>
    <div>
        <div class="menu_links" @click="showModal=true">
            Theme
        </div>
        
        <modal v-if="showModal" @close="showModal = false">
            <div slot="header">

            </div>
            <div slot="body">
                <br>
                <br>
                <ul class="list list--arrows list--hover">
                    <li id="Matador" @click="updateTheme('theme-OnceAMatadorAlwaysAMatador')" class="colorTheme_list_item " name="OnceAMatadorAlwaysAMatador"> Matador Theme</li>
                    <li id="Navy" @click="updateTheme('theme-main')" class="colorTheme_list_item " name="navy"> Navy Theme</li>
                    <li id="Blues" @click="updateTheme('theme-bluesTheme')" class="colorTheme_list_item " name="bluesTheme"> Blue Theme</li>
                    <li id="Cloudy" @click="updateTheme('theme-Cloudy')" class="colorTheme_list_item " name="Cloudy"> Cloudy Theme</li>                </ul>
            </div>
        </modal>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import modal from "../../components/fixed_components/modal.vue"
    
    export default {
        name: "theme-selector",

        data: function () {
            return {
                showModal: false
            }
        },

         methods: {
            updateTheme: function(theme) {
                let data = new FormData();
                data.append('theme', theme);


                
                axios.post('/update_theme', data, {
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

