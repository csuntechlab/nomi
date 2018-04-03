<template>
<nav class="menu_bar navy-blue">
    <div class="row">
        <div class="type--center">
            <div v-if="this.menushow" class="menu_button">
                <i class="fa fa-angle-up fa-3x type--white" title="Open Menu" @click.prevent="openMenu()" @click="$store.dispatch('toggleMenu')"></i>
            </div>
            <div v-else class="menu_button">
                <i class="fa fa-angle-down fa-3x type--white" title="Close Menu" @click.prevent="closeMenu()" @click="$store.dispatch('toggleMenu')"></i>
            </div>
        </div>
    </div>
  </nav>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "menu-button",
        methods: {
             openMenu: function() {
                document.getElementById("menu-open-close").style.height = "80%";
            },
            closeMenu: function(event) {
                document.getElementById("menu-open-close").style.height = "0%";
            }
        },
        computed: {
            ...mapGetters([
                'menushow'
            ])
        }
    }
</script>
