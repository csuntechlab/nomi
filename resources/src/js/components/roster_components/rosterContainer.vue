<template>
    <div>
        <template v-if="students != null">
            <div v-if="this.list">
                <student-list :courseid="this.courseid"></student-list>
            </div>
            <div v-else>
                <student-matrix :courseid="this.courseid"></student-matrix>
            </div>
        </template>
        <div v-else class="type--center">
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
import studentMatrix from './studentMatrix';
import studentList from './studentList';

    export default {
      name: 'roster-container',

      components: {
        studentMatrix,
        studentList,
      },

      props: [
        'courseid',
      ],

      computed: {
        ...mapGetters([
          'list',
          'students'
        ]),
      },

      created() {
        this.$store.dispatch('nullifyStudentProfile');
      },
    };
</script>
