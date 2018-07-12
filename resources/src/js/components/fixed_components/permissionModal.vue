<template>
    <transition name="modal">
        <div class="modal-mask" v-if="this.permission == null" id="permission_modal">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot class="type--center" name="header">
                            <h4>Permission Needed</h4>
                        </slot>
                    </div>
                    <div class="modal-body">
                            <h5>Photo and Camera access required for full functionality</h5>
                    </div>
                    <div class="permission_footer">
                        <button class="modal_btn confirm_btn fa fa-2x fa-check" @click="accept()"></button>
                        <button class="modal_btn decline_btn fa fa-2x fa-times" @click="deny()"></button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapActions } from 'vuex'
    export default {
        name: "permission-modal",

        computed: {
            ...mapGetters([
                'permission'
            ]),

        },

        methods: {
            ...mapActions([
                'handlePermissionResponse',
            ]),

            accept() {
                this.handlePermissionResponse(true);
            },

            deny() {
                this.handlePermissionResponse(false);
            }
        }
    }
</script>