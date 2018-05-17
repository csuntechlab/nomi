<template>
    <i v-if="this.courses[0]" class="fa fa-angle-left fa-3x back_button fa-blue" title="Go Back" @click="goBack"></i>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "back-button",

        methods: {
            goBack: function () {
                this.$router.go(-1);
            }
        },

        computed: {
            ...mapGetters([
                'courses'
            ])
        }
    }
</script>
