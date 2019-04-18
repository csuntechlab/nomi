<template>
    <div>
        <student-list-item v-for="student in this.students[this.courseid]" :key="student.student_id+':'+student.image_priority" :student="student"/>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import studentListItem from './studentListItem.vue';
    export default {
      name: 'student-list',
      components: {
        studentListItem,
      },
      props: ['courseid'],
      computed: {
        ...mapGetters(['courses', 'students']),
      },
    };
</script>