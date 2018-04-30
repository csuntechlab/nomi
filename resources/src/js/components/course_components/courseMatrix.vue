<template>
    <div>
        <div class="col-xs-6 col-md-4 col-lg-3" v-for="course in courses">
            <course-card :key="course.course_id" :course="course"></course-card>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import courseCard from './courseCard';
export default {
    name: "course-matrix",

    data: function () {
        return {
            show: true,
            messages: true,
            errors: [],
        }
    },

    components: {
        courseCard
    },

    computed: {
        ...mapGetters([
            'courses',
        ])
    },
}
</script>
