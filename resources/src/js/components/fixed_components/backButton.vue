<template>
    <div v-if="!hideBack">
        <i class="fa fa-angle-left fa-3x back-button" title="Go Back" @click="goBack" data-interactable></i>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
      name: 'back-button',

      methods: {
        goBack() {
            this.$router.push({path: `/class/${this.$route.params.courseID}`})
        },
      },
      computed: {
        ...mapGetters([
          'hideBack',
          'currentCourse',
        ]),
      },
    };
</script>