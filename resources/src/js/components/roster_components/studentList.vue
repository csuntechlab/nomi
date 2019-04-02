<template>
    <div v-if="students != null">
        <student-list-item v-for="student in this.students[this.courseid]" :key="student.display_name" :student="student"/>
    </div>
    <div v-else class="type--center">
        <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
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