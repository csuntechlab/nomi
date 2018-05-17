<template>
    <i v-if="this.courses[0]" class="fa fa-angle-left fa-3x" title="Go Back" @click="goBack"></i>
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

<style scoped>
    i {
        position: absolute;
        left: 15px;
    }

    .fa-3x {
        color: #F4F4F4;
        transition: 25ms;
    }

    .fa-3x:active {
        color: #4F9DA3;
        transform: scale(1.2);
    }
</style>
