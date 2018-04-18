<template>
    <div>
        <!-- <div v-if="loading" class="type--center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div> -->
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
            loading: true, 
        }
    },

    // created () {
    //         this.$store.subscribe(mutation => {
    //             if (mutation.type === 'GET_FACULTY_PROFILE') {
    //                 this.loading = false; 
    //             }
    //         })
    // },

    components: {
        courseCard
    },

    computed: {
        ...mapGetters([
            'courses',
            'faculty_profile',
        ])
    },
}
</script>
