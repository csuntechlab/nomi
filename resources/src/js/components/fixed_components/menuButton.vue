<template>
    <nav class="menu_bar">
        <div class="row">
            <div class="type--center">
                <div v-if="this.menushow" class="menu_button">
                    <i class="fa fa-angle-down fa-3x type--center" title="Close Menu" @click.prevent="closeMenu"></i>
                </div>
                <div v-else class="menu_button">
                    <i class="fa fa-angle-up fa-3x type--center" title="Open Menu" @click.prevent="openMenu"></i>
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
                let height = "60vh";

                if(window.screen.height < window.screen.width)
                    height = "66vh";

                document.getElementById("menu-open-close").style.height = height;
                this.$store.dispatch('toggleMenu');
            },

            closeMenu: function(event) {
                document.getElementById("menu-open-close").style.height = "0";
                this.$store.dispatch('toggleMenu');
            }
        },
        computed: {
            ...mapGetters([
                'menushow'
            ])
        }
    }
</script>
<style scoped>
    .fa-3x{
        color: #F4F4F4;
        transition: 25ms;
    }

    .fa-3x:active {
        color: #4F9DA3;
        transform: scale(1.2);
    }
</style>