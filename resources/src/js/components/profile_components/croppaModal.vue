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
    import { mapGetters } from 'vuex';
import modal from '../fixed_components/modal.vue';
import croppaProfile from './croppaProfile.vue';

    export default {
      name: 'croppa-modal',

      computed: {
        ...mapGetters([
          'permission',
        ]),

        displayModal() {
          return (this.showModal && !this.permission);
        },

      },

      props: [
        'showModal',
        'student',
      ],

      components: {
        croppaProfile,
        modal,
      },

      methods: {
        closeCroppaModal() {
          this.$emit('setImgUrl');
          this.$emit('close');
        },
      },
    };
</script>