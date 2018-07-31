<template>
    <div>
        <!-- <menu-up></menu-up> -->
        <bottom-nav></bottom-nav>
        <!-- <menu-button></menu-button> -->
    </div>
</template>

<script>
    import menuUp from './menuUp.vue'
    import bottomNav from './bottomNav.vue'
    export default {
        components: {
            menuUp,
            bottomNav
        },

        beforeCreate() {
            this.$store.dispatch('getOnlySettings');
        }
    }
</script>