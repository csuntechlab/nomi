<template>
<div>
    <div class="modal-button__container pull-left">
        <div class="modal-button">
            <div @click="chooseImage" class="type--center"><i class="fa fa-camera fa-2x"></i></div>
        </div>
    </div>
    <div class="modal-button__container pull-right">
        <div class="modal-button">
            <div @click.prevent="confirmImage" class="type--center"><i class="fa fa-check fa-2x"></i></div>
        </div>
    </div>
</div>
</template>
<script>
import modal from "../fixed_components/modal.vue";
import { mapGetters } from 'vuex';
export default {
        name: "croppa-functionality",

        computed: {
            ...mapGetters([
                'permission'
            ]),

        },

        components: {
            modal
        },

        methods: {
            chooseImage() {
                this.$root.$emit('chooseImage');
            },
            confirmImage() {
                this.$root.$emit('confirmImage');
            }
        }
    }

</script>