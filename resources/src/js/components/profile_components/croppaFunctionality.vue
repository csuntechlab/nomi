<template>
<div>
    <div @click="chooseImage()" class="modal-button__container modal-button-photo pull-left">
        <div class="modal-button">
            <div class="type--center"><i class="fa fa-camera fa-2x"></i></div>
        </div>
    </div>
    <div @click="confirmImage()" class="modal-button__container modal-button-confirm pull-right">
        <div class="modal-button">
            <div class="type--center"><i class="fa fa-check fa-2x"></i></div>
        </div>
    </div>
</div>
</template>
<script>
import modal from "../fixed_components/modal.vue";
import { mapGetters, mapActions } from 'vuex';

export default {
        name: "croppa-functionality",
        data: function() {
            return{
                disabled: true,
            }
        },

        computed: {
            ...mapGetters([
                'toggleCroppa'
            ]),

        },

        components: {
            modal
        },

        methods: {
        ...mapActions(['toggleCropping','toggleModal', 'setUploadImage']),
            chooseImage() {
                this.$root.$emit('chooseImage');
            },
                confirmImage() {
                this.$root.$emit('confirmImage');
                this.toggleModal(false);
            },
        },
        beforeDestroy() {
            this.$root.$off('chooseImage');
            this.$root.$off('confirmImage');
        }

    }
</script>