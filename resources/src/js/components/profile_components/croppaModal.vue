<template>
    <div>
        <modal v-if="showModal" @close="closeCroppaModal">
            <div slot="header"></div>
            <div slot="body">
                <croppa-profile :studentImage="student.images['likeness']"></croppa-profile>
            </div>
        </modal>
    </div>
</template>
<script>
    import modal from "../../components/fixed_components/modal.vue";
    import croppaProfile from "../profile_components/croppaProfile.vue"
    export default {
        name: "croppa-modal",

        props: [
            'showModal',
            'student'
        ],

        components: {
            croppaProfile,
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