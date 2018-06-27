<template>
    <div>
        <modal v-if="showModal" @close="closeModal">
            <div slot="header"></div>
            <div slot="body">
                <croppa-profile :studentImage="studentProfile.images['likeness']"></croppa-profile>
            </div>
        </modal>
    </div>
</template>
<script>
    export default {
        name: "croppa-modal",

        props: [
            'showModal',
            'imgURL'
        ],

        data: function () {
            return {

            }
        },

        computed: {
        },

        methods: {
            closeModal() {
                this.$emit('setImgUrl');
            }
        }
    }
</script>