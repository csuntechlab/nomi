<template>
    <transition name="modal">
        <div class="modal-mask" v-if="this.show" id="permission_modal">
            <div class="modal__wrapper">
                <div class="modal__container">
                    <div class="modal-body__container">
                        <div class="modal-header">
                            <slot class="type--center" name="header">
                                <h4>Permission Needed</h4>
                            </slot>
                        </div>
                        <div class="modal-body">
                            <h5>Photo and Camera access required for full functionality</h5>
                        </div>
                        <div class="permission-footer">
                            <button class="modal-btn confirm-btn fa fa-2x fa-check" @click="accept()"></button>
                            <button class="modal-btn decline-btn fa fa-2x fa-times" @click="deny()"></button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div v-else></div>
    </transition>
</template>

<script>
    import { mapGetters } from 'vuex';
    import { mapActions } from 'vuex';
    import modal from "./modal.vue";
    export default {
        name: "permission-modal",

        data: function() {
            return{
                show: true,
            }
        },

        computed: {
            ...mapGetters([
                'permission',
                'facultyMember',
            ]),

        },

        components: {
            modal
        },

        beforeCreate() {
            this.$store.dispatch("getUploadPermission");
            if(this.permission == false){
                this.show = true;
            }
            else{
                this.show = false;
            }
	    },

        methods: {
            ...mapActions([
                'handlePermissionResponse',
                'storePermission',
                'getUploadPermission',
            ]),

            accept() {
                this.$store.dispatch('storePermission', this.facultyMember.id);
                this.handlePermissionResponse(true);
            },

            deny() {
                this.handlePermissionResponse(false);
                this.show = false;
				// this.$store.dispatch('nullifyPermissionResponse');
            },
        },
    }
</script>