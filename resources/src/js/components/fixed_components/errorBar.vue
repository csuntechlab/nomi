<template>
    <div v-if="this.errors || this.profileErrors" id="error_bar" class="alert error_bar">
        <strong>Oops!</strong> Something went wrong
         <a href="#" class="alert__close" @click="closeError()" >&times;</a>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapActions } from 'vuex'
    export default {
        name: "error-bar",

        data: function() {
            return{
                showError: false,
            }
        },

        computed: {
            ...mapGetters([
                'errors',
                'profileErrors',
                'profileLoadError'
            ]),

        },

        updated() {
            this.enableBackButton();
        },

        methods: {
            ...mapActions([
                'clearErrors',
                'clearProfileErrors',
                'enableBackButton'
            ]),

            logErrors() {
                console.log("Error found: " + this.errors);
                console.log("Profile Error found: " + this.profileErrors);
            },

            closeError() {
                if(this.profileLoadError == true){
                    this.$router.go(-1);
                }
                this.logErrors();
                this.clearErrors();
                this.clearProfileErrors();
            }
        }
    }
</script>

