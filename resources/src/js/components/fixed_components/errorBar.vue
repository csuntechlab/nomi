<template>
    <h2 v-if="this.errors || this.profileErrors">
        There was an error: {{this.errors}} {{this.profileErrors}}
    </h2>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "error-bar",

        computed: {
            ...mapGetters([
                'errors',
                'profileErrors'
            ]),
        }
    }
</script>

