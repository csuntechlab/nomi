<template>
    <div>
        <div class="menu_links" @click="showModal=true">
            Change Theme
        </div>
        
        <modal v-if="showModal" @close="showModal = false">
            <div slot="header">

            </div>
            <div slot="body">
                <br>
                <br>
                <ul class="list list--arrows list--hover">
                    <li @click="updateTheme('theme-main')" class="list__item colorTheme_list_item " name="navy"> Navy Theme</li>
                    <li @click="updateTheme('theme-bluesTheme')" class="list__item colorTheme_list_item " name="bluesTheme"> Blue Theme</li>
                    <li @click="updateTheme('theme-cloudyWithAChanceSunflowers')" class="list__item colorTheme_list_item " name="cloudyWithAChanceSunflowers"> Sunflower Theme</li>
                    <li @click="updateTheme('theme-OnceAMatadorAlwaysAMatador')" class="list__item colorTheme_list_item " name="OnceAMatadorAlwaysAMatador"> Matador Theme</li>
                </ul>
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

