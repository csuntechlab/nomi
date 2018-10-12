<template>
    <div>
        <student-list-item v-for="student in this.courses[this.courseid].roster" :key="student.display_name" :student="student"/>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
import studentListItem from './studentListItem.vue';

    export default {
      name: 'student-list',

      data() {
    return {
          show: false,
          messages: true,
          errors: [],
          sortFirstName: true,
          sortAscending: true,
    };
  },

      components: {
        studentListItem,
      },

      props: ['courseid'],

      computed: {
        ...mapGetters(['courses']),
      },

      created() {
        this.loading = true;
      },
    };
</script>