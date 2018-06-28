<template>
    <modal v-if="showEmail" @close="closeEmailModal">
            <div slot="header"></div>
            <div slot="body">
                <h5 class="textOverflow email_padding">{{this.email}}@my.csun.edu</h5>
            </div>
    </modal>
</template>
<script>
import modal from "../../components/fixed_components/modal.vue";
export default {
        name: "email-modal",

        props: [
            'showEmail',
            'email'
        ],
        components: {
            modal,
        },
        methods: {
            closeEmailModal() {
                this.$emit("closeEmail");
            }
        }
    }
</script>