<template>
    <nav>
        <list-grid-selector></list-grid-selector>
    </nav>
</template>

<script>
    import { mapGetters } from "vuex"
    export default {
        name: "home-settings-banner",

        computed: {
            ...mapGetters([
                'courseTitle',
                'list',
                'flash'
            ])
        }
    }
</script>