<template>
    <i v-if="!hideBack"
       class="fa fa-angle-left fa-3x back_button"
       title="Go Back"
       @click="goBack"></i>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "back-button",

        methods: {
            goBack: function () {
                if(window.location.hash.split('/')[1]=='class'){
                    this.$router.push({name:'home'});
                }
                else
                    this.$router.go(-1);
            }
        },

        computed: {
            ...mapGetters([
                'hideBack'
            ]),
        }
    }
</script>
