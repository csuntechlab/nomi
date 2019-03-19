<template>
<div>
    <div v-if="this.courses != null && this.courses.length > 0">
        <course-list-item v-for="course in this.courses" :key="course.title" :course="course"></course-list-item>
    </div>
    <div v-else>
        <empty-course-item></empty-course-item>
    </div>
</div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import courseListItem from './courseListItem.vue';
    import emptyCourseItem from './emptyCourseItem.vue';
    export default {
      name: 'course-list',
      data() {
        return {
              messages: true,
              errors: [],
        };
      },
      created() {
          if (this.courses.length === 1) {
              this.$store.dispatch('getOnlyRoster', {course: this.courses[0].class_number});
          } else {
              console.log('courses is empty broesha!');
          }
      },
      computed: {
        ...mapGetters([
          'courses',
        ]),
      },
      components: {
        courseListItem,
        emptyCourseItem,
      },
    };
</script>
