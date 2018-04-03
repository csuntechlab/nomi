<template>
<nav class="menu_open navy-blue">
    <div class="row">
        <div class="type--center">
            <div class="menu_close"></div>
            <i v-if="this.menushow" class="fa fa-angle-up fa-3x type--white" id="menuFunc" title="Open Menu" @click.prevent="openMenu()"></i>
            <i v-else class="fa fa-angle-down fa-3x type--white" id="menuFunc" title="Menu Close" @click.prevent="closeMenu()"></i>
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
                document.getElementById("menuFunc").style.height = "85%";
            }
        },
        computed: {
            ...mapGetters([
                'menushow'
            ])
        }
    }
</script>
