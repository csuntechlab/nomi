<template>
    <div>
        <modal v-if="displayModal" @close="closeCroppaModal">
            <div slot="header"></div>
            <div slot="body">
                <croppa-profile :studentImage="student.images['likeness']"></croppa-profile>
            </div>
            
        </modal>
    </div>
</template>
<script>
    import modal from "../fixed_components/modal.vue";
    import croppaProfile from "./croppaProfile.vue";
    import croppaFunctionality from "./croppaFunctionality";
    import { mapGetters } from 'vuex';
    export default {
        name: "croppa-modal",

        computed: {
            ...mapGetters([
                'permission'
            ]),

            displayModal(){
                return(this.showModal && this.permission);
            }

        },

        props: [
            'showModal',
            'student'
        ],

        components: {
            croppaProfile,
            croppaFunctionality,
            modal
        },

        methods: {
            closeCroppaModal() {
                this.$emit('setImgUrl');
                this.$emit('close');
            }
        }
    }
</script>