<template>
    <div>
        <!-- <menu-up></menu-up> -->
        <bottom-nav></bottom-nav>
        <!-- <menu-button></menu-button> -->
    </div>
</template>

<script>
    import bottomNav from './bottomNav.vue'
    export default {
        components: {
            bottomNav
        },

        beforeCreate() {
            this.$store.dispatch('getOnlySettings');
        }
    }
</script>