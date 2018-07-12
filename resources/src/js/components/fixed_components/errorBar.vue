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
            ]),

        },

        methods: {
            ...mapActions([
                'clearErrors',
                'clearProfileErrors',
            ]),

            logErrors() {
                console.log("Errors: " + this.errors);
                console.log("Profile Errors: " + this.profileErrors);
            },

            closeError() {
                this.logErrors();
                this.clearErrors();
                this.clearProfileErrors();
            }
        }
    }
</script>

